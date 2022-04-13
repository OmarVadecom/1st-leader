<?php $__env->startSection('content'); ?>
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <?php if(request('type') === '0'): ?>
                            انشاء عرض سعر محلي
                        <?php else: ?>
                            انشاء عرض سعر دولي
                        <?php endif; ?>
                    </h4>
                </div>
                <?php echo Form::open([
                'url' => route('purchases-prices-offers.store'),
                'method', 'POST'
                ]); ?>

                <div class="card-body">
                    <div class="card-block">
                        <?php echo $__env->make('admin.purchases_prices_offers.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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