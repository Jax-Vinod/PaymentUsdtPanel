<template>
    <div class="row" id="banks_list">
        <div class="col-lg-12">
            <b-card header="Banks Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="banks" :rows="tableData" :columns="columndata" :columnDefs="columnDefs" url="admin/api/banks">
                    </datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";

    export default {
        name: "banks_list",
        id: "banks_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Bank Name', 'Beneficiary Name', 'IFSC', 'Balance', 'Created At', 'Action'],
                columndata: [
                    {data: 'bank_name', name: 'bank_name', sortable: false},
                    {data: 'beneficiary_name', name: 'beneficiary_name', sortable: false},
                    {data: 'ifsc', name: 'ifsc', sortable: false},
                    {data: 'balance', name: 'balance', sortable: false},
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'action', name: 'action', sortable: false},
                ],
                columnDefs:[{
                        "render": function(data, type, row) {
                            return "<a class='btn btn-info clickable' href='#/admin/bank/edit/" + row.id + "'>Edit</a> " +
                            `<button onclick="open_modal(${row.id})" class="btn btn-danger">Delete</button>`
                        },
                        "targets": 5
                    }
                ],
                trader_id: -1
            }
        },
        methods: {
            open_modal(id) {
                this.trader_id = id;
                this.$refs.modal1.show();
            },
            deleteItem() {
                ApiService.delete('admin/api/banks/' + this.trader_id).then(response => {

                })
                .catch(function (error) {
                });
            }
        },
        mounted() {
        },
    }
</script>

<style type="text/css">

</style>
