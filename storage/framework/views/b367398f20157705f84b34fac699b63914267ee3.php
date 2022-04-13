<?php $__env->startSection('content'); ?>
<?php
$last_id = $entry->id;
$last_id=str_pad($last_id, 4, '0', STR_PAD_LEFT);
$last_id = 'ENT-'.$last_id;
?>
<section id="justified-top-border">
  <div class="row match-height">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">
            تعديل ادخال <?php echo e($last_id); ?>

            <span class="pull-left">
            </span>
          </h4>
        </div>
        <?php echo Form::model($entry ,[
        'method' => 'PATCH',
        'route' => ['supplies.update', $entry->id],
        'files' => true
        ]); ?>

        <input type="hidden" value="<?php echo e($entry->id); ?>" name="id">
        <div class="card-body">
          <div class="card-block">

            <?php echo $__env->make('admin.supplies.form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

          </div>
        </div>
        <?php echo Form::close(); ?>

      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
  $(document).on('change','.select-stock',function(){
		var selected_id = $(this).children("option:selected").val();
      $.ajax({
            dataType: "json",
            url: "<?php echo e(route('admin.supplies.get_warehouses')); ?>",
            data: {
                'stock_id': selected_id,
            },
            success: function(data) {
              $(".warehouse").empty();
              $(".warehouse").append('<option value="">اختر المستودع</option>');
                for (var i = 0; i < data.length; i++) {
                   $(".warehouse").append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
                }
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>