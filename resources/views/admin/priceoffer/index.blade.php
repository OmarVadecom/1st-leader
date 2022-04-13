@extends($pLayout. 'master')

@section('content')

    <!-- File export table -->
    <section id="file-export">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            عروض الاسعار الغير معمده
                            <button class="btn btn-danger no-print" id="print">طباعه</button>
                        </h4>
                        <a class="heading-elements-toggle no-print"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements no-print">
                            <ul class="list-inline mb-0">
                                <li class="tag tag-info">{{ trans('admin.select') }} <input type="checkbox"
                                                                                            class="checkedAll" name="dels"></li>
                                <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

                                {!! getCreateBtn(route('priceoffer.create'), 'products.create') !!}

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
                                    {{-- <th>رقم الزياره</th> --}}
                                    <th>رقم العرض</th>
                                    <th width="20%">الزبون</th>
                                    {{-- <th>النوع</th> --}}
                                    <th>اجمالي عرض السعر</th>
                                    <th>نسخ عرض السعر</th>
                                    <th>تعميد</th>
                                    <th>التحكم</th>

                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot class="no-print">
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    {{-- <th>رقم الزياره</th> --}}
                                    <th>رقم العرض</th>
                                    <th width="20%">الزبون</th>
                                    {{-- <th>النوع</th> --}}
                                    <th>اجمالي عرض السعر</th>
                                    <th>نسخ عرض السعر</th>
                                    <th>تعميد</th>
                                    <th>التحكم</th>
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
                "ordering": 0,
                "pagingType": "full_numbers",
                aLengthMenu: [
                    [25, 50, 100, 200, -1],
                    [25, 50, 100, 200, "All"]
                ],
                iDisplayLength: 25,
                "fixedHeader": true,
                "responsive": true,
                "ajax": "{{ route('admin.priceoffers.ajax') }}",
                "columns": [{
                    data: null,
                    name: null,
                    class: 'no-print'
                },
                    {
                        data: 'select',
                        name: '',
                        class: 'no-print'
                    },
                    //    {data: 'title', name: 'title'},
                    {
                        data: 'num',
                        name: 'num'
                    },
                    {
                        data: 'customer',
                        name: 'customer'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'copy',
                        name: 'copy'
                    },
                    {
                        data: 'verify',
                        name: 'verify'
                    },
                    {
                        data: 'action',
                        name: '',
                        class: 'no-print'
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
            $(document).on('change', '#changeoffer', function () {
                id = $(this).data('id');
                if (this.checked) {
                    if (confirm('هل انت متاكد من تغيير حاله عرض السعر الي معمد؟')) {
                        $.get("{{ url('/') }}/changeoffer", {
                            id: id
                        }, function (data) {});

                        // $('.notverified').addClass('verified').removeClass('notverified');
                        // $('.verified').text('معمد');

                    }
                }
            })



        });

    </script>

    <style>
        .custom-checkbox {
            min-height: 1rem;
            padding-left: 0;
            margin-right: 0;
            cursor: pointer;
        }

        .custom-checkbox .custom-control-indicator {
            content: "";
            display: inline-block;
            position: relative;
            width: 30px;
            height: 10px;
            background-color: #818181;
            border-radius: 15px;
            margin-right: 10px;
            -webkit-transition: background .3s ease;
            transition: background .3s ease;
            vertical-align: middle;
            margin: 0 16px;
            box-shadow: none;
        }

        .custom-checkbox .custom-control-indicator:after {
            content: "";
            position: absolute;
            display: inline-block;
            width: 18px;
            height: 18px;
            background-color: #f1f1f1;
            border-radius: 21px;
            box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.4);
            left: -2px;
            top: -4px;
            -webkit-transition: left .3s ease, background .3s ease, box-shadow .1s ease;
            transition: left .3s ease, background .3s ease, box-shadow .1s ease;
        }

        .custom-checkbox .custom-control-input:checked~.custom-control-indicator {
            background-color: #3BAFDA;
            background-image: none;
            box-shadow: none !important;
        }

        .custom-checkbox .custom-control-input:checked~.custom-control-indicator:after {
            background-color: #3BAFDA;
            left: 15px;
        }

        .custom-checkbox .custom-control-input:focus~.custom-control-indicator {
            box-shadow: none !important;
        }

        .custom-control {
            padding-right: 0px !important;
            margin-top: -20px;
        }

        .notverified {
            color: red;
        }

        .verified {
            color: green;
        }

        .table td {
            padding: 0.75rem 0.5rem;
        }

    </style>
@endsection
