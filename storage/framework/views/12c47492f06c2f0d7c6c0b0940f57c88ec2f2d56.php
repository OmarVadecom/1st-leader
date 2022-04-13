<div class="tab-pane fade" id="menu30">
    <h5 style="text-align:center; margin-bottom:15px;">المنتجات المسجله</h5>
    <div class="col-md-1">
    </div>
    <div class="col-md-8">
        <div id="addproductsin" class="form-group">
            <?php if(isset($productsin)): ?>
                <?php $__currentLoopData = $productsin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <select name="products_in[]" class="form-control tagsadd" id="">
                        <option value="">اختر المنتج</option>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($product->id); ?>"
                                <?php echo e(($product->id == $productin->id) ? 'selected' : ''); ?>>
                                <?php echo e($product->name); ?> |
                                <?php echo e($product->code); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <select name="products_in[]" class="form-control tagsadd" id="">
                    <option value="">اختر المنتج</option>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?> | <?php echo e($product->code); ?> </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>
            <?php endif; ?>
            <br>
        </div><!-- /.form-group -->
    </div>
    <div class="col-md-3">
        <button id="add-pro-in" style="float: left;" class="btn btn-success">اضافه منتج اخر</button>
    </div>

    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
        <hr>
        <h5 style="text-align:center; margin-bottom:15px;"> وتحتوي علي (قطع غيار)</h5>
        <div class="col-md-1">
        </div>
        <div class="col-md-8">
            <div id="addpartsin" class="form-group">
                <?php if(isset($partsin) && $partsin[0] != ""): ?>
                    <?php $__currentLoopData = $partsin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <select name="parts_in[]" class="form-control tagsadd" id="">
                            <option value="">اختر القطعه</option>
                            <?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singlepart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($singlepart->id); ?>"
                                    <?php echo e(($singlepart->id == $partin) ? 'selected' : ''); ?>>
                                    <?php echo e($singlepart->name); ?> | <?php echo e($singlepart->code); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select><br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <select name="parts_in[]" class="form-control tagsadd" id="">
                        <option value="">اختر القطعه</option>
                        <?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singlepart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($singlepart->id); ?>"><?php echo e($singlepart->name); ?> |
                                <?php echo e($singlepart->code); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                <?php endif; ?>
                <br>
            </div><!-- /.form-group -->
        </div>
        <div class="col-md-3">
            <button id="add-part-in" style="float: left;" class="btn btn-success">اضافه قطعه اخري</button>
        </div>
    </div>
    <div class="col-md-12">
        <hr>
        <br><br>
        <h5 style="text-align:center; margin-bottom:15px;">المنتجات الغير مسجله</h5>

        <table class="table table-striped" style="text-align:center">
            <thead>
                <tr>
                    <th style="width:20%">رقم القطعه </th>
                    <th style="width:15%">الشركه</th>
                    <th style="width:20%">اسم الوكيل</th>
                    <th style="width:20%">الصوره </th>
                    <th style="width:1%"></th>
                </tr>
            </thead>
            <tbody class="pro-in-add">
                <div class="form-group ">
                    <?php if(isset($productsout)): ?>
                        <?php $__currentLoopData = $productsout; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo e($productout->code); ?>" class="form-control"
                                        name="product_out_code[]">
                                </td>
                                <td>
                                    <input type="text" value="<?php echo e($productout->company); ?>" min="1" class="form-control"
                                        name="product_out_company[]">
                                </td>
                                <td>
                                    <input type="text" value="<?php echo e($productout->wakel); ?>" class="form-control"
                                        name="product_out_wakel[]">
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="product_out-files[]">
                                    <input type="hidden" value="<?php echo e($productout->image); ?>" name="old_outimage[]"
                                        class="form-control">

                                    <img style="width:100px" src="<?php echo e(url('/')); ?>/uploads/products-parts-out/<?php echo e($productout->image); ?>"
                                        alt="<?php echo e($productout->name); ?>">
                                </td>
                                <td>
                                    <i class="fa fa-times clickremmarket"></i>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td>
                                <input type="text" placeholder="رقم الفطعه" class="form-control"
                                    name="product_out_code[]">
                            </td>
                            <td>
                                <input type="text" placeholder="الشركه" min="1" class="form-control"
                                    name="product_out_company[]">
                            </td>
                            <td>
                                <input type="text" placeholder="اسم الوكيل " class="form-control"
                                    name="product_out_wakel[]">
                            </td>
                            <td>
                                <input type="file" class="form-control" name="product_out-files[]">
                            </td>
                            <td>
                                <i class="fa fa-times clickremproin"></i>
                            </td>
                        </tr>
                    <?php endif; ?>
                </div>
            </tbody>
        </table>
        <button id="add-product-pro-in" style="float:left; margin-top:10px; margin-bottom:10px;"
            class="btn btn-success">اضف
            بيانات أخري</button>
    </div>


</div>
