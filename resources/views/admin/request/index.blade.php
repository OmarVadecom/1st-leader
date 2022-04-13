@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ trans('admin.requests') }}
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                        	<li class="tag tag-info">{{ trans('admin.select') }} <input type="checkbox" class="checkedAll" name="dels"></li>
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            {!! getDeleteBtn(route('admin.contact.deletes'), 'contacts.delete') !!}
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
                                <th width="1%">#</th>
                                <th width="1%"></th>
                                <th width="15%">{{ trans('admin.name')  }}</th>
                                <th width="15%">{{ trans('admin.email')  }}</th>
                                <th width="15%">{{ trans('admin.phone')  }}</th>
                                <th width="20%">{{ trans('admin.package')  }}</th>
                                <th width="10%">{{ trans('admin.date')  }}</th>
                                <th width="9%">{{ trans('admin.status')  }}</th>
                                <th width="15%">{{ trans('admin.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th width="1%">#</th>
                                <th width="1%"></th>
                                <th width="15%">{{ trans('admin.name')  }}</th>
                                <th width="15%">{{ trans('admin.email')  }}</th>
                                <th width="15%">{{ trans('admin.phone')  }}</th>
                                <th width="20%">{{ trans('admin.package')  }}</th>
                                <th width="10%">{{ trans('admin.date')  }}</th>
                                <th width="5%">{{ trans('admin.status')  }}</th>
                                <th width="19%">{{ trans('admin.action') }}</th>
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
        "autoWidth": false,
        "responsive": true,
        "ajax": "{{ route('admin.request.ajax') }}",
        "columns": [
           {data: null, name: null},
           {data: 'select', name: ''},
           {data: 'client_name', name: 'client_name'},
           {data: 'client_email_address', name: 'client_email_address'},
           {data: 'client_phone_number', name: 'client_phone_number'},
           {data: 'package', name: 'package'},           
           {data: 'created_at', name: 'created_at'},
           {data: 'status', name: 'status'},
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
<style>
    
    td{
            word-break: break-all !important; 
            padding:10px !important;
    }
        .dataTables_filter{
            float:right;
        }
    </style>
</style>
@endsection