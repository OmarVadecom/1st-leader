<div class="tab-pane  fade" id="menu4">
  <div class="col-md-9">
    <div id="addspecifications" class="form-group">
      <label>المواصفات الفنيه</label><br>
      <div class="col-md-12">
        <label>صوره المواصفات الفنيه</label><br>
        <input type="file" name="main_desc_img">
        <?php if(isset($product) && $product->spec_main_img != ""): ?>
        <img style="width:150px;" src="<?php echo e(url('/')); ?>/uploads/spec_images/<?php echo e($product->spec_main_img); ?>">
        <input type="hidden" name="old_main_desc_img" value="<?php echo e($product->spec_main_img); ?>">
        <?php endif; ?>
        <br><br>
      </div>

      <?php if(isset($product->sections) && count($product->sections) > 0): ?>
      <?php $__currentLoopData = $product->sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$spec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="row">
        <div class="col-md-3">
          <select class="form-control" name="specs_sections[]">
            <option value="">اختر التصنيف</option>
            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($section->id); ?>" <?php echo e(($spec->section_id == $section->id) ? 'selected' :
              ''); ?>><?php echo e($section->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="col-md-3">
          <select class="form-control specs_select2_type" data-numb="1" name="specs_names[]">
            <option value="<?php echo e($spec->name); ?>"><?php echo e($spec->name); ?></option>
          </select>
        </div>
        <div class="col-md-5 colm9-1" style="margin-bottom:10px">
          <?php echo Form::text("specs_desc[]", $spec->description, [
          "class" => "form-control",
          "placeholder" => "الوصف",
          "style" => 'direction: ltr',
          ]); ?>

        </div>
        <div class="col-md-1">
          <i class="fa fa-close removethis"></i>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php elseif(isset($specs_names)): ?>
      <?php $__currentLoopData = $specs_names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$spec_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="row">
        <div class="col-md-3">
          <select class="form-control" name="specs_sections[]">
            <option value="">اختر التصنيف</option>
            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($section->id); ?>"><?php echo e($section->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="col-md-3">
          <select class="form-control specs_select2_type" data-numb="1" name="specs_names[]">
            <option value="<?php echo e($spec_name); ?>"><?php echo e($spec_name); ?></option>
          </select>
        </div>

        <div class="col-md-5 colm9-1" style="margin-bottom:10px">
          <?php echo Form::text("specs_desc[]", $specs_desc[$key], [
          "class" => "form-control",
          "placeholder" => "الوصف",
          "style" => 'direction: ltr',
          ]); ?>

        </div>
        <div class="col-md-1">
          <i class="fa fa-close removethis"></i>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
      <div class="col-md-3">
        <select class="form-control" name="specs_sections[]">
          <option value="">اختر التصنيف</option>
          <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($section->id); ?>"><?php echo e($section->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
      <div class="col-md-3">
        <select class="form-control specs_select2_type" data-numb="1" name="specs_names[]">
          <option value="الطول">الطول</option>
          <option value="العرض">العرض</option>
          <option value="الارتفاع">الارتفاع</option>
          <option value="القوه الهيدروليكيه">القوه الهيدروليكيه</option>
          <option value="الكهرباء">الكهرباء</option>
          <option value="سرعه الدوران">سرعه الدوران</option>
        </select>
      </div>

      <div class="col-md-6 colm9-1" style="margin-bottom:10px">
        <?php echo Form::text("specs_desc[]", "", [
        "class" => "form-control",
        "placeholder" => "الوصف",
        "style" => 'direction: ltr',
        ]); ?>


      </div>
      <?php endif; ?>
    </div><!-- /.form-group -->
  </div>
  <div class="col-md-3">
    <button id="add-specfic" style="float: left; margin-top: 20px;" class="btn btn-success">اضافه وصف اخر</button>
  </div>

</div>
<style>
  .removethis {
    padding: 10px;
    background: antiquewhite;
    color: red;
  }
</style>