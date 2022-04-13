<?php $__env->startSection('title'); ?> فاتوره بيع <?php $__env->stopSection(); ?>
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
                فاتوره بيع <?php echo e($offer->type == 2 ? 'طلب ورشه' : ''); ?>

                <?php if(in_array(auth()->id(), [1, 7, 9])): ?>
                    <a href="<?php echo e(route('sells.edit',$offer->id)); ?>?m=<?php echo e($offer->maintenance_id); ?>&main_type=<?php echo e($offer->main_type ?? 1); ?>&invoice_num=<?php echo e(request('invoice_num')); ?>" class="editbtu"
                       target="_blank"> - تعديل </a>
                <?php endif; ?>
            </h3>
        </div>
    </div>
    <div class="row no-gutters" style="border-bottom: 1px solid #ccc;">
        <div class="col-md-3">

            <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                <div class="d-flex">
                    <span class="about_prop">الشركة :</span>
                    <span class="about_value"><?php echo e($customer->name); ?></span>
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
                    <span class="about_value"><?php echo e($customer->resp_name); ?></span>
                </div>
            </div>

            <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                <div class="d-flex">
                    <span class="about_prop">رقم الجوال :</span>
                    <span class="about_value en-font"><?php echo e($customer->resp_phone); ?></span>
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
                    <span
                        class="about_value en-font"><?php echo e($customer->dreb_number != '' ? $customer->dreb_number : 'لا يوجد'); ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-6 m-auto" style="margin-top:5px !important;margin-bottom:5px !important; ">
        <!-- <p class ="en-font" style="text-align: center; font-size: 12px; word-wrap: break-word; width: 70%; margin: auto; font-weight: 600;"><?php echo e($qrcode_string); ?></p>-->

            <div class="row no-gutters  text-center">

                <a target="_blank" class="m-auto" href="<?php echo e(route("qrcode.view")); ?>?<?php echo e($qr_data); ?>">
                    <img width="130" height="130" src="<?php echo e($qrcode_img); ?>" alt=""
                         class="img-fluid m-auto">
                </a>
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
                        <span class="about_prop">رقم الفاتوره/ </span>
                    </div>
                    <div class="row no-gutters" style="border: 1px solid #ccc;">
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
                        <span class="about_value en-font"><?php echo e($offer->code . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT)); ?></span>
                    </div>
                    <div class="row no-gutters " style="border: 1px solid #ccc; border-right: 0; ">
                        <span class="about_value en-font"><?php echo e($customer->code); ?></span>
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