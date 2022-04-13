<div class="tab-pane  fade" id="menu8">
    <div class="col-md-12 addgift">
        <?php if(isset($gifts_ids)): ?>
        <?php $__currentLoopData = $gifts_ids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$gifts_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label> الهديه</label>
                    <select name="gifts_ids[]" class="form-control" id="">
                        <option value=""> اختر الهديه</option>
                        <?php $__currentLoopData = $gifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($gift->id); ?>" <?php echo e(($gift->id==$gifts_id) ? 'selected' : ''); ?>><?php echo e($gift->name); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div><!-- /.form-group -->
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label> الكميه</label>
                    <?php echo Form::number("gifts_quantities[]",$gifts_quantities[$key] , [
                    "class" => "form-control",
                    "placeholder" => "الكميه ",
                    ]); ?>

                </div><!-- /.form-group -->
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>لكل </label>
                    <?php echo Form::text("gifts_for[]", $gifts_for[$key] , [
                    "class" => "form-control",
                    "placeholder" => "الهديه لكل",
                    ]); ?>

                </div><!-- /.form-group -->

            </div>
            <div class="col-md-3">
                <?php if($key == 0): ?>
                <button id="add-gift" style="float: left;margin-top: 24px;" class="btn btn-success">اضافه هديه
                    اخري</button>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label> الهديه</label>
                    <select name="gifts_ids[]" class="form-control" id="">
                        <option value=""> اختر الهديه</option>
                        <?php $__currentLoopData = $gifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gift): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($gift->id); ?>"><?php echo e($gift->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div><!-- /.form-group -->
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label> الكميه</label>
                    <?php echo Form::number("gifts_quantities[]","" , [
                    "class" => "form-control",
                    "placeholder" => "الكميه ",
                    ]); ?>

                </div><!-- /.form-group -->
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>لكل </label>
                    <?php echo Form::text("gifts_for[]", "" , [
                    "class" => "form-control",
                    "placeholder" => "الهديه لكل",
                    ]); ?>

                </div><!-- /.form-group -->

            </div>
            <div class="col-md-3">
                <button id="add-gift" style="float: left;margin-top: 24px;" class="btn btn-success">اضافه هديه
                    اخري</button>
            </div>
        </div>
        <?php endif; ?>


    </div>


    <div class="card-body collapse in">
        <div class="card-block card-dashboard">
            <table class="table table-striped table-bordered " id="data" style="width:100%;">
                <thead>
                    <tr>
                        <th>رقم السند</th>
                        <th>التاريخ</th>
                        <th>نوع الهديه</th>
                        <th>الكميه</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th>رقم السند</th>
                        <th>التاريخ</th>
                        <th>نوع الهديه</th>
                        <th>الكميه</th>
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