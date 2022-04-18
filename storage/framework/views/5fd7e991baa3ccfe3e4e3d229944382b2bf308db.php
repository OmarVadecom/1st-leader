<div class="card-body">
    <div class="card-block">
        <div class="row">
            <?php if(\Request::get('status') == 1 || \Request::get('status') == 2): ?>
            <div class="col-md-12">
                <?php if(isset($offer) && $offer->status == 1): ?>
                <div class="form-group">
                    <div class="checkbox">
                        <label><input type="checkbox" name="status" value="2"> تحويل الي امر شراء </label>
                    </div>
                </div>
                <?php elseif(isset($offer) && $offer->status == 2): ?>
                <div class="form-group">
                    <div class="checkbox">
                        <label><input type="checkbox" name="status" value="3"> تأكيد فاتوره الشراء </label>
                    </div>
                </div>
                <?php else: ?>
                <input type="hidden" name="status" value="1">
                <?php endif; ?>
                <?php if(\Request::get('pur_type')): ?>
                <input type="hidden" name="pur_type" value="<?php echo e((\Request::get('pur_type'))); ?>">
                <?php else: ?>
                <input type="hidden" name="pur_type" value="0">

                <?php endif; ?>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">المورد</label><br>
                    <select name="supplier_id" class="form-control" id="">
                        <option value="">اختر المورد</option>
                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($supplier->id); ?>" <?php echo e((isset($offer) && $offer->supplier==$supplier->name) ?
                            'selected' : ''); ?>>
                            <?php echo e($supplier->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <a href="<?php echo e(route('supplier.create')); ?>" target="blank">اضافه مورد جديد</a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">الشركه</label><br>
                    <input type="text" class="form-control" name="supplier_comp"
                        value="<?php echo e(isset($offer) ? $offer->supplier_comp : ''); ?>">

                </div>
            </div>
            <?php else: ?>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">أختر الزبون</label><br>
                    <select name="customer" class="form-control selectproduct" required>
                        <option value="">اختر الزبون</option>
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($customer->id); ?>" <?php if(isset($edit)||isset($verify)): ?> <?php echo e($customer->
                            id==$offer->customer_id ? 'selected' : ''); ?> <?php endif; ?>
                            <?php echo e((isset($visit) && $customer->id==$visit->customer_id) ? 'selected' : ''); ?>

                            <?php echo e((\Request::get('client') != '' && $customer->id==\Request::get('client')) ? 'selected' :
                            ''); ?>>
                            <?php echo e($customer->name); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select><br>
                    <a href="<?php echo e(url('/')); ?>/customers/create">اضافه زبون جديد </a>

                </div>
            </div>
            <?php endif; ?>
            <input type="hidden" name="parent" value="<?php echo e(\Request::get('parent')); ?>">
            <div class="<?php echo e((\Request::get('status') == 1 || \Request::get('status') == 2) ? 'col-md-2' : 'col-md-3'); ?>">
                <div class="form-group">
                    <label for="title">التاريخ</label>
                    <input value=" <?php echo e(isset($offer->date) ? $offer->date : date('Y-m-d')); ?>" required name="date" class="form-control">
                </div>
            </div>

            <div class="<?php echo e((\Request::get('status') == 1 || \Request::get('status') == 2) ? 'col-md-2' : 'col-md-3'); ?>">
                <div class="form-group">
                    <label for="title">الوقت</label>
                    <input value="<?php echo e(isset($offer->time) ? $offer->time : date('h:i:s A')); ?>" required name="time" class="form-control">
                </div>
            </div>

            <div class="<?php echo e((\Request::get('status') == 1 || \Request::get('status') == 2) ? 'col-md-2' : 'col-md-3'); ?>">
                <div class="form-group">
                    <label for="title">مدة العرض</label>
                    <input required value="<?php echo e(isset($offer->offer_duration) ? $offer->offer_duration : ''); ?>" name="offer_duration" class="form-control">
                </div>
            </div>


        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">ملاحظات</label>
                    <textarea name="notes" id="" class="form-control"><?php echo e(isset($offer->notes) ? $offer->notes : ''); ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">البيان</label>
                    <textarea name="declaration" class="form-control"><?php echo e(isset($offer->declaration) ? $offer->declaration : ''); ?></textarea>
                </div>
            </div>
        </div>
        <hr>
        <div class="tab">
            <button type="button" class="tablinks active" onclick="openTab(event, 'product-tab')">العرض</button>
            <button type="button" class="tablinks" onclick="openTab(event, 'details-tab')">تفاصيل العرض</button>
            <?php if(isset($verify)): ?>
            <button type="button" class="tablinks " onclick="openTab(event, 'verify-tab')">التعميد</button>
            <?php endif; ?>
            <button type="button" class="tablinks" onclick="openTab(event, 'attach-tab')">اضافه مرفق</button>
        </div>

        <div id="product-tab" class="tabcontent" style="display: block;">
            <?php
            if(isset($edit)){
            $items=$offer_products ;
            $quantities=$offer_products_quantities;
            $prices=$offer_products_prices;
            $discounts=$offer_products_discounts;
            $taxes=$offer_products_taxes;
            $addon_disc=$offer->addon_disc;
            }
            ?>
            <?php echo $__env->make('admin.layouts.product_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>
        <div id="details-tab" class="tabcontent ">
            <div class="container">
                <div class="row">
                    <label> تفاصيل العرض</label>
                    <button type="button" onclick="addOfferDetail()" class="btn btn-primary">+</button>
                </div>
                <div id="offer-details" style="margin-top: 20px;" class="row">

                    <?php if(isset($edit)||isset($verify)): ?>
                    <?php $__currentLoopData = $offer_products_offer_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div id="single-offer-detail">
                        <div class="col-md-1">
                            <button onclick="removeOfferDetail(this);" type="button" class="btn btn-danger">-</button>
                        </div>

                        <div class="col-md-11">
                            <div class="form-group">
                                <input value="<?php echo e($element); ?>" name="offer_details[]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <div id="single-offer-detail">
                        <div class="col-md-1">
                            <button onclick="removeOfferDetail(this);" type="button" class="btn btn-danger">-</button>
                        </div>

                        <div class="col-md-11">
                            <div class="form-group">
                                <input value="" name="offer_details[]" class="form-control">
                            </div>
                        </div>
                    </div>

                    <?php endif; ?>
                </div>

                <div class="row">
                    <label> تفاصيل العميل</label>
                    <button type="button" onclick="addClientDetail()" class="btn btn-primary">+</button>
                </div>
                <div id="client-details" style="margin-top: 20px;" class="row">
                    <?php if(isset($edit)||isset($verify)): ?>
                    <?php $__currentLoopData = $offer_products_client_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div id="single-client-detail">
                        <div class="col-md-1">
                            <button onclick="removeClientDetail(this);" type="button" class="btn btn-danger">-</button>
                        </div>

                        <div class="col-md-11">
                            <div class="form-group">
                                <input value="<?php echo e($element); ?>" name="client_details[]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <div id="single-client-detail">
                        <div class="col-md-1">
                            <button onclick="removeClientDetail(this);" type="button" class="btn btn-danger">-</button>
                        </div>

                        <div class="col-md-11">
                            <div class="form-group">
                                <input value="" name="client_details[]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if(isset($verify)): ?>
        <div id="verify-tab" class="tabcontent " style="display: none;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">اجمالي القيمة </label>
                            <input disabled value="<?php echo e($total_price); ?> ر.س." required name="date" class="form-control">
                            <input type="hidden" id="total_price" name="total_price" value="<?php echo e($total_price); ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">نوع البيع</label><br>
                            <select name="inv_type" id="inv_type" class="form-control">
                                <option value="">اختر حاله البيع</option>
                                <option value="1">دفع نقدي</option>
                                <option value="2">دفع علي دفعات</option>
                                <option value="0">دفع اجل</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row installment">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title">نسبة الدفعه الاولي %</label>
                                <input type="text" name="startpayment" placeholder="الدفعه الاولي المدفوعه"
                                    class="form-control" id="startpayment">

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="title">قيمه الدفعه الاولي</label>
                                <input  type="text" id="startpaymentvalue" placeholder="الدفعه الاولي المدفوعه"
                                    class="form-control" id="">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="title">عدد الدفعات</label>
                                <input type="number" name="installmentnum" placeholder="عدد الدفعات"
                                    class="form-control" id="installmentnum">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="title">قيمة الدفعات</label>
                                <input disabled type="number" placeholder="قيمة الدفعات" class="form-control"
                                    id="unitprice">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title">الجدوله</label>
                                <select name="installment_type" class="form-control" id="installment_type">
                                    <option value="">اختر الجدوله</option>
                                    <option value="1">بدايه كل شهر ميلادي</option>
                                    <option value="2">نهايه كل شهر ميلادي</option>
                                    <option value="3">بعد شهر من التركيب</option>
                                    <option value="4">تواريح محدده</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <br>
                            <button type="button" id="createtable" class="btn btn-primary">انشاء جدول للدفعات</button>
                            <p class="errortable" style="color: red;"> من فضلك ادخل البيانات كامله..! </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table showunitstable">
                                <thead>
                                    <th>م</th>
                                    <th width="15%">قيمه الدفعه</th>
                                    <th width="9%">نوعه </th>
                                    <th>البنك </th>
                                    <th width="10%">رقمه </th>
                                    <th width="10%">تاريخ الاستحقاق <br> من</th>
                                    <th width="10%">تاريخ الاستحقاق <br> الي</th>
                                    <th width="15%">ملاحظه </th>

                                </thead>
                                <tbody class="paymentstable">
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>


                <div class="row delayed">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">تاريخ الاستحقاق من</label>
                                <input type="date" name="datefrom" placeholder="من" class="form-control">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title"> الي</label>
                                <input type="date" name="dateto" placeholder="الي" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        -<div id="attach-tab" class="tabcontent " style="display: none;">
            <div class="container">
                <div class="row" >
                    <div class="col-md-8"><h2>اضافة مرفقات لعروض الاسعار المعمدة على دفعات</h2>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form action="<?php echo e(route('priceoffer.multiuploads',$offer->id)); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <label for="">اضافة مرفقات :</label>
                            <br />
                            <select name="type">
                                <option disabled selected>اختر نوع المرفق</option>
                                <option value="كفالة غرم">كفالة غرم</option>
                                <option value=" كمبياله"> كمبياله</option>
                                <option value=" بيع اجل"> بيع اجل</option>
                                <option value=" كروكى "> كروكى </option>
                            </select>
                            <br>
                            <br>
                            <input type="file" class="form-control" name="attach" multiple />
                            <br /><br />
                            <input type="submit" class="btn btn-primary" value="Upload" />
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" value="0" name="prstatus" id="prstatus">
        <div class="col-md-12">
            <hr>
            <div class="clear">
                <?php if(isset($verify)): ?>
                <button type="submit" class="btn btn-success">
                    <i class="icon-check2"></i> تعميد
                </button>
                <?php else: ?>
                <button type="submit" class="btn btn-success">
                    <i class="icon-check2"></i> حفظ
                </button>
                <?php if(isset($edit)): ?>
                <?php if(\Request::get('status') != 1 && \Request::get('status') != 2): ?>
                <a href="<?php echo e(route('priceoffer.edit',$offer->id)); ?>?q=verify" class="btn btn-primary">
                    <i class="icon-check2"></i> تعميد
                </a>
                <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>
                <a href="<?php echo e(route('priceoffer.index')); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

                </a>
            </div>
        </div>
    </div>
</div>

<?php $__env->startSection('script'); ?>
<?php echo $__env->make('admin.layouts.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->appendSection(); ?>

<?php echo $__env->make('admin.layouts.style.form_style', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
