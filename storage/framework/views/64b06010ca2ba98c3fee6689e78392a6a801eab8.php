<div class="row" style="background: #eaeaea; padding: 20px;">
    <div class="row">
        <div class="col-md-2">
            <div
                class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
                <label>الاسم</label>

                <?php echo Form::text("name", isset($brand) ? $brand->brand : "", [
                "class" => "form-control",
                "placeholder" => 'الاسم',
                "required"
                ]); ?>

            </div><!-- /.form-group -->
        </div>
        <div class="col-md-2">
            <div
                class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
                <label>رقم الترميز للبراند</label>

                <?php echo Form::text("brandcode", isset($brand) ? $brand->brand : "", [
                "class" => "form-control",
                "placeholder" => 'رقم البراند',
                "required"
                ]); ?>

            </div><!-- /.form-group -->
        </div>

        <div class="col-md-2">
            <div
                class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
                <label>البلد</label>
                <select name="country_id" class="form-control" id="">
                    <option value="">اختر بلد المنشأ</option>
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($country->id); ?>"
                            <?php echo e((isset($brand) && $brand->country_id == $country->id) ? 'selected' : ''); ?>>
                            <?php echo e($country->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div><!-- /.form-group -->
        </div>
        <div class="col-md-2">
            <div
                class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
                <label>الترتيب</label>
                <?php echo Form::number("sort", isset($brand) ? $brand->brand : "", [
                "class" => "form-control",
                "placeholder" => 'الترتيب',
                "required"
                ]); ?>

            </div><!-- /.form-group -->
        </div>
        <div class="col-md-2">
            <div
                class="form-group<?php echo e($errors->has("name") ? " has-error" : ""); ?>">
                <label>صوره البراند</label>
                <br>
                <input type="file" name="image">
                <input type="hidden" name="oldimage"
                    value="<?php echo e(($brand) ? $brand->image : ''); ?>">
            </div><!-- /.form-group -->

        </div>
        <div class="col-md-2">
            <?php if(isset($brand)): ?>
                <img style="width:120px; margin-top:20px;"
                    src="<?php echo e(url('/')); ?>/uploads/brands_images/<?php echo e($brand->image); ?>" alt="">
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
