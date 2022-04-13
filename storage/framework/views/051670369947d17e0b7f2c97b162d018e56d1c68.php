<?php $__env->startSection('content'); ?>
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        تعديل تقرير
                        <span style="color:#b71c1c">
                            <?php echo e($maintenance->maintenance->code . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT)); ?>

                        </span>
                    </h4>
                </div>
                <?php echo Form::model($maintenance ,[
                'method' => 'PATCH',
                'route' => ['maintenance_report.update', $maintenance->id],
                'files' => true
                ]); ?>

                <input type="hidden" value="<?php echo e($maintenance->id); ?>" name="id">
                <div class="card-body">
                    <div class="card-block">


                        <?php echo $__env->make('admin.maintenance_report.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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