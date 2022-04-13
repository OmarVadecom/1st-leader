<div class="card-body">
    <div class="card-block">
        <div class="row">
            <input value="<?php echo e(isset($offer_id) ? $offer_id : ''); ?>" name="offer_id" type="hidden" />
            <input value="<?php echo e(isset($type) ? $type : ''); ?>" name="type" type="hidden" />
            <div class="col-md-3">
                <div class="form-group<?php echo e($errors->has(" name") ? " has-error" : ""); ?>">
                    <label> الحساب التفصيلي</label>
                    <select name="box_id" class="form-control select2" id="" required>
                        <option value="">اختر الحساب</option>
                        <?php $__currentLoopData = $boxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($box->id); ?>" <?php echo e((isset($purchase) && $purchase->box_id === $box->id) ? 'selected' : ''); ?>>
                                <?php echo e($box->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">المورد</label><br>
                    <select name="supplier_id" class="form-control" id="" required>
                        <option value="">اختر المورد</option>
                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($supplier->id); ?>"
                                <?php echo e((isset($purchase) && $purchase->supplier_id === $supplier->id) || ( isset($purchaseOffer) && $purchaseOffer->supplier_id === $supplier->id ) ? 'selected' : ''); ?>

                            >
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
                    <input value="<?php if(isset($purchase)): ?><?php echo e($purchase->date); ?><?php elseif(isset($purchaseOffer)): ?><?php echo e($purchaseOffer->date); ?><?php else: ?><?php echo e(date('Y-m-d')); ?><?php endif; ?>"
                           id="date" name="date" class="form-control" required
                    />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="time">الوقت</label>
                    <input value="<?php if(isset($purchase)): ?><?php echo e($purchase->time); ?><?php elseif(isset($purchaseOffer)): ?><?php echo e($purchaseOffer->time); ?><?php else: ?><?php echo e(date('h:i:s A')); ?><?php endif; ?>"
                           id="time" name="time" class="form-control" required
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="notes">ملاحظات</label>
                    <textarea name="notes" id="notes" class="form-control" required><?php if(isset($purchase)): ?><?php echo e($purchase->notes); ?><?php elseif(isset($purchaseOffer)): ?><?php echo e($purchaseOffer->notes); ?><?php endif; ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="declaration">البيان</label>
                    <textarea name="declaration" id="declaration" class="form-control" required><?php if(isset($purchase)): ?><?php echo e($purchase->declaration); ?><?php elseif(isset($purchaseOffer)): ?><?php echo e($purchaseOffer->declaration); ?><?php endif; ?></textarea>
                </div>
            </div>
        </div>
        <?php
            if( isset($edit) ) {
                $quantities = $purchase_quantities;
                $addon_disc = $purchase->addon_discount;
                $discounts  = $purchase_discounts;
                $prices     = $purchase_prices;
                $items      = $purchase_products;
                $taxes      = $purchase_dreba;
            }
        ?>
        <?php echo $__env->make('admin.layouts.product_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="row">
            <input type="hidden" value="0" name="prstatus" id="prstatus">
            <div class="col-md-12">
                <hr>
                <div class="clear">
                    <button type="submit" class="btn btn-success">
                        <i class="icon-check2"></i> حفظ
                    </button>
                    <?php if(request('type')): ?>
                        <a href="<?php echo e(route('purchases.index') . '?type=' . request('type')); ?>" class="btn btn-danger">
                            <i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

                        </a>
                    <?php endif; ?>
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
