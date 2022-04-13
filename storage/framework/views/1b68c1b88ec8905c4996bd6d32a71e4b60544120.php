<?php $__env->startSection('title'); ?>
    <?php if( $sanad->type === 1 ): ?>
        سند قبض
    <?php else: ?>
        سند صرف
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-md-12 text-center">
        <h3 class="header-3">
        الرقم الضريبي: <span class="en-font"><?php echo e(getSettings('site_vat')); ?></span>
        </h3>
    </div>
    <div class="container text-center" style="font-size: 20px;margin: 40px 0">
        <div class="row" style="width: 30%;margin: 30px auto 0">
            <div class="col-md-12 d-flex">
                <p class="p-0" style="margin: 0 0 0 5px">
                    <?php if( $sanad->type === 1 ): ?>
                        سند قبض
                    <?php else: ?>
                        سند صرف
                    <?php endif; ?>
                </p>
                /
                <p class="p-0" style="margin: 0 50px 0 0">
                    <?php echo e($sanad->gettype()); ?>

                </p>
            </div>
        </div>
        <div class="row" style="width: 95%;margin: 30px auto 0">
            <div class="col-md-6">
                <p style="margin-right: -60px;">
                    رقم السند :
                    <span class="en-font" style="font-size: 15px">
                        <?php echo e($sanad->code); ?>

                    </span>
                </p>
                <p>
                    تاريخ السند :
                    <span class="en-font" style="font-size: 15px;">
                        <?php if(isset($sanad) && $sanad->time !== null): ?>
                            <?php echo e($sanad->time); ?> /
                        <?php endif; ?>
                        <?php echo e($sanad->date); ?>

                    </span>
                </p>
            </div>
            <div class="col-md-6">
                <p>
                    رقم الحساب :
                    <span class="en-font" style="font-size: 15px;">
                        <?php echo e($sanad->box->code); ?>

                    </span>
                </p>
                <p>
                    اسم الحساب :
                    <span style="font-size: 15px;font-weight: 600">
                        <?php echo e($sanad->box->name); ?>

                    </span>
                </p>
            </div>
        </div>
        <div class="row" style="width: 69%;margin: 35px auto;">
            <div class="col-md-3 pl-0">
                <p class="p-0 m-0">يصرف للسيد / للسيدة : </p>
            </div>
            <div class="col-md-7 pr-0 text-right"></div>
            <div class="col-md-2">
                <p class="p-0 m-0">المحترمين</p>
            </div>
        </div>
        <div class="row" style="width: 69%;margin: 35px auto;">
            <div class="col-md-2 pl-0 text-right">
                <p class="p-0 m-0">مبلغ وقدره : </p>
            </div>
            <div class="col-md-3 pr-0 text-right">
                <span class="en-font">
                    <?php echo e($sanad->cost); ?>

                </span>
            </div>
            <div class="col-md-7 text-left">
                <p class="p-0 m-0">
                    <?php echo e(arabic()->toWords($sanad->cost)); ?> ريال لا غير
                </p>
            </div>
        </div>
        <?php if( $sanad->type === 2 && $sanad->expense !== null ): ?>
            <div class="row" style="height: 30px;width: 69%;margin: auto;text-align: right">
                <div class="col-md-6">
                    <p>
                        وذلك مقابل :
                        <span>
                            <?php echo e($sanad->expense->name); ?>

                        </span>
                    </p>
                </div>
            </div>
        <?php endif; ?>
        <?php if( isset($sanad) && $sanad->ex_type === 2): ?>
            <div class="row" style="height: 30px;width: 69%;margin: auto;text-align: right">
                <div class="col-md-6">
                    <p>
                        مجموع الفواتير :
                        <span class="en-font" style="font-size: 15px;">3000</span>
                    </p>
                </div>
            </div>
            <div class="row" style="height: 30px;width: 69%;margin: auto;text-align: right">
                <div class="col-md-6">
                    <p>
                        الباقي :
                        <span class="en-font" style="font-size: 15px;">0</span>
                    </p>
                </div>
            </div>
            <div class="row" style="height: 30px;width: 69%;margin: auto;text-align: right">
            <div class="col-md-6">
                <p>
                    اقفال العهده :
                    <span style="font-size: 15px;"></span>
                </p>
            </div>
        </div>
        <?php endif; ?>
        <div class="row" style="width: 69%;margin: 20px auto;">
            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <?php if( isset($sanad) && $sanad->type === 1 && $sanad->cl_sup_id !== null && $sanad->acc_type === 'client' ): ?>
                                <th>رقم العميل</th>
                                <th>اسم العميل</th>
                            <?php endif; ?>
                            <th>العمله</th>
                            <th>البيان</th>
                            <th>المبلغ</th>
                            <th>تاريخ الاستحقاق</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php if( isset($sanad) && $sanad->type === 1 && $sanad->cl_sup_id !== null && $sanad->acc_type === 'client' ): ?>
                                <th class="en-font"><?php echo e($sanad->cl_sup_id); ?></th>
                                <th><?php echo e($sanad->client->name); ?></th>
                            <?php endif; ?>
                            <th>الريال</th>
                            <th><?php echo e($sanad->notes); ?></th>
                            <th class="en-font"><?php echo e($sanad->cost); ?></th>
                            <th class="en-font"><?php echo e($sanad->date); ?></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" style="width: 69%;margin: 60px auto 0;text-align: right;">
            <div class="col-md-4">
                <p>المستلم </p>
            </div>
            <div class="col-md-4">
                <p>المحاسب</p>
            </div>
            <div class="col-md-4">
                <p>المدير المالي</p>
            </div>
        </div>
        <div class="row" style="margin-top: 50px;text-align: left;padding-left: 100px;">
            <div class="col-md-9">
                <p>
                    التوقيع :
                </p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($pLayout. 'masterinv', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>