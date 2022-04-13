<div class="tab-content px-1 pt-1">
  <?php $__currentLoopData = $dbLangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div role="tabpanel" class="tab-pane fade <?php echo e($key == 0 ? 'active in' : ''); ?>" id="<?php echo e($lang->code); ?>"
    aria-labelledby="<?php echo e($lang->code); ?>-tab" aria-expanded="<?php echo e($key == 0 ? 'true' : 'false'); ?>">
    <div class="col-md-12">
      <div class="form-group">
        <label for="title"><?php echo e(trans('admin.name', ['name' => trans('admin.role', [], $lang->code)], $lang->code)); ?></label>

        <?php echo Form::text('name['.$lang->code.']',
        checkVar($act, $role, $lang->code, 'name','name.'.$lang->code),
        array('class'=>'form-control')); ?>

        <?php if($errors->has('name.'.$lang->code)): ?>
        <span class="help-block">
          <strong><?php echo e($errors->first('name.'.$lang->code)); ?></strong>
        </span>
        <?php endif; ?>
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
        <label for="title"><?php echo e(trans('admin.comment', [], $lang->code)); ?>

        </label>

        <?php echo Form::textarea('comment['.$lang->code.']',
        checkVar($act, $role, $lang->code, 'comment','comment.'.$lang->code),
        array(
        'class'=>'form-control',
        'maxlength' => 250)
        ); ?>

        <?php if($errors->has('comment.'.$lang->code)): ?>
        <span class="help-block">
          <strong><?php echo e($errors->first('comment.'.$lang->code)); ?></strong>
        </span>
        <?php endif; ?>
      </div>
    </div>

  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  <div class="col-md-12">
    <hr>
    <h4><i class="fa fa-bookmark"></i> <?php echo e(trans('admin.shared_values')); ?></h4>
    <div class="col-md-6 col-sm-4">
      <div class="form-group">
        <label for="status"><?php echo e(trans('admin.permissions')); ?></label>
        <select class="permission-select js-states form-control" multiple="multiple" name="permissions[]">
          <?php $__currentLoopData = admin_permissions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <optgroup label="<?php echo e(trans('admin.'. $perm)); ?>">
            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($permission->for == $perm): ?>
            <option value="<?php echo e($permission->id); ?>" <?php if(old('permissions')): ?> <?php if(in_array($permission->id,
              old('permissions'))): ?>
              selected
              <?php endif; ?>
              <?php elseif($role != null): ?>
              <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permiss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($permiss->id == $permission->id): ?>
              selected
              <?php break; ?>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
              >
              <?php echo e(trans('admin.'.$permission->name, ['name' => trans('admin.'. $perm)])); ?>

            </option>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </optgroup>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php if($errors->has('permissions')): ?>
        <span class="help-block">
          <strong><?php echo e($errors->first('permissions')); ?></strong>
        </span>
        <?php endif; ?>
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
        <label for="status"><?php echo e(trans('admin.status')); ?></label>

        <input type="checkbox" class="checkbtnC" name="status" <?php if($act=='edit' ): ?> <?php if($role->status == 1): ?>
        checked="checked" <?php endif; ?> <?php else: ?> checked="checked" <?php endif; ?> />

      </div>
    </div>
  </div>
  <div class="col-md-12">
    <hr>
    <div class="clear">
      <button type="submit" class="btn btn-primary">
        <i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

      </button>
      <a href="<?php echo e(route('role.index')); ?>" class="btn btn-danger">
        <i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

      </a>
    </div>
  </div>
</div>