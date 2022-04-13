
<?php $__env->startSection('content'); ?>
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title"><?php echo e(trans('admin.create', ['name' => trans('admin.role')])); ?></h4>
  				</div>
          <?php echo Form::open([
              'url' => route('role.store'),
              'method', 'POST'
              ]); ?>

  				<div class="card-body">
  					<div class="card-block">
  						<!--<p>Use <code>.nav-justified</code> class to set tabs justified.</p>-->
  						<ul class="nav nav-tabs nav-justified">
                <?php $__currentLoopData = $dbLangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="nav-item">
    								<a class="nav-link <?php echo e($key == 0 ? 'active' : ''); ?>" id="<?php echo e($lang->code); ?>-tab" data-toggle="tab" href="#<?php echo e($lang->code); ?>" aria-controls="<?php echo e($lang->code); ?>" aria-expanded="<?php echo e($key == 0 ? 'true' : 'false'); ?>"><?php echo e($lang->name); ?></a>
    							</li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  						</ul>

  						<?php echo $__env->make('admin.role.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  					</div>
  				</div>
          <?php echo Form::close(); ?>

  			</div>
  		</div>
  	</div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script type="text/javascript">

  $(".permission-select").select2({
    placeholder: "<?php echo e(trans('admin.selectSom')); ?>"
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>