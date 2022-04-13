<div class="tab-pane fade" id="menu3">

    <div class="col-md-12">
      <table class="table table-striped" style="text-align:center">
        <thead>
          <tr>
            <th style="width:40%">الماده</th>
            <th style="width:40%">الكميه</th>
            <th style="width:20%">اجباريه</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="productsadd">
          <div class="form-group ">
            <?php if(isset($productssssssssssssss)): ?>
            <?php $__currentLoopData = $productsgro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$productg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $singleproduct=\App\Models\Products::find($productg);
            ?>
            <tr>
              <td>
                <select style="width:350px;" name="product[]" class="form-control selectproduct">
                  <option value="">اختر المنتج</option>
                  <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if(isset($singleproduct)): ?>
                  <option value="<?php echo e($prod->id); ?>" <?php echo e(($prod->id == $singleproduct->id) ? 'selected' : ''); ?>>
                    <?php echo e($prod->code); ?> | <?php echo e($prod->name); ?></option>
                  <?php else: ?>
                  <option value="<?php echo e($prod->id); ?>">
                    <?php echo e($prod->code); ?> | <?php echo e($prod->name); ?></option>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </td>
              <td>
                <input type="number" value="<?php echo e($quantities[$key]); ?>" placeholder="الكميه" min="1"
                  class="form-control productquantity" name="quantity[]">

              </td>
              <td>
                <div class="checkbox">
                  <input type="hidden" name="group_status[<?php echo e($key); ?>]" value="" />
                  <label><input type="checkbox" name="group_status[<?php echo e($key); ?>]"
                      <?php echo e(($group_statuss[$key]==1) ? 'checked' : ''); ?>> اجباريه </label>
                </div>
              </td>

              <td>
                <i class="fa fa-times clickremrow"></i>
              </td>
            </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <tr>
              <td>
                <select style="width:350px;" name="" class="form-control selectproduct">
                  <option value="">اختر المنتج</option>
                  <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($product->id); ?>"><?php echo e($product->code); ?> | <?php echo e($product->name); ?>

                  </option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </td>
              <td>
                <input type="number" value="1" placeholder="الكميه" min="1" class="form-control productquantity"
                  name="quantity[]">
              </td>
              <td>
                <div class="checkbox">
                  
                </div>
              </td>
              <td>
                <i class="fa fa-times clickremrow"></i>
              </td>
            </tr>
            <?php endif; ?>
          </div>
        </tbody>
      </table>
      <button id="add-product-1" style="float:left; margin-top:10px; margin-bottom:10px;" class="btn btn-success">اضف منتج أخر</button>
    </div>
    <br>
    <div class="col-md-4">
        <label for=""> نظام الاحتساب </label>
        <select name="" class="form-control" id="">
            <option value=""> نظام الاحتساب </option>
            <option value="1">في حاله البيع</option>
            <option value="0">في حاله الشراء</option>
                    </select>
    </div>
    <div class="col-md-4">
        <label for="">حاله اجره التجميع</label>
        <select name="" class="form-control" id="">
<option value="">حاله اجره التجميع</option>
<option value="1">نعم</option>
<option value="0">لا</option>
        </select>
    </div>

    <div class="col-md-4">
        <label for="">اجره التجميع </label>

        <input type="text" class="form-control" placeholder="اجره التجميع" name="" id="">
    </div>
  </div>