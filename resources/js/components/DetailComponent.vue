<template>
<div class="un_detail">
	<button type="button" class="el_btn el_backButton" onClick='history.back();'><i class="fas fa-arrow-circle-left"></i> 戻る</button>
	<div class="detailBox">
		<div class="bl_img" v-if="restaurant.photo"><img :src="restaurant.photo.pc.l" alt="店舗画像"></div>
		<div class="bl_detailTitle">
			<div class="bl_genreName" v-if="restaurant.genre">{{restaurant.genre.name}}</div>
			<div class="bl_name">{{restaurant.name}}</div>
		</div>
		<div class="bl_catch">{{restaurant.catch}}</div>
		<div class="bl_detailItem">
			<p class="detailLabel">平均予算</p>
			<p class="bl_budgetAverage" v-if="restaurant.budget">{{restaurant.budget.average}}</p>
		</div>
		<div class="bl_detailItem">
			<p class="detailLabel">住所</p>
			<p class="bl_access">{{restaurant.address}}</p>
		</div>
		<div class="bl_detailItem">
			<p class="detailLabel">アクセス</p>
			<p class="bl_adress">{{restaurant.access}}</p>
		</div>
		<div class="bl_detailItem">
			<p class="detailLabel">営業時間</p>
			<p class="bl_open">{{restaurant.open}}</p>
		</div>
		<div class="bl_detailItem">
			<p class="detailLabel">定休日</p>
			<p class="bl_close">{{restaurant.close}}</p>
		</div>
	</div>
</div>

</template>
<script>
export default {
	data: function () {
		return {
			id: this.$route.params.id,
			restaurant: {}
		}
	},
	methods: {
		getDetail() {
			axios.get('/api/detail/' + this.id)
				.then((res) => {
					let result = res.data['results'];
					let restaurants = result['shop'];
					let content = Object.entries(restaurants)[0];
					this.restaurant = content[1];
				});
		}
	},
	mounted() {
		this.getDetail();
	}
}
</script>
