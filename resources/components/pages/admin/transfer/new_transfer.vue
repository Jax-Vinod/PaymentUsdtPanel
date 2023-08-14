<template>
    <div class="row">
        <div class="col-lg-12">
            <b-card header="Add Trader" header-tag="h4" class="bg-success-card">
                <div class="row">
                    <div class="col-lg-12 col-12 mb-3">
                        <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
                            <div class="row">
                                <div class="col-lg-6">
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
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <validate tag="div">
                                                <label for="name"> Bank</label>
                                                <select v-model="model.bank_id" id="bank" name="bank_id" class="form-control" size="1" required>
                                                    <option value="0" selected disabled>-- Please select --</option>
                                                    <option v-for="bank in banks" :value="bank.id">{{ bank.beneficiary_name }}</option>
                                                </select>
                                                <field-messages name="bank_id" show="$invalid && $submitted"
                                                                class="text-danger">
                                                    <div slot="required">Bank is a required field</div>
                                                </field-messages>
                                            </validate>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" v-show="show_error">
                                    <ul>
                                        <li v-for="error in validationErrors" class="text-danger">{{error[0]}}</li>
                                    </ul>
                                </div>
                                <div class="col-md-offset-4 col-md-8 m-t-25">
                                    <button type="submit" class="btn btn-primary">Submit
                                    </button>
                                    <button type="reset" class="btn btn-effect-ripple btn-secondary  reset_btn1"
                                            @click="form_reset">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </vue-form>
                    </div>
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

    Vue.use(VueForm, options);
    export default {
        name: "new_transfer",
        data() {
            return {
                banks: [],
                traders: [],
                formstate: {},
                model: {
                    amount: "",
                    trader_id: "",
                    bank_id: "",
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
                    ApiService.post('admin/api/transfers', this.model)
                        .then(data => {
                            this.show_error = false;
                            miniToastr.success("Transfer has been created successfully", "Success")

                            this.form_reset()
                            e.target.reset();
                        })
                        .then(() => {
                            setTimeout(()=>{
                                this.$router.push("/admin/transfers");
                            },500);
                        })
                        .catch(error => {
                            if (error.response.status == 422) {
                                this.validationErrors = error.response.data.errors;
                                this.show_error = true;
                            }
                        })
                }
            },
            form_reset() {
                this.model = {
                    amount: "",
                    trader_id: "",
                    bank_id: "",
                };
            },
            getBanks() {
                ApiService.get('admin/api/banks/')
                    .then(response => {
                        this.banks = response.data.data;
                    })
            },
            getTraders() {
                ApiService.get('admin/api/traders/')
                    .then(response => {
                        this.traders = response.data.data;
                    })
            }
        },
        mounted: function () {

        },
        beforeMount() {
            this.getBanks();
            this.getTraders();
        },
        destroyed: function () {

        }
    }
</script>
