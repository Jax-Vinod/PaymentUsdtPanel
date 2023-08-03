<template>
    <div class="row" id="notices_list">
        <div class="col-lg-12">
            <b-card header="notices Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="notices" :rows="tableData" :columns="columndata" :columnDefs="columnDefs" url="api/notices">
                    </datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";

    export default {
        name: "notices_list",
        id: "notices_list",
        components: {
            datatable
        },
        data() {
            return {
                tableData: ['Date', 'Trader', 'Document'],
                columndata: [
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'trader', name: 'trader', sortable: false},
                    {data: 'document', name: 'document', sortable: false},
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
