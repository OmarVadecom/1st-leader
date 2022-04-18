<?php $__env->startSection('content'); ?>
    <!doctype html>

<?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<div class="container">
    <div class="row">
        <div class="col-md-8"><h2>اضافة مرفقات لعروض الاسعار المعمدة على دفعات</h2>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="<?php echo e(route('priceoffer.multiuploads',$offer->id)); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <label for="">اضافة مرفقات :</label>
                <br />
                <select name="type">
                    <option disabled selected>اختر نوع المرفق</option>
                    <option value="كفالة غرم">كفالة غرم</option>
                    <option value=" كمبياله"> كمبياله</option>
                    <option value=" بيع اجل"> بيع اجل</option>
                    <option value=" كروكى "> كروكى </option>
                </select>
                <br>
                <br>
                <input type="file" class="form-control" name="attach" multiple />
                <br /><br />
                <input type="submit" class="btn btn-primary" value="Upload" />
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>