<?php $__env->startSection('content'); ?>
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <?php

                    if(\Request::get('main_type') == 2){
                    $last_id = \DB::table('maintenance')->where('main_type',2)->max('main_code')+1;
                    $last_id=str_pad($last_id, 4, '0', STR_PAD_LEFT);
                    $last_id = 'OJB-'.$last_id;

                    }else{
                    $last_id = \DB::table('maintenance')->max('id')+1;
                    $last_id=str_pad($last_id, 4, '0', STR_PAD_LEFT);
                    $last_id = 'MNT-'.$last_id;

                    }
                ?>
                <div class="card-header">
                    <h4 class="card-title">
                        <?php if(\Request::get('main_type') == 2): ?>
                            استلام صيانه خارجيه
                        <?php else: ?>
                            استلام ورشه
                        <?php endif; ?>
                        <span style="color:#b71c1c">
                            <?php echo e($last_id); ?></span>
                    </h4>
                </div>
                <?php echo Form::open([
                'url' => route('maintenance.store'),
                'method', 'POST',
                'files'=> true,
                ]); ?>

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