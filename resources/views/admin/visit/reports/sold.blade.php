@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        منتجات تم بيعها
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <table class="table table-striped table-bordered " id="data">
                         <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>اسم المنتج</th>
                                <th>الكميه المباعه</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>اسم المنتج</th>
                                <th>الكميه المباعه</th>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection


@section('script')
<script type="text/javascript">
	$(document).ready(function(){
    var t =$('#data').DataTable({
        "processing": true,
            "language": {
            "sUrl": lang
        },
        "ordering": true,
        "pagingType": "full_numbers",
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: 25,
        "fixedHeader": true,
        "responsive": true,
        "ajax": "{{ route('admin.sold.ajax') }}",
        "columns": [
           {data: null, name: null},
           {data: 'select', name: ''},
           {data: 'product', name: 'product'},
           {data: 'quantity', name: 'quantity'},
        ],
        "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            "order": [[ 1, 'asc' ]]

    });
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
});
</script>
@endsection