
<div class="row" style="background: #eaeaea; padding: 20px;">
  <div class="row">
  <div class="col-md-6">
    <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
      <label>الاسم</label>

      {!! Form::text("name", isset($part) ? $part->name : "", [
      "class" => "form-control",
      "placeholder" => 'الاسم',
      "required"
      ]) !!}
    </div><!-- /.form-group -->
  </div>
  <div class="col-md-6">
    <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
      <label>رقم القطعه</label>

      {!! Form::text("code", isset($part) ? $part->code : "", [
      "class" => "form-control",
      "placeholder" => 'رقم القطعه',
      "required"
      ]) !!}
    </div><!-- /.form-group -->
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
      <label>اختر المنتج</label>
      <br>
<select name="product_id" class="form-control selectproduct" style="width:100%; text-align:right;" required>
<option  value="">اختر المنتج</option>
@foreach($products as $product)
<option value="{{$product->id}}" {{(isset($part) && $part->product_id == $product->id) ? 'selected' : ''}}>{{$product->name}}</option>
@endforeach
</select>

    </div><!-- /.form-group -->
  </div>
{{-- --------------------------------------------- --}}


<div class="col-md-6">
  <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
    <label>السعر</label>

    {!! Form::text("price", isset($part) ? $part->price : "", [
    "class" => "form-control",
    "placeholder" => 'السعر',
    "required"
    ]) !!}
  </div><!-- /.form-group -->
</div>

</div>






  <div class="col-md-3">
    <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
      <label>صوره القطعه</label>
      <br>
<input type="file" name="image">
<input type="hidden" name="oldimage" value="{{($part) ? $part->image : ''}}">
    </div><!-- /.form-group -->

</div>
<div class="col-md-3">
  @if(isset($part))
  <img style="width:120px;" src="{{url('/')}}/uploads/parts_images/{{$part->image}}" alt="">
@endif

</div>



  <div class="col-md-6">
    <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
      <label>ملاحظات</label>

      {!! Form::textarea("notes", isset($part) ? $part->notes : "", [
      "class" => "form-control",
      "placeholder" => 'ملاحظات',
      "rows" => '3',
      ]) !!}
    </div><!-- /.form-group -->
  </div>



</div>

<div class="col-md-12">
  <hr>
  <div class="clear">
      <button type="submit" class="btn btn-success">
          <i class="icon-check2"></i> {{ trans('admin.save') }}
      </button>
  </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<style>
  th {
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
      i=0;
$("#add-product").click(function(){
  i++;
$(".productsadd").append('<tr> <td> <select style="width:350px;" name="product[]" class="form-control selectproduct" > <option value="">اختر المنتج</option> @foreach($products as $product) <option value="{{ $product->id }}">{{ $product->name }}</option> @endforeach </select> </td>  <td> <input type="number"  value="1" placeholder="الكميه" min="1" class="form-control productquantity" name="quantity[]"> </td><td> <div class="checkbox"><input type="hidden" name="group_status['+i+']" value="" /> <label><input type="checkbox" name="group_status['+i+']"> اجباريه </label> </div> </td> <td> <i  class="fa fa-times clickremrow"></i> </td> </tr>');

$('.selectproduct').select2();
return false;
})

$(".productquantity").keyup(function(){


})

$('.selectproduct').select2();

$("#addinputf").click(function(){
    $("#filesinput").append('<br><input type="file" name="attachments[]" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf">');
     return false;
 })


$(".tagsadd").select2({
      tags: true
    });



  $("#add-spec").click(function(){

$("#addspecification").append('{!! Form::text("specification[]", "", [ "class" => "form-control", "placeholder" => "المواصفات الفنيه", ]) !!}');
return false;
})

})
</script>