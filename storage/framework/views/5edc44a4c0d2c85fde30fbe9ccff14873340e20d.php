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
    </div>
    <div class="col-xl-2 col-lg-6 col-xs-12">
        <div class="card" style="padding: 20px;">
            <h4 class="home-card-title">ملخص الحركه</h4>
            <a style="font-size: 16px;" href="<?php echo e(route('admin.sold_report.index')); ?>">تم بيعه
            </a>
            <a style="font-size: 16px;" href="<?php echo e(route('admin.buy_report.index')); ?>">تم
                شراءه </a>
            <a style="font-size: 16px;" href="<?php echo e(route('admin.mahgoz.index')); ?>">المنتجات
                المحجوزه </a>
            <a style="font-size: 16px;" href="<?php echo e(route('admin.available.index')); ?>">المنتجات المتوفره </a>

            <a style="font-size: 16px;" href="<?php echo e(route('admin.sells-of-day')); ?>">تقرير المبيعات </a>

        </div>
    </div>


    <div class="col-xl-2 col-lg-6 col-xs-12">
        <div class="card" style="padding: 20px;">
            <h4 class="home-card-title">العمليات الحسابيه
            </h4>
            <a style="font-size: 16px;" href="<?php echo e(route('purchases.index')); ?>">
                المشتريات </a>
            <a style="font-size: 16px;" href="<?php echo e(route('sells.index')); ?>">
                المبيعات </a>
            <a style="font-size: 16px;" href="<?php echo e(route('admin.stockreport')); ?>">
                ملخص الحركه </a>
                <a style="font-size: 15px;" href="<?php echo e(route('expense.index')); ?>">
                    بنود مصاريف المؤسسه </a>

        <a style="font-size: 14px;" href="<?php echo e(route('expensecategory.index')); ?>">
                        اقسام مصاريف المؤسسه </a>

                        <a style="font-size: 16px;" href="<?php echo e(route('moneybox.index')); ?>">الحسابات
                            التفصيليه </a>
  <a style="font-size: 16px;" href="<?php echo e(route('sanadat.index')); ?>?type=2">سند
                                صرف </a>


 <a style="font-size: 16px;" href="<?php echo e(route('sanadat.index')); ?>?type=1">سند
                                    قبض </a>
        </div>
    </div>

    <div class="col-xl-2 col-lg-6 col-xs-12">
        <div class="card" style="padding: 20px;">
            <h4 class="home-card-title"> بطاقه الصنف </h4>
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
    <div class="col-xl-2 col-lg-6 col-xs-12">
        <div class="card" style="padding: 20px;">
            <h4 class="home-card-title">عملاء Fasep </h4>
            
            <a style="font-size: 16px;" href="<?php echo e(route('tmpclients.index')); ?>?status=0">
                قاعده بيانات العملاء </a>
            <a style="font-size: 16px;" href="<?php echo e(route('tmpclients.index')); ?>?status=1">
                عملاء جديده </a>
        </div>
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