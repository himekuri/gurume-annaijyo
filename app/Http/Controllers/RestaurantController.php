<?php

namespace App\Http\Controllers;

use Attribute;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    //マスタAPIからジャンルと予算のjsonを取得
    public function genreBudget()
    {
        function getJson($a){
            $response = array();
            $response = json_decode(file_get_contents("https://webservice.recruit.co.jp/hotpepper/${a}/v1/?key=38e884e1cc587c5e&format=json"),true);

            return $response['results'];
        }
        return  json_encode(getJson('genre') + getJson('budget'),JSON_UNESCAPED_UNICODE);
    }

    public function searchRestaurant(Request $request){
        // ジャンルをカンマ区切りの文字列に変更
        if (isset($request->genre)){
            $genre_value = implode(",", $request->genre);
        }else{
            $genre_value = $request->genre;
        }
        $query = [
            'key' => '38e884e1cc587c5e',
            'lat' => $request->lat,
            'lng' => $request->lng,
            'range' => $request->range,
            'genre' => $genre_value,
            'budget' => $request->budget,
            'start' => $request->start,
            'format' => 'json',
        ];
        $url = 'https://webservice.recruit.co.jp/hotpepper/gourmet/v1/?';
        $url .= http_build_query($query);
        $json = file_get_contents($url);
        return $json;

    }
    public function showDetail(Request $request){
        $id = $request->id;
        $url = "http://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=38e884e1cc587c5e&id=${id}&format=json";
        $json = file_get_contents($url);
        return $json;
    }

}
