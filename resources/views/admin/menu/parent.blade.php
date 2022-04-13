@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ $menu->name }}
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                        	<li class="tag tag-info">{{ trans('admin.select') }} <input type="checkbox" class="checkedAll" name="dels"></li>
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

                            {!! getCreateBtn(route('menu.create'), 'menus.create') !!}
                            {!! getDeleteBtn(route('admin.menu.deletes'), 'menus.delete') !!}

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
                                <th>{{ trans('admin.title', ['name' => trans('admin.menu')])  }}</th>
                                <th>{{ trans('admin.status')  }}</th>
                                <th>{{ trans('admin.order') }}</th>
                                <th>{{ trans('admin.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $k => $menu)
                            <tr>
                                <td></td>
                                <td>{!! getSelectAjax($menu) !!}</td>
                                <td>{{ $menu->name }}</td>
                                <td>{!! getStatus($menu->show) !!}</td>

                                <td>
                                    @if($k != 0)
                                    <a href="{{ route('menu.up', $menu->id) }}" class="btn btn-success"><i class="fa fa-arrow-up"></i></a>
                                    @endif
                                    @if(!$loop->last)
                                    <a href="{{ route('menu.down', $menu->id) }}" class="btn btn-danger"><i class="fa fa-arrow-down"></i></a>
                                    @endif
                                </td>

                                <td>{!! getAjaxAction('menus.', $menu, route('menu.show', $menu->id), route('menu.edit', $menu->id), route('menu.destroy', $menu->id)) !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>{{ trans('admin.title', ['name' => trans('admin.menu')])  }}</th>
                                <th>{{ trans('admin.status')  }}</th>
                                <th>{{ trans('admin.order') }}</th>
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
        "ordering": false,
        "pagingType": "full_numbers",
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: 25,
        "fixedHeader": true,
        "responsive": true,
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