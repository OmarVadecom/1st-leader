@extends($pLayout. 'master')
@section('content')
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @if(request('type') === '0')
                            اوامر الشراء المحليه
                            <button class="btn btn-danger no-print" id="print">طباعه</button>
                        @else
                            اوامر الشراء الدوليه
                            <button class="btn btn-danger no-print" id="print">طباعه</button>
                        @endif
                    </h4>
                    <a class="heading-elements-toggle no-print"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements no-print">
                        <ul class="list-inline mb-0">
                            <li class="tag tag-info">{{ trans('admin.select') }} <input type="checkbox"
                                                                                        class="checkedAll" name="dels"></li>
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard table-responsive">
                        <table class="table table-striped table-bordered " id="data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>رقم الامر</th>
                                    <th>المورد</th>
                                    <th>اجمالي عرض السعر</th>
                                    <th>فاتورة الشراء</th>
                                    @if(in_array(auth()->id(), [1, 7, 9]))
                                        <th class="headpr">{{ trans('admin.action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot class="no-print">
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>رقم العرض</th>
                                    <th>المورد</th>
                                    <th>اجمالي عرض السعر</th>
                                    <th>فاتورة الشراء</th>
                                    @if(in_array(auth()->id(), [1, 7, 9]))
                                        <th class="headpr">{{ trans('admin.action') }}</th>
                                    @endif
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
        "ajax": "{{ route('admin.purchases-orders-ajax.ajax') }}?type={{ $type }}",
        "columns": [
           {data: null, name: null, class: 'no-print'},
           {data: 'select', name: '', class: 'no-print'},
           {data: 'num', name: 'num'},
           {data: 'supplier', name: 'supplier'},
           {data: 'total', name: 'total'},
           {data: 'purchase', name: 'purchase'},
           @if(in_array(auth()->id(), [1, 7, 9]))
            {data: 'action', name: '', class: 'no-print'}
           @endif
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
<style>
    @media print {

        .headpr,
        .pagination,
        .dataTables_info,
        #data_filter,
        .dataTables_length {
            display: none !important;
            ;
        }

        td:last-child {
            display: none;
        }

        .pagination {
            display: none;
        }

        body.vertical-layout.vertical-menu.menu-expanded .content,
        body.vertical-layout.vertical-menu.menu-expanded .footer {
            margin-right: 0px !important;
        }

        .table-responsive {
            overflow-x: inherit !important;
        }

        .heading-elements .list-inline {
            display: none !important;
        }
    }

    .table td {
        padding: 0.75rem 1rem;
    }
</style>
@endsection
