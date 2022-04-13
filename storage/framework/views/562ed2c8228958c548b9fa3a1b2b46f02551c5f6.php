
<?php $__env->startSection('content'); ?>
<section id="justified-top-border">
	<div class="row match-height">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">ملخص حركه المنتجات</h4>
				</div>
				<?php echo Form::open([
				'url' => route('admin.poststockreport'),
				'method', 'POST'
				]); ?>

				<div class="card-body">
					<div class="card-block">
						<div class="row">

							<div class="col-md-4">
								<div class="col-md-12">
									<div class="form-group">
										<label for="title">اختر المستودع</label>
										<select class="form-control" name="warehouse" id="store">
											<option value="all">كل المستودعات </option>
											<?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="col-md-12">
									<div class="form-group">
										<label for="title">اختر المخزون</label>
										<select class="form-control" name="stock" id="store">
											<option value="all">كل المخزون </option>
											<?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($stock->id); ?>"><?php echo e($stock->name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">اختر المنتج</label>
									<select class="form-control selectproduct" name="product" id="store">
										<option value="all">كل المنتجات </option>
										<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?> | <?php echo e($product->code); ?>

										</option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-6">
								<div class="col-md-12">
									<div class="form-group">
										<label for="title">من تاريخ</label>
										<input type="date" name="date_from" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="title">الي تاريخ</label>
									<input type="date" name="date_to" class="form-control">
								</div>
							</div>
						</div>


						<div class="col-md-12">
							<hr>
							<div class="clear">
								<button type="submit" class="btn btn-primary subm">
									<i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

								</button>
								<a href="/" class="btn btn-danger">
									<i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

								</a>
							</div>
						</div>



					</div>
				</div>
				<?php echo Form::close(); ?>

			</div>
		</div>
	</div>
</section>
<style>
	.select2-container {
		margin-top: 5px !important;
		width: 100% !important;
		direction: rtl;
		text-align: right;
	}
</style>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
	$(".selectproduct").select2();
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>