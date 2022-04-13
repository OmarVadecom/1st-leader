<div class="card-body">
  <div class="card-block">


    <div class="col-md-3">
      <div class="form-group">
        <label for="title">أختر الزبون</label><br>
        <select name="customer" class="form-control selectproduct" required>
          <option value="">اختر الزبون</option>
          <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($customer->id); ?>" <?php echo e((isset($offer) && $customer->id==$offer->customer_id) ? 'selected' :
            ''); ?>

            <?php echo e((isset($delivery) && $delivery->customer_id == $customer->id) ? 'selected' : ''); ?>>
            <?php echo e($customer->name); ?>

          </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select><br>
        <a href="<?php echo e(url('/')); ?>/customers/create">اضافه زبون جديد </a>
      </div>
    </div>


    <div class="col-md-3">
      <div class="form-group<?php echo e($errors->has(" name") ? " has-error" : ""); ?>">
        <label> الحساب المقابل</label>
        <select name="box_id" class="form-control select2" id="">
          <option value="">اختر الحساب</option>
          <?php $__currentLoopData = $boxs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($box->id); ?>" <?php echo e((isset($sell) && $sell->box_id == $box->id) ? 'selected' : ''); ?>>
            <?php echo e($box->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div><!-- /.form-group -->
    </div>


    <?php if(isset($maintenance)): ?>
    <input type="hidden" name="maintenance_id" class="form-control"
      value="<?php echo e(isset($maintenance) ? $maintenance : null); ?>">
    <input type="hidden" name="invtype" class="form-control" value="2">
    <input type="hidden" name="main_type" class="form-control" value="<?php echo e(\Request::get('main_type')); ?>">

    <?php else: ?>
    <input type="hidden" name="invtype" class="form-control" value="<?php echo e(isset($delivery) ? 1 : 0); ?>">
    <?php endif; ?>
    <input type="hidden" name="delivery" class="form-control" value="<?php echo e(isset($delivery) ? $delivery->id : ''); ?>">

    <div class="col-md-3">
      <div class="form-group">
        <label for="title">التاريخ</label>
        <input value=" <?php echo e(isset($offer->date) ? $offer->date : date('Y-m-d')); ?>" required name="date" class="form-control">
      </div>
    </div>

    <div class="col-md-3">
      <div class="form-group">
        <label for="title">الوقت</label>
        <input value="<?php echo e(isset($offer->time) ? $offer->time : date('H:i:s')); ?>" required name="time" class="form-control">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="title">المستودع</label>
        <select name="warehouse" class="form-control" required>
          <option value="">اختر المستودع</option>
          <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($warehouse->id); ?>" <?php echo e((isset($offer) && $offer->warehouse_id == $warehouse->id) ? 'selected' :
            ''); ?>><?php echo e($warehouse->name); ?>

          </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="title">ملاحظات</label>
        <textarea name="notes" id="" class="form-control"><?php echo e((isset($offer)) ? $offer->notes : ''); ?></textarea>
      </div>
    </div>

    <?php
    if(isset($edit)){
    $items=$offer_products;
    $quantities=$offer_products_quantities;
    $prices=$offer_products_prices;
    $discounts=$offer_products_discounts;
    $taxes=$offer_products_taxes;
    $addon_disc=$offer->addon_disc;
    }
    if(isset($del_products_ids) && count($del_products_ids) > 0){
      $edit=true;
      $fillarray=array_fill(0, count($del_products_ids), 0);
      $items=$delivery_products_ids;
      $quantities=$delivery_quantities;
      $prices=$fillarray;
      $discounts=$fillarray;
      $taxes=$fillarray;
      $addon_disc='';
    }
    ?>
    <?php echo $__env->make('admin.layouts.product_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



    <input type="hidden" value="0" name="prstatus" id="prstatus">
    <div class="col-md-12">
      <hr>
      <div class="clear">
        <button type="submit" class="btn btn-success">
          <i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

        </button>
        <button type="submit" class="btn btn-success" id="submitprint">
          <i class="icon-check2"></i> حفظ وطباعه
        </button>
        <a href="<?php echo e(route('priceoffer.index')); ?>" class="btn btn-danger">
          <i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

        </a>
      </div>
    </div>
  </div>
</div>

<?php $__env->startSection('script'); ?>
<?php echo $__env->make('admin.layouts.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->appendSection(); ?>

<!-- /*/*/*/*/*/ Style Section  /*/*/*/*/*/*/*/-->
<?php echo $__env->make('admin.layouts.style.form_style', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- /*/*/*/*/*/ Style Section  /*/*/*/*/*/*/*/-->
