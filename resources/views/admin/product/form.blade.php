<!-- Nav tabs -->
@php
if(isset($product)){
$product_var=$product;
//----------------arrays------------------------
$descriptions = explode('%,%', $product->description);
$title_description = explode('%,%', $product->title_description);
$img_description=explode(',', $product->img_description);
$specs_names = explode(',', $product->specs_names);
$specs_name = explode(',', $product->specs_name);
$specs_desc = explode(',', $product->specs_desc);
$attachments=explode(',',$product->attachments);
$attachment_names = explode(',', $product->attachment_names);
$attachment_links = explode(',', $product->attachment_links);
$attachment_status = explode(',', $product->attachment_status);

if(isset($product->addon[0])){
$units = explode(',', $product->addon[0]->units);
$units_barcode = explode(',', $product->addon[0]->units_barcode);
$units_cons = explode(',', $product->addon[0]->units_cons);
$unit_default = $product->addon[0]->unit_default;
$prices = explode(',', $product->addon[0]->prices);
$prices_discounts = explode(',', $product->addon[0]->prices_discounts);
$prices_targets = explode(',', $product->addon[0]->prices_targets);
$gifts_ids = explode(',', $product->addon[0]->gifts_ids);
$gifts_quantities = explode(',', $product->addon[0]->gifts_quantities);
$gifts_for = explode(',', $product->addon[0]->gifts_for);
}
$charts_names = explode(',', $product->charts_names);
$charts_description = explode(',', $product->charts_description);
$charts=explode(',', $product->charts);
if(isset($product->market[0])){
$suppliers = explode(',', $product->market[0]->supplier);
$date = explode(',', $product->market[0]->date);
$sales_man = explode(',', $product->market[0]->sales_man);
$phone = explode(',', $product->market[0]->phone);
$price = explode(',', $product->market[0]->price);
$employee = explode(',', $product->market[0]->employee);
}

$name=$product->name;
$name_en=$product->name_en;
$code=$product->code;
$image=$product->image;

}

@endphp
@if(\Request::get('product_id'))
<input type="hidden" name="copyproduct" class="form-control" value="1">
@endif
<div class="row" style="background: #eaeaea; padding: 20px;">
  <div class="row">
    <div class="col-md-7">
      <div class="form-group">
        <label>?????????? ????????????</label>

        {!! Form::text("fullcode",(isset($product) && isset($product->brand)) ?
        "EE/".$product->brand->brandcode."/".$product->id : "", [
        "class" => "form-control",
        "placeholder" => '?????????? ????????????',
        "id"=>'fullcode',
        "disabled"=>'disabled',
        ]) !!}


      </div><!-- /.form-group -->
      @if(\Auth::user()->id == 9)
      <div class="form-group">
        <label>?????????? ?????????? </label>
        {!! Form::text("secret_num", isset($product) ? $product->secret_num : "", [
        "class" => "form-control",
        "placeholder" => '?????????? ??????????',
        ]) !!}
      </div><!-- /.form-group -->
      @else
      <input type="hidden" name="secret_num" value="{{isset($product) ? $product->secret_num : ""}}" />
      @endif
      <div class="form-group">
        <label>?????? ????????????</label>

        {!! Form::text("code", isset($product) ? $code : "", [
        "class" => "form-control",
        "placeholder" => '?????? ????????????',
        "required"
        ]) !!}
      </div><!-- /.form-group -->


      <div class="form-group">
        <label>?????????? ????????????</label>
        {!! Form::text("name", isset($product) ? $name : "", [
        "class" => "form-control",
        "placeholder" => '?????????? ????????????',
        "required"
        ]) !!}
      </div><!-- /.form-group -->


      <div class="form-group">
        <label>?????????? ????????????????</label>

        {!! Form::text("name_en", isset($product) ? $name_en : "", [
        "class" => "form-control text-left",
        "placeholder" => "?????????? ????????????????",
        ]) !!}
      </div><!-- /.form-group -->

    </div>


    <div class="col-md-5">
      ???????? ????????????: <input type="file" name="image">

      @if(isset($product))
      <input type="hidden" name="oldimage" value="{{$product->image}}">
      <table class="table">
        <tr>
          <td colspan="4">
            <img class="proimg" src="{{url('/')}}/uploads/products-attachments/{{$product->image}}" alt="{{$product->name}}">
          </td>
        </tr>
        <tr style="border: 1px solid;">
          <th style="border: 1px solid #a8a8a8;">??????????????</th>
          <th style="border: 1px solid #a8a8a8;">????????????</th>
          <th style="border: 1px solid #a8a8a8;">??????????????</th>
          <th style="border: 1px solid #a8a8a8;">????????????</th>
        </tr>
        <tr>
          <td> <img class="icoimg" style="width: 70px;"
              src="{{(isset($product->brand) ? url('/').'/uploads/brands_images/'.$product->brand->image : '')}}" alt="">
          </td>
          <td> <img class="icoimg" style="width: 80px;"
              src="{{(isset($product->origin) ? url('/').'/uploads/countries/'.$product->origin->image : '')}}" alt="">
          </td>
          <td> <img class="icoimg" style="width: 80px;"
              src="{{(isset($product->country) ? url('/').'/uploads/countries/'.$product->country->image : '')}}" alt="">
          </td>
          <td>
            @if($product->insurance == '3 ????????')
            <img style="width: 70px;" class="icoimg" src="{{url('/')}}/uploads/insurances_images/3months.png" alt="">
            @elseif($product->insurance == '6 ????????')
            <img style="width: 70px;" class="icoimg" src="{{url('/')}}/uploads/insurances_images/6months.png""
              alt="">
              @elseif($product->insurance == '1 ??????')
              <img style=" width: 70px;" class="icoimg" src="{{url('/')}}/uploads/insurances_images/1Year.png""
              alt="">
              @elseif($product->insurance == '2 ??????')
              <img style=" width: 70px;" class="icoimg" src="{{url('/')}}/uploads/insurances_images/2Year.png""
              alt="">
              @endif
          </td>
        </tr>

      </table>
      @endif
    </div>

</div>
</div>

<br>
<style>
  .imgdiv {
    width: 100%;
    height: 310px;
    border: 1px solid #ccc;
    position: relative;
  }

  .nav-tabs {
    margin-bottom: 25px;
    background: #e4e4e4;
  }

  .nav-tabs .navvlink {
    color: #000 !important;
  }

  .nav-link.active {
    color: black !important;
  }

  .nav-tabs .nav-link:hover {
    /* border: none; */
  }

  img.proimg {
    width: auto;
    height: 220px;
    margin: auto;
    display: block;
  }

  img.icoimg {
    width: 100%;
    display: block;
    margin: auto;
    height: 60px;
  }

  .table td,
  .table th {
    padding: 0.55rem 2rem !important;
    font-weight: 400 !important;
  }

  .table {
    margin-top: 5px;
  }

  .table thead th {
    vertical-align: bottom;
    border: 1px solid #bdbdbd;
  }
  textarea {
    height: auto !important;
}
.centeritems{
  display: flex;  /* make the row a flex container */
  align-items: center; /* vertically center each flex item in the container */
}
.clickrem{
  color: red;
    background: bisque;
    padding: 9px;
}
</style>
<ul class=" nav nav-tabs">
            <li class="nav-item navbitem">
              <a class="nav-link navvlink active" data-toggle="tab" href="#home">??????</a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu4">?????????????? ????????</a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu5">????????????????</a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu1">??????????</a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu2">??????</a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu8">??????????????</a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu9">???????????????? ??????????????</a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu10"> ????????????????????</a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu11">???????????????? </a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu12">???????? ???????????? </a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu13">???????????? </a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu14">???????? ?????? ???????????? </a>
            </li>
            {{-- <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu15"> ?????? ???????????? </a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu16"> ?????????????????????? </a>
            </li> --}}
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu3"> ???????????? ?????????????????? </a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu17"> ?????????????????? </a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu18"> ?????????????? </a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu19"> ???????????? ?????????? </a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu20"> ???????? ?????????????? </a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu21"> ???????? ?????????????? </a>
            </li>
            {{-- <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu12">???????? ???????????? </a>
            </li> --}}



            {{-- <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu4">???????? ????????????</a>
            </li> --}}
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              @include('admin.product.tabs.general')
              @include('admin.product.tabs.specs')
              @include('admin.product.tabs.attachments')
              @include('admin.product.tabs.prices')
              @include('admin.product.tabs.gifts')
              @include('admin.product.tabs.install')
              @include('admin.product.tabs.warehouse')
              @include('admin.product.tabs.units')
              @include('admin.product.tabs.reserve')
              @include('admin.product.tabs.productreport')
              @include('admin.product.tabs.insurance')
              @include('admin.product.tabs.partsplan')
              @include('admin.product.tabs.groups')
              @include('admin.product.tabs.purchases')
              @include('admin.product.tabs.market')
              @include('admin.product.tabs.installment')
              @include('admin.product.tabs.maintainance')
              @include('admin.product.tabs.roles')
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


            <script>
              $(".menu1").click(function(){
$("#menu1").append('<div style="margin-top:50px" class="col-md-6"> <div class="form-group"> <label>?????? ??????????????</label> {!! Form::text("resp_name[]","", [ "class" => "form-control", "placeholder" => "?????? ??????????????" ]) !!} </div><!-- /.form-group --> <div class="form-group"> <label>????????????</label> {!! Form::text("work[]","", [ "class" => "form-control", "placeholder" => "????????????", ]) !!} </div><!-- /.form-group --> <div class="form-group"> <label>?????? ????????????</label> {!! Form::text("resp_tele[]","", [ "class" => "form-control", "placeholder" => "?????? ????????????", ]) !!} </div><!-- /.form-group --> </div> <div style="margin-top:50px" class="col-md-6"> <div class="form-group"> <label>????????????</label> {!! Form::text("resp_phone[]","", [ "class" => "form-control", "placeholder" => "????????????" ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("email") ? " has-error" : "" }}"> <label>???????????? ????????????????????</label> {!! Form::email("resp_email[]","", [ "class" => "form-control", "placeholder" => "???????????? ????????????????????" ]) !!} @if ($errors->has("email")) <span class="help-block"> <strong style="color:red">{{ $errors->first("email") }}</strong> </span> @endif </div><!-- /.form-group --> <div class="form-group"> <label>????????????</label> {!! Form::text("resp_tele_red[]","", [ "class" => "form-control", "placeholder" => "????????????"]) !!} </div><!-- /.form-group --> </div>');
  return false;
  })





$(".menu3").click(function(){
$("#menu3").append('<br><div style="margin-top:50px" class="col-md-6"> <div class="form-group"> <label>??????????</label> {!! Form::text("locate[]","", [ "class" => "form-control", "placeholder" => "??????????" ]) !!} </div><!-- /.form-group --> <div class="form-group"> <label>????????????</label> {!! Form::text("phonenumber[]","", [ "class" => "form-control", "placeholder" => "????????????"]) !!} </div><!-- /.form-group --> <div class="form-group"> <label>????????</label> {!! Form::text("fax[]","", [ "class" => "form-control", "placeholder" => "????????????" ]) !!} </div><!-- /.form-group --> <div class="form-group"> <label>????????????</label> {!! Form::text("telephone[]","", [ "class" => "form-control", "placeholder" => "????????????" ]) !!} </div><!-- /.form-group --> </div> <div style="margin-top:50px" class="col-md-6"> <div class="form-group"> <label>??????????????</label> {!! Form::text("city[]","", [ "class" => "form-control", "placeholder" => "??????????????" ]) !!} </div><!-- /.form-group --> <div class="form-group"> <label>???????????? 2</label> {!! Form::text("phonenumbertwo[]","", [ "class" => "form-control", "placeholder" => "???????????? 2"]) !!} </div><!-- /.form-group --> <div class="form-group"> <label>???????????? ????????????????????</label> {!! Form::text("email_add[]","", [ "class" => "form-control", "placeholder" => "???????????? ????????????????????" ]) !!} </div><!-- /.form-group --> <div class="form-group"> <label>????????????</label> {!! Form::text("telephone_red[]","", [ "class" => "form-control", "placeholder" => "????????????" ]) !!} </div><!-- /.form-group --> </div>');
  return false;
  })


$(".clickrem").click(function(){
id=$(this).attr('id');
var r = confirm("???? ?????? ?????????? ???? ?????????? ??????????");
if (r == true) {
$(this).parent().parent().remove();
var parts = id.split('btu-', 2);
target=parts[1];
$('.'+target).hide('slow');
$('#'+target).remove();
$('#'+target+'_name').remove();
$('#'+target+'_link').remove();

$(this).hide('slow');
} else {
return false;
}
})
$(document).on("click",".removethis",function() {
var r = confirm("???? ?????? ?????????? ??");
if (r == true) {
$(this).parent().parent().remove();
} else {
return false;
}
})

$(".clickremchart").click(function(){
id=$(this).attr('id');
var r = confirm("???? ?????? ?????????? ???? ?????????? ??????????");
if (r == true) {
$(this).parent().parent().remove();
 var parts = id.split('btu-', 2);
 target=parts[1];
$('#'+target+'_name').remove();
$('#'+target+'_description').remove();
  return false;
} else {
  return false;
}
})
$(".deletethisimg").click(function(){
num=$(this).data('num');
if(confirm("???? ?????? ?????????? ???? ?????????? ??????????????")){
$(".oldimgdesc"+num).val('');
$(".imgdiv"+num).remove();
}else{
  return false;
}
})

$(document).on("click",".clickremrow",function() {
  $(this).parents("tr:first").remove();
})

$(document).on("click",".clickremmarket",function() {
  $(this).parents("tr:first").remove();
})


            </script>
            <style>
              .navbitem {
                float: right !important;
                font-size: 14px;
                width: auto;
                text-align: center;
              }

              .clickrem,
              .clickremchart {
                cursor: pointer;
              }

              .headtitlee {
                background: #1d2b36;
                color: #fff;
                padding: 10px;
                font-weight: bold;
                border-bottom: 0.1px solid #ccc;
                padding-bottom: 10px;
                font-size: 15px;
                border-radius: 5px;
                display: flex;
              }

              .selectproduct {
                text-align: right;
              }

              text-align: right;
              }

              .select2-selection__rendered {
                text-align: right;
              }

              .clickremrow,
              .clickremmarket {
                background: antiquewhite;
                padding: 7px;
                cursor: pointer;
                color: red;
              }

              .nav.nav-tabs .nav-item .nav-link {
                padding: 0.5rem 0.9rem;
              }

              .select2-container {
                margin-top: 5px !important;
                width: 100% !important;
                direction: rtl;
                text-align: right;
              }

              .text-left {
                text-align: left;
                direction: ltr;

              }
            </style>

            <div class="col-md-12">
              <input type="hidden" name="submit_status" id="submitstatus" value="0" id="">
              <hr>
              <div class="clear">
                <button type="submit" class="btn btn-success">
                  <i class="icon-check2"></i> {{ trans('admin.save') }}
                </button>
                <button type="submit" id="submitcontinue" class="btn btn-success">
                  <i class="icon-check2"></i> ?????? ????????????????
                </button>
                <button type="submit" id="submitprint" class="btn btn-success">
                  <i class="icon-check2"></i> ?????? ?? ??????????
                </button>
                </a>
              </div>
            </div>


            <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

            <style>
              th,
              td {
                text-align: center;
              }

              .table-striped tbody tr:nth-of-type(odd) {
                background: #dff0d8 !important;
              }

              .table-striped tbody tr:nth-of-type(even) {
                background: #f2dede !important;
              }
            </style>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

            <script>
              $(document).ready(function(){
                $("#submitcontinue").click(function(){
                  $('#submitstatus').val(1);
                })
                $("#submitprint").click(function(){
                  $('#submitstatus').val(2);
                })
      i=0;
      e=0;
      z=1;
      q=1;
      indexnum=$("#indexnum").val();
      if(indexnum && indexnum !== ''){
        z=indexnum;
      }
      $("#add-unit").click(function(){
z++;
$(".unitsrows").append('<div class="row"> <div class="col-md-4"> <div class="form-group"> <label>???????????? '+z+'</label> {!! Form::text("units[]", "", [ "class" => "form-control", "placeholder" => "????????????", ]) !!} </div><!-- /.form-group --> </div> <div class="col-md-4"> <div class="form-group"> <label>???????? ??????????????</label> {!! Form::number("units_cons[]","" , [ "class" => "form-control", "placeholder" => "???????? ??????????????", ]) !!} </div><!-- /.form-group --> </div> <div class="col-md-4"> <div class="form-group"> <label>?????? ????????????????</label> {!! Form::text("units_barcode[]","" , [ "class" => "form-control", "placeholder" => "?????? ????????????????", ]) !!} </div><!-- /.form-group --> </div> </div> <div class="form-group"> <label><input type="radio" value="'+z+'" name="unit_default[]"> ?????????????????? </label> <br><br> </div><!-- /.form-group -->');
$(".pricesadd").append('<div class="col-md-12"> <h5>?????? ???????????? '+z+'</h5> <div class="col-md-4"> <div class="form-group"> <label>?????????? </label> {!! Form::number("prices[]", "", [ "class" => "form-control", "placeholder" => "??????????" ]) !!} </div><!-- /.form-group --> </div> <div class="col-md-4"> <div class="form-group"> <label>?????????? ???????????? </label> {!! Form::number("prices_discounts[]", "", [ "class" => "form-control", "placeholder" => "?????????? ????????????" ]) !!} </div><!-- /.form-group --> </div> <div class="col-md-4"> <div class="form-group"> <label>?????????? ??????????????????</label> <select name="prices_targets[]" class="form-control"> <option value="">???????? ??????????</option> <option value="1"> ???????????? </option> <option value="2"> ?????????????? </option> </select> </div><!-- /.form-group --> </div> </div>')
return false;
})


$("#add-product").click(function(){
  i++;
$(".productsadd").append('<tr> <td> <select style="width:350px;" name="product[]" class="form-control selectproduct" > <option value="">???????? ????????????</option> @foreach($products as $product) <option value="{{ $product->id }}">{{ $product->name }}</option> @endforeach </select> </td>  <td> <input type="number"  value="1" placeholder="????????????" min="1" class="form-control productquantity" name="quantity[]"> </td><td> <div class="checkbox"><input type="hidden" name="group_status['+i+']" value="" /> <label><input type="checkbox" name="group_status['+i+']"> ?????????????? </label> </div> </td> <td> <i  class="fa fa-times clickremrow"></i> </td> </tr>');

$('.selectproduct').select2();
return false;
})


$("#add-product-1").click(function(){
  i++;
$(".productsadd").append('<tr> <td> <select style="width:350px;" name="product[]" class="form-control selectproduct" > <option value="">???????? ????????????</option> @foreach($products as $product) <option value="{{ $product->id }}">{{ $product->name }}</option> @endforeach </select> </td>  <td> <input type="number"  value="1" placeholder="????????????" min="1" class="form-control productquantity" name="quantity[]"> </td><td> <div class="checkbox"><input type="hidden" name="group_status['+i+']" value="" /> <label><input type="checkbox" name="group_status['+i+']"> ?????????????? </label> </div> </td> <td> <i  class="fa fa-times clickremrow"></i> </td> </tr>');

$('.selectproduct').select2();
return false;
})


$("#add-product-2").click(function(){
  e++;
$(".marketadd").append('<tr> <td> <input type="text"  placeholder="?????? ????????????" class="form-control" name="supplier[]"> </td> <td> <input type="date"  placeholder="??????????????" min="1" class="form-control" name="date[]"> </td> <td> <input type="text"  placeholder="?????????????? " class="form-control" name="sales_man[]"> </td> <td> <input type="number" placeholder="?????? ????????????" min="1" class="form-control" name="phone[]"> </td> <td> <input type="text"  placeholder="?????????? " class="form-control" name="price[]"></td> <td> <input type="text"  placeholder="?????? ???????????? " class="form-control" name="employee[]"> </td> <td> <i class="fa fa-times clickremrow"></i> </td> </tr>');
return false;
})



$(".productquantity").keyup(function(){


})

$('.selectproduct').select2();

$("#addinputf").click(function(){
    $("#filesinput").append('<div class="row"> <div class="col-md-2"> <select name="attachment_names[]" class="form-control" id=""> <option value="">???????? ??????????????</option> @foreach($attachcats as $attachcat) <option value="{{$attachcat->name}}">{{$attachcat->name}}</option> @endforeach </select><input type="hidden" name="counter[]" value="0"></div> <div class="col-md-4"> {!! Form::text("attachment_links[]", "", [ "class" => "form-control", "placeholder" => "???????? ??????????????", ]) !!} </div> <div class="col-md-2"> <input accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file" name="attachments[]"> </div> <div class="col-md-2"> <label class="checkbox-inline"><input type="checkbox" name="attachment_status[]"  value="1" checked> ???????? </label> </div> <div class="col-md-2">  </div> </div> <br>');
     return false;
 })

 $("#addinputparts").click(function(){
    $("#filesinputparts").append('<div class="row"> <div class="col-md-3"> {!! Form::text("charts_names[]", "", [ "class" => "form-control", "placeholder" => "?????? ??????????????", ]) !!} </div> <div class="col-md-4"> {!! Form::text("charts_description[]", "", [ "class" => "form-control", "placeholder" => "?????? ??????????????", ]) !!} </div> <div class="col-md-3"> <input accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file" name="charts[]"> </div> </div> <br>');
     return false;
 })

 $("#addchart").click(function(){
    $("#chartsinput").append('<br><input accept="image/*" type="file" name="charts[]">');
     return false;
 })

$(".tagsadd").select2({
      tags: true
    });



  $("#add-spec").click(function(){

$("#addspecification").append('<div class="col-md-8" style="padding: 0px !important;"> <input type="text" class="form-control"  name="title_description[]" placeholder="?????????? ??????????"> </div><div class="col-md-4"><input type="file" name="img_description[]"></div>{!! Form::textarea("description[]", "", [ "class" => "form-control", "placeholder" => "?????????????? ????????????","rows"=>5,"style"=>"direction:ltr" ]) !!}<br>');
return false;
})



$(".specs_select2_type").select2({
  tags: true
});

$("#add-specfic").click(function(){
q++;
$("#addspecifications").append('<div class="row"><div class="col-md-3"> <select class="form-control" name="specs_sections[]"> <option value="">???????? ??????????????</option> @foreach($sections as $section) <option value="{{$section->id}}">{{$section->name}}</option> @endforeach </select> </div><div class="col-md-3"> <select class="form-control specs_select2_type" data-numb="1" name="specs_names[]"> <option value="??????????">??????????</option> <option value="??????????">??????????</option> <option value="????????????????">????????????????</option> <option value="?????????? ????????????????????????">?????????? ????????????????????????</option> <option value="????????????????">????????????????</option> <option value="???????? ??????????????">???????? ??????????????</option> </select> </div> <div class="col-md-5 colm9-1" style="margin-bottom:10px"> {!! Form::text("specs_desc[]", "", [ "class" => "form-control", "placeholder" => "??????????","style" => "direction: ltr" ]) !!} </div><div class="col-md-1"> <i class="fa fa-close removethis"></i> </div></div>');
$(".specs_select2_type").select2({
  tags: true
});
return false;
})

$("#add-gift").click(function(){
$(".addgift").append('<div class="row"> <div class="col-md-3"><div class="form-group"> <label> ????????????</label> <select name="gifts_ids[]" class="form-control" id=""> <option value=""> ???????? ????????????</option>@foreach($gifts as $gift)<option value="{{$gift->id}}">{{$gift->name}}</option>@endforeach </select> </div><!-- /.form-group --> </div> <div class="col-md-3"> <div class="form-group"> <label> ????????????</label> {!! Form::number("gifts_quantities[]", "" , [ "class" => "form-control", "placeholder" => "???????????? ", ]) !!} </div><!-- /.form-group --> </div> <div class="col-md-3"> <div class="form-group"> <label>?????? </label> {!! Form::text("gifts_for[]",  "" , [ "class" => "form-control", "placeholder" => "???????????? ??????", ]) !!} </div><!-- /.form-group --> </div> <div class="col-md-3"> </div> </div>');
return false;
})


var ctx = document.getElementById('myChart').getContext('2d');
ctx.width = 100;
ctx.height = 100;
data = {
    datasets: [{
        data: [4, 13],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
					],
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        '????????????',
        '????????????????',
    ]
};

var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: data,
    options: {
			responsive: true
			}

    });


//-----------------------------------
var ctx_2 = document.getElementById('myCharttotal').getContext('2d');
var canvas = document.getElementsByTagName('canvas')[0];

canvas.width  = 200;
canvas.height = 100;
ctx_2.width  = 200;
ctx_2.height = 100;

data = {
    datasets: [{
        data: [2000, 1800,200],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
					],
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        '??????????',
        '??????????????',
        '??????????',
    ]
};

var myPieChart = new Chart(ctx_2, {
    type: 'pie',
    data: data,
    options: {
			responsive: true
			}

    });



$(document).on('change', '.specs_type', function() {
  selectvalue=$(this).val();
  numb=$(this).data("numb");
if(selectvalue==0){
  $('.nameattr-'+numb).show('slow');
  $('.colm9-'+numb).removeClass('col-md-9').addClass('col-md-6');
}else{
  $(".nameattr-"+numb).hide('slow');
  $(".nameattr-"+numb).val('');
  $('.colm9-'+numb).removeClass('col-md-6').addClass('col-md-9');
}

})


})
            </script>