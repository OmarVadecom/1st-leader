<div class="tab-pane  active" id="menu1">

    <div class="row bordered">
        <div class="col-md-6">
            <h3 style="text-align: center">منتجات داخليه</h3>
            <table class="table table-striped" style="text-align:center">
                <thead>
                    <tr>
                        <th width="60%">الماده</th>
                        <th width="20%">الكميه</th>
                    </tr>
                </thead>
                <tbody class="productsadd">
                    <?php if(isset($visit)): ?>
                    <?php $__currentLoopData = $inproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$inproduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <select style="width:350px;" name="in_product[]"
                                class="form-control selectproduct selectproducted">
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleproduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($singleproduct->id); ?>" <?php echo e((isset($inproduct) && $inproduct->id ==
                                    $singleproduct->id)? 'selected' : ''); ?>>
                                    <?php echo e($singleproduct->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>

                        <td>
                            <input type="number" value="<?php echo e($inquantities[$key]); ?>" placeholder="الكميه" min="1"
                                class="form-control productquantity" name="in_quantity[]">

                        </td>
                        <td>
                            <i class="fa fa-times clickremrow"></i>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <tr>
                        <td>
                            <select style="width:350px;" name="in_product[]" data-number="0"
                                class="form-control selectproduct selectproducted">
                                <option value="">اختر المنتج</option>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option data-price="<?php echo e($product->price); ?>" data-unit="<?php echo e($product->unit_1); ?>"
                                    data-quantity="<?php echo e($product->quantity); ?>" value="<?php echo e($product->id); ?>">
                                    <?php echo e($product->name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>

                        <td>
                            <input type="number" value="1" placeholder="الكميه" min="1"
                                class="form-control productquantity" name="in_quantity[]">
                        </td>
                        <td>
                            <i class="fa fa-times clickremrow"></i>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <button id="add-product" style="float:left; margin-top:10px;" class="btn btn-success">اضف منتج أخر</button>

        </div>

        <div class="col-md-6">
            <h4 style="text-align: center">منتجات خارجيه</h4>
            <table class="table table-striped" style="text-align:center">
                <thead>
                    <tr>
                        <th width="60%">الماده</th>
                        <th width="20%">الكميه</th>
                    </tr>
                </thead>
                <tbody class="productsadd_2">
                    <?php if(isset($visit)): ?>
                    <?php $__currentLoopData = $outproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$outproduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="out_product[]" value="<?php echo e($outproduct); ?>" id="">
                        </td>
                        <td>
                            <input type="number" value="<?php echo e($outquantities[$key]); ?>" placeholder="الكميه" min="1"
                                class="form-control productquantity" name="out_quantity[]">

                        </td>
                        <td>
                            <i class="fa fa-times clickremrow"></i>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="out_product[]" value="" id="">
                        </td>
                        <td>
                            <input type="number" value="1" placeholder="الكميه" min="1"
                                class="form-control productquantity" name="out_quantity[]">
                        </td>
                        <td>
                            <i class="fa fa-times clickremrow"></i>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <button id="add-product_2" style="float:left; margin-top:10px;" class="btn btn-success">اضف منتج
                أخر</button>
        </div>









    </div>

















</div>