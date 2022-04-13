<div class="tab-pane  fade" id="menu14">
  <div class="row">
    <div class="col-md-12">
      <?php if(isset($charts) && $charts[0] != ""): ?>
      <?php $__currentLoopData = $charts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$chart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <input id="filechart<?php echo e($key); ?>_name" type="hidden" name="charts_names[]" value="<?php echo e($charts_names[$key]); ?>">
      <input id="filechart<?php echo e($key); ?>_description" type="hidden" name="charts_description[]"
        value="<?php echo e($charts_description[$key]); ?>"> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>

      <div id="filesinputparts" class="form-group">
        <label for="title">اسم المستند </label><br>
        <div class="row">
          <div class="col-md-3">
            <?php echo Form::text("charts_names[]", "", [
            "class" => "form-control",
            "placeholder" => "اسم المستند",
            ]); ?>

          </div>
          <div class="col-md-4">
            <?php echo Form::text("charts_description[]", "", [
            "class" => "form-control",
            "placeholder" => "وصف المستند",
            ]); ?>

          </div>
          <div class="col-md-3">
            <input accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file" name="charts[]">
          </div>
          <div class="col-md-2">
            <button id="addinputparts" class="btn btn-primary"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <br>
      </div>
    </div>


    <?php if(isset($charts) && $charts[0] != ""): ?>
    <div class="col-md-12">
      <div class="card-body collapse in">
        <div class="card-block card-dashboard">
          <table class="table table-striped table-bordered " id="data" style="width:100%;">
            <thead>
              <tr>
                <th>اسم المستند</th>
                <th width="60%">وصف المستند</th>
                <th>تحميل </th>
                <th>حذف </th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $charts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$chart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($charts_names[$key]); ?></td>
                <td><?php echo e($charts_description[$key]); ?></td>
                <td> <a href="<?php echo e(url('/')); ?>/uploads/products-charts/<?php echo e($chart); ?>" class="filechart<?php echo e($key); ?>" download><input
                      id="file<?php echo e($key); ?>" type="hidden" name="charts_edit[]" value="<?php echo e($chart); ?>"> <?php echo e($chart); ?></a></td>
                <td><i id="btu-filechart<?php echo e($key); ?>" style="color:red" class="fa fa-times clickremchart"></i></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <?php endif; ?>

  </div>
</div>