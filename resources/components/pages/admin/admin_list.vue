<template>
    <div class="row" id="admins_list">
        <div class="col-lg-12">
            <b-card header="Admins Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="Admins" :rows="tableData" :columns="columndata" url="admin/api/admins_list">
                    </datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";

    export default {
        name: "admins_list",
        id: "admins_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Name', 'Email', 'Password', 'Created At'],
                columndata: [
                    {data: 'name', name: 'name', sortable: false},
                    {data: 'email', name: 'email', sortable: false},
                    {data: 'password_crypt', name: 'password', sortable: false},
                    {data: 'created_at', name: 'created_at', sortable: true},
                ]
            }
        },
        methods: {
        },
        mounted() {
        },
    }
</script>

<style type="text/css">

</style>
