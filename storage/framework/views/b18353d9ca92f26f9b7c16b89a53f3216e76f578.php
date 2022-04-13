<div class="tab-pane fade" id="menu2">
    <div class="row pricesadd">

        <?php if(isset($prices)): ?>
            <?php $__currentLoopData = $prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-md-12">
                    <h5>سعر الوحده <?php echo e($index+1); ?></h5>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>السعر </label>
                            <?php echo Form::number("prices[]", $price, [
                            'class' => 'form-control',
                            'placeholder' => 'السعر',
                            ]); ?>

                        </div><!-- /.form-group -->
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>الخصم المتاح </label>
                            <?php echo Form::number("prices_discounts[]", $prices_discounts[$index], [
                            'class' => 'form-control',
                            'placeholder' => 'الخصم المتاح',
                            ]); ?>

                        </div><!-- /.form-group -->
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>الفئه المستهدفه</label>
                            <select name="prices_targets[]" class="form-control">
                                <option value="">اختر الفئه</option>
                                <option value="1"
                                    <?php echo e(($prices_targets[$index]==1) ? 'selected' : ''); ?>>
                                    العميل
                                </option>
                                <option value="2"
                                    <?php echo e(($prices_targets[$index]==2) ? 'selected' : ''); ?>>
                                    الشركات
                                </option>
                            </select>
                        </div><!-- /.form-group -->
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="col-md-12">
                <h5>سعر الوحده 1</h5>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>السعر </label>
                        <?php echo Form::number("prices[]", "", [
                        'class' => 'form-control',
                        'placeholder' => 'السعر',
                        ]); ?>

                    </div><!-- /.form-group -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>الخصم المتاح </label>
                        <?php echo Form::number("prices_discounts[]", "", [
                        'class' => 'form-control',
                        'placeholder' => 'الخصم المتاح',
                        ]); ?>

                    </div><!-- /.form-group -->
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>الفئه المستهدفه</label>
                        <select name="prices_targets[]" class="form-control">
                            <option value="">اختر الفئه</option>
                            <option value="1"> العميل
                            </option>
                            <option value="2"> الشركات
                            </option>
                        </select>
                    </div><!-- /.form-group -->
                </div>
            </div>
        <?php endif; ?>
    </div>
    <hr>
    <div class="row" style="background: #e6e6e6">
        <div class="col-md-12">
            <h5 style="padding-top: 10px; "> العروض</h5>
            <div class="col-md-6">
                <div
                    class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                    <label>خصم اضافي</label>
                    <?php echo Form::number("discount", isset($product) ? $product->discount : "", [
                    'class' => 'form-control',
                    'placeholder' => 'خصم اضافي',
                    ]); ?>

                </div><!-- /.form-group -->
            </div>


            <div class="col-md-6">
                <div
                    class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                    <label> الكميه</label>
                    <?php echo Form::number("discountquantity", isset($product) ? $product->discountquantity : "", [
                    'class' => 'form-control',
                    'placeholder' => 'الكميه ',
                    ]); ?>

                </div><!-- /.form-group -->
            </div>
        </div>
    </div>


</div>
