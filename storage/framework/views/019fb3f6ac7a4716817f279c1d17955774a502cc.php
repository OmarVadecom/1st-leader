
<?php $__env->startSection('content'); ?>
<section id="justified-top-border">
	<div class="row match-height">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">
						تعديل مورد
						<span class="pull-left">
						</span>
					</h4>
				</div>
				<?php echo Form::model($supplier ,[
				'method' => 'PATCH',
				'route' => ['supplier.update', $supplier->id],
				'files' => true
				]); ?>

				<input type="hidden" value="<?php echo e($supplier->id); ?>" name="id">
				<div class="card-body">
					<div class="card-block">
						<?php echo $__env->make('admin.supplier.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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