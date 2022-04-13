<?php $__env->startSection('content'); ?>
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <?php
                    if(request('main_type') === '2'){
                        $last_id = \App\Models\Maintenance::where('main_type',2)->currentYear()->count() + 1;
                        $last_id = str_pad($last_id, 4, '0', STR_PAD_LEFT);
                        $last_id = 'OJB-'.$last_id;
                    } elseif(request('main_type') === '4') {
                        $last_id = \App\Models\Maintenance::where('main_type', 4)->currentYear()->count() + 1;
                        $last_id = str_pad($last_id, 4, '0', STR_PAD_LEFT);
                        $last_id = 'OVT-' . $last_id;
                    } elseif(request('main_type') === '5') {
                        $last_id = \App\Models\Maintenance::where('main_type', 5)->currentYear()->count() + 1;
                        $last_id = str_pad($last_id, 4, '0', STR_PAD_LEFT);
                        $last_id = 'CAL-' . $last_id;
                    } else {
                        $last_id = \App\Models\Maintenance::whereNull('main_type')->orWhere('main_type', 1)->currentYear()->count() + 1;
                        $last_id = str_pad($last_id, 4, '0', STR_PAD_LEFT);
                        $last_id = 'MNT-'.$last_id;
                    }
                ?>
                <div class="card-header">
                    <h4 class="card-title">
                        <?php if(request('main_type') === '2'): ?>
                            استلام صيانه خارجيه
                        <?php elseif(request('main_type') === '4'): ?>
                            استلام زيارة ميدانيه
                        <?php elseif(request('main_type') === '5'): ?>
                            استلام مركز الاتصالات
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