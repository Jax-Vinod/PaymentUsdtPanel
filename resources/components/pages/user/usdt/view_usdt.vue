<template>
    <div class="row">
        <div class="col-lg-12">
            <b-card :header="'Order: '+ model.order_no " header-tag="h4" class="bg-primary-card">
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
                                        USDT requested {{ model.amount }}
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-right" >
                            <div class="timeline-badge bg-primary">
                                <i class="fa fa-arrow-circle-down"></i>
                            </div>
                            <div class="timeline-card p-20" v-if="model.step >= 0">
                                <div class="timeline-heading p-10">
                                    <h4 class="timeline-title">
                                    Send Destination Bank
                                    </h4>
                                </div>
                                <div class="timeline-body p-10">
                                    <step1 :id="model.id" v-if="model.dest_bank_detail === null"></step1>
                                    <div v-else><p class="bank-detail">{{ model.dest_bank_detail }}</p></div>
                                </div>
                            </div>
                            <div class="p-20" v-else></div>
                        </li>
                        <li class="timeline-left" >
                            <div class="timeline-badge bg-primary">
                                <i class="fa fa-arrow-circle-down"></i>
                            </div>
                            <div class="timeline-card p-20" v-if="model.step >= 2">
                                <div class="timeline-heading p-10">
                                    <h4 class="timeline-title">
                                        Received Payment
                                    </h4>
                                </div>
                                <div class="timeline-body p-10">
                                    <img :src="item" v-for="item in JSON.parse(model.document)" alt="" srcset="">
                                    <p class="mt-5">Wallet: {{ model.wallet_address }}</p>
                                </div>
                            </div>
                            <div class="p-20" v-else></div>
                        </li>
                        <li class="timeline-right" >
                            <div class="timeline-badge bg-primary">
                                <i class="fa fa-arrow-circle-down"></i>
                            </div>
                            <div class="timeline-card p-20" v-if="model.step >= 2">
                                <div class="timeline-heading p-10">
                                    <h4 class="timeline-title">
                                        Send USDT
                                    </h4>
                                </div>
                                <div class="timeline-body p-10">
                                    <step3 :id="model.id" v-if="model.txn_hash === null"></step3>
                                    <div v-else>Txn.Hash: <a :href="model.txn_hash">{{ model.txn_hash }}</a> </div>
                                </div>
                            </div>
                            <div class="p-20" v-else></div>
                        </li>
                        <li class="timeline-left" >
                            <div class="timeline-badge bg-primary">
                                <i class="fa fa-arrow-circle-down"></i>
                            </div>
                            <div class="timeline-card p-20" v-if="model.step >= 4">
                                <div class="timeline-heading p-10">
                                    <h4 class="timeline-title">
                                        Approved
                                    </h4>
                                </div>
                                <div class="timeline-body p-10">
                                    <p>
                                        Finished this order.
                                    </p>
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
    import step1 from './step1.vue';
    import step3 from './step3.vue';
    require("resources/common/socket.js");

    Vue.use(VueForm, options);
    export default {
        name: "usdt_timeline",
        components: {
            step1, step3
        },
        data() {
            return {
                formstate: {},
                model: {
                    id: '',
                    order_no: '',
                    amount: "",
                    bank_id: "",
                    txn_hash: "",
                    bank: '',
                    dest_bank_detail: "",
                    wallet_address: "",
                    document: "",
                    step: 0
                },
                show_error:false,
                validationErrors:[],
            }
        },
        methods: {
            getInfo() {
                ApiService.get('api/usdt_orders/' + this.model.id)
                    .then(response => {
                        this.model = response.data;
                    })
            }
        },
        mounted: function () {
            Echo.channel(`UsdtOrder.${this.model.id}`)
                .listen('UsdtOrderEvent', (e) => {
                    console.log('socket', e);
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
