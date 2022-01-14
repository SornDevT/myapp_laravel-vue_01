<template>
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
                        />
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-info d-flex justify-content-between">
                            <span><strong> ລວມຍອດເງິນ: </strong></span>
                            <span><strong>0 ກີບ</strong></span>
                        </h4>
                        <button
                            type="button"
                            disabled=""
                            class="btn btn-success text-white mb-2"
                            style="width: 100%"
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
                                            ຍອດລວມ (<i
                                                class="mdi mdi-close-circle text-danger cursor-pointer"
                                            ></i
                                            >)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "MyappPos",

    data() {
        return {};
    },

    mounted() {},

    methods: {},
};
</script>

<style lang="scss" scoped></style>
