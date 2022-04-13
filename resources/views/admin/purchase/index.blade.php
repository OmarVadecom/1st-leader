@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        فواتير الشراء
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li class="tag tag-info">{{ trans('admin.select') }} <input
                                    type="checkbox" class="checkedAll" name="dels"></li>
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            @if(\Request::get('pur_type'))
                                {!! getCreateBtn(route('purchase.create').'?pur_type=1', 'product.create') !!}
                            @else
                                {!! getCreateBtn(route('purchase.create'), 'product.create') !!}
                            @endif
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
                                    <th>اسم المورد</th>
                                    <th>اجمالي الفاتوره</th>
                                    <th>تاريخ</th>
                                    <th>ملاحظات</th>
                                    <th>{{ trans('admin.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>رقم الفاتوره</th>
                                    <th>اسم المورد</th>
                                    <th>اجمالي الفاتوره</th>
                                    <th>تاريخ</th>
                                    <th>ملاحظات</th>
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
    $(document).ready(function () {
        var t = $('#data').DataTable({
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
            "ajax": "{{ route('admin.purchase.ajax') }}?pur_type={{ \Request::get('pur_type') }}",
            "columns": [{
                    data: null,
                    name: null
                },
                {
                    data: 'select',
                    name: ''
                },
                {
                    data: 'inv',
                    name: 'inv'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'notes',
                    name: 'notes'
                },
                {
                    data: 'action',
                    name: ''
                }
            ],

            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [
                [1, 'asc']
            ]

        });
        t.on('order.dt search.dt', function () {
            t.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    });

</script>
@endsection
