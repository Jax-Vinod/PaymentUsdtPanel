<template>
    <div class="row" id="trader_transfer_list">
        <div class="col-lg-12">
            <b-card header="Basic Client Table" header-tag="h4" class="bg-primary-card">
                <div class="table-responsive">
                    <datatable title="Trader Transfers" :rows="tableData" :columns="columndata">
                    </datatable>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script type="text/javascript">
    import datatable from "components/plugins/DataTable/DataTable.vue";
    import ApiService from "../../../common/api.service";

    export default {
        name: "trader_transfers_list",
        id: "trader_transfer_list",
        components: {
            datatable
        },
        data() {
            return {
                windowText: null,
                someValueSetOnClick: null,
                tableData: [],
                columndata: [{
                    label: 'ID',
                    field: 'id',
                    numeric: true,
                    html: false,
                }, {
                    label: 'Trader',
                    field: 'trader',
                    numeric: false,
                    html: false,
                }, {
                    label: 'Bank',
                    field: 'bank',
                    numeric: false,
                    html: false,
                },
                {
                    label: 'Amount',
                    field: 'amount',
                    numeric: false,
                    html: false,
                },
                {
                    label: 'Date',
                    field: 'date',
                    numeric: false,
                    html: false,
                },
                 {
                    label: 'Actions',
                    field: 'action',
                    numeric: false,
                    html: true,
                }]
            }
        },
        methods: {
        },
        mounted() {
            ApiService.get('trader_transfers_list').then(response => {
                this.tableData = response.data.data;
                this.tableData.forEach((item, index) => {
                    this.$set(item, "action",
                        "<a class='btn btn-info clickable' href='#/edit_user/" + item.id + "'>Edit</a> " +
                        "<a class='btn btn-warning clickable' href='#/view_user/" + item.id + "'>View</a>");
                });
            })
                .catch(function (error) {
                });
        },
    }
</script>

<style type="text/css">

</style>
