<div class="row" style="background: #eaeaea; padding: 20px;">
    <div class="row">
        <input type="hidden" name="type" value="<?php echo e(isset($sanad) ? $sanad->type : \Request::get('type')); ?>">
        <input type="hidden" name="acc_type" id="acc_type" value=<?php if(isset($sanad)): ?>'<?php echo e($sanad->acc_type); ?>'<?php elseif( request()->has('client') && request()->get('client') !== 0): ?>'client'<?php else: ?>''<?php endif; ?>>

        <input type="hidden" name="sell_id" value="<?php echo e(request()->has('sell') ? request()->get('sell') : ''); ?>" />

        <?php if(request()->get('type') === '1'): ?>
            <div class="col-md-4">
                <div class="form-group<?php echo e($errors->has(" name") ? " has-error" : ""); ?>">
                    <label>النوع</label>
                    <select name="p_type" class="form-control" id="" required>
                        <option value="">اختر النوع</option>
                        <option value="1" <?php echo e(((isset($sanad) && $sanad->p_type === 1) || request()->has('sell') ) ? 'selected' : ''); ?>>
                            اجل - نقدي
                        </option>
                        <option value="2" <?php echo e((isset($sanad) && $sanad->p_type === 2 ) ? 'selected' : ''); ?>>
                            بنكي - تحويل
                        </option>
                    </select>
                </div>
            </div>
        <?php else: ?>
            <div class="col-md-4">
                <div class="form-group<?php echo e($errors->has(" name") ? " has-error" : ""); ?>">
                    <label>النوع</label>
                    <select name="ex_type" class="form-control" id="">
                        <option value="">اختر النوع</option>
                        <option value="1" <?php echo e((isset($sanad) && $sanad->ex_type === 1 ) ? 'selected' : ''); ?>>
                            نقدي
                        </option>
                        <option value="2" <?php echo e((isset($sanad) && $sanad->ex_type === 2 ) ? 'selected' : ''); ?>>
                            عهده
                        </option>
                        <option value="3" <?php echo e((isset($sanad) && $sanad->ex_type === 3 ) ? 'selected' : ''); ?>>
                            بنكي - تحويل
                        </option>
                    </select>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-4">
            <div class="form-group<?php echo e($errors->has(" name") ? " has-error" : ""); ?>">
                <label> الحساب التفصيلي</label>
                <select name="box_id" class="form-control select2" id="">
                    <option value="">اختر الحساب</option>
                    <?php $__currentLoopData = $boxs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $box): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option
                            <?php echo e(((isset($sanad) && $sanad->box_id == $box->id) || (request()->has('box') && request()->get('box') == $box->id)) ? 'selected' : ''); ?>

                            value="<?php echo e($box->id); ?>"
                        >
                            <?php echo e($box->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <?php if( request()->get('type') === '1' ): ?>
            <div class="col-md-4">
                <div class="form-group<?php echo e($errors->has(" name") ? " has-error" : ""); ?>">
                    <label> الحساب المقابل</label>
                    <select name="cl_sup_id" class="form-control select2" id="cl_sup_id">
                        <option value="">اختر النوع</option>
                        <optgroup label="العملاء">
                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    <?php echo e(( (isset($sanad) && $sanad->acc_type === 'client' && $sanad->cl_sup_id === $client->id) || (request()->has('client') && request()->get('client') == $client->id) ) ? 'selected' : ''); ?>

                                    value="<?php echo e($client->id); ?>"
                                    data-type="client"
                                >
                                    <?php echo e($client->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                        <optgroup label="الموردون المحليون">
                            <?php $__currentLoopData = $local_suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $local): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    <?php echo e((isset($sanad) && $sanad->acc_type === 'supplier' && $sanad->cl_sup_id === $local->id) ? 'selected' : ''); ?>

                                    value="<?php echo e($local->id); ?>"
                                    data-type="supplier"
                                >
                                    <?php echo e($local->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                        <optgroup label="الموردون الدوليون">
                            <?php $__currentLoopData = $int_suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $int): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    <?php echo e((isset($sanad) && $sanad->acc_type === 'supplier' && $sanad->cl_sup_id === $int->id) ? 'selected' : ''); ?>

                                    value="<?php echo e($int->id); ?>"
                                    data-type="supplier"
                                >
                                    <?php echo e($int->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                    </select>
                </div>
            </div>
        <?php else: ?>
            <div class="col-md-4">
                <div class="form-group<?php echo e($errors->has(" name") ? " has-error" : ""); ?>">
                    <label> الحساب المقابل</label>
                    <select name="expense_id" class="form-control select2" id="" required>
                        <option value="">اختر النوع</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <optgroup label="<?php echo e($cat->name); ?>">
                                <?php $__currentLoopData = $cat->expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        <?php echo e((isset($sanad) && $sanad->expense_id === $exp->id) ? 'selected' : ''); ?>

                                        value="<?php echo e($exp->id); ?>"
                                    >
                                        <?php echo e($exp->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php
        if( request()->has('sell') ) {
            $sell = \App\Models\Sells::find(request()->get('sell'));
            $sumSandsForThisInvoiceSell = (str_replace(',', '', $sell->total_money)  - $sell->sand()->sum('cost'));
        }
    ?>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group<?php echo e($errors->has(" name") ? " has-error" : ""); ?>">
                <label>التكلفه</label>
                <?php echo Form::number("cost", null , [
                    "placeholder"   => (request()->has('sell') && $sumSandsForThisInvoiceSell) ? 'المبلغ المتبقي : ' . $sumSandsForThisInvoiceSell : 'التكلفه',
                    "class"         => "form-control",
                    "min"           => 1,
                    "max"           => (request()->has('sell') && $sumSandsForThisInvoiceSell) ? $sumSandsForThisInvoiceSell : '',
                    "required"
                ]); ?>

                <p class="p-0 m-0" style="font-weight: bold; color: #961d1d"><?php echo e((request()->has('sell') && $sumSandsForThisInvoiceSell) ? 'المبلغ المتبقي : ' . $sumSandsForThisInvoiceSell : ''); ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group<?php echo e($errors->has(" name") ? " has-error" : ""); ?>">
                <label>التاريخ</label>
                <?php echo Form::date("date", null , [
                    "class" => "form-control",
                    "placeholder" => 'التاريخ',
                    "required"
                ]); ?>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="title">الوقت</label>
                <input value="<?php echo e(isset($sanad) ? $sanad->time : date('h:m:s A')); ?>" type="time" name="time" class="form-control" required />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group<?php echo e($errors->has(" name") ? " has-error" : ""); ?>">
                <label>البيان</label>
                <?php echo Form::textarea("notes", null , [
                    "class" => "form-control",
                    "placeholder" => 'البيان',
                    "required"
                ]); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="clear">
                <button type="submit" class="btn btn-success">
                    <i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

                </button>
            </div>
        </div>
    </div>
</div>
<style>
    .select2-container {
        text-align: right;
    }
</style>
<?php $__env->startSection('script'); ?>
    <script>
        $(".select2").select2();
        $("#cl_sup_id").change(function () {
            type = $(this).find(':selected').data('type')
            $("#acc_type").val(type);
        })
    </script>
<?php $__env->stopSection(); ?>
