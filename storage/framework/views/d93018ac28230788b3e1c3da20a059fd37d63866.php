<div class="tab-pane  fade" id="menu9">
    <div class="col-md-12">
        <table class="table table-striped" style="text-align:center">
            <thead>
                <tr>
                    <th style="width:40%">الماده</th>
                    <th style="width:40%">الكميه</th>
                    <th style="width:20%">اجباريه</th>
                    <th>x</th>
                </tr>
            </thead>
            <tbody class="productsadd">
                <div class="form-group ">
                    <?php if(isset($productssss)): ?>
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
                                                <option value="<?php echo e($prod->id); ?>"
                                                    <?php echo e(($prod->id == $singleproduct->id) ? 'selected' : ''); ?>>
                                                    <?php echo e($prod->code); ?> | <?php echo e($prod->name); ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo e($prod->id); ?>">
                                                    <?php echo e($prod->code); ?> | <?php echo e($prod->name); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" value="<?php echo e($quantities[$key]); ?>" placeholder="الكميه"
                                        min="1" class="form-control productquantity" name="quantity[]">

                                </td>
                                <td>
                                    <div class="checkbox">
                                        <input type="hidden" name="group_status[<?php echo e($key); ?>]" value="" />
                                        <label><input type="checkbox" name="group_status[<?php echo e($key); ?>]"
                                                <?php echo e(($group_statuss[$key]==1) ? 'checked' : ''); ?>>
                                            اجباريه </label>
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
                                        <option value="<?php echo e($product->id); ?>"><?php echo e($product->code); ?> |
                                            <?php echo e($product->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td>
                                <input type="number" value="1" placeholder="الكميه" min="1"
                                    class="form-control productquantity" name="">
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
        <button id="add-product" style="float:left; margin-top:10px; margin-bottom:10px;" class="btn btn-success">اضف
            منتج أخر</button>

    </div>

    <div class="card-body collapse in">
        <div class="card-block card-dashboard">
            <table class="table table-striped table-bordered " id="data" style="width:100%;">
                <thead>
                    <tr>
                        <th>رقم السند</th>
                        <th>التاريخ</th>
                        <th>رقم الاستلام</th>
                        <th>اسم الفني</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> سند تركيب 12</td>
                        <td>20/02/2020</td>
                        <td>9</td>
                        <td> محمد</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>رقم السند</th>
                        <th>التاريخ</th>
                        <th>رقم الاستلام</th>
                        <th>اسم الفني</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>



</div>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    // 	$(document).ready(function() {
    //     $('#data').DataTable( {
    //         "processing": true,
    //             "language": {
    //             "sUrl": lang
    //         },
    //         "ordering": true,
    //         "pagingType": "full_numbers",
    //             aLengthMenu: [
    //                 [25, 50, 100, 200, -1],
    //                 [25, 50, 100, 200, "All"]
    //             ],
    //             iDisplayLength: 25,
    //         "fixedHeader": true,
    //         "responsive": true,
    //         "ajax": "<?php echo e(route('admin.product.ajax')); ?>",
    //         "columns": [
    //            {data: 'select', name: ''},
    //            {data: 'title', name: 'title'},
    //            {data: 'status', name: 'status'},
    //            {data: 'action', name: ''}
    //         ],

    //     });
    // });

</script>
<?php $__env->stopSection(); ?>
