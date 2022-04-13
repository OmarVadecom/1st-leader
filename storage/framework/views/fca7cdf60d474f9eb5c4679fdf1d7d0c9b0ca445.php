<!-- Nav tabs -->
<?php
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
?>



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
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="home">
    <div class="col-md-4">
      <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
        <label><?php echo e(trans("admin.name", ["name" => trans("admin.user")])); ?> <span class="reqspan">*</span></label>

        <?php echo Form::text("name", isset($customer) ? $customer->name : "", [
        "class" => "form-control required",
        "placeholder" => trans("admin.name", ["name" => trans("admin.user")]),
        "required"
        ]); ?>

      </div><!-- /.form-group -->
    </div>
    <div class="col-md-4">
      <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
        <label>الاسم اللاتيني</label>

        <?php echo Form::text("name_en", isset($customer) ? $customer->name_en : "", [
        "class" => "form-control",
        "placeholder" => "الاسم اللاتيني",
        ]); ?>

      </div><!-- /.form-group -->
    </div>




    <div class="col-md-4">
      <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
        <label>اسم صاحب المؤسسه</label>

        <?php echo Form::text("org_name", isset($customer) ? $customer->org_name : "", [
        "class" => "form-control",
        "placeholder" => "اسم صاحب المؤسسه",

        ]); ?>

      </div><!-- /.form-group -->
    </div>

    <div class="col-md-4">
      <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
        <label>رقم هويه صاحب المؤسسه</label>

        <?php echo Form::text("org_number", isset($customer) ? $customer->org_number : "", [
        "class" => "form-control",
        "placeholder" => "رقم هويه صاحب المؤسسه",

        ]); ?>

      </div><!-- /.form-group -->
    </div>


    <div class="col-md-4">
      <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
        <label>رقم السجل التجاري</label>

        <?php echo Form::text("segl_number", isset($customer) ? $customer->segl_number : "", [
        "class" => "form-control",
        "placeholder" => "رقم السجل التجاري",

        ]); ?>

      </div><!-- /.form-group -->
    </div>

    <div class="col-md-4">
      <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
        <label>الرقم الضريبي</label>

        <?php echo Form::text("dreb_number", isset($customer) ? $customer->dreb_number : "", [
        "class" => "form-control",
        "placeholder" => "الرقم الضريبي",
        ]); ?>

      </div><!-- /.form-group -->
    </div>


    <div class="col-md-4">
      <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
        <label>رقم الرخصه</label>

        <?php echo Form::text("lic_number", isset($customer) ? $customer->lic_number : "", [
        "class" => "form-control",
        "placeholder" => "رقم الرخصه",
        ]); ?>

      </div><!-- /.form-group -->
    </div>

    <div class="col-md-4">
      <div id="filesinput" class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
        <label>المرفقات والمستندات</label><br>
        <input type="file" name="files[]" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf">

        <button id="addinputf" class="btn btn-primary"><i class="fa fa-plus"></i></button>
      </div><!-- /.form-group -->
      <?php if(isset($customer) && $imfilenames[0] != ""): ?>
      <?php $__currentLoopData = $imfilenames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$filename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <input id="file<?php echo e($key); ?>" type="hidden" name="editfiles[]" value="<?php echo e($filename); ?>">
      <a href="<?php echo e(url('/')); ?>/uploads/documents/<?php echo e($filename); ?>" class="file<?php echo e($key); ?>" download> <?php echo e($filename); ?> </a>
      <i id="btu-file<?php echo e($key); ?>" style="color:red" class="fa fa-times clickrem"></i>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
    </div>
     <div class="col-md-6">
  <hr>
  <div class="form-group<?php echo e($errors->has('category_id') ? ' has-error' : ''); ?>">
    <label>القسم</label>
    <select name="category_id" class="select2" id="category_id" required>
      <option value="" class="select2">اختر القسم</option>
      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($category->id); ?>"
        <?php echo e((isset($customer) && $customer->category_id == $category->id) ? 'selected' : ''); ?>><?php echo e($category->name); ?>

      </option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
  </div><!-- /.form-group -->
</div>
<div class="col-md-6">
  <hr>

  <div class="form-group<?php echo e($errors->has('parent_id') ? ' has-error' : ''); ?>">
    <label>العميل الرئيسي</label>
    <select name="parent_id" class="select2" id="parent_id">
      <option value="" class="select2">اختر العميل</option>
      <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($cust->id); ?>"
        <?php echo e((isset($customer) && $customer->parent_id == $cust->id) ? 'selected' : ''); ?>><?php echo e($cust->name); ?>

      </option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
  </div><!-- /.form-group -->
  </div>
  </div>
  <div class="tab-pane  fade" id="menu1">


    <?php if(isset($customer)): ?>
    <?php $__currentLoopData = $resp_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$res_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <p class="headtitlee">المسؤول <?php echo e($key+1); ?> </p>
    <div class="col-md-6" style="margin-bottom:50px">
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>اسم المسؤول <span class="reqspan">*</span></label>
        <?php echo Form::text("resp_name[]", $res_name , [
        'class' => 'form-control required',
        'placeholder' => 'اسم المسؤول',
        "required"
        ]); ?>

      </div><!-- /.form-group -->

      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>المهنه</label>
        <?php echo Form::text("work[]", $work[$key], [
        'class' => 'form-control',
        'placeholder' => 'المهنه',
        ]); ?>

      </div><!-- /.form-group -->

      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>رقم الهاتف</label>
        <?php echo Form::text("resp_tele[]", $resp_tele[$key] , [
        'class' => 'form-control',
        'placeholder' => 'رقم الهاتف',
        ]); ?>

      </div><!-- /.form-group -->
    </div>

    <div class="col-md-6" style="margin-bottom:50px">
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>الجوال <span class="reqspan">*</span></label>
        <?php echo Form::text("resp_phone[]", $resp_phone[$key] , [
        'class' => 'form-control required',
        'placeholder' => 'الجوال',
        "required"
        ]); ?>

      </div><!-- /.form-group -->


      <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
        <label>البريد الالكتروني</label>
        <?php echo Form::email("resp_email[]",$resp_email[$key], [
        'class' => 'form-control',
        'placeholder' => 'البريد الالكتروني',
        ]); ?>

        <?php if($errors->has('email')): ?>
        <span class="help-block">
          <strong style="color:red"><?php echo e($errors->first('email')); ?></strong>
        </span>
        <?php endif; ?>
      </div><!-- /.form-group -->

      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>تحويله</label>
        <?php echo Form::text("resp_tele_red[]",$resp_tele_red[$key], [
        'class' => 'form-control',
        'placeholder' => 'تحويله'
        ]); ?>

      </div><!-- /.form-group -->
    </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
    <div class="col-md-6">
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>اسم المسؤول <span class="reqspan">*</span></label>
        <?php echo Form::text("resp_name[]",'', [
        'class' => 'form-control',
        'placeholder' => 'اسم المسؤول',
        ]); ?>

      </div><!-- /.form-group -->

      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>المهنه</label>
        <?php echo Form::text("work[]",'', [
        'class' => 'form-control',
        'placeholder' => 'المهنه',
        ]); ?>

      </div><!-- /.form-group -->

      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>رقم الهاتف</label>
        <?php echo Form::text("resp_tele[]",'', [
        'class' => 'form-control',
        'placeholder' => 'رقم الهاتف',
        ]); ?>

      </div><!-- /.form-group -->
    </div>

    <div class="col-md-6">
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>الجوال <span class="reqspan">*</span></label>
        <?php echo Form::text("resp_phone[]",'', [
        'class' => 'form-control',
        'placeholder' => 'الجوال',
        ]); ?>

      </div><!-- /.form-group -->


      <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
        <label>البريد الالكتروني</label>
        <?php echo Form::email("resp_email[]", '', [
        'class' => 'form-control',
        'placeholder' => 'البريد الالكتروني',
        ]); ?>

        <?php if($errors->has('email')): ?>
        <span class="help-block">
          <strong style="color:red"><?php echo e($errors->first('email')); ?></strong>
        </span>
        <?php endif; ?>
      </div><!-- /.form-group -->

      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>تحويله</label>
        <?php echo Form::text("resp_tele_red[]",'', [
        'class' => 'form-control',
        'placeholder' => 'تحويله'
        ]); ?>

      </div><!-- /.form-group -->
    </div>
    <?php endif; ?>









    <button style="display: flex;" class="btn btn-primary menu1">اضافه أخر </button>
  </div>
  <div class="tab-pane  fade" id="menu2">
    <div class="col-md-6">
      <div class="col-md-6">
        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
          <label>الدوله</label>
          <select name="country" class="select2" id="country">
            <option value="" class="select2">اختر الدوله</option>
            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($country->name); ?>"
              <?php echo e((isset($customer) && $customer->country == $country->name) ? 'selected' : ''); ?>><?php echo e($country->name); ?>

            </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div><!-- /.form-group -->

        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
          <label>المدينه</label>
          <?php echo Form::text("reg_city", null, [
          'class' => 'form-control city_id',
          'placeholder' => 'المدينه',
          ]); ?>


          <select name="selectcity" class="form-control" id="city_id">
            <option value="">أختر المدينه</option>
            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option data-region="<?php echo e($city->region_id); ?>" class="cities" value="<?php echo e($city->name); ?>"
              <?php echo e((isset($client) && $client->city == $city->name) ? 'selected' : ''); ?>>
              <?php echo e($city->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>


        </div><!-- /.form-group -->



      </div>



      <div class="col-md-6">

        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
          <label>المنطقه <span class="reqspan">*</span></label>
          <?php echo Form::text("region", null, [
          'class' => 'form-control region_id',
          'placeholder' => 'المنطقه',
          ]); ?>



          <select name="selectregion" class="form-control" id="region_id">
            <option value="">أختر المنطقه</option>
            <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($region->name); ?>" data-id="<?php echo e($region->id); ?>"
              <?php echo e((isset($client) && $client->region == $region->name) ? 'selected' : ''); ?>>
              <?php echo e($region->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>

        </div><!-- /.form-group -->
        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
          <label>الشارع <span class="reqspan">*</span></label>
          <?php echo Form::text("street", isset($customer) ? $customer->street : '', [
          'class' => 'form-control required',
          'placeholder' => 'الشارع',
          "required"
          ]); ?>

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

    <?php if(isset($customer)): ?>
    <?php $__currentLoopData = $locate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$locat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <p class="headtitlee">المقر <?php echo e($key+1); ?> </p>
    <div class="col-md-6" style="margin-bottom:50px">
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>المقر</label>
        <?php echo Form::text("locate[]", $locat, [
        'class' => 'form-control',
        'placeholder' => 'المقر',
        ]); ?>

      </div><!-- /.form-group -->


      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>الجوال</label>
        <?php echo Form::text("phonenumber[]",$phonenumber[$key], [
        'class' => 'form-control',
        'placeholder' => 'الجوال',
        ]); ?>

      </div><!-- /.form-group -->

      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>فاكس</label>
        <?php echo Form::text("fax[]", $fax[$key], [
        'class' => 'form-control',
        'placeholder' => 'تحويله',
        ]); ?>

      </div><!-- /.form-group -->
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>الهاتف</label>
        <?php echo Form::text("telephone[]", $telephone[$key], [
        'class' => 'form-control',
        'placeholder' => 'الهاتف',
        ]); ?>

      </div><!-- /.form-group -->

    </div>




    <div class="col-md-6" style="margin-bottom:50px">
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>المدينه</label>
        <?php echo Form::text("city[]", $city[$key], [
        'class' => 'form-control',
        'placeholder' => 'المدينه',
        ]); ?>

      </div><!-- /.form-group -->

      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>الجوال 2</label>
        <?php echo Form::text("phonenumbertwo[]", $phonenumbertwo[$key] , [
        'class' => 'form-control',
        'placeholder' => 'الجوال 2',
        ]); ?>

      </div><!-- /.form-group -->


      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>البريد الالكتروني</label>
        <?php echo Form::text("email_add[]", $email_add[$key], [
        'class' => 'form-control',
        'placeholder' => 'البريد الالكتروني',
        ]); ?>

      </div><!-- /.form-group -->


      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>تحويله</label>
        <?php echo Form::text("telephone_red[]", $telephone_red[$key], [
        'class' => 'form-control',
        'placeholder' => 'تحويله',
        ]); ?>

      </div><!-- /.form-group -->
    </div>


    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
    <div class="col-md-6">
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>المقر</label>
        <?php echo Form::text("locate[]",'', [
        'class' => 'form-control',
        'placeholder' => 'المقر',
        ]); ?>

      </div><!-- /.form-group -->


      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>الجوال</label>
        <?php echo Form::text("phonenumber[]",'', [
        'class' => 'form-control',
        'placeholder' => 'الجوال',
        ]); ?>

      </div><!-- /.form-group -->

      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>فاكس</label>
        <?php echo Form::text("fax[]",'', [
        'class' => 'form-control',
        'placeholder' => 'تحويله',
        ]); ?>

      </div><!-- /.form-group -->
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>الهاتف</label>
        <?php echo Form::text("telephone[]",'', [
        'class' => 'form-control',
        'placeholder' => 'الهاتف',
        ]); ?>

      </div><!-- /.form-group -->

    </div>




    <div class="col-md-6">
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>المدينه</label>
        <?php echo Form::text("city[]",'', [
        'class' => 'form-control',
        'placeholder' => 'المدينه',
        ]); ?>

      </div><!-- /.form-group -->

      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>الجوال 2</label>
        <?php echo Form::text("phonenumbertwo[]",'', [
        'class' => 'form-control',
        'placeholder' => 'الجوال 2',
        ]); ?>

      </div><!-- /.form-group -->


      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>البريد الالكتروني</label>
        <?php echo Form::text("email_add[]",'', [
        'class' => 'form-control',
        'placeholder' => 'البريد الالكتروني',
        ]); ?>

      </div><!-- /.form-group -->


      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>تحويله</label>
        <?php echo Form::text("telephone_red[]",'', [
        'class' => 'form-control',
        'placeholder' => 'تحويله',
        ]); ?>

      </div><!-- /.form-group -->
    </div>

    <?php endif; ?>


    <button style="display: flex;" class="btn btn-primary menu3">اضافه أخر </button>
  </div>


  <div class="tab-pane  fade" id="menu4">

    <div class="col-md-4">
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>سعر المبيع</label>
        <select class="form-control">
          <option selected>خصم المدير</option>
        </select>
      </div><!-- /.form-group -->
    </div>

    <div class="col-md-4">
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>نسبه الحسم</label>
        <?php echo Form::text("",'', [
        'class' => 'form-control',
        'placeholder' => '%',
        ]); ?>

      </div><!-- /.form-group -->
    </div>

    <div class="col-md-4">
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>الرصيد الحالي</label>
        <?php echo Form::text("",'', [
        'class' => 'form-control',
        'placeholder' => '0:00 رس',
        ]); ?>

      </div><!-- /.form-group -->
    </div>

    <div class="col-md-6">
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>الحساب</label>
        <?php echo Form::text("",'', [
        'class' => 'form-control',
        'placeholder' => 'الحساب',
        ]); ?>

      </div><!-- /.form-group -->
    </div>

    <div class="col-md-6">
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>حساب مفابل الحسم المحقق</label>
        <?php echo Form::text("",'', [
        'class' => 'form-control',
        'placeholder' => 'تفصيليه',
        ]); ?>

      </div><!-- /.form-group -->
    </div>

    <div class="col-md-6">
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>حساب مفابل الحسم المشروط</label>
        <?php echo Form::text("",'', [
        'class' => 'form-control',
        'placeholder' => 'تفصيليه',
        ]); ?>

      </div><!-- /.form-group -->
    </div>


    <div class="col-md-6">
      <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
        <label>الضرائب</label>
        <?php echo Form::text("",'', [
        'class' => 'form-control',
        'placeholder' => 'تفصيليه',
        ]); ?>

      </div><!-- /.form-group -->
    </div>
  </div>
</div>
<input type="hidden" name="lat" value="<?php echo e((isset($customer) && $customer->lat != '') ? $customer->lat : '21.4767899'); ?>"
  id="lat">
<input type="hidden" name="lng" value="<?php echo e((isset($customer) && $customer->lng != '') ? $customer->lng : '39.2023801'); ?>"
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
      <i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

    </button>
    </a>
  </div>
</div>


<?php $__env->startSection('script'); ?>


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
        <?php if(isset($customer) && $customer->lat != "" && $customer->lng != ""): ?>
            var map = new google.maps.Map(document.getElementById('googleMap'), {
                center: {lat: <?php echo e($customer->lat); ?>, lng: <?php echo e($customer->lng); ?>},
                zoom: 13,
                mapTypeId: 'roadmap'
            });

            marker = new google.maps.Marker({
                position: {lat: <?php echo e($customer->lat); ?>, lng: <?php echo e($customer->lng); ?>},
                map: map
            });

        <?php else: ?>
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
        <?php endif; ?>

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
$("#menu1").append('<div style="margin-top:50px" class="col-md-6"> <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>"> <label>اسم المسؤول</label> <?php echo Form::text("resp_name[]","", [ "class" => "form-control required", "placeholder" => "اسم المسؤول", "required" ]); ?> </div><!-- /.form-group --> <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>"> <label>المهنه</label> <?php echo Form::text("work[]","", [ "class" => "form-control", "placeholder" => "المهنه", ]); ?> </div><!-- /.form-group --> <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>"> <label>رقم الهاتف</label> <?php echo Form::text("resp_tele[]","", [ "class" => "form-control", "placeholder" => "رقم الهاتف", ]); ?> </div><!-- /.form-group --> </div> <div style="margin-top:50px" class="col-md-6"> <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>"> <label>الجوال</label> <?php echo Form::text("resp_phone[]","", [ "class" => "form-control required", "placeholder" => "الجوال", "required" ]); ?> </div><!-- /.form-group --> <div class="form-group<?php echo e($errors->has("email") ? " has-error" : ""); ?>"> <label>البريد الالكتروني</label> <?php echo Form::email("resp_email[]","", [ "class" => "form-control", "placeholder" => "البريد الالكتروني" ]); ?> <?php if($errors->has("email")): ?> <span class="help-block"> <strong style="color:red"><?php echo e($errors->first("email")); ?></strong> </span> <?php endif; ?> </div><!-- /.form-group --> <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>"> <label>تحويله</label> <?php echo Form::text("resp_tele_red[]","", [ "class" => "form-control", "placeholder" => "تحويله"]); ?> </div><!-- /.form-group --> </div>');
  return false;
  })


$("#addinputf").click(function(){

   $("#filesinput").append('<input type="file" name="files[]" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf">');
    return false;
})



$(".menu3").click(function(){
$("#menu3").append('<br><div style="margin-top:50px" class="col-md-6"> <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>"> <label>المقر</label> <?php echo Form::text("locate[]","", [ "class" => "form-control", "placeholder" => "المقر" ]); ?> </div><!-- /.form-group --> <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>"> <label>الجوال</label> <?php echo Form::text("phonenumber[]","", [ "class" => "form-control", "placeholder" => "الجوال"]); ?> </div><!-- /.form-group --> <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>"> <label>فاكس</label> <?php echo Form::text("fax[]","", [ "class" => "form-control", "placeholder" => "تحويله" ]); ?> </div><!-- /.form-group --> <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>"> <label>الهاتف</label> <?php echo Form::text("telephone[]","", [ "class" => "form-control", "placeholder" => "الهاتف" ]); ?> </div><!-- /.form-group --> </div> <div style="margin-top:50px" class="col-md-6"> <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>"> <label>المدينه</label> <?php echo Form::text("city[]","", [ "class" => "form-control", "placeholder" => "المدينه"  ]); ?> </div><!-- /.form-group --> <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>"> <label>الجوال 2</label> <?php echo Form::text("phonenumbertwo[]","", [ "class" => "form-control", "placeholder" => "الجوال 2"]); ?> </div><!-- /.form-group --> <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>"> <label>البريد الالكتروني</label> <?php echo Form::text("email_add[]","", [ "class" => "form-control", "placeholder" => "البريد الالكتروني" ]); ?> </div><!-- /.form-group --> <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>"> <label>تحويله</label> <?php echo Form::text("telephone_red[]","", [ "class" => "form-control", "placeholder" => "تحويله" ]); ?> </div><!-- /.form-group --> </div>');
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
<?php $__env->stopSection(); ?>