@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        اوامر النقل
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            {!! getCreateBtn(route('transport.create'), 'product.create') !!}
                        </ul>
                    </div>
                </div>

                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <table class="table table-striped table-bordered " id="data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>التاريخ</th>
                                    <th>المنتج</th>
                                    <th>الكميه</th>
                                    <th>من مستودع</th>
                                    <th>الي مستودع</th>
                                    <th>التحكم</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>التاريخ</th>
                                    <th>المنتج</th>
                                    <th>الكميه</th>
                                    <th>من مستودع</th>
                                    <th>الي مستودع</th>
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
        "ajax": "{{ route('admin.transport.ajax') }}",
        "columns": [
           {data: 'select', name: ''},
           {data: 'date', name: 'date'},
           {data: 'product', name: 'product'},
           {data: 'quantity', name: 'quantity'},
           {data: 'from', name: 'from'},
           {data: 'to', name: 'to'},
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
</style>
@endsection