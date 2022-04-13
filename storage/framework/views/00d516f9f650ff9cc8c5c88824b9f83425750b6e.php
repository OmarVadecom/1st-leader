<?php $__env->startSection('content'); ?>
    <section id="justified-top-border">
        <div class="row match-height">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">تقرير المبيعات</h4>
                    </div>
                    <?php echo Form::open([
                    'url' => route('admin.reports-sells.index'),
                    'method', 'get'
                    ]); ?>

                    <div class="card-body">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title">أختر الزبون</label><br>
                                        <select name="customer" class="form-control selectproduct">
                                            <option value="">اختر الزبون</option>
                                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select><br>
                                        <a href="<?php echo e(url('/')); ?>/customers/create">اضافه زبون جديد </a>
                                        <?php if($errors->has('customer')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('customer')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">من تاريخ</label>
                                            <input type="date" name="date_from" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title">الي تاريخ</label>
                                        <input type="date" name="date_to" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr>
                                <div class="clear">
                                    <button type="submit" class="btn btn-primary subm">
                                        <i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </section>
    <style>
        .select2-container {
            margin-top: 5px !important;
            width: 100% !important;
            direction: rtl;
            text-align: right;
        }
    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(".selectproduct").select2();
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>