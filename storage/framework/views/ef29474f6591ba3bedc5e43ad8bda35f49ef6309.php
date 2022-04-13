<?php $__env->startSection('content'); ?>
    <section id="justified-top-border">
        <div class="row match-height">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            تعديل تقرير ضمان
                        </h4>
                    </div>
                    <?php echo Form::model($warranty ,[
                            'method'    => 'PATCH',
                            'route'     => ['warranties.update', $warranty->id],
                            'files'     => true
                        ]); ?>

                    <div class="card-body">
                        <div class="card-block">
                            <?php echo $__env->make('admin.warranties.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>