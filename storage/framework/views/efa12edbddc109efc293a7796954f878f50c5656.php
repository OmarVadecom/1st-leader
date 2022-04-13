<div class="tab-pane  active" id="home">
  <div class="row">
    <div class="col-md-6">

      <div class="form-group">
        <label>المجموعه</label>
        <br>
        <select name="category_id" class="form-control selectproduct">
          <option value="">اختر المجموعه </option>
          <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($cat->id); ?>" <?php echo e(($product && $product->category_id == $cat->id) ? 'selected' : ''); ?>>
            <?php echo e($cat->title); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>

      <div class="form-group">
        <label>الشركه </label> <br>
        <select name="brand_id" class="form-control tagsadd">
          <option value="">أختر الشركه </option>
          <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($brand->id); ?>" <?php echo e((isset($product) && $brand->id==$product->brand_id) ? 'selected' : ''); ?>>
            <?php echo e($brand->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div><!-- /.form-group -->


      <div class="form-group">
        <label> المنشأ</label>
        <br>
        <select name="origin_id" class="form-control tagsadd">
          <option value="">اختر المنشأ</option>
          <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($country->id); ?>" <?php echo e((isset($product) && $country->id==$product->origin_id) ? 'selected' : ''); ?>>
            <?php echo e($country->name); ?>

          </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div><!-- /.form-group -->


      <div class="form-group">
        <label> الصناعه</label><br>
        <select name="country_id" class="form-control tagsadd">
          <option value=""> الصناعه</option>
          <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($country->id); ?>"
            <?php echo e((isset($product) && $country->id==$product->country_id) ? 'selected' : ''); ?>><?php echo e($country->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div><!-- /.form-group -->


      <div class="form-group">
        <label>اللون</label>
        <br>
        <select name="color" class="form-control tagsadd">
          <option value="">اختر اللون</option>
          <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($color->id); ?>" <?php echo e((isset($product) && $color->id==$product->color) ? 'selected' : ''); ?>>
            <?php echo e($color->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div><!-- /.form-group -->

    </div>

    <div class="col-md-6">

      <div class="form-group">
        <label>نوع المنتج</label>
        <select class="form-control" name="type">
          <option value="">اختر نوع المنتج</option>
          <option value="1" <?php echo e((isset($product) && $product->type==1) ? 'selected' : ''); ?>>مستودعي</option>
          <option value="2" <?php echo e((isset($product) && $product->type==2) ? 'selected' : ''); ?>>خدمي</option>
        </select>
      </div>

      <div class="form-group">
        <label>رمز الترقيم</label>

        <?php echo Form::text('label', "EE", [
        "class" => "form-control",
        "placeholder" => ' رمز الترقيم',
        "disabled"=>'disabled',
        ]); ?>

      </div><!-- /.form-group -->


      <div class="form-group">
        <label>فئه المنتج </label>
        <select class="form-control" name="product_type">
          <option value="">اختر فئه المنتج</option>
          <option value="1" <?php echo e((isset($product) && $product->product_type==1) ? 'selected' : ''); ?>>رئيسي</option>
          <option value="2" <?php echo e((isset($product) && $product->product_type==2) ? 'selected' : ''); ?>>تجميعي</option>
        </select>
      </div>

      <div class="form-group">
        <label>كرت الضمان</label>
        <select class="form-control" name="insurance">
          <option value="">اختر كرت الضمان</option>
          <option value="3 اشهر" <?php echo e(($product && $product->insurance == '3 اشهر') ? 'selected' : ''); ?>>3 اشهر</option>
          <option value="6 اشهر" <?php echo e(($product && $product->insurance == '6 اشهر') ? 'selected' : ''); ?>>6 اشهر</option>
          <option value="1 سنه" <?php echo e(($product && $product->insurance == '1 سنه') ? 'selected' : ''); ?>>1 سنه</option>
          <option value="2 سنه" <?php echo e(($product && $product->insurance == '2 سنه') ? 'selected' : ''); ?>>2 سنه</option>
        </select>
      </div>
      <div class="form-group">
        <label>التفعيلات</label><br>
        <div class="col-md-6">

        <label><input type="checkbox" name="maintenance" value="1"
            <?php echo e((isset($product) && $product->maintenance==1) ? 'checked' : ''); ?>> الصيانه </label>
</div>
        <div class="col-md-6">

        <label><input type="checkbox" name="hidden" value="1"
            <?php echo e((isset($product) && $product->hidden==1) ? 'checked' : ''); ?>> اخفاء </label>
  
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
      <?php if(isset($descriptions)): ?>
      <?php $__currentLoopData = $descriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$description): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-8" style="padding: 0px !important;">
      <input type="text" class="form-control"  name="title_description[]" value="<?php echo e(isset($title_description[$key]) ? $title_description[$key] : ''); ?>" placeholder="عنوان الوصف">
      </div><div class="col-md-4"><input type="file" name="img_description[]"></div>
      <input type="hidden" name="old_img_description[]" class="oldimgdesc<?php echo e($key); ?>" value="<?php echo e(isset($img_description[$key]) ? $img_description[$key] : ''); ?>">
      <?php if(isset($img_description[$key]) && $img_description[$key] != "" ): ?>
      <div class="imgdiv<?php echo e($key); ?>">
      <img src="<?php echo e(url('/')); ?>/uploads/products-desc-imgs/<?php echo e($img_description[$key]); ?>" style="width:100px;margin-right: 14px;">
      <button class="btn btn-success deletethisimg" data-num="<?php echo e($key); ?>">حذف</button>
      </div>
      <?php endif; ?>
      <?php echo Form::textarea("description[]", $description, [
      "class" => "form-control",
      "placeholder" => 'معلومات المنتج',
      'rows'=>6,
      'style'=>'direction:ltr',


      ]); ?><br>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
      <div class="col-md-8" style="padding: 0px !important;">
      <input type="text" class="form-control"  name="title_description[]" placeholder="عنوان الوصف">
      </div><div class="col-md-4"><input type="file" name="img_description[]"></div>
      <?php echo Form::textarea("description[]", "", [
      "class" => "form-control",
      "placeholder" => 'معلومات المنتج',
      'rows'=>6,
      'style'=>'direction:ltr',

      ]); ?>

      <?php endif; ?>
      <br>
    </div><!-- /.form-group -->
  </div>
  <div class="col-md-2">
    <button id="add-spec" style="float: left;" class="btn btn-success">اضافه وصف اخر</button>
  </div>

</div>