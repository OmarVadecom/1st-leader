<?php $__env->startSection('title'); ?> تقرير ورشه <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
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
            تقرير ورشه <a href="<?php echo e(route('maintenance_report.edit',$maintenance_report->id)); ?>" class="editbtu"
                target="_blank"> - تعديل
            </a>
        </h3>
    </div>
</div>
<div class="row no-gutters" style="border-bottom: 1px solid #ccc;">
    <div class="col-md-3">
     
      <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">الشركة :</span>
                <span class="about_value"><?php echo e($maintenance->client->name); ?></span>
            </div>
        </div>

        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">العنوان :</span>
                <span
                    class="about_value"><?php echo e($maintenance->client->region); ?>-<?php echo e($maintenance->client->street); ?></span>
            </div>
        </div>

        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">السيد :</span>
                <span class="about_value"><?php echo e($maintenance->client->resp_name); ?></span>
            </div>
        </div>

        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">رقم الهاتف :</span>
                <span class="about_value en-font"><?php echo e($maintenance->client->resp_phone); ?></span>
            </div>
        </div>
<?php if($maintenance->client->resp_email != ""): ?>
        <div class="row no-gutters" style="border: 1px solid #ccc; border-bottom: 0px;">
            <div class="d-flex">
                <span class="about_prop">ايميل :</span>
                <span class="about_value"><?php echo e($maintenance->client->resp_email); ?></span>
            </div>
        </div>
<?php endif; ?>
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
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px; border-top: 0;">
                    <span class="about_prop">التاريخ/ </span>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px;">
                    <span class="about_prop">الوقت/ </span>
                </div>
                
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px;">
                    <span class="about_prop">رقم الطلب/ </span>
                </div>
                <div class="row no-gutters" style="border: 1px solid #ccc;border-bottom: 0px;">
                    <span class="about_prop">رقم الحساب/</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row no-gutters"
                    style="border: 1px solid #ccc;border-bottom: 0px; border-top: 0; border-right: 0; ">
                    <span class=" about_value en-font"><?php echo e($maintenance->date); ?></span>
                </div>
                <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
                    <span class="about_value en-font"><?php echo e($maintenance->time); ?></span>
                </div>
                
                <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
                    <span class="about_value en-font"><?php echo e($maintenance->code); ?></span>
                </div>
                <div class="row no-gutters " style="border: 1px solid #ccc;border-bottom: 0px; border-right: 0; ">
                    <span class="about_value en-font"><?php echo e($maintenance->client->code); ?></span>
                </div>
            </div>

        </div>
    </div>
</div>
<br><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="30%">معلومات المنتج الرئيسي</th>
            <th colspan="2">الرئيسية</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan="6" style="position: relative;">

                <?php if(isset($maintenance->product_id)): ?>

                <img class="main_pro_image" src="<?php echo e(url('/')); ?>/uploads/products-attachments/<?php echo e($maintenance->product->image); ?>"
                    style="width:150px;">
                <?php else: ?>
                <img class="main_pro_image" src="<?php echo e(url('/')); ?>/uploads/parts-attachments/<?php echo e($maintenance->product->image); ?>"
                    style="width:150px;">
                <?php endif; ?>
            </td>
            <td width="15%">سيريال نمبر</td>
            <td class="en-font"><?php echo e($maintenance->serial_num); ?></td>
        </tr>
        <tr>
            <td width="15%">الطراز</td>
            <td class="en-font"><?php echo e($maintenance->type); ?></td>
        </tr>
        <tr>
            <td width="15%">بدايه الفحص</td>
            <td><span class="en-font"><?php echo e($maintenance_report->start); ?></span></td>
        </tr>
        <tr>
            <td width="15%">نهايه الفحص</td>
            <td><span class="en-font"><?php echo e($maintenance_report->end); ?></span></td>
        </tr>
        <tr>
            <td width="15%">هل تم الفحص</td>
            <td><?php echo e($maintenance_report->status == 1 ? 'نعم' : 'لا'); ?></td>
        </tr>
    </tbody>
</table>
<br><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="8" style="background: #F8CBAD;">تفاصيل الاستلام</th>
        </tr>
        <tr>
            <th>م</th>
            <th>رقم الصنف</th>
            <th>اسم القطعه</th>
            <th>رقم القطعه</th>
            <th>حاله القطعه</th>
            <th>حاله التشغيل</th>
            <th>مستوي النظافه</th>
            <th>الصوره</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$pr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="en-font"><?php echo e($k+1); ?></td>
            <td class="en-font"><?php echo e($pr->code); ?></td>
            <td><?php echo e($pr->name); ?></td>
            <td class="en-font"><?php echo e($parts_num[$k]); ?></td>
            <td><?php echo e($parts_status[$k]); ?></td>
            <td><?php echo e($parts_op_status[$k]); ?></td>
            <td><?php echo e($parts_cleaning[$k]); ?></td>
            <td><img src="<?php echo e(url('/')); ?>/uploads/parts-attachments/<?php echo e($pr->image); ?>" style="width:70px;"></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<br><br><br><br>

<table class="table table-bordered">
    <thead>
        <tr>
            <th width="25%">حاله تم الفحص</th>
            <th>تقرير الفني
                <span style="float:left">
                    <i data-id="1"
                        class="fa <?php echo e((isset($maintenance_report) && $maintenance_report->tech_rate >= 1) ? 'fa-star' : 'fa-star-o'); ?> delegate1 stardel"></i>
                    <i data-id="2"
                        class="fa <?php echo e((isset($maintenance_report) && $maintenance_report->tech_rate >= 2) ? 'fa-star' : 'fa-star-o'); ?> delegate2 stardel"></i>
                    <i data-id="3"
                        class="fa <?php echo e((isset($maintenance_report) && $maintenance_report->tech_rate >= 3) ? 'fa-star' : 'fa-star-o'); ?> delegate3 stardel"></i>
                    <i data-id="4"
                        class="fa <?php echo e((isset($maintenance_report) && $maintenance_report->tech_rate >= 4) ? 'fa-star' : 'fa-star-o'); ?> delegate4 stardel"></i>
                    <i data-id="5"
                        class="fa <?php echo e((isset($maintenance_report) && $maintenance_report->tech_rate >= 5) ? 'fa-star' : 'fa-star-o'); ?> delegate5 stardel"></i>
                </span>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan="3" style="position: relative;">
                <div class="main_pro_image" style="font-size: 26px"> <?php echo e($maintenance_report->status == 1 ? 'نعم' : 'لا'); ?>

                </div>
            </td>
            <td style="text-align: right;"><?php echo e($maintenance_report->tech_report); ?></td>
        </tr>
        <tr>
            <th>التوصيه
                <span style="float:left">
                    <i data-id="1"
                        class="fa <?php echo e((isset($maintenance_report) && $maintenance_report->recommends_rate >= 1) ? 'fa-star' : 'fa-star-o'); ?> delegatecl1 stardelcl"></i>
                    <i data-id="2"
                        class="fa <?php echo e((isset($maintenance_report) && $maintenance_report->recommends_rate >= 2) ? 'fa-star' : 'fa-star-o'); ?> delegatecl2 stardelcl"></i>
                    <i data-id="3"
                        class="fa <?php echo e((isset($maintenance_report) && $maintenance_report->recommends_rate >= 3) ? 'fa-star' : 'fa-star-o'); ?> delegatecl3 stardelcl"></i>
                    <i data-id="4"
                        class="fa <?php echo e((isset($maintenance_report) && $maintenance_report->recommends_rate >= 4) ? 'fa-star' : 'fa-star-o'); ?> delegatecl4 stardelcl"></i>
                    <i data-id="5"
                        class="fa <?php echo e((isset($maintenance_report) && $maintenance_report->recommends_rate >= 5) ? 'fa-star' : 'fa-star-o'); ?> delegatecl5 stardelcl"></i>
                </span>
            </th>
        </tr>
        <tr>
            <td style="text-align: right;"><?php echo e($maintenance_report->recommends); ?></td>
        </tr>
    </tbody>
</table>
<br><br>
<?php
$sell_show=true;
$items=$allproducts;
$quantities=$quantities;
$prices=$prices;
$discounts=$discounts;
$addon_disc=$maintenance_report->addon_disc;
?>
<?php echo $__env->make('admin.layouts.show_product_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<br><br><br><br><br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="2" style="background: #FFFF99">ملاحظات مصوره</th>
        </tr>
        <tr>
            <th>الوصف</th>
            <th>الصوره</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td style="position: relative;">
                <?php echo e($note); ?>

            </td>
            <td> <?php if(isset($attachments[$i]) && $attachments[$i] != ""): ?>
                <img src="<?php echo e(url('/')); ?>/uploads/main-attachments/<?php echo e($attachments[$i]); ?>" style="width:150px">
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        padding: .5rem !important;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
    }

    .main_pro_image {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .fa-star {
        color: #ffc12b;
        font-size: 15px;
    }

    @media  print {
        .editbtu {
            display: none;
        }

        table {
            page-break-inside: avoid !important;
            border-collapse: collapse;
        }

        .divFooter {
            position: relative !important;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($pLayout. 'masterinv', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>