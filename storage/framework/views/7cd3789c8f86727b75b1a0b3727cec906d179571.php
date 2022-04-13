<?php $__env->startSection('content'); ?>
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <?php
                $last_id = \DB::table('price_offers')->max('id')+1;
                $last_id=str_pad($last_id, 4, '0', STR_PAD_LEFT);
                if(\Request::get('status') == 1){
                $last_id = 'PPO-'.$last_id;

                }else{
                $last_id = 'QUT-'.$last_id;

                }
                ?>
                <div class="card-header">
                    <?php if(isset($type) && $type==0): ?>
                    <h4 class="card-title">إنشاء عرض سعر غير معمد <span style="color:#b71c1c"><?php echo e(isset($offer->padded_id) ? $offer->padded_id : $last_id); ?></span>
                        <?php elseif(isset($type) && $type==1): ?>
                        <h4 class="card-title">إنشاء عرض سعر معمد <span style="color:#b71c1c"><?php echo e(isset($offer->padded_id) ? $offer->padded_id : $last_id); ?></span>
                            <?php else: ?>
                            <h4 class="card-title">إنشاء عرض سعر <span style="color:#b71c1c">
                                    <?php echo e(isset($offer->padded_id) ? $offer->padded_id : $last_id); ?></span>
                                <?php endif; ?>
                            </h4>




                </div>
                <?php echo Form::open([
                'url' => route('priceoffer.store'),
                'method', 'POST',
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