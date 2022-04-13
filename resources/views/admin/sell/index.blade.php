@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        فواتير مبيعات المعرض
                        <button class="btn btn-danger no-print" id="print">طباعه</button>
                    </h4>
                    <a class="heading-elements-toggle no-print"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements no-print">
                        <ul class="list-inline mb-0">
                            <li class="tag tag-info">{{ trans('admin.select') }} <input type="checkbox"
                                    class="checkedAll" name="dels"></li>
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

                                {!! getCreateBtn(route('sells.create'), 'product.create') !!}
                                {{-- {!! getDeleteBtn(route('admin.product.deletes'), 'products.delete') !!} --}}

                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <table class="table table-striped table-bordered " id="data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>رقم الفاتوره</th>
                                    <th>التاريخ</th>
                                    <th>الزبون</th>
                                    <th width="12%">اجمالي الفاتوره</th>
                                    <th width="20%">{{ trans('admin.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot class="no-print">
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>رقم الفاتوره</th>
                                    <th>تاريخ</th>
                                    <th>الزبون</th>
                                    <th>اجمالي الفاتوره</th>
                                    <th>{{ trans('admin.action') }}</th>
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
    $(document).ready(function() {
    var t =$('#data').DataTable( {
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
        "ajax": "{{ route('admin.sells.ajax') }}",
        "columns": [
           {data: null, name: null, class: 'no-print'},
           {data: 'select', name: '', class: 'no-print'},
           {data: 'code', name: 'code'},
           {data: 'date', name: 'date'},
           {data: 'client', name: 'client'},
           {data: 'total', name: 'total'},
           {data: 'action', name: '', class: 'no-print'}
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
