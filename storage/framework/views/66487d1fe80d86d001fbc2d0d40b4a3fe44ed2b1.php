<div class="row" style="background: #eaeaea; padding: 20px;">
    <div class="row">
        <div class="col-md-4">
            <div
                class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
                <label>الاسم</label>

                <?php echo Form::text("name", null , [
                "class" => "form-control",
                "placeholder" => 'الاسم',
                "required"
                ]); ?>

            </div>
        </div>
        <div class="col-md-4">
            <div
                class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
                <label>القسم</label>
                <select name="category_id" class="form-control" id="">
                    <option value="">اختر القسم</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"
                            <?php echo e((isset($expense) && $expense->category_id == $category->id) ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div
                class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
                <label>الكود</label>
                <?php echo Form::text("code", null , [
                "class" => "form-control",
                "placeholder" => ' كود المصروف',
                ]); ?>

            </div>
        </div>
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
