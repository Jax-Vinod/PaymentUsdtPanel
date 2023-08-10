<template>
    <div class="row">
        <div class="col-lg-12">
            <b-card header="USDT Purchase" header-tag="h4" class="bg-primary-card">
                <div class="timeline-container pt-4 pb-2 mb-3">
                    <ul class="timeline ">
                        <li class="timeline-left" >
                            <div class="timeline-badge bg-primary">
                                <i class="fa fa-arrow-circle-down"></i>
                            </div>
                            <div class="timeline-card p-20">
                                <div class="timeline-heading p-10">
                                    <h4 class="timeline-title">
                                        Created an Order
                                    </h4>
                                </div>
                                <div class="timeline-body p-10">
                                    <p>
                                        You requested {{ model.amount }}
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-right" >
                            <div class="timeline-badge bg-primary">
                                <i class="fa fa-arrow-circle-down"></i>
                            </div>
                            <div class="timeline-card p-20" v-if="model.step >= 1">
                                <div class="timeline-heading p-10">
                                    <h4 class="timeline-title">
                                    Agent Sent Destination Bank
                                    </h4>
                                </div>
                                <div class="timeline-body p-10">
                                    <p class="bank-detail">{{ model.dest_bank_detail }}</p>
                                </div>
                            </div>
                            <div class="p-20" v-else></div>
                        </li>
                        <li class="timeline-left" >
                            <div class="timeline-badge bg-primary">
                                <i class="fa fa-arrow-circle-down"></i>
                            </div>
                            <div class="timeline-card p-20" v-if="model.step >= 1">
                                <div class="timeline-heading p-10">
                                    <h4 class="timeline-title">
                                        Send Money From Source Bank
                                    </h4>
                                </div>
                                <div class="timeline-body p-10">
                                    <step2 :id="model.id" v-if="model.bank_id === null"></step2>
                                    <div v-else>
                                        <img :src="item" v-for="item in JSON.parse(model.document)" alt="" srcset="">
                                    </div>
                                </div>
                            </div>
                            <div class="p-20" v-else></div>
                        </li>
                        <li class="timeline-right" >
                            <div class="timeline-badge bg-primary">
                                <i class="fa fa-arrow-circle-down"></i>
                            </div>
                            <div class="timeline-card p-20" v-if="model.step >= 3">
                                <div class="timeline-heading p-10">
                                    <h4 class="timeline-title">
                                    Agent Sent USDT
                                    </h4>
                                </div>
                                <div class="timeline-body p-10">
                                    <div >Txn.Hash: {{ model.txn_hash }}</div>
                                </div>
                            </div>
                            <div class="p-20" v-else></div>
                        </li>
                        <li class="timeline-left" >
                            <div class="timeline-badge bg-primary">
                                <i class="fa fa-arrow-circle-down"></i>
                            </div>
                            <div class="timeline-card p-20" v-if="model.step >= 3">
                                <div class="timeline-heading p-10">
                                    <h4 class="timeline-title">
                                        Payment Done
                                    </h4>
                                </div>
                                <div class="timeline-body p-10">
                                    <div v-if="model.step === 3">
                                        <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onApprove">
                                            <div class="col-sm-12" v-show="show_error">
                                                <ul>
                                                    <li v-for="error in validationErrors" class="text-danger">{{error[0]}}</li>
                                                </ul>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Approve</button>
                                        </vue-form>
                                    </div>
                                    <div v-else>
                                        <p>Finished this order</p>
                                    </div>
                                </div>
                            </div>
                            <div class="p-20" v-else></div>
                        </li>
                    </ul>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue';
    import VueForm from "vue-form";
    import options from "src/validations/validations.js";
    import ApiService from "resources/common/api.service";
    import miniToastr from 'mini-toastr';
    miniToastr.init();
    require("resources/common/socket.js");

    import step2 from './step2.vue';

    Vue.use(VueForm, options);
    export default {
        name: "usdt_timeline",
        components: {
            step2
        },
        data() {
            return {
                formstate: {},
                model: {
                    id: '',
                    amount: "",
                    bank_id: "",
                    bank: '',
                    dest_bank_detail: "",
                    wallet_address: "",
                    document: "",
                    txn_hash: "",
                    step: 0
                },
                show_error:false,
                validationErrors:[],
            }
        },
        methods: {
            onApprove: function (e) {
                if (this.formstate.$invalid) {
                    return;
                } else {
                    ApiService.post('/admin/api/usdt_purchases/approve', this.model)
                        .then(data => {
                            this.show_error = false;

                            miniToastr.success("Approved successfully", "Success")

                        })
                        .catch(error => {
                            if (error.response.status == 422) {
                                this.validationErrors = error.response.data.errors;
                                this.show_error = true;
                            }
                        })
                }
            },
            getInfo() {
                ApiService.get('admin/api/usdt_purchases/' + this.model.id)
                    .then(response => {
                        this.model = response.data;
                    })
            }
        },
        mounted: function () {
            Echo.channel(`UsdtOrder.${this.model.id}`)
                .listen('UsdtOrderEvent', (e) => {
                    console.log('socket', e.order);
                    this.model = e.order;
                });
        },
        beforeMount() {
            if(this.$route.params.id > 0) {
                this.model.id = this.$route.params.id;
                this.getInfo();
            }
        },
        destroyed: function () {

        }
    }
</script>
<style src="../../../../css/timeline.css" scoped></style>
<style>
.bank-detail {
    white-space: break-spaces;
}
.timeline-container > img {
    width: 100%;
}
</style>
