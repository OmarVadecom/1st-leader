<table class="table table-bordered">

    <thead>
        <tr>
            <th>م</th>
            <th>رقم الصنف</th>
            <th>البيان</th>
            <?php if(isset($show_img)): ?>
            <th> المنشأ</th>
            <th> الصناعه</th>
            <?php endif; ?>
            <th>الكمية</th>
            <th>السعر </th>
            <th>الخصم</th>
            <th>الاجمالي قبل الضريبه</th>
            <th>الضريبه <?php echo e(getSettings('site_vat_value')); ?>%</th>
            <th>السعر بعد الضريبه</th>
            <th>الاجمالي</th>
            <?php if(isset($show_img)): ?>
            <th>الصوره</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $total=0;
        $total_discount=0;
        $total_vat=0;
        $total_quantitiy_price=0;
        $total_before_vat=0;
        $addon_disc_general=0;
        $colspan=7;
        if(isset($show_img)){
            $colspan=10;
        }
        ?>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($product)): ?>
        <?php
        $subtotal=round($quantities[$key] * $prices[$key],2);
        $total_quantitiy_price+=$subtotal;
        $totalsecond=$subtotal*($discounts[$key]/100);
        $total_discount+=$totalsecond;
        $totalbeforevat=$subtotal-$totalsecond;
        $total_before_vat+=$totalbeforevat;
        $totalvatval=$totalbeforevat*(getSettings('site_vat_value')/100);
        $total_vat+=$totalvatval;
        $totalvat=round($totalbeforevat+$totalvatval,2);
        $total +=$totalvat;
        ?>
        <tr>
            <td class="en-font"><?php echo e($key+1); ?></td>
            <td class="en-font"><?php echo e($product->code); ?></td>
            <td><?php echo e($product->name); ?> | <span class="en-font"><?php echo e($product->name_en); ?></span></td>
            <?php if(isset($show_img)): ?>
            <td class="en-font"><img class="icoimg" style="width: 30px;"
                    src="<?php echo e((isset($product->brand) ? url('/').'/uploads/brands_images/'.$product->brand->image : '')); ?>"
                    alt=""></td>
            <td class="en-font"><img class="icoimg" style="width: 30px;"
                    src="<?php echo e((isset($product->origin) ? url('/').'/uploads/countries/'.$product->origin->image : '')); ?>"
                    alt=""></td>
            <?php endif; ?>
            <td class="en-font"><?php echo e($quantities[$key]); ?></td>
            <td class="en-font"><?php echo e($prices[$key]); ?></td>
            <td class="en-font">(<?php echo e($discounts[$key]); ?>%) <?php echo e($totalsecond); ?></td>
            <td class="en-font"><?php echo e($subtotal); ?></td>

            <td class="en-font"><?php echo e(round($totalvatval,2)); ?></td>
            <td class="en-font"><?php echo e($totalvat); ?></td>
            <td class="en-font"><?php echo e($totalvat); ?></td>
            <?php if(isset($show_img)): ?>
            <td>
                <?php if(isset($product->code_type)): ?>
                <img src="<?php echo e(url('/')); ?>/uploads/parts-attachments/<?php echo e($product->image); ?>" style="width:80px;">
                <?php else: ?>
                <img src="<?php echo e(url('/')); ?>/uploads/products-attachments/<?php echo e($product->image); ?>" style="width:80px;">
                <?php endif; ?>
            </td>
            <?php endif; ?>
        </tr>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td colspan="<?php echo e($colspan); ?>"></td>
            <td colspan="2"> الصافي:</td>
            <td class="en-font"><?php echo e($total_quantitiy_price); ?></td>
        </tr>
        <tr>
            <td colspan="<?php echo e($colspan); ?>"></td>
            <td colspan="2"> الخصم:</td>
            <td class="en-font"><?php echo e(number_format(round($total_discount,2))); ?></td>
        </tr>
        <?php if(isset($addon_disc) && $addon_disc != "" && $addon_disc != 0): ?>
        <tr>
            <td colspan="<?php echo e($colspan); ?>"></td>
            <td colspan="2"> الخصم الاضافي:</td>
            <td class="en-font"><?php echo e($addon_disc); ?></td>
        </tr>
        <?php endif; ?>
        <?php
        if(isset($addon_disc) && $addon_disc != "" && $addon_disc != 0){
        $total_before_vat=$total_before_vat-$addon_disc;
        $total_vat=$total_before_vat*(getSettings('site_vat_value')/100);
        $total=$total_before_vat+$total_vat;
        }
        ?>
        <tr>
            <td colspan="<?php echo e($colspan); ?>"></td>
            <td colspan="2"> الاجمالي قبل الضريبه:</td>
            <td class="en-font"><?php echo e(number_format(round($total_before_vat,2))); ?></td>
        </tr>

        <tr>
            <td colspan="<?php echo e($colspan); ?>"></td>
            <td colspan="2"> الضريبه <?php echo e(getSettings('site_vat_value')); ?>%:</td>
            <td class="en-font"><?php echo e(round($total_vat,2)); ?></td>
        </tr>

        <tr>
            <td colspan="<?php echo e($colspan); ?>"></td>
            <td colspan="2"> القيمة الاجمالية:</td>
            <td class="en-font"><?php echo e(number_format(round($total,2))); ?></td>
        </tr>
        <tr>
            <td colspan="2"><?php echo e($sell_show ? 'البائع' : 'المورد'); ?></td>
            <td colspan="<?php echo e($colspan+1); ?>"></td>
        </tr>
    <tfoot>
        <tr>
            <td id="spacer"></td>
        </tr>
    </tfoot>
    </tbody>

</table>
<style>
    .product-table span,
    .product-value span {
        display: table;
        margin: 0 auto !important;
    }

    .about_value {
        height: 100%;
    }

    th,
    td {
        font-size: 16px;
        font-weight: bold;
        text-align: center;
    }
</style>
