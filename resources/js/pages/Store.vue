<template>
<div class="page-wrapper">
        <div class="container-fluid">

                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Dashboard 1</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb justify-content-end">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Store</li>
                            </ol>
                            <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</button>
                        </div>
                    </div>
                </div>

        <div class="row g-0">
					<div class="col-lg-3 col-md-6">
						<div class="card border">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="d-flex no-block align-items-center">
											<div>
												<h3><i class="icon-screen-desktop"></i></h3>
												<p class="text-muted">MYNEW CLIENTS</p>
											</div>
											<div class="ms-auto">
												<h2 class="counter text-primary">23</h2>
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="progress">
											<div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="card border">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="d-flex no-block align-items-center">
											<div>
												<h3><i class="icon-note"></i></h3>
												<p class="text-muted">NEW PROJECTS</p>
											</div>
											<div class="ms-auto">
												<h2 class="counter text-cyan">169</h2>
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="progress">
											<div class="progress-bar bg-cyan" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="card border">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="d-flex no-block align-items-center">
											<div>
												<h3><i class="icon-doc"></i></h3>
												<p class="text-muted">NEW INVOICES</p>
											</div>
											<div class="ms-auto">
												<h2 class="counter text-purple">157</h2>
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="progress">
											<div class="progress-bar bg-purple" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6">
						<div class="card border">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="d-flex no-block align-items-center">
											<div>
												<h3><i class="icon-bag"></i></h3>
												<p class="text-muted">All PROJECTS</p>
											</div>
											<div class="ms-auto">
												<h2 class="counter text-success">431</h2>
											</div>
										</div>
									</div>
									<div class="col-12">
										<div class="progress">
											<div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

                <div class="col-12">
                        <div class="card">
                            <div class="card-body">
								<!-- {{FormShow}} -->
                                <div class="d-flex justify-content-between">
									<div>
<h4 class="card-title">ລາຍການສະຕ໋ອກສິນຄ້າ </h4>
									</div>
									
									<div>
										<button type="button" v-if="FormShow" @click="CheckFormAdd()"   class="btn waves-effect waves-light btn-success me-2">ບັນທຶກ</button>
										<button type="button" v-if="FormShow" @click="Cancel()" class="btn waves-effect waves-light btn-danger me-2">ຍົກເລີກ</button>
										<button type="button" v-if="!FormShow" @click="AddNew()" class="btn waves-effect waves-light btn-info">ເພີ່ມໃໝ່</button>
									</div>
								</div>
									<!-- {{FormData}}
										<hr> 
										ສະຖານະຟອມ: {{FormType}} -->
								<div class="row" v-if="FormShow">
									<div class="col-md-3 p-2">
								
										<img :src="imagePreview" class="mb-2" style="width:100%" alt="">
										<input type="file" class="form-control " @change="onSeclected">
									</div>
									<div class="col-md-9"> 
										
										<div class="form-group" :class="hasDangerName">
												<label for="produc-name" class="form-label">ຊື່ສິນຄ້າ</label>
												<input type="text" class="form-control" :class="inputDangerName" id="product-name" v-model="FormProduct.name"  placeholder="ປ້ອນຊື່ສິນຄ້າ...">
												
                                    	</div>

										<!-- <div class="form-group mt-5 row">
											<label for="produc-name" class="col-2 col-form-label">ຊື່ສິນຄ້າ</label>
											<div class="col-10">
												<input class="form-control" type="text" v-model="FormProduct.name"  placeholder="ປ້ອນຊື່ສິນຄ້າ..." id="product-name">
											</div>
										</div> -->
										<div class="form-group" :class="hasDangerAmount">
												<label for="produc-amount" class="form-label" >ຈຳນວນ</label>
												<input type="number" class="form-control" id="product-amount" :class="inputDangerAmount"  v-model="FormProduct.amount" placeholder="ຈຳນວນສິນຄ້າ...">
												
                                    	</div>
										
										<!-- <div class="form-group mt-5 row">
											<label for="produc-amount" class="col-2 col-form-label">ຈຳນວນ</label>
											<div class="col-10">
												<cleave 
												class="form-control" 
												:options="option" 
												v-model="FormProduct.amount"  
												placeholder="ຈຳນວນສິນຄ້າ..." 
												id="produc-amount"/>

											</div>
										</div> -->

										<div class="row">
												<div class="col-md-6">
														<div class="form-group" :class="hasDangerPriceBuy">
																<label for="price-buy" class="form-label">ລາຄາຊື້</label>
																<cleave type="text" class="form-control" :class="inputDangerPriceBuy" id="price-buy" :options="option"  v-model="FormProduct.price_buy" placeholder="ລາຄາຊື້..."/>
																
														</div>
												</div>
												<div class="col-md-6">
													<div class="form-group" :class="hasDangerPriceSell">
															<label for="price-sell" class="form-label" >ລາຄາຂາຍ</label>
															<cleave type="text" class="form-control" :class="inputDangerPriceSell" id="price-sell" :options="option"  v-model="FormProduct.price_sell"  placeholder="ລາຄາຂາຍ..."/>
															
													</div>
												</div>
										</div>
									</div>

								</div>
                               
                                <div class="table-responsive" v-if="!FormShow">
									<div class="row pt-3 pb-3">
										<div class="col-md-6">

										</div>
										<div class="col-md-6">
											<div class="input-group">
												<input type="text" v-model="SearchProduct" @keyup.enter="GetAllStore()" class="form-control" placeholder="ຄົ້ນຫາ..." >
											</div>
										</div>
									</div>
									
                                    <table class="table border color-table purple-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ຊື່ສິນຄ້າ</th>
                                                <th>ຈຳນວນ</th>
                                                <th>ລາຄາຊື້</th>
                                                <th>ຈັດການ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="list in FormData.data" :key="list.id">
                                                <td width="30">{{list.id}}</td>
                                                <td>{{list.name}}</td>
                                                <td> {{formatPrice(list.amount)}} </td>
                                                <td>{{formatPrice(list.price_buy)}}</td>
                                                <td width="150" class="text-center"> 
													<button type="button" @click="EditPro(list.id)" class="btn btn-info btn-circle text-white me-2"><i class="ti-pencil"></i> </button> 
													<button type="button" @click="DelPro(list.id)" class="btn btn-danger btn-circle text-white"><i class="ti-trash"></i> </button>
													 </td>
                                            </tr>
                                         
                                           
                                        </tbody>
                                    </table>
									<pagination :pagination="FormData" @paginate="GetAllStore($event)" :offset="4" />
                                </div>
                            </div>
                        </div>
                    </div>
		</div>
        </div>
</template>

<script>
export default {
    name: 'MyappHome',

    data() {
        return {
			FormData:[],
            FormShow: false,
			FormType: true, // formType = ture (ເພີ່ມຂໍ້ມູນໃໝ່), formType = false (ອັບເດດຂໍ້ມູນ)
			FormID:'',
			urllocaltion: window.location.origin,
			imagePreview: window.location.origin+"/assets/images/add_images.png",
			FormProduct: {
				name:'',
				amount:'',
				price_buy:'',
				price_sell:''
			},
			imageProduct:'',
			ProductName:'',
			option:{
				//prefix: '$',
				numeral: true,
				numeralPositiveOnly: true,
				noImmediatePrefix: true,
				rawValueTrimPrefix: true,
				numeralIntegerScale: 10,
				numeralDecimalScale: 2,
				numeralDecimalMark: '.',
				delimiter: ','
			},
			hasDangerName:'',
			inputDangerName:'',
			hasDangerAmount:'',
			inputDangerAmount:'',
			hasDangerPriceBuy:'',
			inputDangerPriceBuy:'',
			hasDangerPriceSell:'',
			inputDangerPriceSell:'',
			SearchProduct:'',
        };
    },

    mounted() {
        
    },

	computed:{
		checkForm(){
			if(this.FormProduct.name == "" || this.FormProduct.amount == "" || this.FormProduct.price_buy == "" || this.FormProduct.price_sell == "" )
			{
				return "disabled";
			} else {
				return "";
			}
		}

	},
	watch:{
		SearchProduct(){
			if(this.SearchProduct==''){
				this.GetAllStore()
			}
		}
	},
    methods: {
		GetAllStore(page){
		this.$axios.get("/sanctum/csrf-cookie").then((response) => {
			axios.get(`/api/store?page=${page}&s=${this.SearchProduct}`).then((response) => {
					//	if (response.data.success) {
                        this.FormData = response.data;
					//	}else{
					//		 console.log(response.data.message);
					//	}
						//)
                    }).catch((error) => {
                        console.log(error);
                    })
			});
		},
		AddNew(){
			this.FormShow = true
			 this.imagePreview = window.location.origin+"/assets/images/add_images.png"
			 this.FormProduct.name = ''
			this.FormProduct.amount = ''
			this.FormProduct.price_buy = ''
			this.FormProduct.price_sell = ''
		},
		Cancel(){
			this.FormShow = false
		},
		SaveForm(){

			if(this.FormType){
				//console.log(this.FormProduct);
				// this.FormData.push({
				// 	id: Math.floor(Math.random() * 1000),
				// 	name: this.FormProduct.name,
				// 	amount: this.FormProduct.amount,
				// 	price_buy: this.FormProduct.price_buy,
				// 	price_sell: this.FormProduct.price_sell
				// });

				
					let formData = new FormData();
					formData.append('name', this.FormProduct.name);
					formData.append('amount', this.FormProduct.amount);
					formData.append('price_buy', this.FormProduct.price_buy);
					formData.append('price_sell', this.FormProduct.price_sell);
					formData.append('file', this.imageProduct);
					formData.append('acc_type','expense');
				this.$axios.get("/sanctum/csrf-cookie").then((response) => {
				axios.post("/api/store/add", formData ,{headers:{ "Content-Type": "multipart/form-data"}})
					.then((response) => {
						this.GetAllStore();
						
							// if (response.data.success) {
							// 		console.log('ບັນທຶກ ຂໍ້ມູນສຳເລັດ');
							// } else {
							// 	console.log(response.data.message);
							// }
					})
					.catch((error) => {
					console.log(error);
					})
			 });



			} else {
				///console.log('ມີການອັບເດດ ID: '+this.FormID)
				// this.FormData.find((i)=>i.id == this.FormID).name = this.FormProduct.name
				// this.FormData.find((i)=>i.id == this.FormID).amount = this.FormProduct.amount
				// this.FormData.find((i)=>i.id == this.FormID).price_buy = this.FormProduct.price_buy
				// this.FormData.find((i)=>i.id == this.FormID).price_sell = this.FormProduct.price_sell


					let formData = new FormData();
					formData.append('name', this.FormProduct.name);
					formData.append('amount', this.FormProduct.amount);
					formData.append('price_buy', this.FormProduct.price_buy);
					formData.append('price_sell', this.FormProduct.price_sell);
					formData.append('file', this.imageProduct);

				axios.post(`/api/store/update/${this.FormID}`, formData ,{headers:{ "Content-Type": "multipart/form-data"}})
					.then((response) => {
						
						this.GetAllStore();

					// if (response.data.success) {
					// 	this.GetAllStore();
					// } else {
					// 	console.log(response.data.message);
					// }
					})
					.catch((error) => {
					console.log(error);
					});
			}
			
			//console.log('ບັນທຶກແລ້ວ')

			this.FormProduct.name = ''
			this.FormProduct.amount = ''
			this.FormProduct.price_buy = ''
			this.FormProduct.price_sell = ''
			this.FormShow = false
			this.FormType = true
				
		},
		EditPro(id){
			//console.log(id)
			//let item = this.FormData.find((i)=>i.id == id)
			//console.log(item)


			axios.get(`/api/store/edit/${id}`)
                    .then((response) => {
						console.log(response)

						this.FormProduct.name = response.data.name
						this.FormProduct.amount = response.data.amount
						this.FormProduct.price_buy = response.data.price_buy
						this.FormProduct.price_sell = response.data.price_sell
						//this.imageProduct = response.data.images
						 if(response.data.images){
                            this.imagePreview = window.location.origin+"/assets/images/"+response.data.images;
                        } else {
                            this.imagePreview = window.location.origin+"/assets/images/add_images.png";
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    })


			this.FormShow = true
			
			
			// ປ່ຽນສະຖານະ ຟອມໃຫ້ເປັນການອັບເດດ
			this.FormType = false
			this.FormID = id

		},
		DelPro(id){
			//ແບບເຕັມ
			//let index = this.FormData.map((i)=>i.id).indexOf(id)
			//this.FormData.splice(index,1)
			
			this.$swal({
				title: 'ທ່ານແນ່ໃຈບໍ່?',
				text: 'ທີ່ຈະລຶບຂໍ້ມູນນີ້',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ຍືນຍັນລຶບ!',
				cancelButtonText: 'ຍົກເລີກ',
			}).then((result) => {
				if(result.isConfirmed){

					// ແບບຫຍໍ້
					//this.FormData.splice(this.FormData.map((i)=>i.id).indexOf(id),1)

					
					axios.delete(`/api/store/delete/${id}`)
						.then((response) => {
							//this.FormData = response.data;
							//if (response.data.success) {
								this.GetAllStore();
								//}
						})
						.catch((error) => {
							console.log(error);
						});
			

					this.$swal.fire(
						'ລະບົບໄດ້ຖຶກລຶບແລ້ວ',
						'',
						'info',
					)
				}
			});

			

		},
		formatPrice(value) {
			let val = (value / 1).toFixed(0).replace(",", ".");
			return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		},
		CheckFormAdd()
		{
			if(this.FormProduct.name==''){
				this.hasDangerName = 'has-danger'
				this.inputDangerName = 'form-control-danger'
			} else {
				this.hasDangerName = ''
				this.inputDangerName = ''
			}

			if(this.FormProduct.amount==''){
				this.hasDangerAmount = 'has-danger'
				this.inputDangerAmount = 'form-control-danger'
			} else {
				this.hasDangerAmount = ''
				this.inputDangerAmount = ''
			}

			if(this.FormProduct.price_buy==''){
				this.hasDangerPriceBuy = 'has-danger'
				this.inputDangerPriceBuy = 'form-control-danger'
			} else {
				this.hasDangerPriceBuy = ''
				this.inputDangerPriceBuy = ''
			}
			

			if(this.FormProduct.price_sell==''){
				this.hasDangerPriceSell = 'has-danger'
				this.inputDangerPriceSell = 'form-control-danger'
			} else {
				this.hasDangerPriceSell = ''
				this.inputDangerPriceSell = ''
			}

			if(this.FormProduct.name != "" && this.FormProduct.amount != "" && this.FormProduct.price_buy != "" && this.FormProduct.price_sell != "" )
			{
				this.SaveForm()
			} 

			
		},
		onSeclected(event){
		this.imageProduct = event.target.files[0];
			//console.log(this.imageProduct)
			let reader = new FileReader();
			reader.readAsDataURL(this.imageProduct)
			reader.addEventListener("load", function(){
				this.imagePreview = reader.result;
			}.bind(this), false)
		}
        
    },
	created(){

		this.GetAllStore();
	},
	beforeRouteEnter(to, from, next) {
    if (!window.Laravel.isLoggedin) {
      window.location.href = "/login";
    }
    next();
  },
};
</script>

<style lang="scss" scoped>

</style>