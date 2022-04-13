<div class="tab-pane  active" id="home">
    <div class="row">
        <div class="col-md-6">


            <div class="form-group">
                <label>الشركه </label> <br>
                <select name="brand_id" class="form-control tagsadd">
                    <option value="">أختر الشركه </option>
                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($brand->id); ?>"
                            <?php echo e((isset($product) && $brand->id==$product->brand_id) ? 'selected' : ''); ?>>
                            <?php echo e($brand->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div><!-- /.form-group -->

            <div class="form-group">
                <label> المنشأ</label>
                <br>
                <select name="origin_id" class="form-control tagsadd">
                    <option value="">اختر المنشأ</option>
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($country->id); ?>"
                            <?php echo e((isset($product) && $country->id==$product->origin_id) ? 'selected' : ''); ?>>
                            <?php echo e($country->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div><!-- /.form-group -->


            <div class="form-group">
                <label> الصناعه</label><br>
                <select name="country_id" class="form-control tagsadd">
                    <option value=""> الصناعه</option>
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($country->id); ?>"
                            <?php echo e((isset($product) && $country->id==$product->country_id) ? 'selected' : ''); ?>>
                            <?php echo e($country->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div><!-- /.form-group -->


            <div class="form-group">
                <label>اللون</label>
                <br>
                <select name="color" class="form-control tagsadd">
                    <option value="">اختر اللون</option>
                    <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($color->id); ?>"
                            <?php echo e((isset($product) && $color->id==$product->color) ? 'selected' : ''); ?>>
                            <?php echo e($color->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div><!-- /.form-group -->

            <div class="form-group">
                <label>التفعيلات</label><br>
                <div class="col-md-6">
                    <label><input type="checkbox" name="maintenance" value="1"
                            <?php echo e((isset($product) && $product->maintenance==1) ? 'checked' : ''); ?>>
                        الصيانه </label>
                </div>
                <div class="col-md-6">

                    <label><input type="checkbox" name="hidden" value="1"
                            <?php echo e((isset($product) && $product->hidden==1) ? 'checked' : ''); ?>>
                        اخفاء </label>

                </div>
            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">
                <label>نوع المنتج</label>
                <select class="form-control" name="type">
                    <option value="">اختر نوع المنتج</option>
                    <option value="1"
                        <?php echo e((isset($product) && $product->type==1) ? 'selected' : ''); ?>>
                        مستودعي</option>
                    <option value="2"
                        <?php echo e((isset($product) && $product->type==2) ? 'selected' : ''); ?>>
                        مخزون</option>
                </select>
            </div>

            <div class="form-group">
                <label>رمز الترقيم</label>
                <select class="form-control" name="code_type" required>
                    <option value="">رمز الترقيم</option>
                    <option value="EA"
                        <?php echo e((isset($product) && $product->code_type=='EA') ? 'selected' : ''); ?>>
                        EA</option>
                    <option value="ES"
                        <?php echo e((isset($product) && $product->code_type=='ES') ? 'selected' : ''); ?>>
                        ES</option>
                </select>
            </div>





            <div class="form-group">
                <label>فئه المنتج </label>
                <select class="form-control" name="product_type">
                    <option value="">اختر فئه المنتج</option>
                    <option value="1"
                        <?php echo e((isset($product) && $product->product_type==1) ? 'selected' : ''); ?>>
                        رئيسي</option>
                    <option value="2"
                        <?php echo e((isset($product) && $product->product_type==2) ? 'selected' : ''); ?>>
                        تجميعي</option>
                </select>
            </div>

            <div class="form-group">
                <label>كرت الضمان</label>
                <select class="form-control" name="insurance">
                    <option value="">اختر كرت الضمان</option>
                    <option value="3 اشهر"
                        <?php echo e(($product && $product->insurance == '3 اشهر') ? 'selected' : ''); ?>>
                        3 اشهر</option>
                    <option value="6 اشهر"
                        <?php echo e(($product && $product->insurance == '6 اشهر') ? 'selected' : ''); ?>>
                        6 اشهر</option>
                    <option value="1 سنه"
                        <?php echo e(($product && $product->insurance == '1 سنه') ? 'selected' : ''); ?>>
                        1 سنه</option>
                    <option value="2 سنه"
                        <?php echo e(($product && $product->insurance == '2 سنه') ? 'selected' : ''); ?>>
                        2 سنه</option>
                </select>
            </div>
        </div>
    </div>


    <h5 style="text-align:center;"> المنتجات الداخليه</h5>

    <table class="table">
        <tr>
            <th width="30%">رقم القطعه</th>
            <th width="30%">الشركه </th>
            <th width="40%">الصوره </th>
        </tr>
        <?php if(isset($productsin)): ?>
            <?php $__currentLoopData = $productsin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e((isset($productin->code)) ? $productin->code : ''); ?>

                    </td>
                    <td><?php echo e((isset($productin->brand)) ? $productin->brand->name : ''); ?>

                    </td>
                    <td><img style="width:100px"
                            src="<?php echo e(url('/')); ?>/uploads/products-attachments/<?php echo e((isset($productin->image) ? $productin->image : '')); ?>"
                            alt="<?php echo e($productin->name); ?>"></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </table>
    <br>
    <br>
    <hr>
    <h5 style="text-align:center;"> المنتجات الخارجيه</h5>
    <table class="table">
        <tr>
            <th width="30%">رقم القطعه</th>
            <th width="30%">الشركه </th>
            <th width="40%">الصوره </th>
        </tr>
        <?php if(isset($product)): ?>
            <?php $__currentLoopData = $productsout; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e((isset($productout->code)) ? $productout->code : ''); ?>

                    </td>
                    <td><?php echo e($productout->company); ?></td>
                    <td><img style="width:100px" src="<?php echo e(url('/')); ?>/uploads/products-parts-out/<?php echo e($productout->image); ?>"
                            alt="<?php echo e($productout->name); ?>"></td>
                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </table>
    <br>
</div>
