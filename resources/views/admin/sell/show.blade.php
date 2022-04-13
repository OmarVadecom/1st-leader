@extends($pLayout. 'masterinv')
@section('title') فاتوره بيع @endsection
@section('content')
    <br><br>
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
                فاتوره بيع {{$offer->type == 2 ? 'طلب ورشه' : ''}}
                @if(in_array(auth()->id(), [1, 7, 9]))
                    <a href="{{route('sells.edit',$offer->id)}}?m={{$offer->maintenance_id}}&main_type={{$offer->main_type ?? 1}}&invoice_num={{request('invoice_num')}}" class="editbtu"
                       target="_blank"> - تعديل </a>
                @endif
            </h3>
        </div>
    </div>
    <div class="row no-gutters" style="border-bottom: 1px solid #ccc;">
        <div class="col-md-3">

            <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                <div class="d-flex">
                    <span class="about_prop">الشركة :</span>
                    <span class="about_value">{{$customer->name}}</span>
                </div>
            </div>

            <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                <div class="d-flex">
                    <span class="about_prop">العنوان :</span>
                    <span class="about_value">{{$customer->region}} - {{$customer->street}}</span>
                </div>
            </div>

            <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                <div class="d-flex">
                    <span class="about_prop">السيد :</span>
                    <span class="about_value">{{$customer->resp_name}}</span>
                </div>
            </div>

            <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                <div class="d-flex">
                    <span class="about_prop">رقم الجوال :</span>
                    <span class="about_value en-font">{{$customer->resp_phone}}</span>
                </div>
            </div>
            @if($customer->resp_email != "")
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">ايميل :</span>
                        <span class="about_value">{{$customer->resp_email}}</span>
                    </div>
                </div>
            @endif
            <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                <div class="d-flex">
                    <span class="about_prop"> الرقم الضريبي :</span>
                    <span
                        class="about_value en-font">{{$customer->dreb_number != '' ? $customer->dreb_number : 'لا يوجد'}}</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 m-auto" style="margin-top:5px !important;margin-bottom:5px !important; ">
        <!-- <p class ="en-font" style="text-align: center; font-size: 12px; word-wrap: break-word; width: 70%; margin: auto; font-weight: 600;">{{$qrcode_string}}</p>-->

            <div class="row no-gutters  text-center">

                <a target="_blank" class="m-auto" href="{{route("qrcode.view")}}?{{$qr_data}}">
                    <img width="130" height="130" src="{{$qrcode_img}}" alt=""
                         class="img-fluid m-auto">
                </a>
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
                    <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px;">
                        <span class="about_prop">رقم الفاتوره/ </span>
                    </div>
                    <div class="row no-gutters" style="border: 1px solid #ccc;">
                        <span class="about_prop">رقم الحساب/</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row no-gutters"
                         style="border: 1px solid #ccc;border-bottom: 0px; border-top: 0; border-right: 0; ">
                        <span class=" about_value en-font">{{$offer->date}}</span>
                    </div>
                    <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
                        <span class="about_value en-font">{{$offer->time}}</span>
                    </div>
                    <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
                        <span class="about_value en-font">{{ $offer->code . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="row no-gutters " style="border: 1px solid #ccc; border-right: 0; ">
                        <span class="about_value en-font">{{$customer->code}}</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @php
        $sell_show=true;
        $items=$allproducts;
        $quantities=$quantities;
        $prices=$prices;
        $discounts=$discounts;
        $addon_disc=$offer->addon_disc;
    @endphp
    @include('admin.layouts.show_product_table')
@endsection
