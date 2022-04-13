<?php $__env->startSection('title'); ?> أمر نقل <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="main my-5">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-3">
                <div class="row no-gutters">
                    <h3 class="header-3 p-0">
                        الرقم الضريبي / <?php echo e(getSettings('site_vat')); ?>

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
                    أمر نقل
                </h3>
            </div>
        </div>
        <div class="row no-gutters" style="border-bottom: 1px solid #ccc;">
            <div class="col-md-3">
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0;">
                    <div class="d-flex">
                        <span class="about_prop">التاريخ :</span>
                        <span class="about_value en-font"><?php echo e(date('d-m-Y',strtotime($delivery->created_at))); ?></span>
                    </div>
                </div>

                <div class="row no-gutters" style="border: 1px solid #ccc;">
                    <div class="d-flex">
                        <span class="about_prop">الوقت :</span>
                        <span class="about_value en-font"><?php echo e(date('H:i',strtotime($delivery->created_at))); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 m-auto">
                <div class="row no-gutters  text-center">
                    <img width="150" height="200" src="<?php echo e(asset('panel/app-assets/images/barcode.png')); ?>" alt=""
                        class="img-fluid m-auto">
                </div>
            </div>
            <div class="col-md-3">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <div class="row no-gutters" style="border: 1px solid #ccc; border-top: 0;">
                            <span class="about_prop">رقم امر النقل/</span>
                        </div>
                        <div class="row no-gutters" style="border: 1px solid #ccc; border-top: 0;">
                            <span class="about_prop">عدد المنتجات/</span>
                        </div>

                        <div class="row no-gutters">
                            <span class="about_prop">&nbsp;</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row no-gutters" style="border: 1px solid #ccc; border-top: 0; border-right: 0; ">
                            <span class=" about_value en-font"><?php echo e($delivery->code); ?></span>/
                        </div>
                        <div class="row no-gutters" style="border: 1px solid #ccc; border-top: 0; border-right: 0; ">
                            <span class=" about_value "><?php echo e(count($transproducts)); ?></span>/
                        </div>
                        <div class="row no-gutters " style="">
                            <span class="about_value ">&nbsp;</span>/
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>م</th>
                    <th>رقم الصنف</th>
                    <th width="20%">البيان</th>
                    <th>الكمية</th>
                    <th>من مستودع</th>
                    <th>الي مستودع</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $transproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($product)): ?>
                <tr>
                    <td class="en-font"><?php echo e($key+1); ?></td>
                    <td class="en-font"><?php echo e($product->product->code); ?></td>
                    <td><?php echo e($product->product->name); ?> <br> <span class="en-font"><?php echo e($product->product->name_en); ?></span>
                    </td>
                    <td class="en-font"><?php echo e(-1 * $product->quantity); ?></td>
                    <td class="en-font"><?php echo e($product->warehouse->name); ?></td>
                    <td class="en-font"><?php echo e($product->warehouseto->name); ?> </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tfoot>
                <tr>
                    <td id="spacer"></td>
                </tr>
            </tfoot>
            </tbody>

        </table>
        <br><br>
        <div class="row no-gutters">
            <div class="col-md-5">
                <div class="row no-gutters " style="display: table; margin: 0 auto;">
                    <span class="about_prop ">اسم المسلم</span>
                </div>
                <br><br><br><br><br><br><br><br>

            </div>
            <div class="col-md-2">
                <div class="row no-gutters " style="">
                    <span class="about_value">&nbsp;</span>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row no-gutters " style="display: table; margin: 0 auto;">
                    <span class="about_prop ">هاشم أسكندر</span>
                </div>
                <br><br><br><br><br><br><br><br>

            </div>
        </div>

        <div class="row no-gutters" style="border-bottom: 1px solid #ccc;">
            <div class="col-md-3">
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">الموصل :</span>
                        <span class="about_value"><?php echo e($delivery->deliverer_name); ?></span>
                    </div>
                </div>

                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
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
                        <span class="about_value"><?php echo e($delivery->reciept_street); ?> - <?php echo e($delivery->reciept_region); ?></span>
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