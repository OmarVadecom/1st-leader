<?php $__env->startSection('content'); ?>
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
					  <?php if(\Request::get('type') == 1): ?>
  					<h4 class="card-title">إضافه سند قبض</h4>

					  <?php else: ?>
  					<h4 class="card-title">إضافه سند صرف</h4>

					  <?php endif; ?>
  				</div>
          <?php echo Form::open([
              'url' => route('sanadat.store'),
			  'method', 'POST',
			  'files'=> true,
              ]); ?>

  				<div class="card-body">
  					<div class="card-block">
  						<?php echo $__env->make('admin.sanadat.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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