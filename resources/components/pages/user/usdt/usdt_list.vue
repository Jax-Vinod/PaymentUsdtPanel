<template>
    <div class="row" id="usdt_purchases_list">
        <div class="col-lg-12">
            <b-card header="USDT Order Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="USDT Order" :rows="tableData" :columns="columndata" :columnDefs="columnDefs" url="api/usdt_orders">
                    </datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";

    export default {
        name: "usdt_purchases_list",
        id: "usdt_purchases_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Date', 'Manager', 'Document', 'Status', 'Action'],
                columndata: [
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'admin', name: 'admin', sortable: false},
                    {data: 'document', name: 'document', sortable: false},
                    {data: 'status', name: 'status', sortable: false},
                    {data: 'action', name: 'action', sortable: false},
                ],
                columnDefs: []
            }
        },
        methods: {
        },
        mounted() {
        },
    }
</script>
