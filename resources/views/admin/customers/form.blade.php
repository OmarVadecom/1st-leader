<!-- Nav tabs -->
@php
if(isset($customer)){
$imfilenames=explode(',',$customer->files);
$resp_name=explode(',',$customer->resp_name);
$work=explode(',',$customer->work);
$resp_tele=explode(',',$customer->resp_tele);
$resp_phone=explode(',',$customer->resp_phone);
$resp_email=explode(',',$customer->resp_email);
$resp_tele_red=explode(',',$customer->resp_tele_red);
$locate=explode(',',$customer->locate);
$phonenumber=explode(',',$customer->phonenumber);
$fax=explode(',',$customer->fax);
$telephone=explode(',',$customer->telephone);
$city=explode(',',$customer->city);
$phonenumbertwo=explode(',',$customer->phonenumbertwo);
$email_add=explode(',',$customer->email_add);
$telephone_red=explode(',',$customer->telephone_red);
}
@endphp



<ul class="nav nav-tabs" style="margin-bottom: 25px;">
  <li class="nav-item navbitem">
    <a class="nav-link active" data-toggle="tab" href="#home">عام</a>
  </li>
  <li class="nav-item navbitem">
    <a class="nav-link" data-toggle="tab" href="#menu1">شخصي</a>
  </li>
  <li class="nav-item navbitem">
    <a class="nav-link" data-toggle="tab" href="#menu2">العنوان</a>
  </li>
  <li class="nav-item navbitem">
    <a class="nav-link" data-toggle="tab" href="#menu3">إتصال</a>
  </li>
  <li class="nav-item navbitem">
    <a class="nav-link" data-toggle="tab" href="#menu4">حسابات</a>
  </li>
    <li class="nav-item navbitem">
        <a class="nav-link" data-toggle="tab" href="#menu5">كفيل</a>
    </li>
</ul>
{{--<div class="tab-pane  fade" id="menu5">--}}
<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="home">
    <div class="col-md-4">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>{{ trans("admin.name", ["name" => trans("admin.user")]) }} <span class="reqspan">*</span></label>

        {!! Form::text("name", isset($customer) ? $customer->name : "", [
        "class" => "form-control required",
        "placeholder" => trans("admin.name", ["name" => trans("admin.user")]),
        "required"
        ]) !!}
      </div><!-- /.form-group -->
    </div>
    <div class="col-md-4">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>الاسم اللاتيني</label>

        {!! Form::text("name_en", isset($customer) ? $customer->name_en : "", [
        "class" => "form-control",
        "placeholder" => "الاسم اللاتيني",
        ]) !!}
      </div><!-- /.form-group -->
    </div>




    <div class="col-md-4">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>اسم صاحب المؤسسه</label>

        {!! Form::text("org_name", isset($customer) ? $customer->org_name : "", [
        "class" => "form-control",
        "placeholder" => "اسم صاحب المؤسسه",

        ]) !!}
      </div><!-- /.form-group -->
    </div>

    <div class="col-md-4">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>رقم هويه صاحب المؤسسه</label>

        {!! Form::text("org_number", isset($customer) ? $customer->org_number : "", [
        "class" => "form-control",
        "placeholder" => "رقم هويه صاحب المؤسسه",

        ]) !!}
      </div><!-- /.form-group -->
    </div>


    <div class="col-md-4">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>رقم السجل التجاري</label>

        {!! Form::text("segl_number", isset($customer) ? $customer->segl_number : "", [
        "class" => "form-control",
        "placeholder" => "رقم السجل التجاري",

        ]) !!}
      </div><!-- /.form-group -->
    </div>

    <div class="col-md-4">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>الرقم الضريبي</label>

        {!! Form::text("dreb_number", isset($customer) ? $customer->dreb_number : "", [
        "class" => "form-control",
        "placeholder" => "الرقم الضريبي",
        ]) !!}
      </div><!-- /.form-group -->
    </div>


    <div class="col-md-4">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>رقم الرخصه</label>

        {!! Form::text("lic_number", isset($customer) ? $customer->lic_number : "", [
        "class" => "form-control",
        "placeholder" => "رقم الرخصه",
        ]) !!}
      </div><!-- /.form-group -->
    </div>

    <div class="col-md-4">
      <div id="filesinput" class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>المرفقات والمستندات</label><br>
        <input type="file" name="files[]" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf">

        <button id="addinputf" class="btn btn-primary"><i class="fa fa-plus"></i></button>
      </div><!-- /.form-group -->
      @if(isset($customer) && $imfilenames[0] != "")
      @foreach($imfilenames as $key=>$filename)
      <input id="file{{$key}}" type="hidden" name="editfiles[]" value="{{$filename}}">
      <a href="{{url('/')}}/uploads/documents/{{$filename}}" class="file{{$key}}" download> {{$filename}} </a>
      <i id="btu-file{{$key}}" style="color:red" class="fa fa-times clickrem"></i>
      @endforeach
      @endif
    </div>
     <div class="col-md-6">
  <hr>
  <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
    <label>القسم</label>
    <select name="category_id" class="select2" id="category_id" required>
      <option value="" class="select2">اختر القسم</option>
      @foreach($categories as $category)
      <option value="{{$category->id}}"
        {{(isset($customer) && $customer->category_id == $category->id) ? 'selected' : ''}}>{{$category->name}}
      </option>
      @endforeach
    </select>
  </div><!-- /.form-group -->
</div>
<div class="col-md-6">
  <hr>

  <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
    <label>العميل الرئيسي</label>
    <select name="parent_id" class="select2" id="parent_id">
      <option value="" class="select2">اختر العميل</option>
      @foreach($customers as $cust)
      <option value="{{$cust->id}}"
        {{(isset($customer) && $customer->parent_id == $cust->id) ? 'selected' : ''}}>{{$cust->name}}
      </option>
      @endforeach
    </select>
  </div><!-- /.form-group -->
  </div>
  </div>
  <div class="tab-pane  fade" id="menu1">


    @if(isset($customer))
    @foreach($resp_name as $key=>$res_name)

    <p class="headtitlee">المسؤول {{$key+1}} </p>
    <div class="col-md-6" style="margin-bottom:50px">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>اسم المسؤول <span class="reqspan">*</span></label>
        {!! Form::text("resp_name[]", $res_name , [
        'class' => 'form-control required',
        'placeholder' => 'اسم المسؤول',
        "required"
        ]) !!}
      </div><!-- /.form-group -->

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>المهنه</label>
        {!! Form::text("work[]", $work[$key], [
        'class' => 'form-control',
        'placeholder' => 'المهنه',
        ]) !!}
      </div><!-- /.form-group -->

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>رقم الهاتف</label>
        {!! Form::text("resp_tele[]", $resp_tele[$key] , [
        'class' => 'form-control',
        'placeholder' => 'رقم الهاتف',
        ]) !!}
      </div><!-- /.form-group -->
    </div>

    <div class="col-md-6" style="margin-bottom:50px">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>الجوال <span class="reqspan">*</span></label>
        {!! Form::text("resp_phone[]", $resp_phone[$key] , [
        'class' => 'form-control required',
        'placeholder' => 'الجوال',
        "required"
        ]) !!}
      </div><!-- /.form-group -->


      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label>البريد الالكتروني</label>
        {!! Form::email("resp_email[]",$resp_email[$key], [
        'class' => 'form-control',
        'placeholder' => 'البريد الالكتروني',
        ]) !!}
        @if ($errors->has('email'))
        <span class="help-block">
          <strong style="color:red">{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div><!-- /.form-group -->

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>تحويله</label>
        {!! Form::text("resp_tele_red[]",$resp_tele_red[$key], [
        'class' => 'form-control',
        'placeholder' => 'تحويله'
        ]) !!}
      </div><!-- /.form-group -->
    </div>

    @endforeach
    @else
    <div class="col-md-6">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>اسم المسؤول <span class="reqspan">*</span></label>
        {!! Form::text("resp_name[]",'', [
        'class' => 'form-control',
        'placeholder' => 'اسم المسؤول',
        ]) !!}
      </div><!-- /.form-group -->

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>المهنه</label>
        {!! Form::text("work[]",'', [
        'class' => 'form-control',
        'placeholder' => 'المهنه',
        ]) !!}
      </div><!-- /.form-group -->

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>رقم الهاتف</label>
        {!! Form::text("resp_tele[]",'', [
        'class' => 'form-control',
        'placeholder' => 'رقم الهاتف',
        ]) !!}
      </div><!-- /.form-group -->
    </div>

    <div class="col-md-6">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>الجوال <span class="reqspan">*</span></label>
        {!! Form::text("resp_phone[]",'', [
        'class' => 'form-control',
        'placeholder' => 'الجوال',
        ]) !!}
      </div><!-- /.form-group -->


      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label>البريد الالكتروني</label>
        {!! Form::email("resp_email[]", '', [
        'class' => 'form-control',
        'placeholder' => 'البريد الالكتروني',
        ]) !!}
        @if ($errors->has('email'))
        <span class="help-block">
          <strong style="color:red">{{ $errors->first('email') }}</strong>
        </span>
        @endif
      </div><!-- /.form-group -->

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>تحويله</label>
        {!! Form::text("resp_tele_red[]",'', [
        'class' => 'form-control',
        'placeholder' => 'تحويله'
        ]) !!}
      </div><!-- /.form-group -->
    </div>
    @endif



    <button style="display: flex;" class="btn btn-primary menu1">اضافه أخر </button>
  </div>

    <div class="tab-pane  fade" id="menu5">


        @if(isset($customer))
{{--            @foreach($customer as $key=>$res_name)--}}

                <p class="headtitlee">المسؤول {{$key+1}} </p>
                <div class="col-md-6" style="margin-bottom:50px">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label>اسم المسؤول </label>
                        {!! Form::text("resp_name_sponsor[]", $customer->res_name_sponsor , [
                        'class' => 'form-control ',
                        'placeholder' => 'اسم المسؤول',

                        ]) !!}
                    </div><!-- /.form-group -->

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label>المهنه</label>
                        {!! Form::text("work_sponsor[]", $customer->work_sponsor, [
                        'class' => 'form-control',
                        'placeholder' => 'المهنه',
                        ]) !!}
                    </div><!-- /.form-group -->

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label>رقم الهاتف</label>
                        {!! Form::text("resp_tele_sponsor[]", $customer->resp_tele_sponsor , [
                        'class' => 'form-control',
                        'placeholder' => 'رقم الهاتف',
                        ]) !!}
                    </div><!-- /.form-group -->
                </div>

                <div class="col-md-6" style="margin-bottom:50px">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label></label>
                        {!! Form::text("resp_phone_sponsor[]", $customer->resp_phone_sponsor , [
                        'class' => 'form-control ',
                        'placeholder' => 'الجوال',

                        ]) !!}
                    </div><!-- /.form-group -->


                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label>البريد الالكتروني</label>
                        {!! Form::email("resp_email_sponsor[]",$customer->resp_email_sponsor, [
                        'class' => 'form-control',
                        'placeholder' => 'البريد الالكتروني',
                        ]) !!}
                        @if ($errors->has('email'))
                            <span class="help-block">
          <strong style="color:red">{{ $errors->first('email') }}</strong>
        </span>
                        @endif
                    </div><!-- /.form-group -->

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label>تحويله</label>
                        {!! Form::text("resp_tele_red_sponsor[]",$customer->resp_tele_red_sponsor, [
                        'class' => 'form-control',
                        'placeholder' => 'تحويله'
                        ]) !!}
                    </div><!-- /.form-group -->
                </div>

{{--            @endforeach--}}
        @else
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label>اسم المسؤول <span class="reqspan">*</span></label>
                    {!! Form::text("resp_name_sponsor[]",'', [
                    'class' => 'form-control',
                    'placeholder' => 'اسم المسؤول',
                    ]) !!}
                </div><!-- /.form-group -->

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label>المهنه</label>
                    {!! Form::text("work_sponsor[]",'', [
                    'class' => 'form-control',
                    'placeholder' => 'المهنه',
                    ]) !!}
                </div><!-- /.form-group -->

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label>رقم الهاتف</label>
                    {!! Form::text("resp_tele_sponsor[]",'', [
                    'class' => 'form-control',
                    'placeholder' => 'رقم الهاتف',
                    ]) !!}
                </div><!-- /.form-group -->
            </div>

            <div class="col-md-6">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label>الجوال <span class="reqspan">*</span></label>
                    {!! Form::text("resp_phone_sponsor[]",'', [
                    'class' => 'form-control',
                    'placeholder' => 'الجوال',
                    ]) !!}
                </div><!-- /.form-group -->


                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label>البريد الالكتروني</label>
                    {!! Form::email("resp_email_sponsor[]", '', [
                    'class' => 'form-control',
                    'placeholder' => 'البريد الالكتروني',
                    ]) !!}
                    @if ($errors->has('email'))
                        <span class="help-block">
          <strong style="color:red">{{ $errors->first('email') }}</strong>
        </span>
                    @endif
                </div><!-- /.form-group -->

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label>تحويله</label>
                    {!! Form::text("resp_tele_red_sponsor[]",'', [
                    'class' => 'form-control',
                    'placeholder' => 'تحويله'
                    ]) !!}
                </div><!-- /.form-group -->
            </div>
        @endif


    </div>





















  <div class="tab-pane  fade" id="menu2">
    <div class="col-md-6">
      <div class="col-md-6">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label>الدوله</label>
          <select name="country" class="select2" id="country">
            <option value="" class="select2">اختر الدوله</option>
            @foreach($countries as $country)
            <option value="{{$country->name}}"
              {{(isset($customer) && $customer->country == $country->name) ? 'selected' : ''}}>{{$country->name}}
            </option>
            @endforeach
          </select>
        </div><!-- /.form-group -->

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label>المدينه</label>
          {!! Form::text("reg_city", null, [
          'class' => 'form-control city_id',
          'placeholder' => 'المدينه',
          ]) !!}

          <select name="selectcity" class="form-control" id="city_id">
            <option value="">أختر المدينه</option>
            @foreach($cities as $city)
            <option data-region="{{$city->region_id}}" class="cities" value="{{$city->name}}"
              {{(isset($client) && $client->city == $city->name) ? 'selected' : ''}}>
              {{$city->name}}</option>
            @endforeach
          </select>


        </div><!-- /.form-group -->



      </div>



      <div class="col-md-6">

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label>المنطقه <span class="reqspan">*</span></label>
          {!! Form::text("region", null, [
          'class' => 'form-control region_id',
          'placeholder' => 'المنطقه',
          ]) !!}


          <select name="selectregion" class="form-control" id="region_id">
            <option value="">أختر المنطقه</option>
            @foreach($regions as $region)
            <option value="{{$region->name}}" data-id="{{$region->id}}"
              {{(isset($client) && $client->region == $region->name) ? 'selected' : ''}}>
              {{$region->name}}</option>
            @endforeach
          </select>

        </div><!-- /.form-group -->
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label>الشارع <span class="reqspan">*</span></label>
          {!! Form::text("street", isset($customer) ? $customer->street : '', [
          'class' => 'form-control required',
          'placeholder' => 'الشارع',
          "required"
          ]) !!}
        </div><!-- /.form-group -->

      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group modal-body">
        <label for="title">موقع الزبون علي الخريطه</label>
        <div id="googleMap" style="width:100%; height:300px;"></div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
        </div>
      </div>
    </div>

  </div>
  <div class="tab-pane  fade" id="menu3">

    @if(isset($customer))
    @foreach($locate as $key=>$locat)

    <p class="headtitlee">المقر {{$key+1}} </p>
    <div class="col-md-6" style="margin-bottom:50px">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>المقر</label>
        {!! Form::text("locate[]", $locat, [
        'class' => 'form-control',
        'placeholder' => 'المقر',
        ]) !!}
      </div><!-- /.form-group -->


      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>الجوال</label>
        {!! Form::text("phonenumber[]",$phonenumber[$key], [
        'class' => 'form-control',
        'placeholder' => 'الجوال',
        ]) !!}
      </div><!-- /.form-group -->

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>فاكس</label>
        {!! Form::text("fax[]", $fax[$key], [
        'class' => 'form-control',
        'placeholder' => 'تحويله',
        ]) !!}
      </div><!-- /.form-group -->
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>الهاتف</label>
        {!! Form::text("telephone[]", $telephone[$key], [
        'class' => 'form-control',
        'placeholder' => 'الهاتف',
        ]) !!}
      </div><!-- /.form-group -->

    </div>




    <div class="col-md-6" style="margin-bottom:50px">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>المدينه</label>
        {!! Form::text("city[]", $city[$key], [
        'class' => 'form-control',
        'placeholder' => 'المدينه',
        ]) !!}
      </div><!-- /.form-group -->

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>الجوال 2</label>
        {!! Form::text("phonenumbertwo[]", $phonenumbertwo[$key] , [
        'class' => 'form-control',
        'placeholder' => 'الجوال 2',
        ]) !!}
      </div><!-- /.form-group -->


      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>البريد الالكتروني</label>
        {!! Form::text("email_add[]", $email_add[$key], [
        'class' => 'form-control',
        'placeholder' => 'البريد الالكتروني',
        ]) !!}
      </div><!-- /.form-group -->


      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>تحويله</label>
        {!! Form::text("telephone_red[]", $telephone_red[$key], [
        'class' => 'form-control',
        'placeholder' => 'تحويله',
        ]) !!}
      </div><!-- /.form-group -->
    </div>


    @endforeach
    @else
    <div class="col-md-6">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>المقر</label>
        {!! Form::text("locate[]",'', [
        'class' => 'form-control',
        'placeholder' => 'المقر',
        ]) !!}
      </div><!-- /.form-group -->


      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>الجوال</label>
        {!! Form::text("phonenumber[]",'', [
        'class' => 'form-control',
        'placeholder' => 'الجوال',
        ]) !!}
      </div><!-- /.form-group -->

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>فاكس</label>
        {!! Form::text("fax[]",'', [
        'class' => 'form-control',
        'placeholder' => 'تحويله',
        ]) !!}
      </div><!-- /.form-group -->
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>الهاتف</label>
        {!! Form::text("telephone[]",'', [
        'class' => 'form-control',
        'placeholder' => 'الهاتف',
        ]) !!}
      </div><!-- /.form-group -->

    </div>




    <div class="col-md-6">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>المدينه</label>
        {!! Form::text("city[]",'', [
        'class' => 'form-control',
        'placeholder' => 'المدينه',
        ]) !!}
      </div><!-- /.form-group -->

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>الجوال 2</label>
        {!! Form::text("phonenumbertwo[]",'', [
        'class' => 'form-control',
        'placeholder' => 'الجوال 2',
        ]) !!}
      </div><!-- /.form-group -->


      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>البريد الالكتروني</label>
        {!! Form::text("email_add[]",'', [
        'class' => 'form-control',
        'placeholder' => 'البريد الالكتروني',
        ]) !!}
      </div><!-- /.form-group -->


      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>تحويله</label>
        {!! Form::text("telephone_red[]",'', [
        'class' => 'form-control',
        'placeholder' => 'تحويله',
        ]) !!}
      </div><!-- /.form-group -->
    </div>

    @endif


    <button style="display: flex;" class="btn btn-primary menu3">اضافه أخر </button>
  </div>


  <div class="tab-pane  fade" id="menu4">

    <div class="col-md-4">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>سعر المبيع</label>
        <select class="form-control">
          <option selected>خصم المدير</option>
        </select>
      </div><!-- /.form-group -->
    </div>

    <div class="col-md-4">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>نسبه الحسم</label>
        {!! Form::text("",'', [
        'class' => 'form-control',
        'placeholder' => '%',
        ]) !!}
      </div><!-- /.form-group -->
    </div>

    <div class="col-md-4">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>الرصيد الحالي</label>
        {!! Form::text("",'', [
        'class' => 'form-control',
        'placeholder' => '0:00 رس',
        ]) !!}
      </div><!-- /.form-group -->
    </div>

    <div class="col-md-6">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>الحساب</label>
        {!! Form::text("",'', [
        'class' => 'form-control',
        'placeholder' => 'الحساب',
        ]) !!}
      </div><!-- /.form-group -->
    </div>

    <div class="col-md-6">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>حساب مفابل الحسم المحقق</label>
        {!! Form::text("",'', [
        'class' => 'form-control',
        'placeholder' => 'تفصيليه',
        ]) !!}
      </div><!-- /.form-group -->
    </div>

    <div class="col-md-6">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>حساب مفابل الحسم المشروط</label>
        {!! Form::text("",'', [
        'class' => 'form-control',
        'placeholder' => 'تفصيليه',
        ]) !!}
      </div><!-- /.form-group -->
    </div>


    <div class="col-md-6">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label>الضرائب</label>
        {!! Form::text("",'', [
        'class' => 'form-control',
        'placeholder' => 'تفصيليه',
        ]) !!}
      </div><!-- /.form-group -->
    </div>
  </div>
</div>
<input type="hidden" name="lat" value="{{(isset($customer) && $customer->lat != '') ? $customer->lat : '21.4767899'}}"
  id="lat">
<input type="hidden" name="lng" value="{{(isset($customer) && $customer->lng != '') ? $customer->lng : '39.2023801'}}"
  id="lng">
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

  .select2-container {
    margin-top: 5px !important;
    width: 100% !important;
    direction: rtl;
    text-align: right;
  }

  .error,
  .reqspan {
    color: red;
  }

  #region_id,
  #city_id {
    display: none;
  }
</style>

<div class="col-md-12">
  <hr>
  <p class="error"></p>
  <div class="clear">
    <button type="submit" id="mysubmitbtu" class="btn btn-success">
      <i class="icon-check2"></i> {{ trans('admin.save') }}
    </button>
    </a>
  </div>
</div>


@section('script')


<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgT7WlFOpeuez5qKBL-yDXkuRpCUol0Rg&libraries=places&callback=initAutocomplete"
  async defer></script>

<script>
  $('.select2').select2();
$("#country").change(function(){
  val=$(this).val();
  if(val== "SAUDI ARABIA"){
$("#region_id").show('slow');
$(".region_id").hide('slow');
$("#city_id").show('slow');
$(".city_id").hide('slow');

$(".city_id").val('');
$(".region_id").val('');
  }else{
  $("#region_id").hide('slow');
  $(".region_id").show('slow');
  $(".city_id").show('slow');
$("#city_id").hide('slow');
$("#city_id").val('');
$("#region_id").val('');
  }
})

$("#region_id").change(function(){
region_id=$(this).find(':selected').attr('data-id');
$('.cities').hide();
$('.cities[data-region='+region_id+']').show();

    }).trigger('change');
  function initAutocomplete(lat, lng) {
        @if (isset($customer) && $customer->lat != "" && $customer->lng != "")
            var map = new google.maps.Map(document.getElementById('googleMap'), {
                center: {lat: {{$customer->lat}}, lng: {{$customer->lng}}},
                zoom: 13,
                mapTypeId: 'roadmap'
            });

            marker = new google.maps.Marker({
                position: {lat: {{$customer->lat}}, lng: {{$customer->lng}}},
                map: map
            });

        @else
            console.log("ana f el map");
            var map = new google.maps.Map(document.getElementById('googleMap'), {
                center: {lat: 21.4767899, lng: 39.2023801},
                zoom: 13,
                mapTypeId: 'roadmap'
            });
            marker = new google.maps.Marker({
                position: {lat: 21.4767899, lng: 39.2023801},
                map: map
            });
        @endif

        var input = document.getElementById('pac-input');
        if(input === null){
            $(".modal-body").append("<input id=\"pac-input\" onPaste=\"\" onkeydown=\"if (event.keyCode == 13) {return false;}\"\n" +
                "                           class=\"controls form-control\" type=\"text\" placeholder=\"Search Box\" style=\"position: absolute;\n" +
                "    z-index: 0;\n" +
                "    right: 0px;\n" +
                "    top: 0px;\n" +
                "    width: 50%;\">");

            var input = document.getElementById('pac-input');

        }

        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];

        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            markers.forEach(function (marker) {
                marker.setMap(null);
            });
            markers = [];

            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }


                markers.push(new google.maps.Marker({
                        map: map,
                        title: place.name,
                        position: place.geometry.location,
                        draggable: true
                    })
                );




                var last_marker = markers[markers.length - 1];
                console.log(last_marker.map.center.lat());
                console.log(last_marker.map.center.lng());
                document.getElementById('lat').value = markers[0].position.lat();
                document.getElementById('lng').value = markers[0].position.lng();

                $("#lat").val(markers[0].position.lat());
                $("#lng").val(markers[0].position.lng());
                console.log($("#lat").val());
                console.log(markers[0].position.lat());
                google.maps.event.addListener(last_marker, 'dragend', function (event) {
                    $("#lat").val(event.latLng.lat());
                    $("#lng").val(event.latLng.lng());
                    document.getElementById('lat').value = event.latLng.lat();
                    document.getElementById('lng').value = event.latLng.lng();
                });


                if (place.geometry.viewport) {

                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }


            });
            map.fitBounds(bounds);
        });

    }

</script>

<script>
  $(".menu1").click(function(){
$("#menu1").append('<div style="margin-top:50px" class="col-md-6"> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>اسم المسؤول</label> {!! Form::text("resp_name[]","", [ "class" => "form-control required", "placeholder" => "اسم المسؤول", "required" ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>المهنه</label> {!! Form::text("work[]","", [ "class" => "form-control", "placeholder" => "المهنه", ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>رقم الهاتف</label> {!! Form::text("resp_tele[]","", [ "class" => "form-control", "placeholder" => "رقم الهاتف", ]) !!} </div><!-- /.form-group --> </div> <div style="margin-top:50px" class="col-md-6"> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>الجوال</label> {!! Form::text("resp_phone[]","", [ "class" => "form-control required", "placeholder" => "الجوال", "required" ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("email") ? " has-error" : "" }}"> <label>البريد الالكتروني</label> {!! Form::email("resp_email[]","", [ "class" => "form-control", "placeholder" => "البريد الالكتروني" ]) !!} @if ($errors->has("email")) <span class="help-block"> <strong style="color:red">{{ $errors->first("email") }}</strong> </span> @endif </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>تحويله</label> {!! Form::text("resp_tele_red[]","", [ "class" => "form-control", "placeholder" => "تحويله"]) !!} </div><!-- /.form-group --> </div>');
  return false;
  })


$("#addinputf").click(function(){

   $("#filesinput").append('<input type="file" name="files[]" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf">');
    return false;
})



$(".menu3").click(function(){
$("#menu3").append('<br><div style="margin-top:50px" class="col-md-6"> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>المقر</label> {!! Form::text("locate[]","", [ "class" => "form-control", "placeholder" => "المقر" ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>الجوال</label> {!! Form::text("phonenumber[]","", [ "class" => "form-control", "placeholder" => "الجوال"]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>فاكس</label> {!! Form::text("fax[]","", [ "class" => "form-control", "placeholder" => "تحويله" ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>الهاتف</label> {!! Form::text("telephone[]","", [ "class" => "form-control", "placeholder" => "الهاتف" ]) !!} </div><!-- /.form-group --> </div> <div style="margin-top:50px" class="col-md-6"> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>المدينه</label> {!! Form::text("city[]","", [ "class" => "form-control", "placeholder" => "المدينه"  ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>الجوال 2</label> {!! Form::text("phonenumbertwo[]","", [ "class" => "form-control", "placeholder" => "الجوال 2"]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>البريد الالكتروني</label> {!! Form::text("email_add[]","", [ "class" => "form-control", "placeholder" => "البريد الالكتروني" ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>تحويله</label> {!! Form::text("telephone_red[]","", [ "class" => "form-control", "placeholder" => "تحويله" ]) !!} </div><!-- /.form-group --> </div>');
  return false;
  })
  $(".menu5").click(function(){
      $("#menu5").append('<div style="margin-top:50px" class="col-md-6"> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>اسم المسؤول</label> {!! Form::text("resp_name[]","", [ "class" => "form-control ", "placeholder" => "اسم المسؤول" ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>المهنه</label> {!! Form::text("work[]","", [ "class" => "form-control", "placeholder" => "المهنه", ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>رقم الهاتف</label> {!! Form::text("resp_tele[]","", [ "class" => "form-control", "placeholder" => "رقم الهاتف", ]) !!} </div><!-- /.form-group --> </div> <div style="margin-top:50px" class="col-md-6"> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>الجوال</label> {!! Form::text("resp_phone[]","", [ "class" => "form-control ", "placeholder" => "الجوال" ]) !!} </div><!-- /.form-group --> <div class="form-group{{ $errors->has("email") ? " has-error" : "" }}"> <label>البريد الالكتروني</label> {!! Form::email("resp_email[]","", [ "class" => "form-control", "placeholder" => "البريد الالكتروني" ]) !!} @if ($errors->has("email")) <span class="help-block"> <strong style="color:red">{{ $errors->first("email") }}</strong> </span> @endif </div><!-- /.form-group --> <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}"> <label>تحويله</label> {!! Form::text("resp_tele_red[]","", [ "class" => "form-control", "placeholder" => "تحويله"]) !!} </div><!-- /.form-group --> </div>');
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

$("#mysubmitbtu").click(function(){
  $(".required").each( function() {
    var check = $(this).val();

    if(check == '') {
        $(".error").text("من فضلك تأكد من ادخال كل الحقول الاجباريه (*)");
        return false;
    }else{
      $(".error").text("");
      return true;
    }
});
})


</script>
@endsection
