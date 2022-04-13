@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        الزبائن
                        @if(\Request::get('category_id'))
                            @php
                                $cuscat=\App\Models\CustomerCategory::find(\Request::get('category_id'));
                            @endphp
                            (قسم {{ $cuscat->name }})

                        @elseif(\Request::get('parent_id'))
                            @php
                                $cuscat=\App\Models\Customers::find(\Request::get('parent_id'));
                            @endphp
                            (للعميل الرئيسي {{ $cuscat->name }})

                        @endif
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            {!! getCreateBtn(route('customers.create'), 'users.create') !!}
                            <!--<li><a data-action="reload" onclick="getContant()"><i class="icon-reload"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            <li><a data-action="close"><i class="icon-cross2"></i></a></li>-->
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
                                    <th>الاسم</th>
                                    <th>اسم المسئول</th>
                                    <th>رقم الجوال</th>
                                    <th>الفرعي</th>
                                    <th>{{ trans('admin.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>الاسم</th>
                                    <th>اسم المسئول</th>
                                    <th>رقم الجوال</th>
                                    <th>الفرعي</th>
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
            "serverSide": true,
            "pagingType": "full_numbers",
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: 25,
            //"fixedHeader": true,
            "responsive": true,
            "ajax": "{{ route('admin.customers.ajax') }}?category_id={{ \Request::get('category_id') }}&parent_id={{ \Request::get('parent_id') }}",
            "columns": [{
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'select',
                    name: ''
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'resp_name',
                    name: 'resp_name'
                },
                {
                    data: 'resp_phone',
                    name: 'resp_phone'
                },
                {
                    data: 'customers',
                    name: 'customers'
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
            ],
            dom: 'Bfrtip',
            buttons: [{
                    text: copy,
                    className: 'btn btn-success datatabeBTNS',
                    extend: 'copy'
                },
                {
                    text: excel,
                    className: 'btn btn-success datatabeBTNS',
                    extend: 'excel'
                },
                {
                    text: pdf,
                    className: 'btn btn-success datatabeBTNS',
                    extend: 'pdf'
                }

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
