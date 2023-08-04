<template>
    <div class="row" id="banks_list">
        <div class="col-lg-12">
            <b-card header="Blocked Banks Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="Blocked Banks" :rows="tableData" :columns="columndata" :columnDefs="columnDefs" url="admin/api/blocked_banks">
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
                tableData: ['Beneficiary Name', 'IFSC', 'Balance', 'Created At', 'Action'],
                columndata: [
                    {data: 'beneficiary_name', name: 'beneficiary_name', sortable: false},
                    {data: 'ifsc', name: 'ifsc', sortable: false},
                    {data: 'balance', name: 'balance', sortable: false},
                    {data: 'created_at', name: 'created_at', sortable: true},
                    {data: 'action', name: 'action', sortable: true},
                ],
                columnDefs:[{
                        "render": function(data, type, row) {
                            return "<a class='btn btn-info clickable' href='#/admin/bank/edit/" + row.id + "'><i class='fa fa-edit'> </i></a> " +
                            `<button data-item-id=${row.id} class="btn btn-danger delete-item"><i class='fa fa-trash'> </i></button>`
                        },
                        "targets": 4
                    }
                ],
            }
        },
        methods: {
        },
        mounted() {
        },
    }
</script>
