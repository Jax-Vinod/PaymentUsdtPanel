<template>
    <div class="card-body">
        <div class="tab-content p-3 border table-responsive" id="nav-tabContent">
            <table class="table dataTable display stripe table dt-responsive nowrap" id="dataTable">
                <thead>
                    <tr>
                        <th v-for="row in rows">{{row}}</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
    </div>
</template>

<script>
    var $ = require( "jquery" );
    import 'datatables.net-dt';
    import 'datatables.net-responsive-dt';
    import 'datatables.net-jqui';
    import 'datatables.net-bs5';
    import 'datatables.net-responsive-bs5';
    import JwtService from "resources/common/jwt.service";
    export default {
        props: ['url', 'rows', 'columns', 'columnDefs'],
        data() {
            return {
                table: null,
            }
        },
        methods: {
            open_modal(id) {
                this.$emit('OpenModal', id);
            }
        },
        mounted() {
            var self = this;
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                aLengthMenu: [[10, 30, 50, 75, -1], [10, 30, 50, 75, "All"]],
                pageLength: 10,
                // dom: '<"justify-content-between top-information"lf>rt<"justify-content-between bottom-information"ip><"clear">',
                ajax: {
                    url: this.url,
                    'beforeSend': function (request) {
                        request.setRequestHeader("Authorization", `Bearer ${JwtService.getToken()}`);
                    }
                },
                order: [
                    [0, 'desc']
                ],
                columns: this.columns,
                columnDefs: this.columnDefs,
                drawCallback: function( settings ) {
                    $(".delete-item").on( 'click', function (e) {
                       self.open_modal(e.target.dataset.itemId)
                    });
                }
            });
        }
    }
</script>
