<div class="tab-pane fade" id="menu5">
    <div class="row">
        <div class="col-md-12">

            <?php if(isset($product) && $attachments[0] != ""): ?>
                <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$filename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input id="file<?php echo e($key); ?>" type="hidden" name="attachments_edit[]" value="<?php echo e($filename); ?>">
                    <input id="file<?php echo e($key); ?>_name" type="hidden" name="attachment_names[]"
                        value="<?php echo e($attachment_names[$key]); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>


            <div id="filesinput" class="form-group">
                <label for="title">المرفقات </label><br>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo Form::text("attachment_names[]", "", [
                        "class" => "form-control",
                        "placeholder" => "اسم المستند",
                        ]); ?>

                    </div>
                    <div class="col-md-4">
                        <input accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file"
                            name="attachments[]">
                    </div>
                    <div class="col-md-2">
                        <button id="addinputf" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <br>
            </div>

            <?php if(isset($product) && $attachments[0] != ""): ?>
                <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$filename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(url('/')); ?>/uploads/products-attachments/<?php echo e($filename); ?>"
                        class="file<?php echo e($key); ?>" download><span
                            style="color:#000; margin-left: 10px;"><?php echo e($attachment_names[$key]); ?>: </span>
                        <?php echo e($filename); ?> </a>
                    <i id="btu-file<?php echo e($key); ?>" style="color:red" class="fa fa-times clickrem"></i>
                    <br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

        </div>
    </div>
</div>
