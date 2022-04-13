<input type="hidden" id="maintenance_sr" value="1">
<input type="hidden" name="main_type" value="<?php echo e(request('main_type')); ?>"/>
<input
    type="hidden"
    name="code"
    <?php if(isset($maint)): ?>
    value="<?php echo e($maint->code . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT)); ?>"
    <?php elseif(isset($maintenance)): ?>
    value="<?php echo e($maintenance->maintenance->code . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT)); ?>"
    <?php else: ?>
    value=""
    <?php endif; ?>
/>
<div class="row">
    <ul class=" nav nav-tabs">
        <li class="nav-item navbitem">
            <a class="nav-link navvlink active" data-toggle="tab" href="#menu1">عام</a>
        </li>
        <li class="nav-item navbitem">
            <a class="nav-link navvlink" data-toggle="tab" href="#menu2">ملاحظات مصوره</a>
        </li>
    </ul>
    <br>
    <div class="tab-content">
        <div class="tab-pane active" id="menu1">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>حاله التقرير</label>
                        <div class="radio" style="margin-right: 3%;">
                            <label>
                                <input
                                    <?php echo e((isset($maintenance)) ? ($maintenance->status_report == 1) ? 'checked' : '' : 'checked'); ?>

                                    name="status_report"
                                    type="radio"
                                    value="1"
                                />
                                تحت التنفيذ
                            </label>
                        </div>
                        <div class="radio" style="margin-right: 3%;">
                            <label>
                                <input
                                    <?php echo e((isset($maintenance) && $maintenance->status_report == 2) ? 'checked' : ''); ?>

                                    name="status_report"
                                    type="radio"
                                    value="2"
                                />
                                مكتمل
                            </label>
                        </div>
                        <div class="radio" style="margin-right: 3%;">
                            <label>
                                <input
                                    <?php echo e((isset($maintenance) && $maintenance->status_report == 3) ? 'checked' : ''); ?>

                                    name="status_report"
                                    type="radio"
                                    value="3"
                                />
                                مرفوض
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>حاله الضمان</label>
                        <div class="radio" style="margin-right: 3%;">
                            <label>
                                <input
                                    <?php echo e((isset($maintenance)) ? ($maintenance->status_warranty == 1) ? 'checked' : '' : 'checked'); ?>

                                    name="status_warranty"
                                    type="radio"
                                    value="1"
                                />
                                خارج الضمان
                            </label>
                        </div>
                        <div class="radio" style="margin-right: 3%;">
                            <label>
                                <input
                                    <?php echo e((isset($maintenance) && $maintenance->status_warranty == 2) ? 'checked' : ''); ?>

                                    name="status_warranty"
                                    type="radio"
                                    value="2"
                                />
                                داخل الضمان
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label> هل تم الفحص</label>
                        <div class="radio" style="margin-right: 30%;">
                            <label><input type="radio" value="1" name="status" <?php echo e((isset($maintenance)) ? ($maintenance->status == 1) ?
                'checked' : '' : 'checked'); ?>> نعم </label>
                        </div>
                        <div class="radio" style="margin-right: 30%;">
                            <label><input value="0" type="radio" name="status" <?php echo e((isset($maintenance) && $maintenance->status == 0) ?
                'checked' : ''); ?>> لا </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group<?php echo e($errors->has(" name") ? " has-error" : ""); ?>">
                        <label>نوع المشكله</label>

                        <?php echo Form::text("type", isset($maintenance) ? $maintenance->type : "", [
                        "class" => "form-control",
                        "placeholder" => 'نوع المشكله',
                        "required"
                        ]); ?>

                    </div><!-- /.form-group -->
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">بدايه الفحص</label>
                        <input type="date" value="<?php echo e(isset($maintenance->start) ? $maintenance->start : date('Y-m-d')); ?>" required name="start"
                               class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">نهايه الفحص الفحص</label>
                        <input type="date" value="<?php echo e(isset($maintenance->end) ? $maintenance->end : date('Y-m-d')); ?>" required name="end"
                               class="form-control">
                    </div>
                </div>
                <?php if(isset($maint)): ?>
                    <input type="hidden" name="maintenance_id" value="<?php echo e($maint->id); ?>">
                    <input type="hidden" name="customer_id" value="<?php echo e($maint->client_id); ?>">
                <?php endif; ?>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>تقرير الفني</label>
                        <i data-id="1"
                           class="fa <?php echo e((isset($maintenance) && $maintenance->tech_rate >= 1) ? 'fa-star' : 'fa-star-o'); ?> delegate1 stardel"></i>
                        <i data-id="2"
                           class="fa <?php echo e((isset($maintenance) && $maintenance->tech_rate >= 2) ? 'fa-star' : 'fa-star-o'); ?> delegate2 stardel"></i>
                        <i data-id="3"
                           class="fa <?php echo e((isset($maintenance) && $maintenance->tech_rate >= 3) ? 'fa-star' : 'fa-star-o'); ?> delegate3 stardel"></i>
                        <i data-id="4"
                           class="fa <?php echo e((isset($maintenance) && $maintenance->tech_rate >= 4) ? 'fa-star' : 'fa-star-o'); ?> delegate4 stardel"></i>
                        <i data-id="5"
                           class="fa <?php echo e((isset($maintenance) && $maintenance->tech_rate >= 5) ? 'fa-star' : 'fa-star-o'); ?> delegate5 stardel"></i>
                        <input type="hidden" name="tech_rate" value="5" class="delegate">
                        <textarea style="height: inherit !important;" class="form-control" name="tech_report"
                                  placeholder="تقرير الفني"
                                  rows="4"><?php echo e(isset($maintenance) ? $maintenance->tech_report : ""); ?></textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>التوصيه</label>
                        <i data-id="1"
                           class="fa <?php echo e((isset($maintenance) && $maintenance->recommends_rate >= 1) ? 'fa-star' : 'fa-star-o'); ?> delegatecl1 stardelcl"></i>
                        <i data-id="2"
                           class="fa <?php echo e((isset($maintenance) && $maintenance->recommends_rate >= 2) ? 'fa-star' : 'fa-star-o'); ?> delegatecl2 stardelcl"></i>
                        <i data-id="3"
                           class="fa <?php echo e((isset($maintenance) && $maintenance->recommends_rate >= 3) ? 'fa-star' : 'fa-star-o'); ?> delegatecl3 stardelcl"></i>
                        <i data-id="4"
                           class="fa <?php echo e((isset($maintenance) && $maintenance->recommends_rate >= 4) ? 'fa-star' : 'fa-star-o'); ?> delegatecl4 stardelcl"></i>
                        <i data-id="5"
                           class="fa <?php echo e((isset($maintenance) && $maintenance->recommends_rate >= 5) ? 'fa-star' : 'fa-star-o'); ?> delegatecl5 stardelcl"></i>
                        <input type="hidden" name="recommends_rate" value="5" class="delegatecl">
                        <textarea style="height: inherit !important;" class="form-control" name="recommends"
                                  placeholder="التوصيه"
                                  rows="4"><?php echo e(isset($maintenance) ? $maintenance->recommends : ""); ?></textarea>
                    </div>
                </div>
            </div>

            <?php
                if(isset($edit)){
                $items=$offer_products ;
                $quantities=$offer_products_quantities;
                $prices=$offer_products_prices;
                $discounts=$offer_products_discounts;
                $taxes=$offer_products_taxes;
                $addon_disc=$maintenance->addon_disc;
                }
            ?>
            <?php echo $__env->make('admin.layouts.product_table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </div>
        <div class="tab-pane fade" id="menu2">
            <?php if(isset($maintenance)): ?>
                <div class="row main_specs">
                    <?php if(count($notes) > 0 ): ?>
                        <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($note)): ?>
                                <div class="col-md-7">
                                    <input type="text" name="main_spec[]" value="<?php echo e($note); ?>" class="form-control main_spec" placeholder="الملاحظه" />
                                    <input
                                        value="<?php echo e(isset($attachments[$i]) ? $attachments[$i] : ''); ?>"
                                        class="file_num_<?php echo e($i); ?>"
                                        name="old_main_images[]"
                                        type="hidden"
                                    />
                                </div>
                                <div class="col-md-3">
                                    <input type="file" name="main_images[]">
                                    <?php if(isset($attachments[$i])): ?>
                                        <?php if($note != "" || $attachments[$i] != ""): ?>
                                            <div class="downimg">
                                                <img src="<?php echo e(url('/')); ?>/uploads/main-attachments/<?php echo e($attachments[$i]); ?>" style="width: 150px; height: 150px; padding: 10px;">
                                                <a href="<?php echo e(url('/')); ?>/uploads/main-attachments/<?php echo e($attachments[$i]); ?>" download=""> تحميل </a>
                                                <span class="removethis" data-num="<?php echo e($i); ?>" style="color:red;cursor:pointer;"> حذف </span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-2">
                                    <?php if(($i == 0)): ?>
                                        <button id="add_main_spec" class="btn btn-success">اضافه ملاحظه اخري</button>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="col-md-7">
                            <input type="text" name="main_spec[]" class="form-control main_spec" placeholder="الملاحظه">
                        </div>
                        <div class="col-md-3">
                            <input type="file" name="main_images[]">
                        </div>
                        <div class="col-md-2">
                            <button id="add_main_spec" class="btn btn-success">اضافه ملاحظه اخري</button>
                        </div>

                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="row main_specs">
                    <div class="col-md-7">
                        <input type="text" name="main_spec[]" class="form-control main_spec" placeholder="الملاحظه">
                    </div>
                    <div class="col-md-3">
                        <input type="file" name="main_images[]">
                    </div>
                    <div class="col-md-2">
                        <button id="add_main_spec" class="btn btn-success">اضافه ملاحظه اخري</button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-12">
        <hr>
        <div class="clear">
            <button type="submit" class="btn btn-success">
                <i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

            </button>
        </div>
    </div>


<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('admin.layouts.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->appendSection(); ?>

<!-- /*/*/*/*/*/ Style Section  /*/*/*/*/*/*/*/-->
<?php echo $__env->make('admin.layouts.style.form_style', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- /*/*/*/*/*/ Style Section  /*/*/*/*/*/*/*/-->
