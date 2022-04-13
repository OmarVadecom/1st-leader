<div class="tab-pane fade" id="menu5">
  <div class="row">
    <div class="col-md-12">
      <div id="filesinput" class="form-group">
        <label for="title">المرفقات </label><br>
        <div class="row">
          <div class="col-md-2">
            <select name="attachment_names[]" class="form-control" id="">
              <option value="">اختر التصنيف</option>
              <?php $__currentLoopData = $attachcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($attachcat->name); ?>"><?php echo e($attachcat->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <input type="hidden" name="counter[]" value="0">
          </div>
          <div class="col-md-4">
            <?php echo Form::text("attachment_links[]", "", [
            "class" => "form-control",
            "placeholder" => "لينك المستند",
            ]); ?>

          </div>
          <div class="col-md-2">
            <input accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file" name="attachments[]">
          </div>
          <div class="col-md-2">
            <label class="checkbox-inline"><input type="checkbox" name="attachment_status[]" value="1" checked> مفعل
            </label>
          </div>
          <div class="col-md-2">
            <button id="addinputf" class="btn btn-primary"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <br>
      </div>
      <div class="row">
        <?php if(isset($product)): ?>
        <?php if($attachments[0] != "" || $attachment_links[0] != "" || $attachment_names[0] != ""): ?>
        <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$filename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $attach=\App\Models\AttachmentCat::Where('name',$attachment_names[$key])->first();
        if($attach){
        $attachimg=url('/').'/uploads/attachcat/'.$attach->image;
        }else{
        $attachimg=asset('panel/app-assets/images/emptyimg.jpg');
        }
        ?>
        <div class="col-md-6 centeritems">
          <div class="col-md-3">
            <img src="<?php echo e($attachimg); ?>" alt="<?php echo e($attachment_names[$key]); ?>" style="width: 75px;padding: 6px;">
          </div>
          <div class="col-md-6">
            <select name="attachment_names[]" class="form-control" id="">
              <option value="">اختر التصنيف</option>
              <?php $__currentLoopData = $attachcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($attachcat->name); ?>" <?php echo e(($attachment_names[$key]==$attachcat->name) ? 'selected' : ''); ?>>
                <?php echo e($attachcat->name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php if($filename != ""): ?>
            <a href="<?php echo e(url('/')); ?>/uploads/products-attachments/<?php echo e($filename); ?>" class="file<?php echo e($key); ?>" download>تحميل الملف</a><br>
            <?php endif; ?>
            <?php if(isset($attachment_links[$key]) && $attachment_links[$key] != ""): ?>
            <a href="<?php echo e($attachment_links[$key]); ?>" target="_blank"><?php echo e($attachment_links[$key]); ?></a>
            <?php endif; ?>
            <select name="attachment_status[]">
              <option value="1" <?php echo e((isset($attachment_status[$key])) ? $attachment_status[$key]==1 ? 'selected' : ''
                : 'selected'); ?>>مفعل</option>
              <option value="0" <?php echo e((isset($attachment_status[$key])) ? $attachment_status[$key]==0 ? 'selected' : ''
                : 'selected'); ?>>غير مفعل</option>
            </select>

            <!-- <label class="checkbox-inline"><input type="checkbox" name="attachment_status[]" <?php echo e((isset($attachment_status[$key])) ? $attachment_status[$key] == 1 ? 'checked' : '' : 'checked'); ?> value="1"> مفعل </label>-->

          </div>
          <div class="col-md-3">
            <i id="btu-file<?php echo e($key); ?>" style="color:red" class="fa fa-times clickrem"></i>
          </div>
          <input id="file<?php echo e($key); ?>" type="hidden" name="attachments_edit[]" value="<?php echo e($filename); ?>">
          
          <input id="file<?php echo e($key); ?>_link" type="hidden" name="attachment_links[]"
            value="<?php echo e(isset($attachment_links[$key]) ? $attachment_links[$key] : ''); ?>">
        </div>




        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>