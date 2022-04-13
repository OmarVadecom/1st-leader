<div class="card-body">
    <div class="card-block">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">أختر الزبون</label><br>
                    <select name="customer" class="form-control selectproduct" required>
                        <option value="">اختر الزبون</option>
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                <?php echo e((isset($delivery) && $delivery->customer_id === $customer->id) ? 'selected' : ''); ?>

                                <?php echo e((isset($offer) && $customer->id === $offer->customer_id) ? 'selected' : ''); ?>

                                value="<?php echo e($customer->id); ?>"
                            >
                                <?php echo e($customer->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <br>
                    <a href="<?php echo e(url('/')); ?>/customers/create">اضافه زبون جديد </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group<?php echo e($errors->has(" name") ? " has-error" : ""); ?>">
                    <label> الحساب المقابل</label>
                    <select name="box_id" class="form-control select2" id="" required>
                        <option value="">اختر الحساب</option>
                        <?php $__currentLoopData = $boxs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                <?php echo e((isset($offer) && $offer->box_id == $box->id ) ? 'selected' : ''); ?>

                                value="<?php echo e($box->id); ?>"
                            >
                                <?php echo e($box->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <input type="hidden" name="invoice_num" value="<?php echo e(request('invoice_num') ?? 0); ?>" />
            <?php if(isset($maintenance)): ?>
                <input type="hidden" name="maintenance_id" class="form-control" value="<?php echo e($maintenance ?? null); ?>" />
                <input type="hidden" name="invtype" class="form-control" value="2" />
                <input type="hidden" name="main_type" class="form-control" value="<?php echo e(request()->get('main_type')); ?>" />
            <?php elseif(request()->get('main_type') !== null): ?>
                <?php if(request('main_type') === '1'): ?>
                    <input type="hidden" name="invtype" class="form-control" value="2" />
                    <input type="hidden" name="main_type" class="form-control" value="" />
                <?php else: ?>
                    <input type="hidden" name="invtype" class="form-control" value="<?php echo e(request()->get('main_type')); ?>" />
                    <input type="hidden" name="main_type" class="form-control" value="<?php echo e(request()->get('main_type')); ?>" />
                <?php endif; ?>
            <?php else: ?>
                <input type="hidden" name="invtype" class="form-control" value="<?php echo e(isset($delivery) ? 1 : 0); ?>" />
            <?php endif; ?>
            <input type="hidden" name="delivery" class="form-control" value="<?php echo e(isset($delivery) ? $delivery->id : ''); ?>">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">التاريخ</label>
                    <input value=" <?php echo e(isset($offer->date) ? $offer->date : date('Y-m-d')); ?>" name="date" class="form-control" required />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">الوقت</label>
                    <input value="<?php echo e(isset($offer->time) ? $offer->time : date('h:i:s A')); ?>" name="time" class="form-control" required />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">المستودع</label>
                    <select name="warehouse" class="form-control" required>
                        <option value="">اختر المستودع</option>
                        <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                <?php echo e((isset($offer) && $offer->warehouse_id === $warehouse->id) ? 'selected' : ''); ?>

                                value="<?php echo e($warehouse->id); ?>"
                            >
                                <?php echo e($warehouse->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="invoice_type">نوع الفاتورة</label>
                    <select name="invoice_type" class="form-control" id="invoice_type">
                        <option value="">اختر نوع الفاتورة</option>
                        <option
                            <?php echo e((isset($offer) && $offer->invoice_type === 'cache') ? 'selected' : ''); ?>

                            value="cache"
                        >
                            فاتورة بيع نقديه
                        </option>
                        <option
                            <?php echo e((isset($offer) && $offer->invoice_type === 'deferred') ? 'selected' : ''); ?>

                            value="deferred"
                        >
                            فاتورة بيع اجله
                        </option>
                    </select>
                    <input
                        value="<?php echo e((isset($offer) && $offer->invoice_type === 'deferred' && $offer->down_payment !== null) ? $offer->down_payment : ''); ?>"
                        style="<?php echo e((isset($offer) && $offer->invoice_type === 'deferred') ? 'display: block' : 'display: none'); ?>"
                        placeholder="ادخل الدفعه المقدمه"
                        class="form-control mt-2"
                        name="down_payment"
                        id="down_payment"
                        type="text"
                        <?php echo e(isset($offer) && $offer->invoice_type === 'deferred' ? 'required' : ''); ?>

                    />
                    <?php if( isset($edit, $offer) && $offer->invoice_type === 'deferred' && $offer->down_payment !== null && $offer->total_money !== null ): ?>
                        <p>
                            <a
                                href="<?php echo e(route('sanadat.create')); ?>?type=1&client=<?php echo e($offer->customer_id); ?>&box=<?php echo e($offer->box_id); ?>&sell=<?php echo e($offer->id); ?>"
                                style="color: #961d1d;font-weight: bold"
                                target="_blank"
                            >
                                <span>المبلغ المتبقي : </span>
                                <span><?php echo e(str_replace(',', '', $offer->total_money) - $offer->sand()->sum('cost')); ?></span>
                            </a>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">ملاحظات</label>
                    <textarea name="notes" id="" class="form-control"><?php echo e((isset($offer)) ? $offer->notes : ''); ?></textarea>
                </div>
            </div>
        </div>

        <?php
            if( isset($edit) ) {
                $quantities = $offer_products_quantities;
                $addon_disc = $offer->addon_disc;
                $discounts  = $offer_products_discounts;
                $prices     = $offer_products_prices;
                $taxes      = $offer_products_taxes;
                $items      = $offer_products;
            }
            if( isset($del_products_ids) && count($del_products_ids) > 0 ) {
                $quantities   = $delivery_quantities;
                $addon_disc   = '';
                $fillarray    = array_fill(0, count($del_products_ids), 0);
                $discounts    = $fillarray;
                $prices       = $fillarray;
                $items        = $delivery_products_ids;
                $taxes        = $fillarray;
                $edit         = true;
            }
        ?>
        <?php echo $__env->make('admin.layouts.product_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <input type="hidden" value="0" name="prstatus" id="prstatus">
        <div class="col-md-12">
            <hr>
            <div class="clear">
                <button type="submit" class="btn btn-success">
                    <i class="icon-check2"></i>
                    <?php echo e(trans('admin.save')); ?>

                </button>
                <button type="submit" class="btn btn-success" id="submitprint">
                    <i class="icon-check2"></i> حفظ وطباعه
                </button>
                <?php if((isset($offer) && $offer->main_type === 2 && $offer->type === 2) || request()->get('main_type') === '2'): ?>
                    <a href="<?php echo e(route('admin.sellsmnt.index')); ?>?main_type=2" class="btn btn-danger">
                        <i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

                    </a>
                <?php elseif((isset($offer) && $offer->type === 2) || request()->get('main_type') === '1'): ?>
                    <a href="<?php echo e(route('admin.sellsmnt.index')); ?>?main_type=1" class="btn btn-danger">
                        <i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

                    </a>
                <?php elseif((isset($offer) && $offer->type === 3) || request()->get('main_type') === '3'): ?>
                    <a href="<?php echo e(route('admin.sellsint.index')); ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

                    </a>
                <?php elseif((isset($offer) && $offer->type === 4) || request()->get('main_type') === '4'): ?>
                    <a href="<?php echo e(route('admin.sellsmnt.index')); ?>?main_type=4" class="btn btn-danger">
                        <i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

                    </a>
                <?php elseif((isset($offer) && $offer->type === 5) || request()->get('main_type') === '5'): ?>
                    <a href="<?php echo e(route('admin.sellsmnt.index')); ?>?main_type=5" class="btn btn-danger">
                        <i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('sells.index')); ?>" class="btn btn-danger">
                        <i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('admin.layouts.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script>
        $('#invoice_type').on('click', function () {
            var invoiceType = $(this).val();
            if(invoiceType === 'deferred') {
                $('#down_payment').prop('required', true).fadeIn(300);
            } else {
                $('#down_payment').prop('required', false).fadeOut(300);
            }
        })
    </script>
<?php $__env->appendSection(); ?>

<?php echo $__env->make('admin.layouts.style.form_style', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
