<?php $__env->startSection('content'); ?>
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <?php
                $last_id = \DB::table('price_offers')->max('id')+1;
                $last_id=str_pad($last_id, 4, '0', STR_PAD_LEFT);
                if($offer->status == 1){
                $last_id = 'PPO-'.$last_id;
                }elseif($offer->status == 2){
                $last_id = 'PO-'.$last_id;
                }else{
                $last_id = 'QUT-'.$last_id;
                }
                ?>
                <div class="card-header">

                    <?php if(isset($verify)): ?>
                    <h4 class="card-title">تعميد عرض السعر <span
                            style="color:#b71c1c"><?php echo e(isset($offer->padded_id) ? $offer->padded_id : $last_id); ?></span></h4>
                    <?php else: ?>
                    <?php if($offer->status == 1): ?>
                    <h4 class="card-title">تعديل عرض سعر <span style="color:#b71c1c">
                            <?php echo e($last_id); ?>


                        </span></h4>
                    <?php elseif($offer->status == 2): ?>
                    <h4 class="card-title">تعديل أمر شراء <span style="color:#b71c1c">
                           <?php echo e($last_id); ?>

                        </span></h4>
                    <?php else: ?>

                    <h4 class="card-title">تعديل عرض السعر <span
                            style="color:#b71c1c"><?php echo e(isset($offer->padded_id) ? $offer->padded_id : $last_id); ?></span></h4>
                  <?php endif; ?>
                    <?php endif; ?>
                </div>


                <?php echo Form::model($offer ,[
                'method' => 'PATCH',
                'route' => ['priceoffer.update', $offer->id],
                'files' => true
                ]); ?>


                <?php echo $__env->make('admin.priceoffer.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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