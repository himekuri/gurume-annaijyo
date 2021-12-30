<template>
	<div class="un_search">
		<img class="bl_logoImg" src="image/logo.png" alt="グルメ案内所">
		<div id="box1" class="bl_searchBox" v-show="activeBox === 'box1'">
			<div class="bl_searchText">
				STEP1 （1/3）<br>現在地からの距離を選んでください
			</div>
			<div class="bl_selectWrap">
				<select name="range" class="bl_select" v-model="rangeValue">
					<option value="1">300m以内</option>
					<option value="2">500m以内</option>
					<option value="3">1000m以内</option>
					<option value="4">2000m以内</option>
					<option value="5">3000m以内</option>
				</select>
			</div>

			<div class="hp_flexEnd">
				<button type="button" class="el_btn hp_widthFull" v-on:click="getLocation">
					次へ進む <i class="fas fa-arrow-right"></i>
				</button>
			</div>
		</div>
		<div id="box2" class="bl_searchBox" v-show="activeBox === 'box2'">
			<button type="button" class="el_btn el_backButton" v-on:click="setActiveBox('box1')"><i class="fas fa-arrow-circle-left"></i> 戻る</button>
			<div class="el_backButton"></div>
			<div class="bl_searchText">
				STEP２ （2/3）<br>お店のジャンルを選んでください(任意)
			</div>
			<div class="bl_checkGenre">
				<label v-for="(genre, index) in genres" :key="index">
					<input type="checkbox" name="genre" :value="genre.code" v-model="genreValue">
					{{ genre.name }}
				</label>
			</div>
			<div class="hp_flexEnd">
				<button type="button" class="el_btn hp_widthFull" v-on:click="setActiveBox('box3')">
					次へ進む <i class="fas fa-arrow-right"></i>
				</button>
			</div>
		</div>
		<div id="box3" class="bl_searchBox" v-show="activeBox === 'box3'">
			<button class="el_btn el_backButton" v-on:click="setActiveBox('box2')"><i class="fas fa-arrow-circle-left"></i> 戻る</button>
			<div class="bl_searchText">
				STEP３ （3/3）<br>予算を選んでください
			</div>
			<div class="bl_selectWrap">
				<select name="budget" id="budget" class="bl_select" v-model="budgetValue">
					<option v-for="(budget, index) in budgets" :key="index" :value="budget.code">{{ budget.name }}</option>
				</select>
			</div>
			<div class="hp_flexEnd">
				<router-link v-bind:to="{name: 'result', query: { lat: lat, lng: lng, range: rangeValue, 'genre[]': genreValue, budget:budgetValue}}">
					<button type="button" class="el_btn hp_widthFull">
						<i class="fas fa-search"></i> 探す
					</button>
				</router-link>
			</div>
		</div>
		<!-- モーダルウィンドウ -->
		<div id="overlay" v-show="showModal">
			<div id="modal">
				<p>{{error}}</p>
				<button class="hp_flexEnd" v-on:click="closeModal">OK</button>
    		</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				lat: '',
				lng: '',
				error: '',
				genres: [],
				budgets: [],
				showModal: false,
				activeBox: 'box1',
				rangeValue: '1',
				genreValue: [],
				budgetValue: 'B002',
			}
		},

		methods: {
			// Geolocation APIに対応しているか判定
   			getLocation() {
				if (!navigator.geolocation) {
					this.error = 'お使いのブラウザでは現在地の取得ができません。'
					// モーダルの表示
					this.openModal();
				}
				else{
					// 位置情報を取得する
					navigator.geolocation.getCurrentPosition( this.successFunc ,this.errorFunc ) ;
				}
			},
			// 位置情報の取得に成功したとき
			successFunc(position) {
				this.lat = position.coords.latitude
				this.lng = position.coords.longitude
				this.setActiveBox('box2');
			},
			// 位置情報の取得に失敗したとき
			errorFunc(error) {
				if (error.code == 1){
					this.error = '現在地の取得ができません。設定を確認してください。'
				}
				else{
					this.error = '現在地の取得ができません。'
				}
				this.openModal();
			},

			// ジャンルと予算の取得
			getGenreBudget() {
			    axios.get('/api/')
			        .then((res) => {
						this.genres = res.data['genre']
						this.budgets = res.data['budget']
			        });
			},

			// modal
			openModal() {
				this.showModal = true
			},
			closeModal() {
				this.showModal = false
    		},

			setActiveBox(boxName){
				this.activeBox = boxName
			},
		},
		mounted() {
            this.getGenreBudget();
        }
	}

</script>
