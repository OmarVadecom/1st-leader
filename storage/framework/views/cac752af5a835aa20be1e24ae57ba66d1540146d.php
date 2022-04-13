<?php $__env->startSection('content'); ?>
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title">
                        <?php if(request('type') === '0'): ?>
                            انشاء فاتورة شراء محليه
                        <?php else: ?>
                            انشاء فاتورة شراء دوليه
                        <?php endif; ?>
                    </h4>
  				</div>
          <?php echo Form::open([
              'url' => route('purchases.store'),
			  'method', 'POST',
			  'files'=> true,
              ]); ?>

  				<div class="card-body">
  					<div class="card-block">
  						<?php echo $__env->make('admin.purchases.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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