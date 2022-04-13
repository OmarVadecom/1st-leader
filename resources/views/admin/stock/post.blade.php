@extends($pLayout. 'masterinv')
@section('content')
<div class="text-right">
    <button id="printInvoice" class="btn btn-info" style="margin: 5px;"><i class="fa fa-print"></i> طباعه</button>
    <a id="back" href="{{url('/')}}/storereport" class="btn btn-danger"><i class="fa fa-print"></i> رجوع</a>
</div>
<div class="table-container text-center p-5" id="print">
    <div class="container">
        <h4 class="pb-4">ملخص الحركه</h4>
        <div class="row">
            <div class="col-xs-6 m-auto">


                <table class="table table-bordered">
                    <thead>
                        @if($warehouse != null)
                        <tr>
                            <th scope="col">اسم المستودع</th>
                            <td style="width: 250px;">{{$warehouse->name}}</td>
                        </tr>
                        @endif
                    </thead>
                    <tbody>
                        @if($warehouse==null)
                        <tr>
                            <th scope="row">كل المستودعات</th>
                            <td style="width: 250px;"><i class='fa fa-check'></i></td>
                        </tr>
                        @endif

                    </tbody>
                </table>



                <table class="table table-bordered">
                    <thead>
                        @if($stock != null)
                        <tr>
                            <th scope="col">اسم المخزون</th>
                            <td style="width: 250px;">{{$stock->name}}</td>
                        </tr>
                        @endif
                    </thead>
                    <tbody>
                        @if($stock==null)
                        <tr>
                            <th scope="row">كل المخزون</th>
                            <td style="width: 250px;"><i class='fa fa-check'></i></td>
                        </tr>
                        @endif

                    </tbody>
                </table>
                <table class="table table-bordered">
                    @if($product != 'all')
                    <tr>
                        <th scope="row">اسم المنتج</th>
                        <td style="width: 250px;">{{$products[0]->name}}</td>
                    </tr>
                    @endif
                    @if($product=='all')
                    <tr>
                        <th scope="row">كل المنتجات</th>
                        <td style="width: 250px;"><i class='fa fa-check'></i></td>
                    </tr>
                    @endif
                </table>
            </div>
            <div class="col-xs-6 m-auto">
                @if($datefrom)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">من فترة</th>
                            <td style="width:150px;">{{date('d',strtotime($datefrom))}} </td>
                            <td style="width:150px;">{{date('m',strtotime($datefrom))}}</td>
                            <td scope="col">{{date('Y',strtotime($datefrom))}}</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">الى فترة</th>
                            <td style="width:150px;">{{date('d',strtotime($dateto))}}</td>
                            <td style="width:150px;">{{date('m',strtotime($dateto))}}</td>
                            <td>{{date('Y',strtotime($dateto))}}</td>
                        </tr>
                    </tbody>
                </table>
                @endif
            </div>
            <div class="col-md-12">
                <table class="table table-head table-resize ml-auto mb-4 table-bordered">
                    <thead>
                        <th>المنتج</th>
                        <th>الصادر</th>
                        <th>الوارد</th>
                        <th>المتبقي</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection