<?php $__env->startSection('content'); ?>
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">انشاء زبون</h4>
                </div>
                <?php echo Form::open([
                'url' => route('customers.store'),
                'method', 'POST',
                'files' => true
                ]); ?>

                <div class="card-body">
                    <div class="card-block">
                        <!--<p>Use <code>.nav-justified</code> class to set tabs justified.</p>-->

                        <?php echo $__env->make('admin.customers.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>