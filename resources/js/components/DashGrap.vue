<template>
    <div>
         <div class="row g-0">
					<div class="col-lg-3 col-md-6">
						<div class="card border">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="d-flex no-block align-items-center">
											<div>
												<h3><i class="ti-stats-up"></i></h3>
												<p class="text-muted">ລາຍຮັບ</p>
											</div>
											<div class="ms-auto">
												<h3 class="counter text-primary">{{ formatPrice(sum_income) }} ກີບ</h3>
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
												<h3><i class="ti-stats-down"></i></h3>
												<p class="text-muted">ລາຍຈ່າຍ</p>
											</div>
											<div class="ms-auto">
												<h3 class="counter text-cyan"> {{ formatPrice(sum_expense) }} ກີບ </h3>
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
												<h3><i class="ti-pie-chart"></i></h3>
												<p class="text-muted">ກຳໄລ</p>
											</div>
											<div class="ms-auto">
												<h3 class="counter text-purple"> {{ formatPrice(sum_profit) }} ກີບ </h3>
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
												<h3><i class="ti-package"></i></h3>
												<p class="text-muted">ສະຕ໋ອກສິນຄ້າ</p>
											</div>
											<div class="ms-auto">
												<h3 class="counter text-success"> {{formatPrice(sum_store)}} </h3>
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
    </div>
</template>

<script>
export default {
    name: 'MyappDashgrap',

    data() {
        return {
            data_income:[],
            data_expense:[],
            data_store:[],
        };
    },

    mounted() {
        
    },
    computed:{
        sum_income(){
        return this.data_income.reduce((num, item) => num + item.price, 0);
        },
        sum_expense(){
            return this.data_expense.reduce((num, item) => num + item.price, 0);
        },
        sum_profit(){
            return this.sum_income-this.sum_expense;
        },
        sum_store(){
            return this.data_store.reduce((num, item) => num + item.amount, 0);
        },
    },
    methods: {
         formatPrice(value) {
            if(value==null || value==''){ return 0;} else {
                let val = (value / 1).toFixed(0).replace(",", ".");
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        },
        GetData(){
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                axios
                .post("/api/report/dashgrap")
                .then((response) => {
                    this.data_income = response.data.income;
                    this.data_expense = response.data.expense;
                    this.data_store = response.data.store;
                })
                .catch((error) => {
                    this.loading = false;
                });
            });
        }
    },
    created(){
        this.GetData();
    }
};
</script>

<style lang="scss" scoped>

</style>