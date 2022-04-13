<!-- Nav tabs -->
@php
if(isset($product)){
$name=$product->name;
$name_en=$product->name_en;
$code=$product->code;
$image=$product->image;
$factory=$product->factory;
$album=$product->album;
$unit_1=$product->unit_1;
$unit_status=$product->unit_default;
$unit_2=$product->unit_2;
$unit_2_con=$product->unit_2_con;
$unit_3=$product->unit_3;
$unit_3_con=$product->unit_3_con;
$price=$product->price;
$price_vat=$product->price_vat;
$price_unit=$product->price_unit;
$bui_cou=$product->bui_cou;
$fact_co=$product->fact_co;
$description=$product->description;
$color=$product->color;
$weight=$product->weight;
$saf_weight=$product->saf_weight;
$dimension=$product->dimension;
$productsgro=explode(',',$product->group_pro);
$quantities=explode(',',$product->group_quantities);
$group_statuss=explode(',',$product->group_status);
$imfilenames=explode(',',$product->attachments);
$charts=explode(',',$product->charts);
}

@endphp
<div class="row" style="background: #eaeaea; padding: 20px;">
  <div class="row">
  <div class="col-md-6">
    <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
      <label>كود المنتج</label>

      {!! Form::text("code", isset($product) ? $code : "", [
      "class" => "form-control",
      "placeholder" => 'كود المنتج',
      "required"
      ]) !!}
    </div><!-- /.form-group -->
  </div>
  <div class="col-md-6">
    <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
      <label>{{ trans("admin.name", ["name" => trans("admin.user")]) }}</label>

      {!! Form::text("name", isset($product) ? $name : "", [
      "class" => "form-control",
      "placeholder" => trans("admin.name", ["name" => trans("admin.user")]),
      "required"
      ]) !!}
    </div><!-- /.form-group -->
  </div>
  </div>
<div class="row">
  <div class="col-md-6">
    <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
      <label>الاسم اللاتيني</label>

      {!! Form::text("name_en", isset($product) ? $name_en : "", [
      "class" => "form-control",
      "placeholder" => "الاسم اللاتيني",
      ]) !!}
    </div><!-- /.form-group -->
  </div>

  <div class="col-md-3">
    <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
      <label>صوره المنتج</label>
      <br>
<input type="file" name="image">
<input type="hidden" name="oldimage" value="{{($product) ? $product->image : ''}}">
    </div><!-- /.form-group -->

</div>
<div class="col-md-3">
  @if(isset($product))
  <img style="width:120px;" src="{{url('/')}}/uploads/products-attachments/{{$product->image}}" alt="">
@endif

</div>

</div>


  {{-- <div class="col-md-6">
    <div id="filesinput" class="form-group">
      <label for="title">المرفقات </label><br>
      <input accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file" name="attachments[]">
      <button id="addinputf" class="btn btn-primary"><i class="fa fa-plus"></i></button>
    </div>
    @if(isset($product) && $imfilenames[0] != "")
    @foreach($imfilenames as $key=>$filename)
    <input id="file{{$key}}" type="hidden" name="editfiles[]" value="{{$filename}}">
    <a href="{{url('/')}}/uploads/products-attachments/{{$filename}}" class="file{{$key}}" download> {{$filename}} </a>
    <i id="btu-file{{$key}}" style="color:red" class="fa fa-times clickrem"></i>
    <br>
    @endforeach
    @endif

  </div> --}}

  {{-- <div class="col-md-6">
    <div id="chartsinput" class="form-group">
      <label for="title"> مخططات تفصيليه</label><br>
      <input accept="image/*" type="file" name="charts[]">
      <button id="addchart" class="btn btn-primary"><i class="fa fa-plus"></i></button>
    </div>
    @if(isset($product) && $charts[0] != "")
    @foreach($charts as $key=>$chart)
    <input id="filechart{{$key}}" type="hidden" name="editcharts[]" value="{{$chart}}">
    <a href="{{url('/')}}/uploads/products-charts/{{$chart}}" class="filechart{{$key}}" download> {{$chart}} </a>
    <i id="btuchart-filechart{{$key}}" style="color:red" class="fa fa-times clickremchart"></i>
    <br>
    @endforeach
    @endif

  </div> --}}



</div>

<br>
<style>
  .nav-tabs {
    margin-bottom: 25px;
    background: #162029;
  }

  .nav-tabs .navvlink {
    color: aliceblue !important;
  }

  .nav-link.active {
    color: black !important;
  }

  .nav-tabs .nav-link:hover {
    border: none;
  }
</style>
<ul class="nav nav-tabs">
  <li class="nav-item navbitem">
    <a class="nav-link navvlink active" data-toggle="tab" href="#home">عام</a>
  </li>
  <li class="nav-item navbitem">
    <a class="nav-link navvlink" data-toggle="tab" href="#menu4">المواصفات الفنيه</a>
  </li>
  <li class="nav-item navbitem">
    <a class="nav-link navvlink" data-toggle="tab" href="#menu5">المحلقات</a>
  </li>
  <li class="nav-item navbitem">
    <a class="nav-link navvlink" data-toggle="tab" href="#menu1">وحدات</a>
  </li>
  <li class="nav-item navbitem">
    <a class="nav-link navvlink" data-toggle="tab" href="#menu2">سعر</a>
  </li>
  <li class="nav-item navbitem">
    <a class="nav-link navvlink" data-toggle="tab" href="#menu3">ماده تجميعيه</a>
  </li>



  {{-- <li class="nav-item navbitem">
    <a class="nav-link navvlink" data-toggle="tab" href="#menu4">ملخص الحركه</a>
  </li> --}}
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="home">
<div class="row">
  <div class="col-md-6">
    <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
      <label>نوع المنتج</label>
      <select class="form-control" name="type">
<option value="">اختر نوع الخدمه</option>
<option value="سلعة" {{($product && $product->type == 'سلعة') ? 'selected' : ''}}>سلعة</option>
<option value="خدمه" {{($product && $product->type == 'خدمه') ? 'selected' : ''}}>خدمه</option>
      </select>
    </div>
  </div>

  <div class="col-md-6">
    <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
      <label>كرت الضمان</label>
      <select class="form-control" name="insurance">
        <option value="">اختر كرت الضمان</option>
        <option value="3 اشهر" {{($product && $product->insurance == '3 اشهر') ? 'selected' : ''}}>3 اشهر</option>
        <option value="6 اشهر" {{($product && $product->insurance == '6 اشهر') ? 'selected' : ''}}>6 اشهر</option>
        <option value="1 سنه" {{($product && $product->insurance == '1 سنه') ? 'selected' : ''}}>1 سنه</option>
        <option value="سنتان" {{($product && $product->insurance == 'سنتان') ? 'selected' : ''}}>سنتان</option>
        </select>
      </div>
  </div>
</div>


<div class="row">
    <div class="col-md-6">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>المجموعه</label>
        <br>
        <select name="category_id" class="form-control selectproduct">
        <option value="">اختر المجموعه </option>
        @foreach($cats as $cat)
        <option value="{{$cat->id}}" {{($product && $product->category_id == $cat->id) ? 'selected' : ''}}>{{$cat->title}}</option>
        @endforeach
        </select>
      </div>
    </div>


    <div class="col-md-6">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>بلد المنشأ</label>
        <br>
        <select name="bui_cou" class="form-control tagsadd">
          <option value="">اختر بلد المنشأ</option>
          @foreach($pro_countries as $pro_country)
          @if($pro_country->bui_cou != '')
          <option value="{{$pro_country->bui_cou}}"
            {{(isset($product) && $pro_country->bui_cou==$bui_cou) ? 'selected' : ''}}>{{$pro_country->bui_cou}}
          </option>
          @endif
          @endforeach
        </select>
      </div><!-- /.form-group -->
    </div>
  </div>
  <div class="row">

    <div class="col-md-6">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>بلد التصنيع</label>
        <select name="fact_co" class="form-control tagsadd">
          <option value="">اختر بلد التصنيع</option>
          @foreach($pro_factories as $pro_fact)
          @if($pro_fact->fact_co != '')
          <option value="{{$pro_fact->fact_co}}"
            {{(isset($product) && $pro_fact->fact_co==$fact_co) ? 'selected' : ''}}>{{$pro_fact->fact_co}}</option>
          @endif
          @endforeach
        </select>
      </div><!-- /.form-group -->
    </div>




    <div class="col-md-6">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>الشركه المصنعه</label>
        <select name="factory" class="form-control tagsadd">
          <option value="">أختر الشركه المصنعه</option>
          @foreach($factories as $sfactory)
          <option value="{{$sfactory->id}}"
            {{(isset($product) && $sfactory->factory==$factory) ? 'selected' : ''}}>{{$sfactory->name}}</option>
          @endforeach
        </select>
      </div><!-- /.form-group -->
    </div>

  </div>





    <div class="col-md-6">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>الوصف</label>

        {!! Form::textarea("description", isset($product) ? $description : "", [
        "class" => "form-control",
        "placeholder" => 'الوصف',
        ]) !!}
      </div><!-- /.form-group -->
    </div>


    <div class="col-md-6">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>اللون</label>
        <br>
        <select name="color" class="form-control tagsadd">
          <option value="">اختر اللون</option>
          @foreach($colors as $scolor)
          @if($scolor->color != '')
          <option value="{{$scolor->color}}" {{(isset($product) && $scolor->color==$color) ? 'selected' : ''}}>
            {{$scolor->color}}</option>
          @endif
          @endforeach
        </select>
      </div><!-- /.form-group -->

      <div class="col-md-4">
        <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
          <label>الوزن</label>

          {!! Form::text('weight', isset($product) ? $weight : "", [
          "class" => "form-control",
          "placeholder" => 'الوزن',

          ]) !!}
        </div><!-- /.form-group -->
      </div>

      <div class="col-md-4">
        <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
          <label>الوزن الصافي</label>

          {!! Form::text("saf_weight", isset($product) ? $saf_weight : "", [
          "class" => "form-control",
          "placeholder" => 'الوزن الصافي',

          ]) !!}
        </div><!-- /.form-group -->
      </div>


      <div class="col-md-4">
        <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
          <label>ابعاد المنتج</label>

          {!! Form::text("dimention", isset($product) ? $dimension : "", [
          "class" => "form-control",
          "placeholder" => 'ابعاد المنتج',
          ]) !!}
        </div><!-- /.form-group -->
      </div>



      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>الكاتالوج</label>

        {!! Form::text("album", isset($product) ? $album : "", [
        "class" => "form-control",
        "placeholder" => 'رابط كتالوج الصنف',

        ]) !!}
      </div><!-- /.form-group -->
    </div>



  </div>
  <div class="tab-pane container fade" id="menu1">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>الوحده 1</label>
            {!! Form::text("unit_1", isset($product) ? $unit_1 : "" , [
            'class' => 'form-control',
            'placeholder' => 'الوحده 1',
            'required'
            ]) !!}
          </div><!-- /.form-group -->
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            @if(isset($product))
            <label><input type="radio" value="1" name="unit_status" {{($unit_status == 1) ? 'checked' : ''}}> الافتراضي
              @else
              <label><input type="radio" value="1" name="unit_status" checked> الافتراضي

                @endif
              </label>
          </div><!-- /.form-group -->
        </div><!-- /.form-group -->
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>الوحده 2</label>
            {!! Form::text("unit_2", isset($product) ? $unit_2 : "", [
            'class' => 'form-control',
            'placeholder' => 'الوحده 2',
            ]) !!}
          </div><!-- /.form-group -->
        </div>
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>عامل التحويل</label>
            {!! Form::text("unit_2_con", isset($product) ? $unit_2_con : "" , [
            'class' => 'form-control',
            'placeholder' => 'عامل التحويل',
            ]) !!}
          </div><!-- /.form-group -->
        </div>


      </div>





      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label><input type="radio" value="2" name="unit_status"
            {{(isset($product) && $unit_status == 2) ? 'checked' : ''}}> الافتراضي
        </label>
      </div><!-- /.form-group -->





      <div class="row">
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>الوحده 3</label>
            {!! Form::text("unit_3", isset($product) ? $unit_3 : "" , [
            'class' => 'form-control',
            'placeholder' => 'الوحده 3',
            ]) !!}
          </div><!-- /.form-group -->
        </div>
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label>عامل التحويل</label>
            {!! Form::text("unit_3_con", isset($product) ? $unit_3_con : "" , [
            'class' => 'form-control',
            'placeholder' => 'عامل التحويل',
            ]) !!}
          </div><!-- /.form-group -->
        </div>
      </div>
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label><input type="radio" value="3" name="unit_status"
            {{(isset($product) && $unit_status == 3) ? 'checked' : ''}}> الافتراضي
        </label>
      </div><!-- /.form-group -->

    </div>



  </div>
  <div class="tab-pane container fade" id="menu2">
    <div class="col-md-6">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>السعر قبل الخصم</label>
        {!! Form::text("price", isset($product) ? $price : "", [
        'class' => 'form-control',
        'placeholder' => 'السعر',
        'required'
        ]) !!}
      </div><!-- /.form-group -->


      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>ضريبه القيمه المضافه</label>
        {!! Form::text("price_vat", isset($product) ? $price_vat : "", [
        'class' => 'form-control',
        'placeholder' => 'ضريبه القيمه المضافه %',
        ]) !!}
      </div><!-- /.form-group -->

    </div>



    <div class="col-md-6">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>العمله</label>
        <select name="price_unit" class="form-control">
          <option value="ريال سعودي" {{(isset($product) && $price_unit=='ريال سعودي')? 'selected' : ''}}> ريال سعودي
          </option>
          <option value="دولار" {{(isset($product) && $price_unit=='دولار')? 'selected' : ''}}> دولار </option>
          <option value="يورو" {{(isset($product) && $price_unit=='يورو')? 'selected' : ''}}> يورو </option>
        </select>
      </div><!-- /.form-group -->
    </div>

  </div>
  <div class="tab-pane container fade" id="menu3">

    <div class="col-md-12">
      <table class="table table-striped" style="text-align:center">
        <thead>
          <tr>
            <th style="width:40%">الماده</th>
            <th style="width:40%">الكميه</th>
            <th style="width:20%">اجباريه</th>

          </tr>
        </thead>
        <tbody class="productsadd">
          <div class="form-group ">
            @if(isset($product))
            @foreach($productsgro as $key=>$productg)
            @php
            $singleproduct=\App\Models\Products::find($productg);
            @endphp
            <tr>
              <td>
                <select style="width:350px;" name="product[]" class="form-control selectproduct">
                  <option value="">اختر المنتج</option>
                  @foreach($products as $prod)
                  @if(isset($singleproduct))
                  <option value="{{ $prod->id }}" {{($prod->id == $singleproduct->id) ? 'selected' : ''}}>
                    {{ $prod->code }} | {{ $prod->name }}</option>
                  @else
                  <option value="{{ $prod->id }}">
                    {{ $prod->code }} | {{ $prod->name }}</option>
                  @endif
                  @endforeach
                </select>
              </td>
              <td>
                <input type="number" value="{{$quantities[$key]}}" placeholder="الكميه" min="1"
                  class="form-control productquantity" name="quantity[]">

              </td>
              <td>
                <div class="checkbox">
                  <input type="hidden" name="group_status[{{$key}}]" value="" />
                  <label><input type="checkbox" name="group_status[{{$key}}]"
                      {{($group_statuss[$key]==1) ? 'checked' : ''}}> اجباريه </label>
                </div>
              </td>

              <td>
                <i class="fa fa-times clickremrow"></i>
              </td>
            </tr>

            @endforeach
            @else
            <tr>
              <td>
                <select style="width:350px;" name="product[]" class="form-control selectproduct">
                  <option value="">اختر المنتج</option>
                  @foreach($products as $oneproduct)
                  <option value="{{ $oneproduct->id }}">{{ $oneproduct->code }} | {{ $oneproduct->name }}
                  </option>
                  @endforeach
                </select>
              </td>
              <td>
                <input type="number" value="1" placeholder="الكميه" min="1" class="form-control productquantity"
                  name="quantity[]">
              </td>
              <td>
                <div class="checkbox">
                  <input type="hidden" name="group_status[0]" value="" />
                  <label><input type="checkbox" name="group_status[0]"> اجباريه </label>
                </div>
              </td>
              <td>
                <i class="fa fa-times clickremrow"></i>
              </td>
            </tr>
            @endif
          </div>
        </tbody>
      </table>
      <button id="add-product" style="float:left; margin-top:10px;" class="btn btn-success">اضف منتج أخر</button>

    </div>
  </div>

  <div class="tab-pane container fade" id="menu4">
    <div class="col-md-9">
    <div id="addspecification" class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
      <label>المواصفات الفنيه</label><br>
<div class="col-md-3">
  {!! Form::text("specification[]", "", [
    "class" => "form-control",
    "placeholder" => "المسمي",
    ]) !!}

</div>


<div class="col-md-9"  style="margin-bottom:10px">
  {!! Form::text("specification[]", "", [
    "class" => "form-control",
    "placeholder" => "الوصف",
    ]) !!}

</div>

    </div><!-- /.form-group -->
  </div>
  <div class="col-md-3">
  <button id="add-spec" style="float: left; margin-top: 20px;" class="btn btn-success">اضافه وصف اخر</button>
  </div>

</div>

<div class="tab-pane container fade" id="menu5">
  <div class="col-md-3">
    <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
      <label>صوره المنتج</label>
      <br>
<input type="file" name="image">
<input type="hidden" name="oldimage" value="{{($product) ? $product->image : ''}}">
    </div><!-- /.form-group -->
    <hr>
</div>
<div class="col-md-3">
  @if(isset($product))
  <img style="width:120px;" src="{{url('/')}}/uploads/products-attachments/{{$product->image}}" alt="">
@endif
</div>

<div class="col-md-6">
  <div id="chartsinput" class="form-group">
    <label for="title"> مخططات تفصيليه</label><br>
    <input accept="image/*" type="file" name="charts[]">
    <button id="addchart" class="btn btn-primary"><i class="fa fa-plus"></i></button>
  </div>
  @if(isset($product) && $charts[0] != "")
  @foreach($charts as $key=>$chart)
  <input id="filechart{{$key}}" type="hidden" name="editcharts[]" value="{{$chart}}">
  <a href="{{url('/')}}/uploads/products-charts/{{$chart}}" class="filechart{{$key}}" download> {{$chart}} </a>
  <i id="btuchart-filechart{{$key}}" style="color:red" class="fa fa-times clickremchart"></i>
  <br>
  @endforeach
  @endif
  <hr>
</div>

<br>
<div class="row">
<div class="col-md-12">
  <div id="filesinput" class="form-group">
    <label for="title">المرفقات </label><br>
    <div class="col-md-6">
      {!! Form::text("specification[]", "", [
        "class" => "form-control",
        "placeholder" => "اسم المستند",
        ]) !!}
    </div>
    <div class="col-md-6">
    <input accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file" name="attachments[]">
    <button id="addinputf" class="btn btn-primary"><i class="fa fa-plus"></i></button>
    </div>
  </div>

  @if(isset($product) && $imfilenames[0] != "")
  @foreach($imfilenames as $key=>$filename)
  <input id="file{{$key}}" type="hidden" name="editfiles[]" value="{{$filename}}">
  <a href="{{url('/')}}/uploads/products-attachments/{{$filename}}" class="file{{$key}}" download> {{$filename}} </a>
  <i id="btu-file{{$key}}" style="color:red" class="fa fa-times clickrem"></i>
  <br>
  @endforeach
  @endif

</div>
</div>
</div>




</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<script>
  $(".menu1").click(function(){
$("#menu1").append('<div style="margin-top:50px" class="col-md-6"> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>اسم المسؤول</label> {!! Form::text("resp_name[]","", [ "class" => "form-control", "placeholder" => "اسم المسؤول", "required" ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>المهنه</label> {!! Form::text("work[]","", [ "class" => "form-control", "placeholder" => "المهنه", ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>رقم الهاتف</label> {!! Form::text("resp_tele[]","", [ "class" => "form-control", "placeholder" => "رقم الهاتف", ]) !!} </div><!-- /.form-group --> </div> <div style="margin-top:50px" class="col-md-6"> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>الجوال</label> {!! Form::text("resp_phone[]","", [ "class" => "form-control", "placeholder" => "الجوال", "required" ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("email") ? " has-error" : "" }}"> <label>البريد الالكتروني</label> {!! Form::email("resp_email[]","", [ "class" => "form-control", "placeholder" => "البريد الالكتروني", "required" ]) !!} @if ($errors->has("email")) <span class="help-block"> <strong style="color:red">{{ $errors->first("email") }}</strong> </span> @endif </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>تحويله</label> {!! Form::text("resp_tele_red[]","", [ "class" => "form-control", "placeholder" => "تحويله"]) !!} </div><!-- /.form-group --> </div>');
  return false;
  })





$(".menu3").click(function(){
$("#menu3").append('<br><div style="margin-top:50px" class="col-md-6"> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>المقر</label> {!! Form::text("locate[]","", [ "class" => "form-control", "placeholder" => "المقر", "required" ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>الجوال</label> {!! Form::text("phonenumber[]","", [ "class" => "form-control", "placeholder" => "الجوال", "required"]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>فاكس</label> {!! Form::text("fax[]","", [ "class" => "form-control", "placeholder" => "تحويله" ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>الهاتف</label> {!! Form::text("telephone[]","", [ "class" => "form-control", "placeholder" => "الهاتف", "required" ]) !!} </div><!-- /.form-group --> </div> <div style="margin-top:50px" class="col-md-6"> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>المدينه</label> {!! Form::text("city[]","", [ "class" => "form-control", "placeholder" => "المدينه", "required" ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>الجوال 2</label> {!! Form::text("phonenumbertwo[]","", [ "class" => "form-control", "placeholder" => "الجوال 2"]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>البريد الالكتروني</label> {!! Form::text("email_add[]","", [ "class" => "form-control", "placeholder" => "البريد الالكتروني", "required" ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>تحويله</label> {!! Form::text("telephone_red[]","", [ "class" => "form-control", "placeholder" => "تحويله", "required" ]) !!} </div><!-- /.form-group --> </div>');
  return false;
  })


$(".clickrem").click(function(){
id=$(this).attr('id');
var r = confirm("هل انت متاكد من ازاله الملف");
if (r == true) {
var parts = id.split('btu-', 2);
target=parts[1];
$('.'+target).hide('slow');
$('#'+target).remove();
$(this).hide('slow');
} else {

}
})



$(".clickremchart").click(function(){
id=$(this).attr('id');
var r = confirm("هل انت متاكد من ازاله الملف");
if (r == true) {
var parts = id.split('btuchart-', 2);
target=parts[1];
$('.'+target).hide('slow');
$('#'+target).remove();
$(this).hide('slow');
} else {

}
})



$(document).on("click",".clickremrow",function() {
  $(this).parents("tr:first").remove();
})




</script>
<style>
  .navbitem {
    float: right !important;
    font-size: 14px;
    width: 15%;
    text-align: center;
  }

  .clickrem {
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

  .select2-selection {
    text-align: right;
  }

  .select2-selection__rendered {
    text-align: right;
  }

  .clickremrow {
    background: antiquewhite;
    padding: 7px;
    cursor: pointer;
    color: red;
  }
</style>

<div class="col-md-12">
  <hr>
  <div class="clear">
    <button type="submit" class="btn btn-success">
      <i class="icon-check2"></i> {{ trans('admin.save') }}
    </button>
    @if(isset($product))
    <button class="btn btn-primary">
      <i class="fa fa-file"></i> طباعه
    </button>
    @endif
    </a>
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
    $("#filesinput").append('<div class="col-md-6"> {!! Form::text("specification[]", "", [ "class" => "form-control", "placeholder" => "اسم المستند", ]) !!} </div> <div class="col-md-6"> <input accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file" name="attachments[]"> </div>');
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

$("#addspecification").append('<div class="col-md-3"> {!! Form::text("specification[]", "", [ "class" => "form-control", "placeholder" => "المسمي", ]) !!} </div> <div class="col-md-9" style="margin-bottom:10px"> {!! Form::text("specification[]", "", [ "class" => "form-control", "placeholder" => "الوصف", ]) !!}</div>');
return false;
})

})
</script>