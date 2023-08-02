<template>
    <div class="row" id="agents_list">
        <div class="col-lg-12">
            <b-card header="Agents Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="Agents" :rows="tableData" :columns="columndata" :columnDefs="columnDefs" url="admin/api/agents">
                    </datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";

    export default {
        name: "agents_list",
        id: "agents_list",
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
                    {data: 'action', name: 'action', sortable: false},
                ],
                columnDefs:[{
                        "render": function(data, type, row) {
                            return "<a class='btn btn-info clickable' href='#/admin/agent/edit/" + row.id + "'>Edit</a> " +
                            `<button onclick="open_modal(${row.id})" class="btn btn-danger">Delete</button>`
                        },
                        "targets": 4
                    }
                ],
                agent_id: -1
            }
        },
        methods: {
            open_modal(id) {
                this.agent_id = id;
                this.$refs.modal1.show();
            },
            deleteItem() {
                ApiService.delete('admin/api/agents/' + this.agent_id).then(response => {

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
