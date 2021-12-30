<template>
<div class="un_result">
	<button type="button" class="el_btn el_backButton" onClick='history.back();'><i class="fas fa-arrow-circle-left"></i> 戻る</button>
	<p class="bl_count">全{{number}}件</p>
	<div class="bl_restaurants">
		<div class="bl_restaurantBox" v-for="(restaurant, index) in restaurants" :key="index" v-on:click="$router.push({ name: 'detail', params: {id: restaurant.id} })">
			<div class="bl_logoImg"><img :src="restaurant.photo.mobile.s" alt="店舗画像"></div>
			<div class="bl_textArea">
				<div class="bl_title">
					<p class="bl_genreName">{{restaurant.genre.name}}</p>
					<p class="bl_name">{{restaurant.name}}</p>
				</div>
				<p class="bl_catch">{{restaurant.catch}}</p>
				<div class="bl_informationArea">
					<p class="bl_budgedAverage"><i class="fas fa-yen-sign"></i>　{{restaurant.budget.average}}</p>
					<p class="bl_access"><i class="fas fa-map-marker-alt"></i>　{{restaurant.mobile_access}}</p>
				</div>
			</div>
		</div>
	</div>
	<paginate
		:page-count="page"
		:page-range="3"
		:margin-pages="2"
		:click-handler="clickCallback"
		:prev-text="'＜'"
		:next-text="'＞'"
		:container-class="'pagination'"
		:page-class="'page-item'">
	</paginate>
</div>

</template>
<script>
export default {
	data() {
		return {
			number:'0',
          	restaurants: {},
			parPage: 10,
     		currentPage: 1,
			start: 1,
			page:0,
        }
	},
	methods: {
		clickCallback(pageNum) {
			this.currentPage = Number(pageNum);
			this.getRestaurants();
		},
		getRestaurants() {
			let current = this.currentPage * this.parPage;
       		this.start = current - this.parPage + 1;
			axios.get('/api/result/'+ location.search + '&start=' + this.start)
				.then((res) => {
					let result = res.data['results'];
					this.number = result['results_available'];
					this.restaurants = result['shop'];
					this.page = Math.ceil(this.number / this.parPage);
			});
        }
	},
	mounted() {
		this.getRestaurants();
	}

}
</script>
