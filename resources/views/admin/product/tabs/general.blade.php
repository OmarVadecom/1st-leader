<div class="tab-pane  active" id="home">
  <div class="row">
    <div class="col-md-6">

      <div class="form-group">
        <label>المجموعه</label>
        <br>
        <select name="category_id" class="form-control selectproduct">
          <option value="">اختر المجموعه </option>
          @foreach($cats as $cat)
          <option value="{{$cat->id}}" {{($product && $product->category_id == $cat->id) ? 'selected' : ''}}>
            {{$cat->title}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>الشركه </label> <br>
        <select name="brand_id" class="form-control tagsadd">
          <option value="">أختر الشركه </option>
          @foreach($brands as $brand)
          <option value="{{$brand->id}}" {{(isset($product) && $brand->id==$product->brand_id) ? 'selected' : ''}}>
            {{$brand->name}}</option>
          @endforeach
        </select>
      </div><!-- /.form-group -->


      <div class="form-group">
        <label> المنشأ</label>
        <br>
        <select name="origin_id" class="form-control tagsadd">
          <option value="">اختر المنشأ</option>
          @foreach($countries as $country)
          <option value="{{$country->id}}" {{(isset($product) && $country->id==$product->origin_id) ? 'selected' : ''}}>
            {{$country->name}}
          </option>
          @endforeach
        </select>
      </div><!-- /.form-group -->


      <div class="form-group">
        <label> الصناعه</label><br>
        <select name="country_id" class="form-control tagsadd">
          <option value=""> الصناعه</option>
          @foreach($countries as $country)
          <option value="{{$country->id}}"
            {{(isset($product) && $country->id==$product->country_id) ? 'selected' : ''}}>{{$country->name}}</option>
          @endforeach
        </select>
      </div><!-- /.form-group -->


      <div class="form-group">
        <label>اللون</label>
        <br>
        <select name="color" class="form-control tagsadd">
          <option value="">اختر اللون</option>
          @foreach($colors as $color)
          <option value="{{$color->id}}" {{(isset($product) && $color->id==$product->color) ? 'selected' : ''}}>
            {{$color->name}}</option>
          @endforeach
        </select>
      </div><!-- /.form-group -->

    </div>

    <div class="col-md-6">

      <div class="form-group">
        <label>نوع المنتج</label>
        <select class="form-control" name="type">
          <option value="">اختر نوع المنتج</option>
          <option value="1" {{(isset($product) && $product->type==1) ? 'selected' : ''}}>مستودعي</option>
          <option value="2" {{(isset($product) && $product->type==2) ? 'selected' : ''}}>خدمي</option>
        </select>
      </div>

      <div class="form-group">
        <label>رمز الترقيم</label>

        {!! Form::text('label', "EE", [
        "class" => "form-control",
        "placeholder" => ' رمز الترقيم',
        "disabled"=>'disabled',
        ]) !!}
      </div><!-- /.form-group -->


      <div class="form-group">
        <label>فئه المنتج </label>
        <select class="form-control" name="product_type">
          <option value="">اختر فئه المنتج</option>
          <option value="1" {{(isset($product) && $product->product_type==1) ? 'selected' : ''}}>رئيسي</option>
          <option value="2" {{(isset($product) && $product->product_type==2) ? 'selected' : ''}}>تجميعي</option>
        </select>
      </div>

      <div class="form-group">
        <label>كرت الضمان</label>
        <select class="form-control" name="insurance">
          <option value="">اختر كرت الضمان</option>
          <option value="3 اشهر" {{($product && $product->insurance == '3 اشهر') ? 'selected' : ''}}>3 اشهر</option>
          <option value="6 اشهر" {{($product && $product->insurance == '6 اشهر') ? 'selected' : ''}}>6 اشهر</option>
          <option value="1 سنه" {{($product && $product->insurance == '1 سنه') ? 'selected' : ''}}>1 سنه</option>
          <option value="2 سنه" {{($product && $product->insurance == '2 سنه') ? 'selected' : ''}}>2 سنه</option>
        </select>
      </div>
      <div class="form-group">
        <label>التفعيلات</label><br>
        <div class="col-md-6">

        <label><input type="checkbox" name="maintenance" value="1"
            {{(isset($product) && $product->maintenance==1) ? 'checked' : ''}}> الصيانه </label>
</div>
        <div class="col-md-6">

        <label><input type="checkbox" name="hidden" value="1"
            {{(isset($product) && $product->hidden==1) ? 'checked' : ''}}> اخفاء </label>
  
      </div>

      </div>

    </div>
  </div>


  <h5 style="text-align:center;">معلومات المنتج</h5>
  <br>
  <div class="col-md-2">
  </div>
  <div class="col-md-8">
    <div id="addspecification" class="form-group">
      @if(isset($descriptions))
      @foreach($descriptions as $key=>$description)
      <div class="col-md-8" style="padding: 0px !important;">
      <input type="text" class="form-control"  name="title_description[]" value="{{isset($title_description[$key]) ? $title_description[$key] : ''}}" placeholder="عنوان الوصف">
      </div><div class="col-md-4"><input type="file" name="img_description[]"></div>
      <input type="hidden" name="old_img_description[]" class="oldimgdesc{{$key}}" value="{{isset($img_description[$key]) ? $img_description[$key] : ''}}">
      @if(isset($img_description[$key]) && $img_description[$key] != "" )
      <div class="imgdiv{{$key}}">
      <img src="{{url('/')}}/uploads/products-desc-imgs/{{$img_description[$key]}}" style="width:100px;margin-right: 14px;">
      <button class="btn btn-success deletethisimg" data-num="{{$key}}">حذف</button>
      </div>
      @endif
      {!! Form::textarea("description[]", $description, [
      "class" => "form-control",
      "placeholder" => 'معلومات المنتج',
      'rows'=>6,
      'style'=>'direction:ltr',


      ]) !!}<br>
      @endforeach
      @else
      <div class="col-md-8" style="padding: 0px !important;">
      <input type="text" class="form-control"  name="title_description[]" placeholder="عنوان الوصف">
      </div><div class="col-md-4"><input type="file" name="img_description[]"></div>
      {!! Form::textarea("description[]", "", [
      "class" => "form-control",
      "placeholder" => 'معلومات المنتج',
      'rows'=>6,
      'style'=>'direction:ltr',

      ]) !!}
      @endif
      <br>
    </div><!-- /.form-group -->
  </div>
  <div class="col-md-2">
    <button id="add-spec" style="float: left;" class="btn btn-success">اضافه وصف اخر</button>
  </div>

</div>