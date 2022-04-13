<?php $__env->startSection('content'); ?>
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <?php if(request('main_type') === '2'): ?>
                            تعديل طلب صيانه خارجيه
                        <?php elseif(request('main_type') === '4'): ?>
                            تعديل زيارة ميدانيه
                        <?php elseif(request('main_type') === '5'): ?>
                            تعديل مركز الاتصالات
                        <?php else: ?>
                            تعديل طلب ورشه
                        <?php endif; ?>
                        <span class="pull-left">
                        </span>
                    </h4>
                </div>
                <?php echo Form::model($maintenance ,[
                'method' => 'PATCH',
                'route' => ['maintenance.update', $maintenance->id],
                'files' => true
                ]); ?>

                <input type="hidden" value="<?php echo e($maintenance->id); ?>" name="id">
                <div class="card-body">
                    <div class="card-block">


                        <?php echo $__env->make('admin.maintenance.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>