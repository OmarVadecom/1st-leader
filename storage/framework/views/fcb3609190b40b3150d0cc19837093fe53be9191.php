<!-- Nav tabs -->
<?php
if(isset($product)){
//----------------arrays------------------------
$descriptions = explode(',', $product->description);
$specs_names = explode(',', $product->specs_names);
$specs_name = explode(',', $product->specs_name);
$specs_desc = explode(',', $product->specs_desc);
$attachments=explode(',',$product->attachments);
$attachment_names = explode(',', $product->attachment_names);
if(isset($product->addon[0])){
$units = explode(',', $product->addon[0]->units);
$units_barcode = explode(',', $product->addon[0]->units_barcode);
$units_cons = explode(',', $product->addon[0]->units_cons);
$unit_default = $product->addon[0]->unit_default;
$prices = explode(',', $product->addon[0]->prices);
$prices_discounts = explode(',', $product->addon[0]->prices_discounts);
$prices_targets = explode(',', $product->addon[0]->prices_targets);
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

$products_in = explode(',', $product->products_id);

// $product_out_code = explode(',', $product->productsout->code);
// $product_out_company = explode(',', $product->productsout->company);
// $product_out_wakel = explode(',', $product->productsout->wakel);
// $product_out_images = explode(',', $product->productsout->image);
$products_award = explode(',', $product->related_ids);


}

$name=$product->name;
$name_en=$product->name_en;
$code=$product->code;
$image=$product->image;

}

?>
<?php if(\Request::get('part_id')): ?>
<input type="hidden" name="copyproduct" class="form-control" value="1">
<?php endif; ?>
<div class="row" style="background: #eaeaea; padding: 20px;">
  <div class="row">
    <div class="col-md-7">


      <div class="form-group">
        <label>?????????? ????????????</label>

        <?php echo Form::text("fullcode",(isset($product) && isset($product->brand)) ?
        "ES/".$product->brand->brandcode."/".$product->id : "", [
        "class" => "form-control",
        "placeholder" => '?????????? ????????????',
        "id"=>'fullcode',
        "disabled"=>'disabled',
        ]); ?>



      </div><!-- /.form-group -->
      <?php if(\Auth::user()->id == 9): ?>
      <div class="form-group">
        <label>?????????? ?????????? </label>
        <?php echo Form::text("secret_num", isset($product) ? $product->secret_num : "", [
        "class" => "form-control",
        "placeholder" => '?????????? ??????????',
        ]); ?>

      </div><!-- /.form-group -->
      <?php else: ?>
      <input type="hidden" name="secret_num" value="<?php echo e(isset($product) ? $product->secret_num : ""); ?>" />
      <?php endif; ?>
      <div class="form-group">
        <label>?????? ????????????</label>

        <?php echo Form::text("code", isset($product) ? $code : "", [
        "class" => "form-control",
        "placeholder" => '?????? ????????????',
        "required"
        ]); ?>

      </div><!-- /.form-group -->


      <div class="form-group">
        <label>?????????? ????????????</label>
        <?php echo Form::text("name", isset($product) ? $name : "", [
        "class" => "form-control",
        "placeholder" => '?????????? ????????????',
        "required"
        ]); ?>

      </div><!-- /.form-group -->


      <div class="form-group">
        <label>?????????? ????????????????</label>

        <?php echo Form::text("name_en", isset($product) ? $name_en : "", [
        "class" => "form-control",
        "placeholder" => "?????????? ????????????????",
        ]); ?>

      </div><!-- /.form-group -->

    </div>


    <div class="col-md-5">
      ???????? ???????? ????????????: <input type="file" name="image">

      <?php if(isset($product)): ?>
      <input type="hidden" name="oldimage" value="<?php echo e($product->image); ?>">
      <table class="table">
        <tr>
          <td colspan="4">
            <img class="proimg" src="<?php echo e(url('/')); ?>/uploads/parts-attachments/<?php echo e($product->image); ?>" alt="<?php echo e($product->name); ?>">
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
              src="<?php echo e((isset($product->brand) ? url('/'). '/uploads/brands_images/'.$product->brand->image : '')); ?>" alt="">
          </td>
          <td> <img class="icoimg" style="width: 80px;"
              src="<?php echo e((isset($product->origin) ? url('/').'/uploads/countries/'.$product->origin->image : '')); ?>" alt="">
          </td>
          <td> <img class="icoimg" style="width: 80px;"
              src="<?php echo e((isset($product->country) ? url('/').'/uploads/countries/'.$product->country->image : '')); ?>" alt="">
          </td>
          <td>
            <?php if($product->insurance == '3 ????????'): ?>
            <img style="width: 70px;" class="icoimg" src="<?php echo e(url('/')); ?>/uploads/insurances_images/3months.png" alt="">
            <?php elseif($product->insurance == '6 ????????'): ?>
            <img style="width: 70px;" class="icoimg" src="<?php echo e(url('/')); ?>/uploads/insurances_images/6months.png""
              alt="">
              <?php elseif($product->insurance == '1 ??????'): ?>
              <img style=" width: 70px;" class="icoimg" src="<?php echo e(url('/')); ?>/uploads/insurances_images/1Year.png""
              alt="">
              <?php elseif($product->insurance == '2 ??????'): ?>
              <img style=" width: 70px;" class="icoimg" src="<?php echo e(url('/')); ?>/uploads/insurances_images/2Year.png""
              alt="">
              <?php endif; ?>
          </td>
        </tr>

      </table>
      <?php endif; ?>
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
</style>
<ul class=" nav nav-tabs">
            <li class="nav-item navbitem">
              <a class="nav-link navvlink active" data-toggle="tab" href="#home">??????</a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu4">?????????????? ????????</a>
            </li>
            <li class="nav-item navbitem">
              <a class="nav-link navvlink" data-toggle="tab" href="#menu30"> ???????????????? ????????????????</a>
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
              <a class="nav-link navvlink" data-toggle="tab" href="#menu13">???????????? </a>
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
              <a class="nav-link navvlink" data-toggle="tab" href="#menu14">???????? ?????? ???????????? </a>
            </li>
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
            
            
            
            



            
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <?php echo $__env->make('admin.parts.tabs.general', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.specs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.products', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.attachments', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.prices', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.install', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.warehouse', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.units', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.reserve', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.productreport', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.insurance', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.partsplan', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.awards', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.groups', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.purchases', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.market', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.installment', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.maintainance', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <?php echo $__env->make('admin.parts.tabs.roles', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


            <script>
              $(".menu1").click(function(){
$("#menu1").append('<div style="margin-top:50px" class="col-md-6"> <div class="form-group"> <label>?????? ??????????????</label> <?php echo Form::text("resp_name[]","", [ "class" => "form-control", "placeholder" => "?????? ??????????????" ]); ?> </div><!-- /.form-group --> <div class="form-group"> <label>????????????</label> <?php echo Form::text("work[]","", [ "class" => "form-control", "placeholder" => "????????????", ]); ?> </div><!-- /.form-group --> <div class="form-group"> <label>?????? ????????????</label> <?php echo Form::text("resp_tele[]","", [ "class" => "form-control", "placeholder" => "?????? ????????????", ]); ?> </div><!-- /.form-group --> </div> <div style="margin-top:50px" class="col-md-6"> <div class="form-group"> <label>????????????</label> <?php echo Form::text("resp_phone[]","", [ "class" => "form-control", "placeholder" => "????????????" ]); ?> </div><!-- /.form-group --> <div class="form-group<?php echo e($errors->has("email") ? " has-error" : ""); ?>"> <label>???????????? ????????????????????</label> <?php echo Form::email("resp_email[]","", [ "class" => "form-control", "placeholder" => "???????????? ????????????????????" ]); ?> <?php if($errors->has("email")): ?> <span class="help-block"> <strong style="color:red"><?php echo e($errors->first("email")); ?></strong> </span> <?php endif; ?> </div><!-- /.form-group --> <div class="form-group"> <label>????????????</label> <?php echo Form::text("resp_tele_red[]","", [ "class" => "form-control", "placeholder" => "????????????"]); ?> </div><!-- /.form-group --> </div>');
  return false;
  })





$(".menu3").click(function(){
$("#menu3").append('<br><div style="margin-top:50px" class="col-md-6"> <div class="form-group"> <label>??????????</label> <?php echo Form::text("locate[]","", [ "class" => "form-control", "placeholder" => "??????????" ]); ?> </div><!-- /.form-group --> <div class="form-group"> <label>????????????</label> <?php echo Form::text("phonenumber[]","", [ "class" => "form-control", "placeholder" => "????????????"]); ?> </div><!-- /.form-group --> <div class="form-group"> <label>????????</label> <?php echo Form::text("fax[]","", [ "class" => "form-control", "placeholder" => "????????????" ]); ?> </div><!-- /.form-group --> <div class="form-group"> <label>????????????</label> <?php echo Form::text("telephone[]","", [ "class" => "form-control", "placeholder" => "????????????" ]); ?> </div><!-- /.form-group --> </div> <div style="margin-top:50px" class="col-md-6"> <div class="form-group"> <label>??????????????</label> <?php echo Form::text("city[]","", [ "class" => "form-control", "placeholder" => "??????????????" ]); ?> </div><!-- /.form-group --> <div class="form-group"> <label>???????????? 2</label> <?php echo Form::text("phonenumbertwo[]","", [ "class" => "form-control", "placeholder" => "???????????? 2"]); ?> </div><!-- /.form-group --> <div class="form-group"> <label>???????????? ????????????????????</label> <?php echo Form::text("email_add[]","", [ "class" => "form-control", "placeholder" => "???????????? ????????????????????" ]); ?> </div><!-- /.form-group --> <div class="form-group"> <label>????????????</label> <?php echo Form::text("telephone_red[]","", [ "class" => "form-control", "placeholder" => "????????????" ]); ?> </div><!-- /.form-group --> </div>');
  return false;
  })


$(".clickrem").click(function(){
id=$(this).attr('id');
var r = confirm("???? ?????? ?????????? ???? ?????????? ??????????");
if (r == true) {
var parts = id.split('btu-', 2);
target=parts[1];
$('.'+target).hide('slow');
$('#'+target).remove();
$('#'+target+'_name').remove();
$(this).hide('slow');
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
} else {
  return false;
}
})



$(document).on("click",".clickremrow",function() {
  $(this).parents("tr:first").remove();
})

$(document).on("click",".clickremmarket",function() {
  $(this).parents("tr:first").remove();
})
$(document).on("click",".clickremproin",function() {
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
              .clickremmarket,
              .clickremproin {
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
            </style>

            <div class="col-md-12">
              <input type="hidden" name="submit_status" id="submitstatus" value="0" id="">
              <hr>
              <div class="clear">
                <button type="submit" class="btn btn-success">
                  <i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

                </button>
                <button type="submit" id="submitcontinue" class="btn btn-success">
                  <i class="icon-check2"></i> ?????? ????????????????
                </button>
                <?php if(isset($product)): ?>
                <button class="btn btn-primary">
                  <i class="fa fa-file"></i> ??????????
                </button>
                <?php endif; ?>
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
$(".unitsrows").append('<div class="row"> <div class="col-md-4"> <div class="form-group"> <label>???????????? '+z+'</label> <?php echo Form::text("units[]", "", [ "class" => "form-control", "placeholder" => "????????????", ]); ?> </div><!-- /.form-group --> </div> <div class="col-md-4"> <div class="form-group"> <label>???????? ??????????????</label> <?php echo Form::number("units_cons[]","" , [ "class" => "form-control", "placeholder" => "???????? ??????????????", ]); ?> </div><!-- /.form-group --> </div> <div class="col-md-4"> <div class="form-group"> <label>?????? ????????????????</label> <?php echo Form::text("units_barcode[]","" , [ "class" => "form-control", "placeholder" => "?????? ????????????????", ]); ?> </div><!-- /.form-group --> </div> </div> <div class="form-group"> <label><input type="radio" value="'+z+'" name="unit_default[]"> ?????????????????? </label> <br><br> </div><!-- /.form-group -->');
$(".pricesadd").append('<div class="col-md-12"> <h5>?????? ???????????? '+z+'</h5> <div class="col-md-4"> <div class="form-group"> <label>?????????? </label> <?php echo Form::number("prices[]", "", [ "class" => "form-control", "placeholder" => "??????????" ]); ?> </div><!-- /.form-group --> </div> <div class="col-md-4"> <div class="form-group"> <label>?????????? ???????????? </label> <?php echo Form::number("prices_discounts[]", "", [ "class" => "form-control", "placeholder" => "?????????? ????????????" ]); ?> </div><!-- /.form-group --> </div> <div class="col-md-4"> <div class="form-group"> <label>?????????? ??????????????????</label> <select name="prices_targets[]" class="form-control"> <option value="">???????? ??????????</option> <option value="1"> ???????????? </option> <option value="2"> ?????????????? </option> </select> </div><!-- /.form-group --> </div> </div>')
return false;
})


$("#add-product").click(function(){
  i++;
$(".productsadd").append('<tr> <td> <select style="width:350px;" name="product[]" class="form-control selectproduct" > <option value="">???????? ????????????</option> <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select> </td>  <td> <input type="number"  value="1" placeholder="????????????" min="1" class="form-control productquantity" name="quantity[]"> </td><td> <div class="checkbox"><input type="hidden" name="group_status['+i+']" value="" /> <label><input type="checkbox" name="group_status['+i+']"> ?????????????? </label> </div> </td> <td> <i  class="fa fa-times clickremrow"></i> </td> </tr>');

$('.selectproduct').select2();
return false;
})


$("#add-product-1").click(function(){
  i++;
$(".productsadd").append('<tr> <td> <select style="width:350px;" name="product[]" class="form-control selectproduct" > <option value="">???????? ????????????</option> <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select> </td>  <td> <input type="number"  value="1" placeholder="????????????" min="1" class="form-control productquantity" name="quantity[]"> </td><td> <div class="checkbox"><input type="hidden" name="group_status['+i+']" value="" /> <label><input type="checkbox" name="group_status['+i+']"> ?????????????? </label> </div> </td> <td> <i  class="fa fa-times clickremrow"></i> </td> </tr>');

$('.selectproduct').select2();
return false;
})


$("#add-product-2").click(function(){
  e++;
$(".marketadd").append('<tr> <td> <input type="text"  placeholder="?????? ????????????" class="form-control" name="supplier[]"> </td> <td> <input type="date"  placeholder="??????????????" min="1" class="form-control" name="date[]"> </td> <td> <input type="text"  placeholder="?????????????? " class="form-control" name="sales_man[]"> </td> <td> <input type="number" placeholder="?????? ????????????" min="1" class="form-control" name="phone[]"> </td> <td> <input type="text"  placeholder="?????????? " class="form-control" name="price[]"></td> <td> <input type="text"  placeholder="?????? ???????????? " class="form-control" name="employee[]"> </td> <td> <i class="fa fa-times clickremrow"></i> </td> </tr>');
return false;
})


$("#add-product-pro-in").click(function(){
  // e++;
$(".pro-in-add").append('<tr> <td> <input type="text"  placeholder="?????? ????????????" class="form-control" name="product_out_code[]"> </td> <td> <input type="text"  placeholder="????????????" min="1" class="form-control" name="product_out_company[]"> </td> <td> <input type="text"  placeholder="?????? ???????????? " class="form-control" name="product_out_wakel[]"> </td> <td> <input type="file" class="form-control" name="product_out-files[]"> </td> <td> <i class="fa fa-times clickremproin"></i> </td> </tr>');
return false;
})

$(".productquantity").keyup(function(){


})

$('.selectproduct').select2();

$("#addinputf").click(function(){
    $("#filesinput").append('<div class="row"> <div class="col-md-6"> <?php echo Form::text("attachment_names[]", "", [ "class" => "form-control", "placeholder" => "?????? ??????????????", ]); ?> </div> <div class="col-md-4"> <input accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file" name="attachments[]"> </div> <div class="col-md-2"> </div> </div> <br>');
     return false;
 })

 $("#addinputparts").click(function(){
    $("#filesinputparts").append('<div class="row"> <div class="col-md-3"> <?php echo Form::text("charts_names[]", "", [ "class" => "form-control", "placeholder" => "?????? ??????????????", ]); ?> </div> <div class="col-md-4"> <?php echo Form::text("charts_description[]", "", [ "class" => "form-control", "placeholder" => "?????? ??????????????", ]); ?> </div> <div class="col-md-3"> <input accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file" name="charts[]"> </div> </div> <br>');
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

$("#addspecification").append('<?php echo Form::text("description[]", "", [ "class" => "form-control", "placeholder" => "?????????????? ????????????", ]); ?><br>');
return false;
})

$("#add-pro-in").click(function(){

$("#addproductsin").append('<select name="products_in[]" class="form-control tagsadd" id=""> <option value="">???????? ????????????</option> <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?> | <?php echo e($product->code); ?> </option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select><br>');
$(".tagsadd").select2({
      tags: true
    });
return false;
})

$("#add-part-in").click(function(){

$("#addpartsin").append('<select name="parts_in[]" class="form-control tagsadd" id=""> <option value="">???????? ????????????</option> <?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singlepart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($singlepart->id); ?>"><?php echo e($singlepart->name); ?> | <?php echo e($singlepart->code); ?> </option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select><br>');
$(".tagsadd").select2({
      tags: true
    });
return false;
})


$("#add-pro-awards").click(function(){
$("#addproductsawards").append('<select name="products_in[]" class="form-control tagsadd" id=""> <option value="">???????? ????????????</option> <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?> | <?php echo e($product->code); ?> </option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select><br>');
$(".tagsadd").select2({
      tags: true
    });
return false;
})


$("#add-specfic").click(function(){
q++;
$("#addspecifications").append('<div class="col-md-3"> <select class="form-control specs_type" data-numb="'+q+'" id="specs_type" name="specs_names[]"> <option value="0">????????????</option> <option value="??????????">??????????</option> <option value="??????????">??????????</option> <option value="????????????????">????????????????</option> <option value="?????????? ????????????????????????">?????????? ????????????????????????</option> <option value="????????????????">????????????????</option> <option value="???????? ??????????????">???????? ??????????????</option> </select> </div> <div class="col-md-3"> <input type="text" class="form-control nameattr-'+q+'" placeholder="????????????" name="specs_name[]"> </div> <div class="col-md-6 colm9-'+q+'"  style="margin-bottom:10px"> <?php echo Form::text("specs_desc[]", "", [ "class" => "form-control", "placeholder" => "??????????", ]); ?> </div><br>');
return false;
})




var ctx = document.getElementById('myChart').getContext('2d');
ctx.width = 100;
ctx.height = 100;
data = {
    datasets: [{
        data: [0, 1],
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