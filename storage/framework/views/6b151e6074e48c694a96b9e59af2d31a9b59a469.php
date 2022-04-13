
<?php $__env->startSection('content'); ?>
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title">ارساله رساله</h4>
  				</div>
          <?php echo Form::open([
              'url' => route('admin.msg.send'),
              'method', 'POST'
              ]); ?>

             <div class="card-body">
              <div class="card-block">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">أختر العميل</label>
                                <select name="user_id" class="form-control" required>
                                    <option value="">أختر العميل</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                    <div class="col-md-6">
             <div class="form-group">
              <label for="title">الرساله</label>
                                    <br>
                <textarea name="message" class="form-control"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                    <i class="icon-check2"></i> ارسال
                </button>
    <?php echo Form::close(); ?>

        </div>
    </div>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>