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
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="productOrPart">أختر منتج ام جزء</label><br>
                        <select
                            class="form-control selectproduct"
                            name="product_or_part"
                            id="productOrPart"
                            required
                        >
                            <option value="">اختر منتج ام جزء</option>
                            <option
                                value="1"
                                <?php if(isset(request()['product'])): ?> selected <?php endif; ?>
                                <?php if(isset($warranty, $warranty->product_id)): ?> selected <?php endif; ?>
                            > منتج </option>
                            <option
                                value="2"
                                <?php if(isset(request()['part'])): ?> selected <?php endif; ?>
                                <?php if(isset($warranty, $warranty->part_id)): ?> selected <?php endif; ?>
                            > جزء </option>
                        </select>
                    </div>
                </div>
                <div
                    style="<?php if(isset(request()['product']) || isset($warranty, $warranty->product_id)): ?> display: block; <?php else: ?> display: none; <?php endif; ?>"
                    id="productSelect"
                    class="col-md-4"
                >
                    <div class="form-group">
                        <label for="product">أختر المنتج</label><br>
                        <select
                            class="form-control selectproduct"
                            name="product_id"
                            id="product"
                        >
                            <option value="">اختر المنتج</option>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    <?php echo e((isset($warranty) && $warranty->product_id === $product->id) ? 'selected' : ''); ?>

                                    <?php echo e((isset(request()['product']) && request()['product'] == $product->id) ? 'selected' : ''); ?>

                                    value="<?php echo e($product->id); ?>"
                                >
                                    <?php echo e($product->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div
                    style="<?php if(isset(request()['part']) || isset($warranty, $warranty->part_id)): ?> display: block; <?php else: ?> display: none; <?php endif; ?>"
                    class="col-md-4"
                    id="partSelect"
                >
                    <div class="form-group">
                        <label for="part">أختر جزء</label><br>
                        <select
                            class="form-control selectproduct"
                            name="part_id"
                            id="part"
                        >
                            <option value="">اختر الجزء</option>
                            <?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    <?php echo e((isset($warranty) && $warranty->part_id === $part->id) ? 'selected' : ''); ?>

                                    <?php echo e((isset(request()['part']) && request()['part'] == $part->id) ? 'selected' : ''); ?>

                                    value="<?php echo e($part->id); ?>"
                                >
                                    <?php echo e($part->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group <?php echo e($errors->has("problem_type") ? " has-error" : ""); ?>">
                        <label for="problem_type">المشكله</label>
                        <?php echo Form::text("problem", isset($warranty) ? $warranty->problem_type : "", [
                            "placeholder"   => 'نوع المشكله',
                            "required",
                            "class"         => "form-control",
                            "id"            => "problem_type",
                            ]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group <?php echo e($errors->has("date_create_warranty") ? " has-error" : ""); ?>">
                        <label for="date_create_warranty">تاريخ انشاء الضمان</label>
                        <input
                            value="<?php echo e(isset($warranty->date_create_warranty) ? $warranty->date_create_warranty : date('Y-m-d')); ?>"
                            name="date_create_warranty"
                            id="date_create_warranty"
                            class="form-control"
                            type="date"
                            required
                        />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group <?php echo e($errors->has("tech_report") ? " has-error" : ""); ?>">
                        <label for="tech_report">التقرير الفني</label>
                        <textarea
                            style="height: inherit !important;resize: none"
                            placeholder="تقرير الفني"
                            class="form-control"
                            name="tech_report"
                            id="tech_report"
                            rows="5"
                        ><?php echo e(isset($warranty) ? $warranty->tech_report : ""); ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group <?php echo e($errors->has("recommend") ? " has-error" : ""); ?>">
                        <label for="recommend">التوصيه</label>
                        <textarea
                            style="height: inherit !important;resize: none"
                            placeholder="التوصيه"
                            class="form-control"
                            name="recommend"
                            id="recommend"
                            rows="5"
                        ><?php echo e(isset($warranty) ? $warranty->recommend : ""); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="menu2">
            <?php if(isset($warranty)): ?>
                <div class="row main_specs">
                    <?php if(count($notes) > 0 ): ?>
                        <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($note)): ?>
                                <div class="col-md-7">
                                    <input
                                        class="form-control main_spec"
                                        placeholder="الملاحظه"
                                        name="main_spec[]"
                                        value="<?php echo e($note); ?>"
                                        type="text"
                                    />
                                    <input
                                        value="<?php echo e($attachments[$i]); ?>"
                                        class="file_num_<?php echo e($i); ?>"
                                        name="old_main_images[]"
                                        type="hidden"
                                    />
                                </div>
                                <div class="col-md-3">
                                    <input type="file" name="main_images[]">
                                    <?php if($note != "" || $attachments[$i] != ""): ?>
                                        <div class="downimg">
                                            <img
                                                src="<?php echo e(url('/')); ?>/uploads/warranty-attachments/<?php echo e($attachments[$i]); ?>"
                                                style="width: 150px; height: 150px; padding: 10px 0;"
                                            >
                                            <a
                                                href="<?php echo e(url('/')); ?>/uploads/warranty-attachments/<?php echo e($attachments[$i]); ?>"
                                                download=""
                                            > تحميل </a>
                                            <span
                                                class="removethis"
                                                data-num="<?php echo e($i); ?>"
                                                style="color:red;cursor:pointer;"
                                            > حذف </span>
                                        </div>
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
                    <div class="col-md-3" style="margin-top: 5px">
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
                <i class="icon-check2"></i>
                <?php echo e(trans('admin.save')); ?>

            </button>
            <a href="<?php echo e(route('warranties.index')); ?>" class="btn btn-danger">
                <i class="fa fa-times"></i>
                <?php echo e(trans('admin.cancel')); ?>

            </a>
        </div>
    </div>
</div>

<?php $__env->startSection('script'); ?>
    <?php echo $__env->make('admin.layouts.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script>
        $('#productOrPart').on('change', function () {
            if($(this).val() === '1') {
                $('#productSelect').fadeIn(300);
                $('#partSelect').hide();
            } else {
                $('#partSelect').fadeIn(300);
                $('#productSelect').hide();
            }
        })
    </script>
<?php $__env->stopSection(); ?>
