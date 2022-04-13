<div class="col-md-12">
    <table id="added_products_table" class="table table-striped" style="text-align:center">
        <thead>
            <tr>
                <th>رقم المادة</th>
                <th>الماده</th>
                <th style="width:7%;">الكميه</th>
                <th style="width:9%;"> السعر</th>
                <th>الاجمالي</th>
                <th style="width:8%;">الخصم</th>
                <th>الاجمالي قبل الضريبه</th>
                <th style="width:8%;">الضريبه</th>
                <th>الاجمالي بعد الضريبه</th>
            </tr>
        </thead>
        <tbody id="table_body" class="productsadd">
            <?php if(isset($edit)): ?>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(isset($item)): ?>
            <tr><input type="hidden" name="product[]" value="<?php echo e($item->id); ?>">
                <input type="hidden" name="product_code_type[]" value="<?php echo e(isset($item->code_type) ? $item->code_type : ''); ?>">
                <td><?php echo e($item->code); ?></td>
                <td> <?php echo e($item->name); ?></td>
                <td><input type="number" value="<?php echo e($quantities[$k]); ?>" data-number="<?php echo e($k); ?>" placeholder="الكميه" min="1"
                        class="quantities form-control productquantity quantity<?php echo e($k); ?>" name="quantity[]">
                </td>
                <td><input type="number" value="<?php echo e(round($prices[$k],2)); ?>" data-number="<?php echo e($k); ?>" step="any"
                        placeholder="السعر" min="1" class="prices form-control productprice price<?php echo e($k); ?>" name="price[]">
                </td>
                <td class="totals totalfir<?php echo e($k); ?>">
                    <?php echo e(round($prices[$k]*$quantities[$k],2)); ?></td>
                <td><input type="number" value="<?php echo e($discounts[$k]); ?>" data-number="<?php echo e($k); ?>" placeholder="الخصم %" min="0"
                        class="form-control productdiscount discounts discount<?php echo e($k); ?>" style="width:85%"
                        name="discount[]"><span style="float: left; margin-top: -32px;">%</span> </td>
                <td class="totals totalsdisc totaldisc<?php echo e($k); ?>">
                    <?php $discount=$prices[$k] * $quantities[$k] * $discounts[$k]/100;
                    $total_after_disc=$prices[$k] * $quantities[$k] - $discount;
                    ?>
                    <?php echo e(round( $total_after_disc,2)); ?>

                </td>
                <td><input type="number" value="<?php echo e($taxes[$k]); ?>" data-number="<?php echo e($k); ?>" placeholder="الضريبه" min="0"
                        class="prices form-control productdreba dareba<?php echo e($k); ?>" name="darebadis[]" style="width:85%"
                        disabled> <input type="hidden" name="dareba[]" value="<?php echo e($taxes[$k]); ?>" id=""><span
                        style="float: left; margin-top: -32px;">%</span> </td>
                <?php $dreba=$total_after_disc * $taxes[$k]/100; ?>
                <td class="totals total<?php echo e($k); ?>"><input id="total_input" type="number" step="any" data-number="<?php echo e($k); ?>"
                        name="totals[]" value="<?php echo e(round($total_after_disc + $dreba,2)); ?>"
                        class="totalinp<?php echo e($k); ?> form-control totalinp">
                </td>
                <td><i data-rownumber="<?php echo e($k); ?>" class="fa fa-times clickremrow"></i> </td>
            </tr>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </tbody>
    </table>
    <table class="table table-striped" style="text-align:center">
        <tbody>
            <tr>
                <td colspan="7" style="width: 70%;"></td>
                <td colspan="2">الاجمالي</td>
                <td colspan="1" class="totalmo">0</td>

            </tr>
            <tr>
                <td colspan="6"></td>
                <td colspan="3">خصم اضافي</td>
                <td colspan="1"><input type="text" value="<?php echo e(isset($edit) || isset($priceOffer) ? $addon_disc : 0); ?>"
                        style="text-align: center;" class="form-control totdisc"><input
                        value="<?php echo e(isset($edit) ? $addon_disc : 0); ?>" type="hidden" name="addon_disc" class="totdiscinp">
                </td>

            </tr>
            <tr>
                <td colspan="7" style="width: 70%;"></td>
                <td colspan="2"> الاجمالي بعد الخصم و الضريبه</td>
                <td colspan="1" class="totalmoafter">0</td>
                <input type="hidden" name="totalafterdisc" class="totalmoinp">
            </tr>
        </tbody>
    </table>

    <?php if(!isset($delivery)): ?>
    <?php echo $__env->make('admin.product_search.product_search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
</div>
