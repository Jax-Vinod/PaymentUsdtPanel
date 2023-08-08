<template>
    <div class="row">
        <div class="col-lg-12">
            <b-card header="Add Bank" header-tag="h4" class="bg-success-card">
                <div class="row">
                    <div class="col-lg-12 col-12 mb-3">
                        <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <validate tag="div">
                                                <label for="bank_name"> Bank Name</label>
                                                <input v-model="model.bank_name" id="bank_name" name="bank_name" type="text"
                                                       required autofocus placeholder="Bank Name" class="form-control"/>
                                                <field-messages name="bank_name" show="$invalid && $submitted"
                                                                class="text-danger">
                                                    <div slot="required">Bank name is a required field</div>
                                                </field-messages>
                                            </validate>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <validate tag="div">
                                                <label for="account_number"> Account Number</label>
                                                <input v-model="model.account_number" name="account_number" id="account_number" type="text"
                                                       required placeholder="Account Number" class="form-control"/>
                                                <field-messages name="account_number" show="$invalid && $submitted"
                                                                class="text-danger">
                                                    <div slot="required">Account Number is a required field</div>
                                                    <div slot="account_number">Account Number is not valid</div>
                                                </field-messages>
                                            </validate>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <validate tag="div">
                                                <label for="ifsc"> IFSC</label>
                                                <input v-model="model.ifsc" name="ifsc" id="ifsc" type="text"
                                                       required placeholder="IFSC" class="form-control"/>
                                                <field-messages name="ifsc" show="$invalid && $submitted"
                                                                class="text-danger">
                                                    <div slot="required">IFSC is a required field</div>
                                                    <div slot="ifsc">IFSC is not valid</div>
                                                </field-messages>
                                            </validate>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <validate tag="div">
                                                <label for="amount"> Total Amount</label>
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
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <validate tag="div">
                                                        <label for="min"> Min.</label>
                                                        <input v-model="model.min" name="min" id="min" type="number"
                                                            required placeholder="Minimum" class="form-control"/>
                                                        <field-messages name="min" show="$invalid && $submitted"
                                                                        class="text-danger">
                                                            <div slot="required">Min is a required field</div>
                                                            <div slot="min">Min is not valid</div>
                                                        </field-messages>
                                                    </validate>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <validate tag="div">
                                                        <label for="max"> Max.</label>
                                                        <input v-model="model.max" name="max" id="max" type="number"
                                                            required placeholder="Maximum" class="form-control"/>
                                                        <field-messages name="max" show="$invalid && $submitted"
                                                                        class="text-danger">
                                                            <div slot="required">Max is a required field</div>
                                                            <div slot="max">Max is not valid</div>
                                                        </field-messages>
                                                    </validate>
                                                </div>
                                            </div>
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
        props: ['id'],
        name: "add_bank",
        data() {
            return {
                formstate: {},
                model: {
                    id: this.id,
                    account_number: "",
                    bank_name: "",
                    ifsc: "",
                    amount: "",
                    min: "",
                    max: "",
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
                    ApiService.post('api/usdt_order/step1', this.model)
                        .then(data => {
                            this.show_error = false;

                            miniToastr.success("Sent bank detail successfully", "Success")

                            this.form_reset()
                            e.target.reset();
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
                    account_number: "",
                    bank_name: "",
                    ifsc: "",
                    amount: "",
                    min: "",
                    max: "",
                };
            }
        },
        mounted: function () {

        },
        destroyed: function () {

        }
    }
</script>
