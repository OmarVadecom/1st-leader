<div class="row">

    <div class="col-md-6">

        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
            <label><?php echo e(trans('admin.name', ['name' => trans('admin.user')])); ?></label>

            <?php echo Form::text("name", null, [
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
    </div> <!-- /.col -->
    <?php if(!isset($user)): ?>
        <div class="col-md-6">
            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                <label><?php echo e(trans('admin.password')); ?></label>
                <?php echo Form::password("password", [
                'class' => 'form-control',
                'placeholder' => trans('admin.password'),
                'required'
                ]); ?>

                <?php if($errors->has('password')): ?>
                    <span class="help-block">
        <strong style="color:red"><?php echo e($errors->first('password')); ?></strong>
      </span>
                <?php endif; ?>
            </div><!-- /.form-group -->
        </div> <!-- /.col -->
    <?php else: ?>
        <div class="col-md-6">
            <div class="form-group">

                <label><?php echo e(trans('admin.password')); ?></label><br/>
                <a href="#" onclick="changePass();"><?php echo e(trans('admin.changePass')); ?></a><br/><br/><br/><br/>
            </div>
        </div> <!-- /.col -->
    <?php endif; ?>


</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
            <label><?php echo e(trans('admin.email')); ?></label>
            <?php echo Form::email("email", null, [
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

    <div class="col-md-6" style="">
        <div class="form-group<?php echo e($errors->has('isAdmin') ? ' has-error' : ''); ?>">
            <label><?php echo e(trans('admin.role')); ?></label>
            <?php echo Form::select("isAdmin", admin_roles(), null, [
            'class' => 'form-control',
            'id' => 'isAdmin',
            'onchange' => 'getRoles(this.value);'
            ]); ?>

            <?php if($errors->has('isAdmin')): ?>
                <span class="help-block">
        <strong style="color:red"><?php echo e($errors->first('isAdmin')); ?></strong>
      </span>
            <?php endif; ?>
        </div><!-- /.form-group -->
    </div><!-- /.col -->


</div>
<div class="row">
    <div class="col-md-6 role-group">
        <div class="form-group<?php echo e($errors->has('role_id') ? ' has-error' : ''); ?>">
            <label><?php echo e(trans('admin.roles')); ?></label>
            <?php echo Form::select("role_id", $roles, null, [
            'class' => 'form-control',
            ]); ?>

            <?php if($errors->has('role_id')): ?>
                <span class="help-block">
        <strong style="color:red"><?php echo e($errors->first('role_id')); ?></strong>
      </span>
            <?php endif; ?>
        </div><!-- /.form-group -->
    </div><!-- /.col -->

    <div class="col-md-6">
        <label>حاله العضو</label>
        <select class="form-control" name="type">
            <option value="">اختر حاله العضو</option>
            <option value="1" <?php if(isset($user) && $user->type === 1): ?> selected <?php endif; ?>>فني</option>
            <option value="2" <?php if(isset($user) && $user->type === 2): ?> selected <?php endif; ?>>محضر</option>
            <option value="3" <?php if(isset($user) && $user->type === 3): ?> selected <?php endif; ?>>مسلم</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="branch">الفرع</label>
        <select class="form-control" name="branch" id="branch">
            <option value="">اختر الفرع الخاص بهذا العضو</option>
            <option value="dam" <?php if(isset($user) && $user->branch === 'dam'): ?> selected <?php endif; ?>>فرع الدمام</option>
            <option value="Wsh" <?php if(isset($user) && $user->branch === 'Wsh'): ?> selected <?php endif; ?>>فرع الورشة</option>
            <option value="exh" <?php if(isset($user) && $user->branch === 'exh'): ?> selected <?php endif; ?>>فرع المعرض</option>
        </select>
    </div>
</div>

<!--<div class="col-md-12">
                      <label><?php echo e(trans('admin.status')); ?></label>

                    <input type="checkbox" class="checkbtnC" name="state" <?php if(isset($user)): ?> <?php if($user->state == 1): ?> checked="checked" <?php endif; ?> <?php else: ?> checked="checked"  <?php endif; ?> />
                   </div> -->


<div class="col-md-12">
    <hr>
    <div class="clear">
        <button type="submit" class="btn btn-primary">
            <i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

        </button>
        <a href="<?php echo e(route('users.index')); ?>" class="btn btn-danger">
            <i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

        </a>
    </div>
</div>


<div class="modal fade changePass" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo e(trans('admin.changePass')); ?></h4>
            </div>
            <div class="modal-body">
                <span><?php echo e(trans('admin.password')); ?></span>
                <input type="password" id="password" placeholder="<?php echo e(trans('admin.password')); ?>" class="form-control">
                <br/>
                <div class="errors" style="display: none"></div>
                <div class="load" style=""></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('admin.cancel')); ?></button>
                <?php $word = trans('admin.updated', ['name' => trans('admin.password')]) ?>
                <button type="button" class="btn btn-primary" data-url="<?php echo e(route('admin.changePass.ajax')); ?>"
                        onclick="updatePassRequest(this, '<?php echo e($word); ?>')"><?php echo e(trans('admin.save')); ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $__env->startSection('script'); ?>
    <script>
        $("#isAdmin").val(1);
        $('select[name="role_id"]').val(1);
    </script>
<?php $__env->stopSection(); ?>
