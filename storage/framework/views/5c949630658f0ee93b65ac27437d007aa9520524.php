<?php $__env->startSection('title'); ?> أمر تسليم <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="main my-5">
    <div class="container">
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
                    أمر تسليم
                    <?php echo e($delivery->maintenance_id ? 'طلب صيانه' :''); ?>

                </h3>
            </div>
        </div>
        <div class="row no-gutters" style="border-bottom: 1px solid #ccc;">
            <div class="col-md-3">
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">الشركة :</span>
                        <span class="about_value"><?php echo e($delivery->customer->name); ?></span>
                    </div>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">العنوان :</span>
                        <span
                            class="about_value"><?php echo e($delivery->customer->region); ?>-<?php echo e($delivery->customer->street); ?></span>
                    </div>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">السيد :</span>
                        <span class="about_value"><?php echo e($delivery->customer->resp_name); ?></span>
                    </div>
                </div>

                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">رقم الهاتف :</span>
                        <span class="about_value en-font"><?php echo e($delivery->customer->resp_phone); ?></span>
                    </div>
                </div>
                <?php if($delivery->customer->resp_email != ""): ?>

                    <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                        <div class="d-flex">
                            <span class="about_prop">ايميل :</span>
                            <span class="about_value"><?php echo e($delivery->customer->resp_email); ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-6 m-auto">
                <div class="row no-gutters  text-center">
                    <img width="150" height="200"
                        src="<?php echo e(asset('panel/app-assets/images/barcode.png')); ?>" alt=""
                        class="img-fluid m-auto">
                </div>
            </div>
            <div class="col-md-3">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <div class="row no-gutters" style="border: 1px solid #ccc; border-top: 0;">
                            <span class="about_prop">التاريخ/</span>
                        </div>
                        <div class="row no-gutters" style="border: 1px solid #ccc; border-top: 0;">
                            <span class="about_prop">الوقت/</span>
                        </div>
                        <div class="row no-gutters" style="border: 1px solid #ccc; border-top: 0;">
                            <span class="about_prop">رقم التسليم/</span>
                        </div>
                        <div class="row no-gutters" style="border: 1px solid #ccc; border-top: 0;">
                            <span class="about_prop">رقم الحساب/</span>
                        </div>

                        <div class="row no-gutters">
                            <span class="about_prop">&nbsp;</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row no-gutters" style="border: 1px solid #ccc; border-top: 0; border-right: 0; ">
                            <span
                                class=" about_value en-font"><?php echo e(date('d-m-Y',strtotime($delivery->created_at))); ?></span>/
                        </div>
                        <div class="row no-gutters" style="border: 1px solid #ccc; border-top: 0; border-right: 0; ">
                            <span
                                class=" about_value en-font"><?php echo e(date('H:i',strtotime($delivery->created_at))); ?></span>/
                        </div>
                        <div class="row no-gutters" style="border: 1px solid #ccc; border-top: 0; border-right: 0; ">
                            <span class=" about_value en-font"><?php echo e($delivery->code); ?></span>/
                        </div>
                        <div class="row no-gutters" style="border: 1px solid #ccc; border-top: 0; border-right: 0; ">
                            <span class=" about_value en-font"><?php echo e($delivery->customer->id); ?></span>/
                        </div>
                        <div class="row no-gutters " style="">
                            <span class="about_value ">&nbsp;</span>/
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row no-gutters product-table ">
            <div class="col-md-1 ">
                <div class="row no-gutters " style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0; ">
                    <span class="about_prop "> م:</span>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="row no-gutters "
                    style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class="about_prop "> رقم الصنف:</span>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="row no-gutters "
                    style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class="about_prop "> البيان:</span>
                </div>
            </div>
            <div class="col-md-1 ">
                <div class="row no-gutters "
                    style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class="about_prop "> الوحدة:</span>
                </div>
            </div>
            <div class="col-md-1 ">
                <div class="row no-gutters "
                    style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class="about_prop "> الكمية:</span>
                </div>
            </div>
        </div>
        <?php
            $totalquantity=0;
        ?>
        <?php $__currentLoopData = $delivery->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $totalquantity +=$product->quantity;
            ?>
            <div class="row no-gutters product-value">
                <div class="col-md-1">
                    <div class="row no-gutters " style="border: 1px solid #ccc;height: 100%; ">
                        <span class="about_value "><?php echo e($key); ?></span>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row no-gutters " style="border: 1px solid #ccc;  border-right: 0;height: 100%; ">
                        <span class="about_value "><?php echo e($product->product->code); ?></span>
                        <br>
                        <br>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="row no-gutters " style="border: 1px solid #ccc;  border-right: 0; height: 100%; ">
                        <span class="about_value "><?php echo e($product->product->name); ?> |
                            <?php echo e($product->product->name_en); ?></span>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="row no-gutters " style="border: 1px solid #ccc;  border-right: 0; height: 100%; ">
                        <span class="about_value "><?php echo e($product->product->unit_1); ?></span>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="row no-gutters " style="border: 1px solid #ccc;  border-right: 0; height: 100%;">
                        <span class="about_value "><?php echo e($product->quantity); ?></span>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="row no-gutters ">
            <div class="col-md-10 buyer-data">
                
            </div>
            <div class="col-md-1">
                <div class="row no-gutters " style="border: 1px solid #ccc;">
                    <span class="about_prop " style="font-size: 1.5rem; "> الكميه الاجمالية:</span>
                </div>
            </div>
            <div class="col-md-1 ">
                <div class="row no-gutters " style="border: 1px solid #ccc;">
                    <span class="about_value" style="font-size: 1.5rem; margin: 0 auto;"><?php echo e($totalquantity); ?></span>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row no-gutters" style="border-bottom: 1px solid #ccc;">
            <div class="col-md-3">
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">الموصل :</span>
                        <span class="about_value"><?php echo e($delivery->deliverer_name); ?></span>
                    </div>
                </div>

                <div class="row no-gutters" style="border: 1px solid #ccc;">
                    <div class="d-flex">
                        <span class="about_prop">رقم الهاتف :</span>
                        <span class="about_value"><?php echo e($delivery->deliverer_phone_number); ?></span>
                    </div>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">رقم الهويه :</span>
                        <span class="about_value"><?php echo e($delivery->deliverer_identity); ?></span>
                    </div>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">رقم اللوحه :</span>
                        <span class="about_value"><?php echo e($delivery->delivery_car_num); ?></span>
                    </div>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">التوقيع :</span>
                        <span class="about_value"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-5 m-auto">
            </div>
            <div class="col-md-4">
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px; ">
                    <div class="d-flex">
                        <span class="about_prop">المستلم :</span>
                        <span class="about_value"><?php echo e($delivery->recipient_name); ?></span>
                    </div>
                </div>

                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">رقم الهاتف :</span>
                        <span class="about_value"><?php echo e($delivery->recipient_phone_number); ?></span>
                    </div>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">المدينه :</span>
                        <span class="about_value"><?php echo e($delivery->reciept_city); ?></span>
                    </div>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">العنوان :</span>
                        <span class="about_value"><?php echo e($delivery->reciept_street); ?> -
                            <?php echo e($delivery->reciept_region); ?></span>
                    </div>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">التوقيع :</span>
                        <span class="about_value"></span>
                    </div>
                </div>
            </div>


    </div>

    <div class="row no-gutters" style="margin: 70px 0 30px;">
        <div class="col-md-3" style="border: 1px solid #ccc;padding: 5px 3px 5px 0;">
            <span class="about_prop">اسم المسلم</span>
        </div>
        <div class="col-md-5"></div>
        <div class="col-md-4" style="border: 1px solid #ccc;padding: 5px 3px 5px 0;"></div>
    </div>

    <style>
        .product-table span,
        .product-value span {
            display: table;
            margin: 0 auto !important;
        }

    </style>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make($pLayout. 'masterinv', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>