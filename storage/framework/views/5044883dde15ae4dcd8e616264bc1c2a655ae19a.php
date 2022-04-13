
<?php $__env->startSection('content'); ?>
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title"><?php echo e(trans('admin.create', ['name' => trans('admin.user')])); ?></h4>
  				</div>
          <?php echo Form::open([
              'url' => route('users.store'),
              'method', 'POST',
              'files' => true
              ]); ?>

  				<div class="card-body">
  					<div class="card-block">
  						<!--<p>Use <code>.nav-justified</code> class to set tabs justified.</p>-->

  						<?php echo $__env->make('admin.user.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  					</div>
  				</div>
          <?php echo Form::close(); ?>

  			</div>
  		</div>
  	</div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  var role = $('#isAdmin').val();
  getRoles(role);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>