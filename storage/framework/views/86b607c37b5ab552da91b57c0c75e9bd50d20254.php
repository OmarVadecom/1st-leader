<?php $__env->startSection('content'); ?>
<section id="justified-top-border">
	<div class="row match-height">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">
						<?php if(request('main_type') === '1'): ?>
                            تعديل فاتورة بيع طلبات ورشه
                        <?php elseif(request('main_type') === '2'): ?>
                            تعديل فاتورة بيع طلبات الصيانه الخارجيه
						<?php elseif(request('main_type') === '3'): ?>
							تعديل فاتورة بيع داخليه
                        <?php elseif(request('main_type') === '4'): ?>
                            تعديل فاتورة بيع زيارة ميدانيه
                        <?php elseif(request('main_type') === '5'): ?>
                            تعديل فاتورة بيع مركز الاتصالات
                        <?php else: ?>
                            تعديل فاتورة بيع معرض
                        <?php endif; ?>
						<span class="pull-left">
						</span>
					</h4>
				</div>
				<?php echo Form::model($offer ,[
				'method' => 'PATCH',
				'route' => ['sells.update', $offer->id],
				'files' => true
				]); ?>

				<input type="hidden" value="<?php echo e($offer->id); ?>" name="id">
				<?php echo $__env->make('admin.sell.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php echo Form::close(); ?>

			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>