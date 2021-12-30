<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//マスタAPIからジャンルと予算のjsonを取得
Route::get('/', 'RestaurantController@genreBudget');
// グルメサーチAPIで検索する
Route::get('/result/', 'RestaurantController@searchRestaurant');
// 詳細画面を表示する用
Route::get('/detail/{id}', 'RestaurantController@showDetail');


