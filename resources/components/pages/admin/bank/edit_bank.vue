<template>
    <div class="row">
        <div class="col-lg-12">
            <b-card header="Edit Bank" header-tag="h4" class="bg-success-card">
                <div class="row">
                    <div class="col-lg-12 col-12 mb-3">
                        <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <validate tag="div">
                                                <label for="name" class="font-weight-bold"> Bank Name</label>
                                                <input v-model="model.bank_name" id="name" name="username" type="text"
                                                       required autofocus placeholder="Bank Name" class="form-control"/>
                                                <field-messages name="username" show="$invalid && $submitted"
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
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <validate tag="div">
                                                <label for="name"> Status</label>
                                                <select v-model="model.is_active" id="is_active" name="is_active" class="form-control" size="1" required>
                                                    <option value="1" :selected="model.is_active === 1">Active</option>
                                                    <option value="0" :selected="model.is_active === 0">Inactive</option>
                                                </select>
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
                                    <button type="submit" class="btn btn-primary">Update</button>
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
        name: "edit_Bank",
        data() {
            return {
                formstate: {},
                model: {
                    bank_id: 0,
                    beneficiary_name: "",
                    bank_name: "",
                    ifsc: "",
                    balance: "",
                    is_active: true
                },
                show_error: false,
                validationErrors: [],
            }
        },
        methods: {
            onSubmit: function () {
                if (this.formstate.$invalid) {
                    return;
                } else {
                    ApiService.update('admin/api/banks', this.model.bank_id, this.model)
                        .then(data => {
                            this.show_error = false;
                            miniToastr.success("Bank has been updated successfully", "Success")
                        })
                        .catch(error => {
                            if (error.response.status == 422) {
                                this.validationErrors = error.response.data.errors;
                                this.show_error = true;
                            }
                        })
                }
            },
            getBankInfo() {
                ApiService.get('admin/api/banks/' + this.model.bank_id)
                    .then(response => {
                        this.model.bank_name = response.data.bank_name;
                        this.model.beneficiary_name = response.data.beneficiary_name;
                        this.model.ifsc = response.data.ifsc;
                        this.model.balance = response.data.balance;
                        this.model.is_active = response.data.is_active;
                    })
            }
        },
        beforeMount() {
            if(this.$route.params.bank_id > 0) {
                this.model.bank_id = this.$route.params.bank_id;
                this.getBankInfo();
            }
        },
        destroyed: function () {

        }
    }
</script>
