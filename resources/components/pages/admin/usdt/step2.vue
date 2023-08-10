<template>
    <div class="row">
        <div class="col-lg-12 col-12 mb-3">
            <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <validate tag="div">
                                    <label for="name"> Bank</label>
                                    <select v-model="model.bank_id" id="bank" name="bank_id" class="form-control" size="1" required>
                                        <option value="0" selected disabled>-- Please select --</option>
                                        <option v-for="bank in banks" :value="bank.id">{{ bank.bank_name }}</option>
                                    </select>
                                    <field-messages name="bank_id" show="$invalid && $submitted"
                                                    class="text-danger">
                                        <div slot="required">Bank is a required field</div>
                                    </field-messages>
                                </validate>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <validate tag="div">
                                    <label for="name"> Document</label>
                                    <vue-dropzone ref="product_attachment" id="dropzone"
                                        :options="dropzoneOptions"
                                        @vdropzone-success="onUploaded"
                                        @vdropzone-sending="handleSending"
                                        @vdropzone-removed-file="onRemoved" />
                                    <field-messages name="document" show="$invalid && $submitted"
                                                    class="text-danger">
                                        <div slot="required">Document is a required field</div>
                                    </field-messages>
                                </validate>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <validate tag="div">
                                    <label for="name"> Wallet Address</label>
                                    <input v-model="model.wallet_address" name="wallet_address" id="wallet_address" type="string"
                                            required placeholder="Wallet address" class="form-control"/>
                                    <field-messages name="wallet_address" show="$invalid && $submitted"
                                                    class="text-danger">
                                        <div slot="required">Wallet address is a required field</div>
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
    import JwtService from "resources/common/jwt.service";
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    import miniToastr from 'mini-toastr';
    miniToastr.init();

    Vue.use(VueForm, options);
    export default {
        name: "new_transfer",
        props: ['id'],
        components: {
            vueDropzone: vue2Dropzone,
        },
        data() {
            return {
                csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                banks: [],
                formstate: {},
                model: {
                    id: this.id,
                    documents: [],
                    bank_id: "",
                    wallet_address: ''
                },
                droppedFiles: [],
                show_error:false,
                validationErrors:[],
                dropzoneOptions: {
                    url: '/admin/api/file/upload',
                    thumbnailWidth: 150,
                    maxFilesize: 20,
                    addRemoveLinks: true,
                    dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>SELECT OR DROP FILES TO UPLOAD",
                    headers: { "Authorization": `Bearer ${JwtService.getToken()}`}
                }
            }
        },
        methods: {
            handleSending(file, xhr, formData) {
                formData.append('_token', this.csrfToken);
            },
            onUploaded: function(file, response) {
                console.log('upload response', response);
                this.droppedFiles.push(file.upload.uuid);
                this.model.documents.push(response);
                console.log('docus', this.model.documents);
                console.log('droppedFiles', this.droppedFiles);
            },
            onRemoved: function (file) {
                console.log('remmoved file', file.upload.uuid);
                // const term = this.droppedFiles.find((item) => item === file.upload.uuid);
                const idx = this.droppedFiles.findIndex((element) => element === file.upload.uuid);
                if (idx > -1) {
                    const removedFileUrl = this.model.documents.at(idx);
                    this.model.documents.splice(idx, 1);
                    this.removeFile(removedFileUrl);
                }
            },
            removeFile: function (url) {
                ApiService.post('/admin/api/file/remove', {'file': url})
                    .then(data => {
                        this.show_error = false;
                        // this.show_success = true;
                    })
                    .catch(error => {
                        if (error.response.status == 422) {
                            this.validationErrors = error.response.data.errors;
                            this.show_error = true;
                            this.show_success = false;
                        }
                    })
            },
            onSubmit: function (e) {
                if (this.formstate.$invalid) {
                    return;
                } else {
                    ApiService.post('/admin/api/usdt_purchases/step2', this.model)
                        .then(data => {
                            this.show_error = false;
                            miniToastr.success("Sent payment successfully", "Success")

                            this.model = {
                                documents: [],
                                bank_id: "",
                                wallet_address: ''
                            };
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
            getBanks() {
                ApiService.get('/admin/api/banks/')
                    .then(response => {
                        this.banks = response.data.data;
                    })
            }
        },
        mounted: function () {

        },
        beforeMount() {
            this.getBanks();
        },
        destroyed: function () {

        }
    }
</script>
