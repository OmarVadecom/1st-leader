<?php if(Session::has('flash_message')): ?>
	<script type="text/javascript">
		swal({
		  title: "<?php echo e(Session::get('flash_message')); ?>",
		  text: "<?php echo e(trans('admin.autoC', ['num' => trans('admin.sec')])); ?>",
		  imageUrl: "<?php echo e(Request::root().'/cus/alert/alert.png'); ?>",
		  timer: 1000,
		  showConfirmButton: false
		});
	</script>
<?php endif; ?>

<?php if(Session::has('cusMessage')): ?>
	<script type="text/javascript">
		swal({
		  title: "<?php echo e(Session::get('cusMessage')); ?>",
		  text: "<?php echo e(trans('admin.autoC', ['num' => trans('admin.sec')])); ?>",
		  imageUrl: "<?php echo e(Request::root().'/public/cus/alert/alert2.png'); ?>",
		  timer: 1000,
		  showConfirmButton: false
		});
	</script>
<?php endif; ?>

<?php if(isset($delMessage)): ?>
	<script type="text/javascript">
		swal({
		  title: "<?php echo e($delMessage); ?>",
		  text: "<?php echo e(trans('admin.autoC', ['num' => trans('admin.sec')])); ?>",
		  imageUrl: "<?php echo e(Request::root().'/public/cus/alert/alert2.png'); ?>",
		  timer: 1000,
		  showConfirmButton: true
		});
	</script>
<?php endif; ?>