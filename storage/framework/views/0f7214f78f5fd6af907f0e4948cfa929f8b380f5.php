<?php $__env->startSection('content'); ?>

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        تفاصيل الدفعه
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>

                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <div class="tab-content px-1 pt-1">
                            <?php $__currentLoopData = $dbLangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div role="tabpanel" class="tab-pane fade <?php echo e($key == 0 ? 'active in' : ''); ?>"
                                id="<?php echo e($lang->code); ?>" aria-labelledby="<?php echo e($lang->code); ?>-tab"
                                aria-expanded="<?php echo e($key == 0 ? 'true' : 'false'); ?>">

                                <table class="table table-striped table-bordered">

                                    <tr>
                                        <th>رقم الدفعه</th>
                                        <td>

                                            <?php
                                            $id = str_pad($fund->id, 4, '0', STR_PAD_LEFT);
                                            $id = 'INV-' . $id;
                                            ?>
                                            <?php echo e($id); ?>


                                        </td>
                                    </tr>

                                    <tr>
                                        <th>اسم الزبون</th>
                                        <td><?php echo e($fund->customer->name); ?></td>
                                    </tr>

                                    <tr>
                                        <th> عرض السعر</th>
                                        <td><?php echo e($fund->price->code); ?></td>
                                    </tr>

                                    <tr>
                                        <th> المبلغ المستحق</th>
                                        <td><?php echo e($fund->money); ?></td>
                                    </tr>
                                    <tr>
                                        <th> تاريخ الاستحقاق من</th>
                                        <td><?php echo e($fund->date_from); ?></td>
                                    </tr>
                                    <tr>
                                        <th> تاريخ الاستحقاق الي</th>
                                        <td><?php echo e($fund->date_to); ?></td>
                                    </tr>
                                    <tr>
                                        <th> نوع الدفعه</th>
                                        <td>
                                            <?php if($fund->type == 1): ?>
                                            شيك
                                            <?php else: ?>
                                            كمبياله
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php if($fund->type == 1): ?>
                                    <tr>
                                        <th> البنك </th>
                                        <td><?php echo e($fund->bank); ?></td>
                                    </tr>
                                    <tr>
                                        <th>رقم البنك</th>
                                        <td><?php echo e($fund->bank_num); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th>ملاحظه</th>
                                        <td><?php echo e($fund->note); ?></td>
                                    </tr>

                                    <tr>
                                        <th>حاله الدفع</th>
                                        <td>
                                            <?php if($fund->status == 1): ?>
                                            <i style="color:green" class="fa fa-check"></i> تم الدفع
                                            <br>
                                            <?php else: ?>
                                            <i style="color:red" class="fa fa-times"></i> لم يتم الدفع
                                            <br>
                                            <?php endif; ?>
                                            <form style="padding-top:10px;" method="post"
                                                action="<?php echo e(route('funds.store')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="fund_id" value="<?php echo e($fund->id); ?>">
                                                <input id="radio_id" type="checkbox" class="checkbtnC" name="status"
                                                    <?php if($fund->status == 1): ?>
                                                checked="checked" <?php endif; ?> /><br>
                                                <button type="submit" class="btn btn-success">حفظ </button>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <a href="<?php echo e(route('funds.index')); ?>" class="btn btn-danger"><?php echo e(trans('admin.back')); ?></a>
                        <button id="print" class="btn btn-primary">طباعه</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>

<script>
    $(function () {
 $("#print").click(function(){
$('#file-export').print();
})
})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>