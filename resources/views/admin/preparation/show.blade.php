@extends($pLayout. 'masterinv')
@section('title') أمر تحضير @endsection
@section('content')
<section class="main my-5">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-3">
                <div class="row no-gutters">
                    <h3 class="header-3 p-0">
                        الرقم الضريبي / {{getSettings('site_vat')}}
                    </h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row no-gutters">
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row no-gutters">
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="col-md-1">
                <div class="row no-gutters">
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row no-gutters">
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="col-md-1">
                <div class="row no-gutters">
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <br>
        <div class="row no-gutters">
            <div class="col-md-12 text-center" style="border: 1px solid #ccc">
                <h3 class="header-3">
                    أمر تحضير
                </h3>
            </div>
        </div>
        <div class="row no-gutters" style="border-bottom: 1px solid #ccc;">
            <div class="col-md-3">
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0;">
                    <div class="d-flex">
                        <span class="about_prop">التاريخ :</span>
                        <span class="about_value">{{date('d-m-Y',strtotime($prepare->created_at))}}</span>
                    </div>
                </div>

                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">الوقت :</span>
                        <span class="about_value">{{date('H:i',strtotime($prepare->created_at))}}</span>
                    </div>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">حاله التحضير :</span>
                        <span class="about_value">{!!$prepare->preparestatus!!}</span>
                    </div>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc;">
                    <div class="d-flex">
                        <span class="about_prop">رقم امر التحضير :</span>
                        <span class="about_value">{{$prepare->code}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 m-auto">
                <div class="row no-gutters  text-center">
                    <img width="150" height="200" src="{{asset('panel/app-assets/images/barcode.png')}}" alt=""
                        class="img-fluid m-auto">
                </div>
            </div>
            <div class="col-md-3">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <div class="row no-gutters" style="border: 1px solid #ccc; border-top: 0;">
                            <span class="about_prop">البائع/</span>
                        </div>
                        <div class="row no-gutters">
                            <span class="about_prop">&nbsp;</span>
                        </div>
                        <div class="row no-gutters">
                            <span class="about_prop">&nbsp;</span>
                        </div>
                        <div class="row no-gutters">
                            <span class="about_prop">&nbsp;</span>
                        </div>
                        <div class="row no-gutters">
                            <span class="about_prop">&nbsp;</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row no-gutters" style="border: 1px solid #ccc; border-top: 0; border-right: 0; ">
                            <span class=" about_value ">{{$prepare->representative_name}}</span>/
                        </div>
                        <div class="row no-gutters " style=" ">
                            <span class="about_value ">&nbsp;</span>/
                        </div>
                        <div class="row no-gutters " style="">
                            <span class="about_value ">&nbsp;</span>/
                        </div>
                        <div class="row no-gutters " style="">
                            <span class="about_value ">&nbsp;</span>/
                        </div>
                        <div class="row no-gutters " style="">
                            <span class="about_value ">&nbsp;</span>/
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row no-gutters product-table ">
            <div class="col-md-1 ">
                <div class="row no-gutters " style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0; ">
                    <span class="about_prop "> م:</span>
                </div>
            </div>
            <div class="col-md-2 ">
                <div class="row no-gutters "
                    style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class="about_prop "> رقم الصنف:</span>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="row no-gutters "
                    style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class="about_prop "> البيان:</span>
                </div>
            </div>
            <div class="col-md-1 ">
                <div class="row no-gutters "
                    style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class="about_prop "> الوحدة:</span>
                </div>
            </div>
            <div class="col-md-1 ">
                <div class="row no-gutters "
                    style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class="about_prop "> الكمية:</span>
                </div>
            </div>
            <div class="col-md-1 ">
                <div class="row no-gutters "
                    style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class="about_prop "> اسم المحضر:</span>
                </div>
            </div>
            <div class="col-md-2 ">
                <div class="row no-gutters "
                    style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class="about_prop "> الصوره:</span>
                </div>
            </div>
        </div>
        @php
        $totalquantity=0;
        @endphp
        @foreach($prepare->products as $key=>$product)
        @php
        $totalquantity +=$product->quantity;
        @endphp
        <div class="row no-gutters product-value">
            <div class="col-md-1">
                <div class="row no-gutters " style="border: 1px solid #ccc;height: 100%; ">
                    <span class="about_value ">{{$key}}</span>
                    <br>
                    <br>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row no-gutters " style="border: 1px solid #ccc;  border-right: 0;height: 100%; ">
                    <span class="about_value ">{{$product->product->code}}</span>
                    <br>
                    <br>
                </div>

            </div>
            <div class="col-md-4">
                <div class="row no-gutters " style="border: 1px solid #ccc;  border-right: 0; height: 100%; ">
                    <span class="about_value ">{{$product->product->name}} | {{$product->product->name_en}} </span>
                    <br>
                    <br>
                </div>
            </div>
            <div class="col-md-1">
                <div class="row no-gutters " style="border: 1px solid #ccc;  border-right: 0; height: 100%; ">
                    <span class="about_value ">{{$product->product->unit_1}}</span>
                    <br>
                    <br>
                </div>
            </div>
            <div class="col-md-1">
                <div class="row no-gutters " style="border: 1px solid #ccc;  border-right: 0; height: 100%;">
                    <span class="about_value ">{{$product->quantity}}</span>
                    <br>
                    <br>
                </div>
            </div>
            <div class="col-md-1">
                <div class="row no-gutters " style="border: 1px solid #ccc;  border-right: 0; height: 100%; ">
                    <span class="about_value ">{{$prepare->preparator_name}}</span>
                    <br>
                    <br>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row no-gutters " style="border: 1px solid #ccc;  0px; border-right: 0; height: 100%;">
                    <span class="about_value "><img src="{{url('/')}}/uploads/products-attachments/{{$product->product->image}}"
                            style="width:100px;"></span>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        @endforeach
        <div class="row no-gutters ">
            <div class="col-md-9 buyer-data">
                {{-- <div class="row no-gutters" style="">
                    &nbsp;
                </div> --}}
            </div>
            <div class="col-md-1">
                <div class="row no-gutters " style="border: 1px solid #ccc;">
                    <span class="about_prop " style="font-size: 1.5rem; "> الكميه الاجمالية:</span>
                </div>
            </div>
            <div class="col-md-2 ">
                <div class="row no-gutters " style="border: 1px solid #ccc;">
                    <span class="about_value" style="font-size: 1.5rem;">{{$totalquantity}}</span>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row no-gutters">
            <div class="col-md-5">
                <div class="row no-gutters " style="display: table; margin: 0 auto;">
                    <span class="about_prop ">أمين المستودع</span>
                </div>
                <br><br><br><br><br><br>

            </div>
            <div class="col-md-2">
                <div class="row no-gutters " style="">
                    <span class="about_value">&nbsp;</span>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row no-gutters " style="display: table; margin: 0 auto;">
                    <span class="about_prop ">المحضر</span>
                </div>
                <br><br><br><br><br><br>

            </div>
        </div>
    </div>

    <style>
        .product-table span,
        .product-value span {
            display: table;
            margin: 0 auto !important;
        }
    </style>
    @endsection