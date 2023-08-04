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
                                                <label for="name"> Bank Name</label>
                                                <input v-model="model.bank_name" id="name" name="name" type="text"
                                                       required autofocus placeholder="Bank Name" class="form-control"/>
                                                <field-messages name="name" show="$invalid && $submitted"
                                                                class="text-danger">
                                                    <div slot="required">Bank name is a required field</div>
                                                </field-messages>
                                            </validate>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <validate tag="div">
                                                <label for="beneficiary_name"> Beneficiary Name</label>
                                                <input v-model="model.beneficiary_name" name="beneficiary_name" id="beneficiary_name" type="text"
                                                       required placeholder="Beneficiary Name" class="form-control"/>
                                                <field-messages name="beneficiary_name" show="$invalid && $submitted"
                                                                class="text-danger">
                                                    <div slot="required">Beneficiary name is a required field</div>
                                                    <div slot="beneficiary_name">Beneficiary name is not valid</div>
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
                                                <label for="balance"> Balance</label>
                                                <input v-model="model.balance" name="balance" id="balance" type="number"
                                                       required placeholder="Balance" class="form-control"/>
                                                <field-messages name="balance" show="$invalid && $submitted"
                                                                class="text-danger">
                                                    <div slot="required">Balance is a required field</div>
                                                    <div slot="balance">Balance is not valid</div>
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
                                <div class="col-sm-12" v-show="show_success">
                                    <ul>
                                        <li class="text-success">Bank has been inserted successfully</li>
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

    Vue.use(VueForm, options);
    export default {
        name: "add_bank",
        data() {
            return {
                formstate: {},
                model: {
                    beneficiary_name: "",
                    bank_name: "",
                    ifsc: "",
                    balance: "",
                },
                show_error:false,
                show_success:false,
                validationErrors:[],
            }
        },
        methods: {
            onSubmit: function () {
                if (this.formstate.$invalid) {
                    return;
                } else {
                    ApiService.post('admin/api/banks', this.model)
                        .then(data => {
                            this.show_error = false;
                            this.show_success = true;
                            location.reload();
                        })
                        .catch(error => {
                            if (error.response.status == 422) {
                                this.validationErrors = error.response.data.errors;
                                this.show_error = true;
                                this.show_success = false;
                            }
                        })
                }
            },
            form_reset() {
                this.model = {
                    beneficiary_name: "",
                    bank_name: "",
                    ifsc: "",
                    balance: "",
                };
            }
        },
        mounted: function () {

        },
        destroyed: function () {

        }
    }
</script>
