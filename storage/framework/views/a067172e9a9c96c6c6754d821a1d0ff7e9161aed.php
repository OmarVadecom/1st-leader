<div class="row" style="background: #eaeaea; padding: 20px;">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
        <label>اسم التصنيف</label>

        <?php echo Form::text("name", null, [
        "class" => "form-control",
        "placeholder" => 'الاسم',
        "required"
        ]); ?>

      </div><!-- /.form-group -->
    </div>

    <div class="col-md-3">
      <label>ايقون التصنيف</label>
      <br>
      <input type="file" name="image">
      <input type="hidden" name="oldimage" value="<?php echo e((isset($attachcat)) ? $attachcat->image : ''); ?>">
    </div>
    <div class="col-md-3">
      <?php if(isset($attachcat)): ?>
      <img src="<?php echo e(asset('uploads/attachcat/'.$attachcat->image)); ?>" style="width: 100px;margin-top: -20px;" alt="">
      <?php endif; ?>
    </div>
  </div>


  <div class="col-md-12">
    <hr>
    <div class="clear">
      <button type="submit" class="btn btn-success">
        <i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

      </button>
    </div>
  </div>