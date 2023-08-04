<template>
    <div class="row" id="traders_list">
        <div class="col-lg-12">
            <b-card header="Blocked Traders Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="Blocked Traders" :rows="tableData" :columns="columndata" :columnDefs="columnDefs" url="admin/api/blocked_traders">
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
                tableData: ['Name', 'UPI', 'Sum', 'Note', 'Created At'],
                columndata: [
                    {data: 'name', name: 'name', sortable: false},
                    {data: 'upi', name: 'upi', sortable: false},
                    {data: 'sum', name: 'sum', sortable: false},
                    {data: 'note', name: 'note', sortable: false},
                    {data: 'created_at', name: 'created_at', sortable: true},
                ],
                columnDefs:[],
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
