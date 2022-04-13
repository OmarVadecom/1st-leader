<?php $__env->startSection('title'); ?> أمر تحضير <?php $__env->stopSection(); ?>
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
                    أمر تحضير
                </h3>
            </div>
        </div>
        <div class="row no-gutters" style="border-bottom: 1px solid #ccc;">
            <div class="col-md-3">
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0;">
                    <div class="d-flex">
                        <span class="about_prop">التاريخ :</span>
                        <span class="about_value"><?php echo e(date('d-m-Y',strtotime($prepare->created_at))); ?></span>
                    </div>
                </div>

                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">الوقت :</span>
                        <span class="about_value"><?php echo e(date('H:i',strtotime($prepare->created_at))); ?></span>
                    </div>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
                    <div class="d-flex">
                        <span class="about_prop">حاله التحضير :</span>
                        <span class="about_value"><?php echo $prepare->preparestatus; ?></span>
                    </div>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc;">
                    <div class="d-flex">
                        <span class="about_prop">رقم امر التحضير :</span>
                        <span class="about_value"><?php echo e($prepare->code); ?></span>
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
                            <span class="about_prop">البائع/</span>
                        </div>
                        <div class="row no-gutters">
                            <span class="about_prop">&nbsp;</span>
                        </div>
                        <div class="row no-gutters">
                            <span class="about_prop">&nbsp;</span>
                        </div>
                        <div class="row no-gutters">
                            <span class="about_prop">&nbsp;</span>
                        </div>
                        <div class="row no-gutters">
                            <span class="about_prop">&nbsp;</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row no-gutters" style="border: 1px solid #ccc; border-top: 0; border-right: 0; ">
                            <span class=" about_value "><?php echo e($prepare->representative_name); ?></span>/
                        </div>
                        <div class="row no-gutters " style=" ">
                            <span class="about_value ">&nbsp;</span>/
                        </div>
                        <div class="row no-gutters " style="">
                            <span class="about_value ">&nbsp;</span>/
                        </div>
                        <div class="row no-gutters " style="">
                            <span class="about_value ">&nbsp;</span>/
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
            <div class="col-md-2 ">
                <div class="row no-gutters "
                    style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class="about_prop "> رقم الصنف:</span>
                </div>
            </div>
            <div class="col-md-4 ">
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
            <div class="col-md-1 ">
                <div class="row no-gutters "
                    style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class="about_prop "> اسم المحضر:</span>
                </div>
            </div>
            <div class="col-md-2 ">
                <div class="row no-gutters "
                    style="border: 1px solid #ccc; border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class="about_prop "> الصوره:</span>
                </div>
            </div>
        </div>
        <?php
        $totalquantity=0;
        ?>
        <?php $__currentLoopData = $prepare->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
            <div class="col-md-2">
                <div class="row no-gutters " style="border: 1px solid #ccc;  border-right: 0;height: 100%; ">
                    <span class="about_value "><?php echo e($product->product->code); ?></span>
                    <br>
                    <br>
                </div>

            </div>
            <div class="col-md-4">
                <div class="row no-gutters " style="border: 1px solid #ccc;  border-right: 0; height: 100%; ">
                    <span class="about_value "><?php echo e($product->product->name); ?> | <?php echo e($product->product->name_en); ?> </span>
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
            <div class="col-md-1">
                <div class="row no-gutters " style="border: 1px solid #ccc;  border-right: 0; height: 100%; ">
                    <span class="about_value "><?php echo e($prepare->preparator_name); ?></span>
                    <br>
                    <br>
                </div>
            </div>
            <div class="col-md-2">
                <div class="row no-gutters " style="border: 1px solid #ccc;  0px; border-right: 0; height: 100%;">
                    <span class="about_value "><img src="<?php echo e(url('/')); ?>/uploads/products-attachments/<?php echo e($product->product->image); ?>"
                            style="width:100px;"></span>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="row no-gutters ">
            <div class="col-md-9 buyer-data">
                
            </div>
            <div class="col-md-1">
                <div class="row no-gutters " style="border: 1px solid #ccc;">
                    <span class="about_prop " style="font-size: 1.5rem; "> الكميه الاجمالية:</span>
                </div>
            </div>
            <div class="col-md-2 ">
                <div class="row no-gutters " style="border: 1px solid #ccc;">
                    <span class="about_value" style="font-size: 1.5rem;"><?php echo e($totalquantity); ?></span>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row no-gutters">
            <div class="col-md-5">
                <div class="row no-gutters " style="display: table; margin: 0 auto;">
                    <span class="about_prop ">أمين المستودع</span>
                </div>
                <br><br><br><br><br><br>

            </div>
            <div class="col-md-2">
                <div class="row no-gutters " style="">
                    <span class="about_value">&nbsp;</span>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row no-gutters " style="display: table; margin: 0 auto;">
                    <span class="about_prop ">المحضر</span>
                </div>
                <br><br><br><br><br><br>

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