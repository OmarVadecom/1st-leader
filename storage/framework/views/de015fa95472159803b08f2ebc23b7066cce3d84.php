
<?php $__env->startSection('content'); ?>
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title"><?php echo e(trans('admin.edit', ['name' => trans('admin.user')])); ?></h4>
  				</div>

             <?php echo Form::open([
              'url' => route('users.update.info'),
              'method', 'POST',
              'files' => true,
              ]); ?>

  				<div class="card-body">
  					<div class="card-block">
  						<!--<p>Use <code>.nav-justified</code> class to set tabs justified.</p>-->
              <input type="hidden" id="id" value="<?php echo e($userAuth->id); ?>" name="id">
  						
              <div class="col-md-6">

                  <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                    <label><?php echo e(trans('admin.name', ['name' => trans('admin.user')])); ?></label>

                    <?php echo Form::text("name", $userAuth->name, [
                    'class' => 'form-control',
                    'placeholder' => trans('admin.name', ['name' => trans('admin.user')]),
                    'required'
                    ]); ?>

                    <?php if($errors->has('name')): ?>
                    <span class="help-block">
                        <strong style="color:red"><?php echo e($errors->first('name')); ?></strong>
                    </span>
                    <?php endif; ?>
                  </div><!-- /.form-group -->

                   
                  <div class="form-group">
                    <div class="col-md-6">
                       <label><?php echo e(trans('admin.password')); ?></label><br />
                    <a href="#" onclick="changePass();"><?php echo e(trans('admin.changePass')); ?></a><br /><br /><br /><br />
                    </div>
                  </div>

                </div><!-- /.col -->


                <div class="col-md-6">
                  <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <label><?php echo e(trans('admin.email')); ?></label>
                    <?php echo Form::email("email", $userAuth->email, [
                    'class' => 'form-control',
                    'placeholder' => trans('admin.email'),
                    'required'
                    ]); ?>

                    <?php if($errors->has('email')): ?>
                    <span class="help-block">
                        <strong style="color:red"><?php echo e($errors->first('email')); ?></strong>
                    </span>
                    <?php endif; ?>        
                  </div><!-- /.form-group -->
                 

                </div><!-- /.col -->           
                 
                  
                <div class="col-md-12">
                  <hr>
                  <div class="clear">
                  <button type="submit" class="btn btn-primary">
                    <i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

                  </button>
                </div>
                </div>

                 
<div class="modal fade changePass" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo e(trans('admin.changePass')); ?></h4>
      </div>
      <div class="modal-body">
        <span><?php echo e(trans('admin.password')); ?></span>
        <input type="password" id="password" placeholder="<?php echo e(trans('admin.password')); ?>" class="form-control">
        <br />
        <div class="errors" style="display: none"></div>
        <div class="load" style=""></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('admin.cancel')); ?></button>
        <?php $word = trans('admin.updated', ['name' => trans('admin.password')]) ?>
        <button type="button" class="btn btn-primary" data-url="<?php echo e(route('admin.changePass.ajax')); ?>" onclick="updatePassRequest(this, '<?php echo e($word); ?>')"><?php echo e(trans('admin.save')); ?></button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>