@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        قطع الغيار و الاكسسورات
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="row">
                        <br>
                        <form action="{{ route('admin.product.import_excel') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-3">
                                <input class="form-control" type="file" name="excel">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">اضف إكسل </button>
                            </div>
                            <div class="col-md-2">

                                @if($errors->has('excel'))
                                    <span class="help-block" style="color: red">
                                        <strong>{{ $errors->first('excel') }}</strong>
                                    </span>
                                @endif
                                @if(session('msg'))
                                    <div class="alert alert-succes">
                                        {{ session('msg') }}
                                    </div>
                                @endif
                            </div>
                        </form>
                        <div class="col-md-5">
                            <form enctype="multipart/form-data" id="imgupload">
                                @csrf
                                <div class="upload pull-left">
                                    <div class="col-md-8">
                                        <input class="form-control" type="file" name="image">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">اضف صوره </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li class="tag tag-info">{{ trans('admin.select') }} <input
                                    type="checkbox" class="checkedAll" name="dels"></li>
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

                            {!! getCreateBtn(route('parts.create'), 'products.create') !!}
                            {!! getDeleteBtn(route('admin.parts.deletes'), 'products.create') !!}

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
                                    <th width="5%">الكود</th>
                                    <th width="20%">الاسم العربي </th>
                                    <th width="20%">الاسم اللاتيني </th>
                                    <th>الصوره</th>
                                    <th>الشركه</th>
                                    <th width="18%">{{ trans('admin.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th width="5%">الكود</th>
                                    <th width="20%">الاسم العربي </th>
                                    <th width="20%">الاسم اللاتيني </th>
                                    <th>الصوره</th>
                                    <th>الشركه</th>
                                    <th width="18%">{{ trans('admin.action') }}</th>
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
            "ajax": "{{ route('admin.parts.ajax') }}",
            "columns": [{
                    data: null,
                    name: null
                },
                {
                    data: 'select',
                    name: ''
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'title_ar',
                    name: 'title_ar'
                },
                {
                    data: 'title_en',
                    name: 'title_en'
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'company',
                    name: 'company'
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

    $('#imgupload').on('submit', function (e) {
        e.preventDefault();
        var multiId = [];
        $('.checkSingle:checked').each(function (i) {
            multiId[i] = $(this).val();
        });
        if (multiId.length === 0) {
            alert(pickSome);
        } else {
            var formData = new FormData(this);
            formData.append('ids', multiId);
            $.ajax({
                url: "{{ route('admin.uploadpartsimg') }}",
                type: "POST",
                data: formData,
                success: function (msg) {
                    location.reload();
                },
                cache: false,
                contentType: false,
                processData: false
            });



        }
    });

</script>
@endsection
