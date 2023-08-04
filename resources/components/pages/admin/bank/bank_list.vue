<template>
    <div class="row" id="banks_list" ref="bankRef">
        <div class="col-lg-12">
            <b-card header="Banks Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable
                        title="banks"
                        :rows="tableData"
                        :columns="columndata"
                        :columnDefs="columnDefs"
                        @OpenModal="open_modal"
                        url="admin/api/banks">
                    </datatable>
                </div>
            </b-card>
        </div>
        <b-modal id="modal1" ref="modal1" title="Delete bank" ok-title="Yes" cancel-title="No"
                                                 ok-variant="danger" @ok="deleteItem">
            <p class="my-4">Are you sure want to delete this bank?</p>
        </b-modal>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";
    import ApiService from "resources/common/api.service";

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
                            `<button data-item-id=${row.id} class="btn btn-danger delete-item">Delete</button>`
                        },
                        "targets": 5
                    }
                ],

                bank_id: -1
            }
        },
        methods: {
            open_modal(id) {
                this.bank_id = id;
                this.$refs.modal1.show();
            },
            deleteItem() {
                ApiService.delete('admin/api/banks/' + this.bank_id).then(response => {
                    location.reload();
                })
                .catch(function (error) {
                });
            }
        },
        mounted() {
        },
    }
</script>
