@extends($pLayout. 'masterinv')
@section('title') عرض سعر شراء @endsection
@section('content')
<br/>
<br/>
<div class="row no-gutters">
  <div class="col-md-3">
    <div class="row no-gutters">
      <h3 class="header-3 p-0">
        الرقم الضريبي / <span class="en-font"> {{ getSettings('site_vat') }}</span>
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
        عرض سعر شراء
        <a href="{{ route('purchases-prices-offers.edit', $PurchasePriceOffer->id) }}" class="editbtu" target="_blank"> - تعديل </a>
    </h3>
  </div>
</div>
<div class="row no-gutters" style="border-bottom: 1px solid #ccc;">
  <div class="col-md-3">

    <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
      <div class="d-flex">
        <span class="about_prop"> المورد :</span>
        <span class="about_value">{{ $supplier->name }}</span>
      </div>
    </div>

    <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
      <div class="d-flex">
        <span class="about_prop">العنوان :</span>
        <span class="about_value">{{ $supplier->address }}</span>
      </div>
    </div>

    <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
      <div class="d-flex">
        <span class="about_prop">رقم الجوال :</span>
        <span class="about_value en-font">{{ $supplier->phone }}</span>
      </div>
    </div>
    <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
      <div class="d-flex">
        <span class="about_prop">ايميل :</span>
        <span class="about_value">{{ $supplier->email }}</span>
      </div>
    </div>
  </div>
    <div class="col-md-6 m-auto">
        <div class="row no-gutters text-center">
            <img width="150" height="200" src="{{ asset('panel/app-assets/images/barcode.png') }}" alt="" class="img-fluid m-auto">
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
        <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px; border-top: 0; border-right: 0; ">
          <span class=" about_value en-font">{{ $PurchasePriceOffer->date }}</span>
        </div>
        <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
          <span class="about_value en-font">{{ $PurchasePriceOffer->time }}</span>
        </div>
        <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
          <span class="about_value en-font">{{ $PurchasePriceOffer->code . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT) }}</span>
        </div>
        <div class="row no-gutters " style="border: 1px solid #ccc; border-right: 0; ">
          <span class="about_value en-font">{{ $supplier->code }}</span>
        </div>
      </div>

    </div>
  </div>
</div>


@php
    $addon_disc = $PurchasePriceOffer->addon_discount;
    $quantities = $quantities;
    $discounts  = $discounts;
    $sell_show  = false;
    $prices     = $prices;
    $items      = $allProducts;
@endphp
@include('admin.layouts.show_product_table')
@endsection
