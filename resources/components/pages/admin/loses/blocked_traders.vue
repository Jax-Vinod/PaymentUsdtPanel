<template>
    <div class="row" id="traders_list">
        <div class="col-lg-12">
            <b-card header="Blocked Traders Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable
                        ref="datatable"
                        title="Blocked Traders"
                        :rows="tableData"
                        :columns="columndata"
                        :columnDefs="columnDefs"
                        @OpenModal="open_modal"
                        url="admin/api/blocked_traders">
                    </datatable>
                </div>
            </b-card>
        </div>
        <b-modal id="modal1" ref="modal1" title="Delete bank" ok-title="Yes" cancel-title="No"
                                                 ok-variant="danger" @ok="deleteItem">
            <p class="my-4">Are you sure want to delete this trader?</p>
        </b-modal>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";
    import ApiService from "resources/common/api.service";
    import miniToastr from 'mini-toastr';
    miniToastr.init();

    export default {
        name: "traders_list",
        id: "traders_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Name', 'UPI', 'Sum', 'Note', 'Agent', 'Created At', 'Action'],
                columndata: [
                    {data: 'name', name: 'name', sortable: false},
                    {data: 'upi', name: 'upi', sortable: false},
                    {data: 'sum', name: 'sum', sortable: false},
                    {data: 'note', name: 'note', sortable: false},
                    {data: 'agent', name: 'agent', sortable: false},
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'action', name: 'action', sortable: true},
                ],
                columnDefs:[{
                        "render": function(data, type, row) {
                            return "<a class='btn btn-info clickable' href='#/admin/trader/edit/" + row.id + "'><i class='fa fa-edit'> </i></a> " +
                            `<button data-item-id=${row.id} class="btn btn-danger delete-item"><i class='fa fa-trash'> </i></button>`
                        },
                        "targets": 6
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
                ApiService.delete('admin/api/traders/' + this.trader_id).then(response => {
                    miniToastr.success("Trader has been deleted successfully", "Success")
                    this.$refs.datatable.reload();
                })
                .catch(function (error) {
                });
            }
        },
        mounted() {
        },
    }
</script>
