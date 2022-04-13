<div class="tab-pane fade" id="menu19">

    <div class="col-md-12">
        <table class="table table-striped" style="text-align:center">
            <thead>
                <tr>
                    <th style="width:20%">اسم المورد</th>
                    <th style="width:15%">التاريخ</th>
                    <th style="width:20%">المندوب</th>
                    <th style="width:20%">رقم الجوال</th>
                    <th style="width:10%">السعر </th>
                    <th style="width:15%"> الموظف </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="marketadd">
                <div class="form-group ">
                    <?php if(isset($suppliers)): ?>
                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo e($supplier); ?>" placeholder="اسم المورد"
                                        class="form-control" name="supplier[]">
                                </td>
                                <td>
                                    <input type="date" value="<?php echo e($date[$key]); ?>" placeholder="التاريخ" min="1"
                                        class="form-control" name="date[]">
                                </td>
                                <td>
                                    <input type="text" value="<?php echo e($sales_man[$key]); ?>" placeholder="المندوب "
                                        class="form-control" name="sales_man[]">
                                </td>
                                <td>
                                    <input type="number" value="<?php echo e($phone[$key]); ?>" placeholder="رقم الجوال"
                                        min="1" class="form-control" name="phone[]">
                                </td>
                                <td>
                                    <input type="text" value="<?php echo e($price[$key]); ?>" placeholder="السعر "
                                        class="form-control" name="price[]">
                                </td>
                                <td>
                                    <input type="text" value="<?php echo e($employee[$key]); ?>" placeholder="اسم الموظف "
                                        class="form-control" name="employee[]">
                                </td>
                                <td>
                                    <i class="fa fa-times clickremmarket"></i>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td>
                                <input type="text" placeholder="اسم المورد" class="form-control" name="supplier[]">
                            </td>
                            <td>
                                <input type="date" placeholder="التاريخ" min="1" class="form-control" name="date[]">
                            </td>
                            <td>
                                <input type="text" placeholder="المندوب " class="form-control" name="sales_man[]">
                            </td>
                            <td>
                                <input type="number" placeholder="رقم الجوال" min="1" class="form-control"
                                    name="phone[]">
                            </td>
                            <td>
                                <input type="text" placeholder="السعر " class="form-control" name="price[]">
                            </td>
                            <td>
                                <input type="text" placeholder="اسم الموظف " class="form-control" name="employee[]">
                            </td>
                            <td>
                                <i class="fa fa-times clickremmarket"></i>
                            </td>
                        </tr>
                    <?php endif; ?>
                </div>
            </tbody>
        </table>
        <button id="add-product-2" style="float:left; margin-top:10px; margin-bottom:10px;" class="btn btn-success">اضف
            بيانات أخري</button>
    </div>
    <br>
</div>
