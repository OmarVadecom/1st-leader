<?php $__env->startSection('content'); ?>


    <div class="row home-linking">
        <div class="col-xl-2 col-lg-6 col-xs-12">
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">الاصناف
                </h4>
                <a style="font-size: 16px;" href="<?php echo e(route('product.index')); ?>">
                    المنتجات </a>
                <a style="font-size: 16px;" href="<?php echo e(route('parts.index')); ?>">قطع
                    الغيار </a>
            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">
                    المبيعات
                </h4>
                <a style="font-size: 16px;" href="<?php echo e(route('admin.sold_report.index')); ?>">
                    تم بيعه
                </a>
                <a style="font-size: 16px;" href="<?php echo e(route('admin.sells-of-day')); ?>">
                    تقرير المبيعات
                </a>
            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">
                    ادارة المحاسبه
                </h4>
                <a style="font-size: 16px;" href="<?php echo e(route('expense.index')); ?>">
                    بنود مصاريف
                </a>
                <a style="font-size: 16px;" href="<?php echo e(route('expensecategory.index')); ?>">
                    اقسام مصاريف
                </a>
                <a style="font-size: 16px;" href="<?php echo e(route('moneybox.index')); ?>">
                    الحسابات التفصيليه
                </a>
            </div>
        </div>

        <div class="col-xl-2 col-lg-6 col-xs-12">
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">المخزون </h4>
                <a style="font-size: 16px;" href="<?php echo e(route('warehouse.index')); ?>"> المستودعات
                </a>
                <a style="font-size: 16px;" href="<?php echo e(route('stock.index')); ?>">
                    المخزون </a>
                <?php if(Auth::user()->id == 1 || Auth::user()->id == 7 || Auth::user()->id == 9): ?>
                    <a style="font-size: 16px;" href="<?php echo e(route('supplies.index')); ?>">
                        بضاعه اول المده </a>
                <?php endif; ?>
                <?php if(Auth::user()->id == 1 || Auth::user()->id == 7 || Auth::user()->id == 9): ?>
                    <a style="font-size: 16px;" href="<?php echo e(route('transport.index')); ?>">
                        أوامر نقل بضاعه </a>
                <?php endif; ?>
            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">المتابعه </h4>
                <a style="font-size: 16px;" href="#">
                    المنتجات المحجوزة
                </a>
                <a style="font-size: 16px;" href="#">
                    المنتجات المتوفرة
                </a>
            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">السندات الماليه </h4>
                <a style="font-size: 16px;" href="<?php echo e(route('sanadat.index')); ?>?type=1">
                    سندات الصرف
                </a>
                <a style="font-size: 16px;" href="<?php echo e(route('sanadat.index')); ?>?type=2">
                    سندات القبض
                </a>
            </div>
        </div>

        <div class="col-xl-2 col-lg-6 col-xs-12">
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">ملخص الحركه</h4>
                <a style="font-size: 16px;" href="<?php echo e(route('admin.buy_report.index')); ?>">تم
                    شراءه </a>
            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">المشتريات</h4>
                <a style="font-size: 16px;" href="<?php echo e(route('purchases.index')); ?>?type=0">
                    المشتريات المحليه
                </a>
                <a style="font-size: 16px;" href="<?php echo e(route('purchases.index')); ?>?type=1">
                    المشتريات الدوليه
                </a>
            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">التحصيل</h4>
                <a style="font-size: 16px;" href="#">
                    قائمه الاوراق الماليه
                </a>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">العمليات الحسابيه
                </h4>
                <a style="font-size: 16px;" href="<?php echo e(route('admin.stockreport')); ?>">
                    المتابعه </a>

            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title"> الانماط المساعده </h4>
                <a style="font-size: 16px;" href="<?php echo e(route('product-categories.index')); ?>">
                    المجموعات </a>
                <a style="font-size: 16px;" href="<?php echo e(route('brands.index')); ?>">
                    البرندات </a>
                <a style="font-size: 16px;" href="<?php echo e(route('country.index')); ?>">
                    الدول </a>
                <a style="font-size: 16px;" href="<?php echo e(route('gifts.index')); ?>">
                    الهدايا </a>
                <a style="font-size: 16px;" href="<?php echo e(route('color.index')); ?>">
                    الالوان </a>
                <a style="font-size: 16px;" href="<?php echo e(route('attachmentcat.index')); ?>">
                    تصنيفات المرفقات </a>
                <a style="font-size: 16px;" href="<?php echo e(route('sections.index')); ?>">
                    تصنيفات المواصفات الفنيه </a>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">عملاء Fasep </h4>
                
                <a style="font-size: 16px;" href="<?php echo e(route('tmpclients.index')); ?>?status=0">
                    قاعده بيانات العملاء </a>
                <a style="font-size: 16px;" href="<?php echo e(route('tmpclients.index')); ?>?status=1">
                    عملاء جديده </a>
            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title"> خدمات ما بعد البيع </h4>
                <a style="font-size: 16px;" href="<?php echo e(route('admin.sellsmnt.index')); ?>?main_type=1">
                    الورشه
                </a>
                <a style="font-size: 16px;" href="<?php echo e(route('admin.sellsmnt.index')); ?>?main_type=2">
                    الصيانه الخارجيه
                </a>
                <a style="font-size: 16px;" href="<?php echo e(route('admin.sellsmnt.index')); ?>?main_type=4">
                    الزيارة الميدانيه
                </a>
                <a style="font-size: 16px;" href="<?php echo e(route('admin.sellsmnt.index')); ?>?main_type=5">
                    مركز الاتصالات
                </a>
            </div>
            <?php if(in_array(auth()->id(), [1, 9])): ?>
                <div class="card" style="padding: 20px;">
                    <h4 class="home-card-title"> الضمان </h4>
                    <a style="font-size: 16px;" href="<?php echo e(route('warranties.index')); ?>">
                        تقارير الضمان
                    </a>
                    <a style="font-size: 16px;" href="<?php echo e(route('warranties.create')); ?>">
                        انشاء تقرير ضمان جديد
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <style>
        .home-linking .card {
            padding: 20px !important;
        }

        .home-linking a {
            color: #961D1D;
            display: block;
            padding: 0;
            margin: 0;
            margin-bottom: 2px;
            list-style-type: circle !important;

        }

        .home-card-title {
            display: block !important;
            border-bottom: 1px solid #ccc !important;
            text-align: center;
            padding-bottom: 10px;
            font-weight: bold;
            font-size: 16px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($pLayout . 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>