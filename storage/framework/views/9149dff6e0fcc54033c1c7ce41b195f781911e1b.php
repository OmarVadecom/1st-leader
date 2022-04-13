<?php $__env->startSection('content'); ?>
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <?php
                    $last_id = \DB::table('product_transport')->max('id')+1;
                    $last_id=str_pad($last_id, 4, '0', STR_PAD_LEFT);
                    $last_id = 'TR-'.$last_id;
                    ?>
                    <h4>
                        انشاء امر نقل بضاعه
                        <span style="color:#b71c1c"><?php echo e($last_id); ?> </span></h4>
                </div>
                <?php echo Form::open([
                'url' => route('transport.store'),
                'method', 'POST',
                'files'=> true,
                ]); ?>

                <?php echo $__env->make('admin.transport.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>




<?php $__env->stopSection(); ?>
<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>