<?php $__env->startSection('content'); ?>
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">

                    <h4 class="card-title">
                        <?php if(\Request::get('m')): ?>
                        انشاء فاتوره بيع لطلب صيانه
                        <?php else: ?>
                        إنشاء فاتوره بيع
                        <?php endif; ?>
                    </h4>
                    <span class="pull-left">
                    </span>
                </div>
                <?php echo Form::open([
                'url' => route('sells.store'),
                'method', 'POST',
                'files'=> true,
                ]); ?>

                <?php echo $__env->make('admin.sell.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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