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
                                                <label for="name"> Trader Name</label>
                                                <input v-model="model.name" id="name" name="name" type="text"
                                                       required autofocus placeholder="Trader Name" class="form-control"/>
                                                <field-messages name="name" show="$invalid && $submitted"
                                                                class="text-danger">
                                                    <div slot="required">Name is a required field</div>
                                                </field-messages>
                                            </validate>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <validate tag="div">
                                                <label for="email"> E-mail</label>
                                                <input v-model="model.email" name="email" id="email" type="email"
                                                       required placeholder="E-mail" class="form-control"/>
                                                <field-messages name="email" show="$invalid && $submitted"
                                                                class="text-danger">
                                                    <div slot="required">Email is a required field</div>
                                                    <div slot="email">Email is not valid</div>
                                                </field-messages>
                                            </validate>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <validate tag="div">
                                                <label for="name"> Trader Phone</label>
                                                <input v-model="model.phone" id="phone" name="phone" type="text"
                                                       required autofocus placeholder="Trader Phone Number" class="form-control"/>
                                                <field-messages name="name" show="$invalid && $submitted"
                                                                class="text-danger">
                                                    <div slot="required">Phone is a required field</div>
                                                </field-messages>
                                            </validate>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <validate tag="div">
                                                <label for="name"> Trader UPI</label>
                                                <input v-model="model.upi" id="upi" name="upi" type="text"
                                                       required autofocus placeholder="Trader UPI" class="form-control"/>
                                                <field-messages name="name" show="$invalid && $submitted"
                                                                class="text-danger">
                                                    <div slot="required">Upi is a required field</div>
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
                                        <li class="text-success">Trader has been inserted successfully</li>
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
        name: "add_user",
        data() {
            return {
                formstate: {},
                model: {
                    name: "",
                    email: "",
                    phone: "",
                    upi: "",
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
                    ApiService.post('admin/api/traders', this.model)
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
                    name: "",
                    email: "",
                    phone: "",
                    upi: "",
                };
            }
        },
        mounted: function () {

        },
        destroyed: function () {

        }
    }
</script>
