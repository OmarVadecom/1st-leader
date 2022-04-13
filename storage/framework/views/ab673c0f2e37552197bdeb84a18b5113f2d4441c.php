<?php $__env->startSection('content'); ?>
<section id="justified-top-border">
  <div class="row match-height">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">اعدادات السيستم</h4>
        </div>
        <?php echo Form::open([
        'url' => route('admin.settings.update'),
        'method', 'POST',
        'files' => true
        ]); ?>

        <div class="card-body">
          <div class="card-block">
            <!--<p>Use <code>.nav-justified</code> class to set tabs justified.</p>-->
            <ul class="nav nav-tabs nav-justified">
              <?php $__currentLoopData = getAllLangFromDB(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="nav-item">
                <a class="nav-link <?php echo e($key == 0 ? 'active' : ''); ?>" id="<?php echo e($lang->code); ?>-tab" data-toggle="tab"
                  href="#<?php echo e($lang->code); ?>" aria-controls="<?php echo e($lang->code); ?>"
                  aria-expanded="<?php echo e($key == 0 ? 'true' : 'false'); ?>"><?php echo e($lang->name); ?></a>
              </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <div class="tab-content px-1 pt-1">
              <?php $__currentLoopData = $dbLangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div role="tabpanel" class="tab-pane fade <?php echo e($key == 0 ? 'active in' : ''); ?>" id="<?php echo e($lang->code); ?>"
                aria-labelledby="<?php echo e($lang->code); ?>-tab" aria-expanded="<?php echo e($key == 0 ? 'true' : 'false'); ?>">
                <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($setting->lang != $lang->code): ?>
                <?php continue; ?>
                <?php endif; ?>
                <div class="form-group">
                  <label for="<?php echo e($setting->name.'['.$setting->lang.']'); ?>"><?php echo e($setting->slug); ?></label>
                  <?php if($setting->type == 'text'): ?>
                  <?php echo Form::text($setting->name.'['. $setting->lang .']', $setting->value, ['class' => 'form-control']); ?>


                  <?php elseif($setting->type == 'textarea'): ?>
                  <?php echo Form::textarea($setting->name.'['.$setting->lang.']', $setting->value, ['class' =>
                  'form-control']); ?>


                  <?php elseif($setting->type == 'editor'): ?>
                  <?php echo Form::textarea($setting->name .'['.$setting->lang.']', $setting->value, ['class' => 'form-control
                  ckeditor']); ?>


                  <?php elseif($setting->type == 'hidden'): ?>
                  <?php echo Form::hidden($setting->name .'['.$setting->lang.']', $setting->value, ['class' => 'form-control']); ?>


                  <?php elseif($setting->type == 'select'): ?>
                  <?php echo Form::select($setting->name .'['.$setting->lang.']', $setting->select_options, $setting->value,
                  ['class' => 'form-control']); ?>


                  <?php elseif($setting->type == 'color'): ?>
                  <?php echo Form::color($setting->name .'['.$setting->lang.']', $setting->value, ['class' => 'form-control']); ?>


                  <?php elseif($setting->type == 'aceeditor'): ?>
                  <?php echo Form::textarea($setting->name.'['.$setting->lang.']', $setting->value, ['class' =>
                  'form-control']); ?>



                  <div id="<?php echo e($setting->name.'['.$setting->lang.']'); ?>" style="height:350px;">
                    <?php echo $setting->value; ?>

                  </div>

                  <?php elseif($setting->type == 'file'): ?>
                  <br>
                  <input class="btn btn-primary" type="file" accept=".jpg,.png,.jpeg"
                    name="<?php echo e($setting->name.'['. $setting->lang .']'); ?>"><br>
                  <?php if($setting->value != null): ?>
                  <img src="<?php echo e(url('/')); ?>/uploads/logo/<?php echo e($setting->value); ?>" alt="<?php echo e($setting->name); ?>"
                    style="width:280px; margin-top:10px;">
                  <?php endif; ?>
                  <?php else: ?>
                  <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <!--<div class="form-group">
                       <label for=""><?php echo e(trans('admin.simages')); ?></label>

                      <a href=""></a>
                </div>-->

              <div class="clear">
                <button type="submit" class="btn btn-primary">
                  <i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

                </button>
              </div>
            </div>

          </div>
        </div>
        <?php echo Form::close(); ?>

      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>