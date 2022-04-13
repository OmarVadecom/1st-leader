<?php $__env->startSection('title'); ?> عرض سعر <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<br><br>
<div class="row no-gutters">
    <div class="col-md-3">
        <div class="row no-gutters">
            <h3 class="header-3 p-0">
                الرقم الضريبي / <span class="en-font"> <?php echo e(getSettings('site_vat')); ?></span>
            </h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row no-gutters">
            <br>
            <br>
            <br>
        </div>
    </div>
    <div class="col-md-2">
        <div class="row no-gutters">
            <br>
            <br>
            <br>
        </div>
    </div>
    <div class="col-md-1">
        <div class="row no-gutters">
            <br>
            <br>
            <br>
        </div>
    </div>
    <div class="col-md-2">
        <div class="row no-gutters">
            <br>
            <br>
            <br>
        </div>
    </div>
    <div class="col-md-1">
        <div class="row no-gutters">
            <br>
            <br>
            <br>
        </div>
    </div>
</div>
<br>
<div class="row no-gutters">
    <div class="col-md-12 text-center" style="border: 1px solid #ccc">
        <h3 class="header-3">
            <?php if($offer->type==0): ?>
            <?php if($offer->status == 1): ?>
            عرض سعر مشتريات
            <?php elseif($offer->status == 2): ?>
            أمر شراء
            <?php elseif($offer->status == 3): ?>
            فاتوره شراء
            <?php else: ?>
            عرض سعر غير معمد
            <?php endif; ?>
            <?php else: ?>
            عرض سعر معمد
            <?php endif; ?>
        </h3>
    </div>
</div>
<div class="row no-gutters" style="border-bottom: 1px solid #ccc;">
    <?php if($offer->status != 0): ?>
    <div class="col-md-3">
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0;">
            <div class="d-flex">
                <span class="about_prop">السيد :</span>
                <span class="about_value"><?php echo e($offer->supplier != '' ? $offer->supplier : 'لا يوجد'); ?></span>
            </div>
        </div>

        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">الشركة :</span>
                <span class="about_value"><?php echo e($offer->supplier_comp != '' ? $offer->supplier_comp : 'لا يوجد'); ?></span>
            </div>
        </div>
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">العنوان :</span>
                <span class="about_value">لا يوجد</span>
            </div>
        </div>
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">ايميل :</span>
                <span class="about_value">لا يوجد</span>
            </div>
        </div>
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">رقم الهاتف :</span>
                <span class="about_value">لا يوجد</span>
            </div>
        </div>
    </div>


    <?php else: ?>
    <div class="col-md-3">
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;border-top: 0;">
            <div class="d-flex">
                <span class="about_prop">الشركة :</span>
                <span class="about_value"><?php echo e($customer->name != '' ? $customer->name : 'لا يوجد'); ?></span>
            </div>
        </div>
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">العنوان :</span>
                <span class="about_value"><?php echo e($customer->region); ?> - <?php echo e($customer->street); ?></span>
            </div>
        </div>
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">السيد :</span>
                <span class="about_value"><?php echo e($customer->resp_name != '' ? $customer->resp_name : 'لا يوجد'); ?></span>
            </div>
        </div>

        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">رقم الجوال :</span>
                <span class="about_value en-font"><?php echo e($customer->resp_phone != '' ? $customer->resp_phone : 'لا
                    يوجد'); ?></span>
            </div>
        </div>
        <?php if($customer->resp_email != ""): ?>
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">ايميل :</span>
                <span class="about_value"><?php echo e($customer->resp_email); ?></span>
            </div>
        </div>
        <?php endif; ?>
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop"> الرقم الضريبي :</span>
                <span class="about_value en-font"><?php echo e($customer->dreb_number != '' ? $customer->dreb_number : 'لا
                    يوجد'); ?></span>
            </div>
        </div>

    </div>
    <?php endif; ?>
    <div class="col-md-6 m-auto">
        <div class="row no-gutters  text-center">
            <img width="150" height="200" src="<?php echo e(asset('panel/app-assets/images/barcode.png')); ?>" alt=""
                class="img-fluid m-auto">
        </div>
    </div>
    <div class="col-md-3">
        <div class="row no-gutters">
            <div class="col-md-6">
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px; border-top: 0;">
                    <span class="about_prop">التاريخ/ </span>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px;">
                    <span class="about_prop">الوقت/ </span>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px;">
                    <span class="about_prop">مدة العرض/ </span>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px;">
                    <span class="about_prop">رقم العرض/ </span>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px;">
                    <span class="about_prop">رقم الحساب/</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row no-gutters"
                    style="border: 1px solid #ccc;border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class=" about_value en-font"><?php echo e($offer->date); ?></span>
                </div>
                <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
                    <span class="about_value en-font"><?php echo e($offer->time); ?></span>
                </div>
                <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
                    <span class="about_value "><?php echo e($offer->offer_duration); ?></span>
                </div>
                <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
                    <span class="about_value en-font">
                        <?php if($offer->status != 0): ?>
                        <?php
                        $id = str_pad($offer->id, 4, '0', STR_PAD_LEFT);
                        if($offer->status == 1){
                        echo 'PPO-'.$id;
                        }elseif ($offer->status == 2){
                        echo 'PO-'.$id;
                        }elseif ($offer->status == 3){
                        echo 'PUR-'.$id;
                        }
                        ?>
                        <?php else: ?>
                        <?php echo e($offer->code); ?>

                        <?php endif; ?>
                    </span>
                </div>
                <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
                    <span class="about_value en-font"><?php echo e(isset($customer) ? $customer->code : ''); ?></span>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
$sell_show=true;
$items=$allproducts;
$quantities=$quantities;
$prices=$prices;
$discounts=$discounts;
$addon_disc=$offer->addon_disc;
?>
<?php echo $__env->make('admin.layouts.show_product_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($pLayout. 'masterinv', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>