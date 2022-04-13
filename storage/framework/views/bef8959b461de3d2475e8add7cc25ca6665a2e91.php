<div class="row" style="background: #eaeaea; padding: 20px;">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group<?php echo e($errors->has(" name") ? " has-error" : ""); ?>">
        <label>الاسم</label>

        <?php echo Form::text("name", isset($warehouse) ? $warehouse->name : "", [
        "class" => "form-control",
        "placeholder" => 'الاسم',
        "required"
        ]); ?>

      </div>
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