<template>
    <div class="row" id="traders_list">
        <div class="col-lg-12">
            <b-card header="Traders Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="Traders" :rows="tableData" :columns="columndata" url="admin/api/traders_list">
                    </datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";

    export default {
        name: "traders_list",
        id: "traders_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Name', 'Email', 'Created At'],
                columndata: [
                    {data: 'name', name: 'name', sortable: false},
                    {data: 'email', name: 'email', sortable: false},
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
