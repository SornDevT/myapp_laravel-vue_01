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
                                <li class="breadcrumb-item active">Report</li>
                            </ol>
                            <button type="button" class="btn btn-info d-none d-lg-block m-l-15 text-white"><i class="fa fa-plus-circle"></i> Create New</button>
                        </div>
                    </div>
                </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                            <div class="card-title">
                                ສະຫຼຸບລາຍຮັບ-ລາຍຈ່າຍ
                            </div>
                            <div class="text-end">
                                 <div class="btn-group me-2" role="group" aria-label="Basic example"> 
                                                <button type="button" class="btn btn-secondary" @click="monthtype = 'm'"> <i class="mdi mdi-menu-right" v-if="monthtype == 'm'"></i> ເດືອນ</button>
                                                <button type="button" class="btn btn-secondary" @click="monthtype = 'y'"> <i class="mdi mdi-menu-right" v-if="monthtype == 'y'"></i> ປີ</button>
                                            </div>
                                            <input type="date" style="width: 180px;" v-model="dmy" class="form-control me-2">
                                            <button class="btn btn-success text-white me-2" @click="CreateReport()" >
                                                <i class="mdi mdi-view-list"></i> ສະແດງລາຍງານ
                                            </button>
                            </div>

                            <linechart 
                                :chartData="chdata"
                                :chartOptions="chdataop"
                                :update="update_chart"
                                :key="key"
                                v-if="shchart"
                            />
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                   
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="d-flex flex-row">
                                <div class="p-10 bg-info">
                                    <h3 class="text-white box m-b-0"><i class="ti-wallet"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0 text-info">$18090</h3>
                                    <h5 class="text-muted m-b-0">Income</h5></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="d-flex flex-row">
                                <div class="p-10 bg-success">
                                    <h3 class="text-white box m-b-0"><i class="ti-wallet"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0 text-success">$18090</h3>
                                    <h5 class="text-muted m-b-0">Income</h5></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="d-flex flex-row">
                                <div class="p-10 bg-inverse">
                                    <h3 class="text-white box m-b-0"><i class="ti-wallet"></i></h3></div>
                                <div class="align-self-center m-l-20">
                                    <h3 class="m-b-0">$18090</h3>
                                    <h5 class="text-muted m-b-0">Income</h5></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->

                </div>
                   

            </div>

        </div>
    </div>
</div>
</template>

<script>

    import linechart from "../components/LineChart.vue";
    import moment from "moment";

export default {
    name: 'MyappReport',
    components:{
        linechart,moment
    },
    data() {
        return {
            shchart:false,
            update_chart:null,
            chdata:[],
            chdataop:{
                 responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                    yAxes: [
                        {
                        ticks: {
                            display: true,
                            beginAtZero: false,
                            callback: function (value, index, values) {
                            return ( Number(value) .toFixed(0) .replace(/./g, function (c, i, a) { return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c; }) + " ກີບ" );
                            },
                        },
                        gridLines: {
                            show: true,
                        },
                        },
                    ],
                    },
                    tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                        return (
                            Number(tooltipItem.yLabel) .toFixed(0) .replace(/./g, function (c, i, a) { return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c; }) + " ກີບ" );
                        },
                    },
                    mode: "index",
                    intersect: false,
                    },
            },
            monthtype:'m',
            dmy:'',
            key: 0,
            data_income:[],
            data_expense:[],
        };
    },

    mounted() {
        
    },

    methods: {
        CreateReport(){

            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
            axios.post("/api/report", {
            monthtype: this.monthtype,
            dmy: this.dmy,
            })
            .then((response) => {
                //if(response.data.success){
                this.data_income = response.data.income;
                this.data_expense = response.data.expense;


                this.GenGrap();
            })
            .catch((error) => {
                this.loading = false;
                });
            });
        },
        GenGrap() {
                    this.shchart = true;
                    /// ສ້າງກຼາບຂໍ້ມູນປະຈຳເດືອນ
                if (this.monthtype == "m") {
                    this.key++;
                    let re_income = [];
                    let re_expense = [];

                    let y = this.dmy.split("-")[0];
                    let m = this.dmy.split("-")[1];
                    let lastday = this.Getlastday(y, m);

                    //console.log('ຊອກວັນທີ່: '+lastday)

                    let chart_label = [];
                    for (let i = 0; i < lastday; i++) {
                    chart_label.push("ວັນທີ່ " + (i + 1));
                    //console.log(i)
                    }

                    re_income = this.Get_data_chart(lastday, this.data_income) || 0;
                    re_expense = this.Get_data_chart(lastday, this.data_expense) || 0;
                

                    this.chdata = {
                    labels: chart_label,
                    datasets: [
                        {
                        label: "ລາຍຮັບ",
                        fill: false,
                        borderColor: "#3366CC",
                        data: re_income,
                        },
                        {
                        label: "ລາຍຈ່າຍ",
                        fill: false,
                        borderColor: "#DC3912",
                        data: re_expense,
                        },

                    ],
                    };
                    this.update_chart = Math.floor(Math.random() * 100);
                    // ສ້າງກຼາບໃນຮູບແບບຂອງປີ
                } else if (this.monthtype == "y") {
                    this.key++;
                    let re_income = [];
                    let re_expense = [];
                    let chart_label = [
                    "ເດືອນ 1",
                    "ເດືອນ 2",
                    "ເດືອນ 3",
                    "ເດືອນ 4",
                    "ເດືອນ 5",
                    "ເດືອນ 6",
                    "ເດືອນ 7",
                    "ເດືອນ 8",
                    "ເດືອນ 9",
                    "ເດືອນ 10",
                    "ເດືອນ 11",
                    "ເດືອນ 12",
                    ];

                    re_income = this.Get_data_chart_y(12, this.data_income) || 0;
                    re_expense = this.Get_data_chart_y(12, this.data_expense) || 0;

                    this.chdata = {
                    labels: chart_label,
                    datasets: [
                        {
                        label: "ລາຍຮັບ",
                        fill: false,
                        borderColor: "#3366CC",
                        data: re_income,
                        },
                        {
                        label: "ລາຍຈ່າຍ",
                        fill: false,
                        borderColor: "#DC3912",
                        data: re_expense,
                        },
                    ],
                    };
                    this.update_chart = Math.floor(Math.random() * 100);
                }
    },
    Getlastday(y, m) {
      return new Date(y, m + 1, 0).getDate();
    },
    Getday(value) {
      return moment(value).format("DD");
    },
    Getmonth(value) {
      return moment(value).format("MM");
    },
    Getyear(value) {
      return moment(value).format("YYYY");
    },
    Get_data_chart(date, data) {
      ///  console.log(data)
      let new_db_in = [];
      let databack = [];
      for (let y = 0; y < data.length; y++) {
        if (data[y] != "") {
          let day = this.Getday(data[y].created_at);

          new_db_in.push({ price: data[y].price, day: day });
        }
      }
       // console.log(new_db_in)
       
      let update_db_in = new_db_in.reduce((a, c) => {
        let filtered = a.filter((el) => el.day === c.day);
        if (filtered.length > 0) {
          a[a.indexOf(filtered[0])].price =
            parseInt(a[a.indexOf(filtered[0])].price) + parseInt(c.price);
        } else {
          a.push(c);
        }
        return a;
      }, []);
      // console.log(update_db_in)
      for (let i = 0; i < date; i++) {
        let type = true;
        for (let k = 0; k < update_db_in.length; k++) {
          if (update_db_in[k].day == i + 1) {
            if (type) {
              databack.push(update_db_in[k].price);
              type = false;
            }
          }
        }
        if (type) {
          databack.push(0);
          type = false;
        }
      }
      return databack;
    },
    Get_data_chart_y(monthchart, data) {
      let new_db_in = [];
      let databack = [];
      for (let y = 0; y < data.length; y++) {
        if (data[y] != "") {
          let month = this.Getmonth(data[y].created_at);
          new_db_in.push({ price: data[y].price, month: month });
        }
      }

      let update_db_in = new_db_in.reduce((a, c) => {
        let filtered = a.filter((el) => el.month == c.month);
        if (filtered.length > 0) {
          a[a.indexOf(filtered[0])].price =
            parseInt(a[a.indexOf(filtered[0])].price) + parseInt(c.price);
        } else {
          a.push(c);
        }
        return a;
      }, []);

      for (let i = 0; i < monthchart; i++) {
        let type = true;
        for (let k = 0; k < update_db_in.length; k++) {
          if (update_db_in[k].month == i + 1) {
            if (type) {
              databack.push(update_db_in[k].price);
              type = false;
            }
          }
        }
        if (type) {
          databack.push(0);
          type = false;
        }
      }

      return databack;
    },

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