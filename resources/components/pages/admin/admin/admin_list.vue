<template>
    <div class="row" id="admins_list">
        <div class="col-lg-12">
            <b-card header="Admins Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable
                        ref="datatable"
                        title="Admins"
                        :rows="tableData"
                        :columns="columndata"
                        :columnDefs="columnDefs"
                        @OpenModal="open_modal"
                        url="admin/api/admins">
                    </datatable>
                </div>
            </b-card>
        </div>
        <b-modal id="modal1" ref="modal1" title="Delete admin" ok-title="Yes" cancel-title="No"
                                                 ok-variant="danger" @ok="deleteItem">
            <p class="my-4">Are you sure want to delete this admin?</p>
        </b-modal>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";
    import ApiService from "resources/common/api.service";
    import miniToastr from 'mini-toastr';
    miniToastr.init();
    export default {
        name: "admins_list",
        id: "admins_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Name', 'Email', 'Password', 'Created At', 'Action'],
                columndata: [
                    {data: 'name', name: 'name', sortable: false},
                    {data: 'email', name: 'email', sortable: false},
                    {data: 'password_crypt', name: 'password', sortable: false},
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'action', name: 'action', sortable: false, width: '110px'},
                ],
                columnDefs:[{
                        "render": function(data, type, row) {
                            return "<a class='btn btn-info clickable' href='#/admin/admin/edit/" + row.id + "'><i class='fa fa-edit'> </i></a> " +
                            `<button data-item-id=${row.id} class="btn btn-danger delete-item"><i class='fa fa-trash'> </i></button>`
                        },
                        "targets": 4
                    }
                ],
                admin_id: -1
            }
        },
        methods: {
            open_modal(id) {
                this.admin_id = id;
                this.$refs.modal1.show();
            },
            deleteItem() {
                ApiService.delete('admin/api/admins/' + this.admin_id).then(response => {
                    miniToastr.success("Admin has been deleted successfully", "Success")
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

<style type="text/css">

</style>
