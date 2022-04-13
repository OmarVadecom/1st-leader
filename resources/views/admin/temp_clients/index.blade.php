@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @if(Request::get('status') == 0)
                        قاعده بيانات العملاء
                        @else
                        العملاء الجديده
                        @endif
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li class="tag tag-info">{{ trans('admin.select') }} <input type="checkbox"
                                    class="checkedAll" name="dels"></li>
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

                            {!! getCreateBtn(route('tmpclients.create').'?status='.Request::get('status'),
                            'product.create') !!}
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
                                    <th width="1%"></th>
                                    <th width="25%">اسم المركز</th>
                                    <th width="5%">رقم القطعه</th>
                                    <th width="5%"> السجل التجاري</th>
                                    <th width="5%">المدينه</th>
                                    <th width="5%">رقم التليفون</th>

                                    {{-- <th width="5%">المنطقه</th> --}}
                                    {{-- <th width="10%">المنتج</th> --}}
                                    {{-- <th width="15%">الصوره </th> --}}
                                    <th>{{ trans('admin.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th width="1%"></th>
                                    <th width="25%">اسم المركز</th>
                                    <th width="5%">رقم القطعه</th>
                                    <th width="5%"> السجل التجاري</th>
                                    <th width="5%">المدينه</th>
                                    <th width="5%">رقم التليفون</th>
                                    {{-- <th width="15%">الصوره </th> --}}
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
<style>
    tr>td:last-of-type {
        padding: 0.75rem 0.6rem;
    }
</style>
@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {
   var t= $('#data').DataTable( {
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
        "ajax": "{{ route('admin.tmpclients.ajax') }}?status={{\Request::get('status')}}",
        "columns": [
           {data: null, name: null},
           {data: 'select', name: ''},
           {data: 'centername', name: 'centername'},
           {data: 'code', name: 'code'},
           {data: 'segl_num', name: 'segl_num'},
           {data: 'city', name: 'city'},
           {data: 'phone', name: 'phone'},
        //    {data: 'region', name: 'region'},
        //    {data: 'product', name: 'product'},
        //    {data: 'image', name: 'image'},
           {data: 'action', name: ''}
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