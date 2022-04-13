<div class="card-body">
    <div class="card-block">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group<?php echo e($errors->has(" name") ? " has-error" : ""); ?>">
                    <label> الحساب التفصيلي</label>
                    <select name="box_id" class="form-control select2" id="">
                        <option value="">اختر الحساب</option>
                        <?php $__currentLoopData = $boxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($box->id); ?>" <?php echo e((isset($offer) && $offer->box_id === $box->id) ? 'selected' : ''); ?>>
                                <?php echo e($box->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">المورد</label><br>
                    <select name="supplier_id" class="form-control" id="">
                        <option value="">اختر المورد</option>
                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($supplier->id); ?>" <?php echo e((isset($offer) && $offer->supplier === $supplier->name) ? 'selected' : ''); ?>>
                                <?php echo e($supplier->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <a href="<?php echo e(route('supplier.create')); ?>" target="blank">اضافه مورد جديد</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="date">التاريخ</label>
                    <input value=" <?php echo e(isset($offer->date) ? $offer->date : date('Y-m-d')); ?>" id="date" name="date" class="form-control" required />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="time">الوقت</label>
                    <input value="<?php echo e(isset($offer->time) ? $offer->time : date('H:i:s')); ?>" id="time" name="time" class="form-control" required />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="notes">ملاحظات</label>
                    <textarea name="notes" id="notes" class="form-control"><?php echo e(isset($offer->notes) ? $offer->notes : ''); ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="declaration">البيان</label>
                    <textarea name="declaration" id="declaration" class="form-control"><?php echo e(isset($offer->declaration) ? $offer->declaration : ''); ?></textarea>
                </div>
            </div>
        </div>
        <?php
            if( isset($edit) ) {
                $quantities = $offer_products_quantities;
                $addon_disc = $offer->addon_disc;
                $discounts  = $offer_products_discounts;
                $prices     = $offer_products_prices;
                $items      = $offer_products ;
                $taxes      = $offer_products_taxes;
            }
        ?>
        <?php echo $__env->make('admin.layouts.product_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="row">
            <input type="hidden" value="0" name="prstatus" id="prstatus">
            <div class="col-md-12">
                <hr>
                <div class="clear">
                    <?php if(isset($verify)): ?>
                    <button type="submit" class="btn btn-success">
                        <i class="icon-check2"></i> تعميد
                    </button>
                    <?php else: ?>
                    <button type="submit" class="btn btn-success">
                        <i class="icon-check2"></i> حفظ
                    </button>
                    <?php if(isset($edit)): ?>
                    <?php if(\Request::get('status') != 1 && \Request::get('status') != 2): ?>
                    <a href="<?php echo e(route('priceoffer.edit',$offer->id)); ?>?q=verify" class="btn btn-primary">
                        <i class="icon-check2"></i> تعميد
                    </a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>


                    <a href="<?php echo e(route('priceoffer.index')); ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

                    </a>
                </div>
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
