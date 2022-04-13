<div class="tab-pane fade" id="menu17">
    <h5 style="text-align:center; margin-bottom:15px;"> المكافئات</h5>
    <div class="col-md-1">
    </div>
    <div class="col-md-8">
        <div id="addproductsawards" class="form-group">

            <select name="products_award[]" class="form-control tagsadd" id="">
                <option value="">اختر المنتج</option>
                <?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($part->id); ?>"><?php echo e($part->name); ?> | <?php echo e($part->code); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>

            <br>
        </div><!-- /.form-group -->
    </div>
    <div class="col-md-3">
        <button id="add-pro-awards" style="float: left;" class="btn btn-success">اضافه منتج اخر</button>
    </div>




    <div class="card-body collapse in">
        <div class="card-block card-dashboard">
            <table class="table table-striped table-bordered " id="data" style="width:100%;">
                <thead>
                    <tr>
                        <th>رقم القطعه</th>
                        <th>اسم القطعه</th>
                        <th>السعر </th>
                        <th>الشركه </th>
                        <th>بلد المنشأ </th>
                        <th>بلد التصنيع </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th>رقم القطعه</th>
                        <th>اسم القطعه</th>
                        <th>السعر </th>
                        <th>الشركه </th>
                        <th>بلد المنشأ </th>
                        <th>بلد التصنيع </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>





</div>
