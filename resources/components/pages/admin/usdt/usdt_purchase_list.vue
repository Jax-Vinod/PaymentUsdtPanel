<template>
    <div class="row" id="usdt_purchases_list">
        <div class="col-lg-12">
            <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
                <div class="row">
                    <div class="col-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <validate tag="div">
                                    <!-- <label for="name"> Agent</label> -->
                                    <select v-model="model.agent_id" id="agent" name="agent_id" class="form-control" size="1" required>
                                        <option value="0" selected disabled>-- Please select --</option>
                                        <option v-for="agent in agents" :value="agent.id">{{ agent.name }}</option>
                                    </select>
                                    <field-messages name="agent_id" show="$invalid && $submitted"
                                                    class="text-danger">
                                        <div slot="required">Agent is a required field</div>
                                    </field-messages>
                                </validate>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <validate tag="div">
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
                        <button type="submit" class="btn btn-primary">Request Now</button>
                    </div>
                </div>
                <div class="col-sm-12" v-show="show_error">
                    <ul>
                        <li v-for="error in validationErrors" class="text-danger">{{error[0]}}</li>
                    </ul>
                </div>
            </vue-form>
            <b-card header="USDT Purchase Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable
                        title="USDT Purchase"
                        :rows="tableData"
                        :columns="columndata"
                        :columnDefs="columnDefs"
                        url="admin/api/usdt_purchases">
                    </datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script type="text/javascript">
    import Vue from 'vue';
    import VueForm from "vue-form";
    import options from "src/validations/validations.js";
    import ApiService from "resources/common/api.service";
    import datatable from "components/plugins/DataTable/DataTable.vue";

    Vue.use(VueForm, options);
    export default {
        name: "usdt_purchases_list",
        id: "usdt_purchases_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Date', 'Manager', 'Amount', 'Source Bank', 'Dest Bank', 'Document', 'Status', 'Action'],
                columndata: [
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'admin', name: 'admin', sortable: false},
                    {data: 'amount', name: 'amount', sortable: true},
                    {data: 'source_bank', name: 'source_bank', sortable: false},
                    {data: 'dest_bank_detail', name: 'dest_bank_detail', sortable: false},
                    {data: 'document', name: 'document', sortable: false},
                    {data: 'status', name: 'status', sortable: false},
                    {data: 'action', name: 'action', sortable: false},
                ],
                columnDefs:[{
                    "render": function(data, type, row) {
                            return "<a class='btn btn-info clickable' href='#/admin/usdt_purchase/view/" + row.id + "'><i class='fa fa-eye'> </i></a> ";
                        },
                        "targets": 7
                    }
                ],
                formstate: {},
                model: {
                    amount: "",
                    agent_id: -1
                },
                show_error:false,
                validationErrors:[],
                agents: []
            }
        },
        methods: {
            onSubmit: function (e) {
                if (this.formstate.$invalid) {
                    return;
                } else {
                    ApiService.post('admin/api/usdt_purchases', this.model)
                        .then(response => {
                            this.show_error = false;
                            this.model = {
                                amount: "",
                            },
                            e.target.reset();
                            location.href='#/admin/usdt_purchase/view/'+response.data.id;

                        })
                        .catch(error => {
                            if (error.response.status == 422) {
                                this.validationErrors = error.response.data.errors;
                                this.show_error = true;
                            }
                        })
                }
            },
            getAgents() {
                ApiService.get('admin/api/agents/')
                    .then(response => {
                        this.agents = response.data.data;
                    })
            }
        },
        mounted() {
        },
        beforeMount() {
            this.getAgents();
        },
    }
</script>
