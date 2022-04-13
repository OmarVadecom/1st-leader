<?php $__env->startSection('content'); ?>
<section id="justified-top-border">
	<div class="row match-height">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">
                        تقرير ورشه
                        <span style="color:#b71c1c">
							<?php echo e($maint->code . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT)); ?>

                        </span>
                    </h4>
				</div>
				<?php echo Form::open([
				'url' => route('maintenance_report.store'),
				'method', 'POST',
				'files'=> true,
				]); ?>

				<div class="card-body">
					<div class="card-block">
						<?php echo $__env->make('admin.maintenance_report.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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