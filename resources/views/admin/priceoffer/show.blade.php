@extends($pLayout. 'masterinv')
@section('title') عرض سعر @endsection
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
            @if($offer->type==0)
            @if($offer->status == 1)
            عرض سعر مشتريات
            @elseif($offer->status == 2)
            أمر شراء
            @elseif($offer->status == 3)
            فاتوره شراء
            @else
            عرض سعر غير معمد
            @endif
            @else
            عرض سعر معمد
            @endif
        </h3>
    </div>
</div>
<div class="row no-gutters" style="border-bottom: 1px solid #ccc;">
    @if($offer->status != 0)
    <div class="col-md-3">
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0;">
            <div class="d-flex">
                <span class="about_prop">السيد :</span>
                <span class="about_value">{{$offer->supplier != '' ? $offer->supplier : 'لا يوجد'}}</span>
            </div>
        </div>

        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">الشركة :</span>
                <span class="about_value">{{$offer->supplier_comp != '' ? $offer->supplier_comp : 'لا يوجد'}}</span>
            </div>
        </div>
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">العنوان :</span>
                <span class="about_value">لا يوجد</span>
            </div>
        </div>
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">ايميل :</span>
                <span class="about_value">لا يوجد</span>
            </div>
        </div>
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">رقم الهاتف :</span>
                <span class="about_value">لا يوجد</span>
            </div>
        </div>
    </div>


    @else
    <div class="col-md-3">
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;border-top: 0;">
            <div class="d-flex">
                <span class="about_prop">الشركة :</span>
                <span class="about_value">{{$customer->name != '' ? $customer->name : 'لا يوجد'}}</span>
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
                <span class="about_value">{{$customer->resp_name != '' ? $customer->resp_name : 'لا يوجد'}}</span>
            </div>
        </div>

        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">رقم الجوال :</span>
                <span class="about_value en-font">{{$customer->resp_phone != '' ? $customer->resp_phone : 'لا
                    يوجد'}}</span>
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
                <span class="about_value en-font">{{$customer->dreb_number != '' ? $customer->dreb_number : 'لا
                    يوجد'}}</span>
            </div>
        </div>

    </div>
    @endif
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
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px;">
                    <span class="about_prop">مدة العرض/ </span>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px;">
                    <span class="about_prop">رقم العرض/ </span>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px;">
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
                    <span class="about_value ">{{$offer->offer_duration}}</span>
                </div>
                <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
                    <span class="about_value en-font">
                        @if($offer->status != 0)
                            @php
                                if($offer->status == 1){
                                    echo 'PPO-' . substr($this['created_at']->format('Y'), -2) . '-' . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT);
                                }elseif ($offer->status == 2){
                                    echo 'PO-' . substr($this['created_at']->format('Y'), -2) . '-' . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT);
                                }elseif ($offer->status == 3){
                                    echo 'PUR-' . substr($this['created_at']->format('Y'), -2) . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT);
                                }
                            @endphp
                        @else
                            {{$offer->code . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT)}}
                        @endif
                    </span>
                </div>
                <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
                    <span class="about_value en-font">{{isset($customer) ? $customer->code : ''}}</span>
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
