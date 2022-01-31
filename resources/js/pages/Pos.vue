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
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Pos</li>
                    </ol>
                    <button
                        type="button"
                        class="btn btn-info d-none d-lg-block m-l-15 text-white"
                    >
                        <i class="fa fa-plus-circle"></i> Create New
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="ຄົ້ນຫາ...."
                            v-model="SearchProduct"
                            @keyup.enter="GetAllStore"
                        />
                    </div>
                </div>

                <div class="row" style="height: 67vh; overflow:auto;">
                        <div class="col-md-3" v-for="list in ProductData.data" :key="list.id">
                                <div class="card cursor-pointer" @click="AddToOrder(list.id)">

                                    <span v-for="listoder in ListOrder" :key="listoder.id"> 
                                            <span v-if="list.id == listoder.id" style="background-color: cornflowerblue;position: absolute; padding: 5px;right: 0px; border-bottom-left-radius: 12px; color: white; font-weight: bold;
                                            "> {{ listoder.order_amount }} </span>
                                    </span>

                                    <img v-if="list.images" class="card-img-top img-responsive" :src="urlLocaltion+'/assets/images/'+list.images" style=" width:100%; height: 140px; object-fit: cover; object-position: center;"  alt="Card image cap">
                                    <img v-if="!list.images" class="card-img-top img-responsive" :src="urlLocaltion+'/assets/images/add_images.png'" alt="Card image cap" style=" width:100%; height: 140px; object-fit: cover; object-position: center;">

                                    <div class="card-body text-center">
                                        <p class="card-text">{{list.name}} </p>
                                         <p class="card-text text-info"> {{formatPrice(list.price_sell)}} kip</p>
                                    </div>
                                </div>
                        </div>
                        
                       
                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-info d-flex justify-content-between">
                            <span><strong> ລວມຍອດເງິນ: </strong></span>
                            <span><strong>{{ formatPrice(totalAmount) }} ກີບ</strong></span>
                        </h4>
                        <button
                            type="button"
                            class="btn btn-success text-white mb-2"
                            style="width: 100%"
                            :disabled="checkPay"
                            @click="BtPay"
                        >
                            <i class="mdi mdi-currency-usd"></i> ຊຳລະເງິນ
                        </button>
                        <div
                            class="table-responsive"
                            style="height: 65vh; overflow: auto"
                        >
                            <table class="table color-table muted-table border">
                                <thead>
                                    <tr>
                                        <th>ລາຍການ</th>
                                        <th width="120" class="text-center">
                                            ລາຄາ
                                        </th>
                                        <th width="130" class="text-end">
                                            ຍອດລວມ (<i @click="DelAll()" class="mdi mdi-close-circle text-danger cursor-pointer"></i>)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in ListOrder" :key="item.id">
                                        <td>{{ item.name }}</td>
                                        <td class="text-end">{{ formatPrice(item.price_sell) }}  <br>
                                            <i @click="DelOne(item.id)" class="mdi mdi-minus-circle text-info cursor-pointer"></i>
                                           {{item.order_amount}} 
                                           <i @click="AddOne(item.id)" class="mdi mdi-plus-circle text-info cursor-pointer"></i> | 
                                           <i @click="DelOneList(item.id)" class="mdi mdi-close-circle text-danger cursor-pointer"></i>
                                        </td>
                                        <td class="text-end">{{ formatPrice(item.price_sell*item.order_amount) }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="Modal_Pay" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">ຊຳລະສິນຄ້າ</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                             <div class="modal-body">
                                               <h4 class="card-title text-info d-flex justify-content-between">  <span> <strong> ລວມຍອດເງິນ: </strong></span> <span><strong>{{formatPrice(totalAmount)}} ກີບ</strong></span>  </h4>
                                               <h4 class="card-title text-info d-flex justify-content-between">  <span> <strong> ຮັບເງິນນຳລູກຄ້າ: </strong></span> <span><strong>{{formatPrice(CashAmount)}} ກີບ</strong></span>  </h4>
                                               <h4 class="card-title text-danger d-flex justify-content-between" v-if="CashBack>0">  <span> <strong> ເງິນທອນ: </strong></span> <span><strong>{{formatPrice(CashBack)}} ກີບ</strong></span>  </h4>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" v-model="CashAmount" style="text-align:right;" >
                                                    </div>
                                                 <div class="p-2 justify-content-center d-flex">
                                                        <div class="row" style="width:250px">
                                                        <div class="col-4 text-center  mt-2">
                                                            <a  class="btn btn-primary btn-lg text-white" @click="AddNum(1)" style="width:60px">1</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(2)" style="width:60px">2</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(3)" style="width:60px">3</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(4)" style="width:60px">4</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(5)" style="width:60px">5</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <button type="button" class="btn btn-primary btn-lg text-white" @click="AddNum(6)" style="width:60px">6</button>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(7)" style="width:60px">7</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(8)" style="width:60px">8</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(9)" style="width:60px">9</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum('00')" style="width:60px">00</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a class="btn btn-primary btn-lg text-white" @click="AddNum(0)" style="width:60px">0</a>
                                                        </div>
                                                        <div class="col-4 text-center mt-2">
                                                            <a  class="btn btn-danger btn-lg text-white" @click="AddNum('-')" style="width:60px"><i class="fas fa-long-arrow-alt-left"></i></a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center d-flex mt-2 text-center">
                                                        <button type="button" class="btn btn-success" @click="ConfirmPay"  style="width:180px;" :disabled="CheckCPay"><i class="fas fa-coins"></i> ຍືນຍັນຊຳລ່ະເງິນ </button>
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info waves-effect text-white" data-bs-dismiss="modal">ປິດ</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
</div>
</template>

<script>
export default {
    name: "MyappPos",

    data() {
        return {
            ProductData:[],
            SearchProduct:'',
            urlLocaltion: window.location.origin,
            ListOrder:[],
            CashAmount:'',
        };
    },
    computed:{
        totalAmount(){
            return this.ListOrder.reduce((num, item) => num + item.price_sell * item.order_amount,0 )
        },
        checkPay(){
            if(this.totalAmount>0)
            {
                return false
            } else {
                return true
            }
        },
        CashBack(){
            return parseInt(this.CashAmount)-parseInt(this.totalAmount)
        },
        CheckCPay(){
             if((parseInt(this.CashAmount)-parseInt(this.totalAmount))>=0){
                    return false
                } else { return true }
        }
    },

    methods: {
        ConfirmPay(){

            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
            axios.post("/api/transection/add",{
                acc_type:'income',
                listorder: this.ListOrder
            })
                .then((response) => {
                if (response.data.success) {
                    $('#Modal_Pay').modal('hide');
                    this.ListOrder = [];
                    this.CashAmount = '';
                    this.GetAllStore();
                } else {
                    console.log(response.data.message);
                }
                })
                .catch((error) => {
                console.log(error);
                });
            });

        },
        AddNum(num){
            if(num=='-'){
                this.CashAmount = this.CashAmount.slice(0,-1)
            } else {
                this.CashAmount = this.CashAmount+num
            }
        },
        BtPay(){
            $('#Modal_Pay').modal('show');
        },
        AddOne(id){
                let item = this.ProductData.data.find((i)=>i.id==id);
                if(this.ListOrder.find((i)=>i.id==id)){
                        let old_order_amount = this.ListOrder.find((i)=>i.id==id).order_amount;
                        if((item.amount-old_order_amount)>0){
                            this.ListOrder.find((i)=>i.id==id).order_amount = old_order_amount+1;
                        } else { 
                            this.$swal.fire({
                            icon: 'error',
                            title: 'ຜິດຜາດ!',
                            text: 'ສິນຄ້າໝົດສະຕ໋ອກ!',
                            })
                        }
                   }
        },
        DelOne(id){
            //let item = this.ProductData.data.find((i)=>i.id==id);
            if(this.ListOrder.find((i)=>i.id==id)){
                        let old_order_amount = this.ListOrder.find((i)=>i.id==id).order_amount;
                        if((old_order_amount-1)>0){
                            this.ListOrder.find((i)=>i.id==id).order_amount = old_order_amount-1;
                        } else {
                            this.ListOrder.splice(this.ListOrder.map(i=>i.id).indexOf(id),1);
                        }
                   }
        },
        DelOneList(id){
            this.ListOrder.splice(this.ListOrder.map(i=>i.id).indexOf(id),1);
        },
        DelAll(){
            this.ListOrder = []
        },
        GetAllStore(page){
		this.$axios.get("/sanctum/csrf-cookie").then((response) => {
			axios.get(`/api/store?page=${page}&s=${this.SearchProduct}`).then((response) => {
                        this.ProductData = response.data;
						//console.log(response.data)
                    }).catch((error) => {
                        console.log(error);
                    })
			});
		},
        formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(",", ".");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
        AddToOrder(id){
            let item = this.ProductData.data.find((i)=>i.id==id);
                if(this.ListOrder.find((i)=>i.id==id)){
                   // alert('ມີໃນລາຍການ')
                   let old_order_amount = this.ListOrder.find((i)=>i.id==id).order_amount;
                   if(item.amount-old_order_amount>0){
                       this.ListOrder.find((i)=>i.id==id).order_amount = old_order_amount+1
                   } else {
                      //// alert('ສິນຄ້າໝົດ!')
                        this.$swal.fire({
                            icon: 'error',
                            title: 'ຜິດຜາດ!',
                            text: 'ສິນຄ້າໝົດສະຕ໋ອກ!',
                            })
                   }
                } else {
                    if(item.amount>0){
                        this.ListOrder.push({
                            id: item.id,
                            name: item.name,
                            price_sell: item.price_sell,
                            order_amount: 1
                        });
                    } else {
                        //alert('ບໍ່ມີສິນຄ້າ')
                        this.$swal.fire({
                            icon: 'error',
                            title: 'ຜິດຜາດ!',
                            text: 'ສິນຄ້າໝົດສະຕ໋ອກ!',
                            })
                    }
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

<style lang="scss" scoped></style>
