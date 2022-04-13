<div class="row" style="background: #eaeaea; padding: 20px;">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group<?php echo e($errors->has(" name") ? " has-error" : ""); ?>">
        <label>الاسم</label>

        <?php echo Form::text("name", isset($stock) ? $stock->name : "", [
        "class" => "form-control",
        "placeholder" => 'الاسم',
        "required"
        ]); ?>

      </div><!-- /.form-group -->
    </div>


    <!-- <div class="col-md-6">
      <div class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
        <label>المستودع</label>
        <select name="stock" class="form-control" id="">
          <option value="">اختر المستودع</option>
          <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($stock->id); ?>"><?php echo e($stock->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
    </div> -->


  </div>

  <div class="col-md-12">
    <hr>
    <div class="clear">
      <button type="submit" class="btn btn-success">
        <i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

      </button>
    </div>
  </div>