<template>
    <div class="row" id="bank_withdrawals_list">
        <div class="col-lg-12">
            <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
            <div class="row">
                <div class="col-4">
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
                <div class="col-4">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <validate tag="div">
                                <label for="note"> Note</label>
                                <textarea v-model="model.note" name="note" id="note" type="string"
                                        required placeholder="Note" class="form-control"></textarea>
                                <field-messages name="note" show="$invalid && $submitted"
                                                class="text-danger">
                                    <div slot="required">Note is a required field</div>
                                    <div slot="note">Note is not valid</div>
                                </field-messages>
                            </validate>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <div class="col-sm-12" v-show="show_error">
                <ul>
                    <li v-for="error in validationErrors" class="text-danger">{{error[0]}}</li>
                </ul>
            </div>
            <div class="col-sm-12" v-show="show_success">
                <ul>
                    <li class="text-success">Withdrawal has been inserted successfully</li>
                </ul>
            </div>
            </vue-form>
            <b-card header="Bank Withdrawal Table" header-tag="h4" class="bg-primary-card mt-5">
                <div class="table-responsive">
                    <datatable
                        ref="datatable"
                        title="Bank Withdrawal"
                        :rows="tableData"
                        :columns="columndata"
                        url="admin/api/bank_withdrawals">
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
        name: "bank_withdrawals_list",
        id: "bank_withdrawals_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Date', 'Bank', 'Amount', 'Purpose'],
                columndata: [
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'bank', name: 'bank', sortable: false},
                    {data: 'amount', name: 'amount', sortable: true},
                    {data: 'note', name: 'note', sortable: false},
                ],
                columnDefs: [],
                banks: [],
                formstate: {},
                model: {
                    amount: "",
                    bank_id: "",
                    note: "",
                },
                show_error:false,
                show_success:false,
                validationErrors:[],
            }
        },
        methods: {
            onSubmit: function (e) {
                if (this.formstate.$invalid) {
                    return;
                } else {
                    ApiService.post('admin/api/bank_withdrawals', this.model)
                        .then(data => {
                            this.show_error = false;
                            miniToastr.success("Bank Withdrawal has been inserted successfully", "Success")
                            this.model = {
                                amount: "",
                                bank_id: "",
                                note: "",
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
            getBanks() {
                ApiService.get('admin/api/banks/')
                    .then(response => {
                        this.banks = response.data.data;
                    })
            }
        },
        mounted() {
        },
        beforeMount() {
            this.getBanks();
        },
    }
</script>
