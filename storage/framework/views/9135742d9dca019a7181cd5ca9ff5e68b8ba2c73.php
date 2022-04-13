<div class="card-body">
    <div class="card-block">
        <div class="row">
            <input value="<?php echo e(isset($type) ? $type : ''); ?>" name="type" type="hidden" />
            <?php if(\Route::currentRouteName() === 'purchases-prices-offers.edit'): ?>
                <?php if($PurchasePriceOffer->status === 0): ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="status">
                                    <input id="status" type="checkbox" name="status" value="1">
                                    تحويل الي امر شراء
                                </label>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="supplier">المورد</label><br>
                    <select name="supplier_id" class="form-control" id="supplier" required>
                        <option value="">اختر المورد</option>
                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if(isset($PurchasePriceOffer) && $PurchasePriceOffer->supplier_id === $supplier->id): ?>
                            selected
                            <?php endif; ?>
                            value="<?php echo e($supplier->id); ?>"
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
                    <label for="title">التاريخ</label>
                    <input value="<?php echo e(isset($PurchasePriceOffer) ? $PurchasePriceOffer->date : date('Y-m-d')); ?>"
                        class="form-control" name="date" required />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">الوقت</label>
                    <input value="<?php echo e(isset($PurchasePriceOffer) ? $PurchasePriceOffer->time : date('h:i:s A')); ?>"
                        class="form-control" name="time" required />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="offer_duration">مدة العرض</label>
                    <input
                        value="<?php echo e(isset($PurchasePriceOffer) ? $PurchasePriceOffer->offer_duration : old('offer_duration')); ?>"
                        name="offer_duration" class="form-control" required />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="notes"> ملاحظات </label>
                    <textarea class="form-control" name="notes" id="notes"
                        required><?php echo e(isset($PurchasePriceOffer) ? $PurchasePriceOffer->notes : old('notes')); ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="declaration"> البيان </label>
                    <textarea name="declaration" class="form-control"
                        required><?php echo e(isset($PurchasePriceOffer) ? $PurchasePriceOffer->declaration : old('declaration')); ?></textarea>
                </div>
            </div>
        </div>
        <div class="row"></div>
        <hr>
        <div class="tab">
            <button type="button" class="tablinks active" onclick="openTab(event, 'product-tab')">العرض</button>
        </div>

        <?php
        if(isset($edit)){
        $items=$purchase_price_offer_products;
        $quantities=$purchase_price_offer_quantities;
        $prices=$purchase_price_offer_prices;
        $discounts=$purchase_price_offer_discounts;
        $taxes=$purchase_price_offer_dreba;
        $addon_disc=$PurchasePriceOffer->addon_discount;
        }
        ?>
        <?php echo $__env->make('admin.layouts.product_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="col-md-12">
            <hr>
            <div class="clear">
                <button type="submit" class="btn btn-success">
                    <i class="icon-check2"></i> حفظ
                </button>
                <?php if(\Route::currentRouteName() === 'purchases-prices-offers.edit' && $PurchasePriceOffer->status === 1): ?>
                    <?php if(request('type') !== NULL): ?>
                        <a href="<?php echo e(route('admin.purchases-orders.index') . '?type=' . request('type')); ?>" class="btn btn-danger">
                            <i class="fa fa-times"></i> إلغاء
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(request('type') !== NULL): ?>
                        <a href="<?php echo e(route('purchases-prices-offers.index') . '?type=' . request('type')); ?>" class="btn btn-danger">
                            <i class="fa fa-times"></i> إلغاء
                        </a>
                    <?php endif; ?>
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
