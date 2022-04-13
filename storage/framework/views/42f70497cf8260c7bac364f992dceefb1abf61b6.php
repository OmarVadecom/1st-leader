<div class="tab-pane  fade" id="menu1">
  <div class="col-md-12 unitsrows">
    <div class="row">
      <div class="col-md-5">
        <div class="form-group">
          <label>الوحده 1</label>
          <?php echo Form::text("units[]", isset($units) ? $units[0] : "" , [
          'class' => 'form-control',
          'placeholder' => 'الوحده ',
          ]); ?>

        </div><!-- /.form-group -->
        <div class="form-group">
          <label><input type="radio" value="1" <?php echo e((isset($units) && $unit_default==1) ? 'checked' : ''); ?>

              name="unit_default[]"> الافتراضي
          </label>
          <br><br>
        </div><!-- /.form-group -->
      </div><!-- /.form-group -->
      <div class="col-md-5">
        <div class="form-group">
          <label>رمز الباركود</label>
          <?php echo Form::text("units_barcode[]", isset($units) ?$units_barcode[0] : "" , [
          'class' => 'form-control',
          'placeholder' => 'رمز الباركود',
          ]); ?>

        </div><!-- /.form-group -->
      </div>


      <div class="col-md-2">
        <button id="add-unit" style="float: left;margin-top: 24px;" class="btn btn-success">اضافه وحده اخري</button>
      </div>
    </div>

    <?php if(isset($units) && count($units) > 1): ?>
    <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
    if ($index > 1) continue;
    ?>
    <input type="hidden" id="indexnum" value="<?php echo e($index+2); ?>">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group"> <label>الوحده <?php echo e($index+2); ?></label> <?php echo Form::text("units[]", $unit, [ "class" =>
          "form-control",
          "placeholder" => "الوحده", ]); ?> </div><!-- /.form-group -->
      </div>
      <div class="col-md-4">
        <div class="form-group"> <label>عامل التحويل</label> <?php echo Form::number("units_cons[]",$units_cons[$index] , [
          "class" => "form-control", "placeholder" => "عامل التحويل", ]); ?> </div>
        <!-- /.form-group -->
      </div>
      <div class="col-md-4">
        <div class="form-group"> <label>رمز الباركود</label> <?php echo Form::text("units_barcode[]", $units_barcode[$index] ,
          [ "class" =>
          "form-control", "placeholder" => "رمز الباركود", ]); ?> </div><!-- /.form-group -->
      </div>
    </div>
    <div class="form-group"> <label><input type="radio" value="<?php echo e($index+2); ?>" <?php echo e((isset($units) &&
          $unit_default==$index+2) ? 'checked' : ''); ?> name="unit_default[]"> الافتراضي </label>
      <br><br>
    </div><!-- /.form-group -->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <hr>





    




  </div>
</div>