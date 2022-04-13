<div class="col-md-7">
    <hr>
    <h4><i class="fa fa-bookmark"></i> <?php echo e(trans('admin.shared_values')); ?></h4>

    <div class="col-md-12">
        <div class="form-group">
            <label for="title">رمز المجموعه</label>
            <?php echo Form::text('slug',($product) ? $product->slug : '',array('class'=>'form-control')); ?>


        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="title">اسم المجموعه</label>

            <?php echo Form::text('name',($product) ? $product->name : '',
            array('class'=>'form-control')); ?>


        </div>

    </div>


    <div class="col-md-12">
        <div class="form-group">
            <label for="status"><?php echo e(trans('admin.status')); ?></label>

            <input type="checkbox" class="checkbtnC" name="status" <?php if($act=='edit' ): ?> <?php if($product->status == 1): ?>
            checked="checked" <?php endif; ?> <?php else: ?> checked="checked" <?php endif; ?> />

        </div>
    </div>
</div>



<div class="col-md-12">
    <hr>
    <div class="clear">
        <button type="submit" class="btn btn-primary">
            <i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

        </button>
        <a href="<?php echo e(route('product-categories.index')); ?>" class="btn btn-danger">
            <i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

        </a>
    </div>
</div>
