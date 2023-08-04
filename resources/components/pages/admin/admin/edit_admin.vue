<template>
    <div class="row">
        <div class="col-lg-12">
            <b-card header="Edit Admin" header-tag="h4" class="bg-success-card">
                <div class="row">
                    <div class="col-lg-12 col-12 mb-3">
                        <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <validate tag="div">
                                                <label for="name" class="font-weight-bold"> Admin Name</label>
                                                <input v-model="model.name" id="name" name="username" type="text"
                                                       required autofocus placeholder="Admin Name" class="form-control"/>
                                                <field-messages name="username" show="$invalid && $submitted"
                                                                class="text-danger">
                                                    <div slot="required">Name is a required field</div>
                                                </field-messages>
                                            </validate>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <validate tag="div">
                                                <label for="email" class="font-weight-bold"> E-mail</label>
                                                <input v-model="model.email" name="email" id="email" type="email"
                                                       required placeholder="E-mail" class="form-control"/>
                                                <field-messages name="email" show="$invalid && $submitted"
                                                                class="text-danger">
                                                    <div slot="required" class="text-danger">Email is a required field
                                                    </div>
                                                    <div slot="email" class="text-danger">Email is not valid</div>
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
                                    <button type="submit" class="btn btn-primary">Update
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
        name: "edit_admin",
        data() {
            return {
                formstate: {},
                model: {
                    user_id: 0,
                    name: "",
                    email: "",
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
                    ApiService.update('admin/api/admins', this.model.user_id, this.model)
                        .then(data => {
                            this.show_error = false;
                            miniToastr.success("Admin has been updated successfully", "Success")
                        })
                        .then(() => {
                            setTimeout(()=>{
                                this.$router.push("/admin/admins");
                            },2000);
                        })
                        .catch(error => {
                            if (error.response.status == 422) {
                                this.validationErrors = error.response.data.errors;
                                this.show_error = true;
                            }
                        })
                }
            },
            getUserInfo() {
                ApiService.get('admin/api/admins/' + this.model.user_id)
                    .then(response => {
                        this.model.email = response.data.email;
                        this.model.name = response.data.name;
                    })
            }
        },
        beforeMount() {
            if(this.$route.params.user_id > 0) {
                this.model.user_id = this.$route.params.user_id;
                this.getUserInfo();
            }
        },
        destroyed: function () {

        }
    }
</script>
