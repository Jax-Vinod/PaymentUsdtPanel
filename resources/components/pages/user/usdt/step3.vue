<template>
    <div class="row">
        <div class="col-lg-12">
            <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <validate tag="div">
                                <label for="txn_hash"> Transaction Hash</label>
                                <input v-model="model.txn_hash" id="txn_hash" name="txn_hash" type="text"
                                        required autofocus placeholder="Transaction Hash" class="form-control"/>
                                <field-messages name="txn_hash" show="$invalid && $submitted"
                                                class="text-danger">
                                    <div slot="required">Transaction Hash is a required field</div>
                                </field-messages>
                            </validate>
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
            </vue-form>
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
                    txn_hash: "",
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
                    ApiService.post('api/usdt_order/step3', this.model)
                        .then(data => {
                            this.show_error = false;

                            miniToastr.success("Sent transaction successfully", "Success")

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
                    txn_hash: "",
                };
            }
        },
        mounted: function () {

        },
        destroyed: function () {

        }
    }
</script>
