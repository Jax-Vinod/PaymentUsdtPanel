<template>
    <div class="row" id="chargeback_list">
        <div class="col-lg-12">
            <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
            <div class="row">
                <div class="col-4">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <validate tag="div">
                                <label for="name"> Trader</label>
                                <select v-model="model.trader_id" id="trader" name="trader_id" class="form-control" size="1" required>
                                    <option value="0" selected disabled>-- Please select --</option>
                                    <option v-for="trader in traders" :value="trader.id">{{ trader.name }}</option>
                                </select>
                                <field-messages name="trader_id" show="$invalid && $submitted"
                                                class="text-danger">
                                    <div slot="required">Trader is a required field</div>
                                </field-messages>
                            </validate>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <validate tag="div">
                                <label for="amount"> Amount</label>
                                <input v-model="model.amount" name="amount" id="amount" type="number"
                                        required placeholder="Amount" class="form-control"/>
                                <field-messages name="amount" show="$invalid && $submitted"
                                                class="text-danger">
                                    <div slot="required">Amount is a required field</div>
                                    <div slot="amount">Amount is not valid</div>
                                </field-messages>
                            </validate>
                        </div>
                    </div>
                </div>
                <div class="col-4" style="align-self: center;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <div class="col-sm-12" v-show="show_error">
                <ul>
                    <li v-for="error in validationErrors" class="text-danger">{{error[0]}}</li>
                </ul>
            </div>
            </vue-form>
            <b-card header="Chargeback Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable
                        ref="datatable"
                        title="Chargeback"
                        :rows="tableData"
                        :columns="columndata"
                        url="admin/api/chargebacks">
                    </datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";
    import Vue from 'vue';
    import VueForm from "vue-form";
    import options from "src/validations/validations.js";
    import ApiService from "resources/common/api.service";
    import miniToastr from 'mini-toastr';
    miniToastr.init();

    Vue.use(VueForm, options);
    export default {
        name: "chargebacks_list",
        id: "chargeback_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Date', 'Trader', 'Amount'],
                columndata: [
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'trader', name: 'trader', sortable: false},
                    {data: 'amount', name: 'amount', sortable: true},
                ],
                columnDefs: [],
                traders: [],
                formstate: {},
                model: {
                    amount: "",
                    trader_id: "",
                },
                show_error:false,
                validationErrors:[],
            }
        },
        methods: {
            onSubmit: function (e) {
                if (this.formstate.$invalid) {
                    return;
                } else {
                    ApiService.post('admin/api/chargebacks', this.model)
                        .then(data => {
                            this.show_error = false;
                            miniToastr.success("Chargeback has been inserted successfully", "Success")

                            this.model = {
                                amount: "",
                                trader_id: "",
                            },
                            e.target.reset();

                            this.$refs.datatable.reload();
                        })
                        .catch(error => {
                            if (error.response.status == 422) {
                                this.validationErrors = error.response.data.errors;
                                this.show_error = true;
                            }
                        })
                }
            },
            getTraders() {
                ApiService.get('admin/api/traders/')
                    .then(response => {
                        this.traders = response.data.data;
                    })
            }
        },
        mounted() {
        },
        beforeMount() {
            this.getTraders();
        },
    }
</script>
