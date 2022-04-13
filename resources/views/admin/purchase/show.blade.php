@extends($pLayout. 'masterinv')
@section('content')
<div class="text-right">
  <button id="printInvoice" class="btn btn-info" style="margin: 5px;"><i class="fa fa-print"></i> طباعه</button>
  <a id="back" href="{{url('/')}}/sells" class="btn btn-danger"><i class="fa fa-print"></i> رجوع</a>

</div>
<div class="table-container text-center p-5" id="print">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4 class="pb-4">فاتوره شراء</h4>
        <table class="table table-head table-bordered">
          <thead>
            <tr>
              <th scope="col">رقم</th>
              <th scope="col">{{$invoice->id}}</th>
            </tr>
          </thead>
        </table>
      </div>
      <div class="col-md-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">اسم المورد</th>
              <td colspan="3">{{$invoice->name}}</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">الشركة</th>
              <td colspan="3">{{$invoice->company}}</td>
            </tr>
            <tr>
              <th scope="row">تاريخ اليوم</th>
              <td colspan="3" style="width: 250px;">{{date('d-m-Y',strtotime($invoice->created_at))}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>رقم الصنف</th>
              <th>المنتج</th>
              <th>سعر البيع</th>
              <th>الكميه</th>
              <th>الاجمالي</th>
            </tr>
          </thead>
          <tbody class="productsadd">
            @foreach($allproducts as $key=>$product)
            @php
            $totalfirst=$prices[$key] * $quantities[$key];
            @endphp
            <tr>
              <td>{{$ser_numbers[$key]}}</td>
              <td>{{$product->name}}</td>
              <td class="prices">{{number_format($prices[$key])}}</td>
              <td>{{$quantities[$key]}}</td>
              <td class="total_1">{{number_format($totalfirst)}}</td>
            </tr>
            @endforeach

            <tr>
              <td colspan="3"></td>
              <td style="background: #9dffd659">الاجمالي </td>
              <td style="background: #9dffd659">{{number_format($total)}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection