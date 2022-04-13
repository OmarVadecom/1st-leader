@extends($pLayout. 'masterinv')
@section('title')

@if(\Request::get('main_type') == 2)
استلام صيانه خارجيه
@else
استلام ورشه
@endif

@endsection
@section('content')
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<div class="row no-gutters">
    <div class="col-md-3">
        <div class="row no-gutters">
            <h3 class="header-3 p-0">
                الرقم الضريبي / <span class="en-font"> {{getSettings('site_vat')}}</span>
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

            @if(\Request::get('main_type') == 2)
            استلام صيانه خارجيه
            @else
            استلام ورشه
            @endif
        </h3>
    </div>
</div>
<div class="row no-gutters" style="border-bottom: 1px solid #ccc;">
   <div class="col-md-3">

      <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">الشركة :</span>
                <span class="about_value">{{$maintenance->client->name}}</span>
            </div>
        </div>

        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">العنوان :</span>
                <span
                    class="about_value">{{$maintenance->client->region}}-{{$maintenance->client->street}}</span>
            </div>
        </div>

        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">السيد :</span>
                <span class="about_value">{{$maintenance->client->resp_name}}</span>
            </div>
        </div>

        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">رقم الهاتف :</span>
                <span class="about_value en-font">{{$maintenance->client->resp_phone}}</span>
            </div>
        </div>
@if($maintenance->client->resp_email != "")
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">ايميل :</span>
                <span class="about_value">{{$maintenance->client->resp_email}}</span>
            </div>
        </div>
@endif
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
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px; border-top: 0;">
                    <span class="about_prop">التاريخ/ </span>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px;">
                    <span class="about_prop">الوقت/ </span>
                </div>
                {{-- <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px;">
                    <span class="about_prop">مدة العرض/ </span>
                </div> --}}
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px;">
                    <span class="about_prop">رقم الطلب/ </span>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px;">
                    <span class="about_prop">رقم الحساب/</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row no-gutters"
                    style="border: 1px solid #ccc;border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class=" about_value en-font">{{$maintenance->date}}</span>
                </div>
                <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
                    <span class="about_value en-font">{{$maintenance->time}}</span>
                </div>
                {{-- <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
                    <span class="about_value">{{$offer->offer_duration}}</span>
                </div> --}}
                <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
                    <span class="about_value en-font">{{ $maintenance->code . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
                    <span class="about_value en-font">{{$maintenance->client->code}}</span>
                </div>
            </div>

        </div>
    </div>
</div>
<br><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="30%">معلومات المنتج الرئيسي</th>
            <th colspan="2">الرئيسية</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan="6" style="position: relative;">
                @if(isset($maintenance->product_id))
                <img class="main_pro_image" src="{{url('/')}}/uploads/products-attachments/{{$maintenance->product->image}}"
                    style="width:150px;">
                @else
                <img class="main_pro_image" src="{{url('/')}}/uploads/parts-attachments/{{$maintenance->product->image}}"
                    style="width:150px;">
                @endif
            </td>
            <td width="15%">سيريال نمبر</td>
            <td class="en-font">{{$maintenance->serial_num}}</td>
        </tr>
        <tr>
            <td width="15%">الطراز</td>
            <td class="en-font">{{$maintenance->type}}</td>
        </tr>
        <tr>
            <td width="15%">حاله القطعه</td>
            <td>{{$maintenance->status}}</td>
        </tr>
        <tr>
            <td width="15%">عدد القطع المستلمه</td>
            <td class="en-font">{{$maintenance->quantity}}</td>
        </tr>
        <tr>
            <td width="15%">حاله التشغيل</td>
            <td>{{$maintenance->op_status}}</td>
        </tr>
        <tr>
            <td width="15%">مستوي النظافه</td>
            <td>{{$maintenance->cleaning}}</td>
        </tr>
    </tbody>
</table>
<br><br>
<table class="delivery table table-bordered">
    <thead>
        <tr>
            <th colspan="8" style="background: #F8CBAD;">تفاصيل الاستلام</th>
        </tr>
        <tr>
            <th>م</th>
            <th>رقم الصنف</th>
            <th>اسم القطعه</th>
            <th>رقم القطعه</th>
            <th>حاله القطعه</th>
            <th>حاله التشغيل</th>
            <th>مستوي النظافه</th>
            <th>الصوره</th>
        </tr>
    </thead>
    <tbody>
        @foreach($parts as $k=>$pr)
        @if(isset($parts_status[$k]))
        <tr>
            <td>{{$k+1}}</td>
            <td class="en-font">{{$pr->code}}</td>
            <td>{{$pr->name}}</td>
            <td class="en-font">{{$parts_num[$k]}}</td>
            <td>{{$parts_status[$k]}}</td>
            <td>{{$parts_op_status[$k]}}</td>
            <td>{{$parts_cleaning[$k]}}</td>
            <td><img src="{{url('/')}}/uploads/parts-attachments/{{$pr->image}}" style="width:90px;"></td>
        </tr>
        @endif
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td>
                <div class="page-footer-space"></div>
            </td>
        </tr>
    </tfoot>
</table>

<br><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="25%">اجرة الفحص</th>
            <th>وصف المشكله لدي العميل
                <span style="float:left">
                    <i data-id="1"
                        class="fa {{(isset($maintenance) && $maintenance->problem_rate >= 1) ? 'fa-star' : 'fa-star-o' }} delegate1 stardel"></i>
                    <i data-id="2"
                        class="fa {{(isset($maintenance) && $maintenance->problem_rate >= 2) ? 'fa-star' : 'fa-star-o' }} delegate2 stardel"></i>
                    <i data-id="3"
                        class="fa {{(isset($maintenance) && $maintenance->problem_rate >= 3) ? 'fa-star' : 'fa-star-o' }} delegate3 stardel"></i>
                    <i data-id="4"
                        class="fa {{(isset($maintenance) && $maintenance->problem_rate >= 4) ? 'fa-star' : 'fa-star-o' }} delegate4 stardel"></i>
                    <i data-id="5"
                        class="fa {{(isset($maintenance) && $maintenance->problem_rate >= 5) ? 'fa-star' : 'fa-star-o' }} delegate5 stardel"></i>
                </span>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan="5" style="position: relative;">
                <div class="main_pro_image" style="font-size: 26px"> {{$maintenance->cost}} ريال </div>
            </td>
            <td style="text-align: right;">{{$maintenance->problem_description}}</td>
        </tr>
        <tr>
            <th>ملاحظات المستلم
                <span style="float:left">
                    <i data-id="1"
                        class="fa {{(isset($maintenance) && $maintenance->delivery_rate >= 1) ? 'fa-star' : 'fa-star-o' }} delegatecl1 stardelcl"></i>
                    <i data-id="2"
                        class="fa {{(isset($maintenance) && $maintenance->delivery_rate >= 2) ? 'fa-star' : 'fa-star-o' }} delegatecl2 stardelcl"></i>
                    <i data-id="3"
                        class="fa {{(isset($maintenance) && $maintenance->delivery_rate >= 3) ? 'fa-star' : 'fa-star-o' }} delegatecl3 stardelcl"></i>
                    <i data-id="4"
                        class="fa {{(isset($maintenance) && $maintenance->delivery_rate >= 4) ? 'fa-star' : 'fa-star-o' }} delegatecl4 stardelcl"></i>
                    <i data-id="5"
                        class="fa {{(isset($maintenance) && $maintenance->delivery_rate >= 5) ? 'fa-star' : 'fa-star-o' }} delegatecl5 stardelcl"></i>
                </span>
            </th>
        </tr>
        <tr>
            <td style="text-align: right;">{{$maintenance->delivery_description}}</td>
        </tr>

    </tbody>
    <tfoot>
        <tr>
            <td>
                <div class="page-footer-space"></div>
            </td>
        </tr>
    </tfoot>
</table>



<br><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="2" style="background: #FFFF99">ملاحظات مصوره</th>
        </tr>
        <tr>
            <th>الوصف</th>
            <th>الصوره</th>
        </tr>
    </thead>
    <tbody>
        @foreach($notes as $i=>$note)
        @if($note != "" || $attachments[$i] != "")
        <tr>
            <td style="position: relative;">
                {{$note}}
            </td>
            <td>
                @if(isset($attachments[$i]) && $attachments[$i] != "")
                <img src="{{url('/')}}/uploads/main-attachments/{{$attachments[$i]}}" style="width:150px">
                @endif
            </td>
        </tr>
        @endif
        @endforeach

    <tfoot>
        <tr>
            <td>
                <div class="page-footer-space"></div>
            </td>
        </tr>
    </tfoot>
    </tbody>

</table>

<style>
    .product-table span,
    .product-value span {
        display: table;
        margin: 0 auto !important;
    }

    @page {
        margin-bottom: 70px;
    }

    .about_value {
        height: 100%;
    }

    th,
    td {
        padding: .5rem !important;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
    }

    .main_pro_image {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .fa-star {
        color: #ffc12b;
        font-size: 15px;
    }

    .page-footer-space {
        height: 80px;
    }

    .page-header-space {
        height: 30px;
    }

    @media print {
        table {
            /* page-break-inside: auto !important; */
            border-collapse: collapse;
        }

        /* thead   {display: table-header-group;   } */

        tfoot {
            display: table-footer-group;
        }


    }
</style>
@endsection
