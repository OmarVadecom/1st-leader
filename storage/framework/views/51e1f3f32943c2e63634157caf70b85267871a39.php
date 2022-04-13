<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xl-12 alert alert-warning text-center" style="text-align: center;">
        <b><i class="fa fa-exclamation-circle"></i></b> <?php echo e(trans('admin.403')); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($pLayout . 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>