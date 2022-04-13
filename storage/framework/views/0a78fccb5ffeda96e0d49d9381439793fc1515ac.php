<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="title">أختر المستخدم</label><br>
            <select name="user_id" class="form-control selectproduct" required>
                <option value="">اختر المستخدم</option>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($user->id); ?>" <?php if(isset($edit)): ?> <?php echo e($user->id==$entry->user_id ? 'selected' : ''); ?>

                    <?php endif; ?>>
                    <?php echo e($user->name); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select><br>

        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="title">التاريخ</label>
            <?php echo Form::date('date',date('Y-m-d'),['class'=>'form-control','required'=>true]); ?>

        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="title">الوقت</label>
            <?php echo Form::time('time',date('H:i'),['class'=>'form-control','required'=>true]); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="title">ملاحظات</label>
            <?php echo Form::textarea('notes',null,['class'=>'form-control','rows'=>10]); ?>

        </div>
    </div>
    <?php if(!isset($edit)): ?>
    <div class="col-md-3">
        <div class="form-group">
            <label for="title">رفع اكسل</label>
            <input class="form-control" type="file" name="excel">
        </div>
    </div>
    <div class="col-md-2">
        <?php if($errors->has('excel')): ?>
        <span class="help-block" style="color: red">
            <strong><?php echo e($errors->first('excel')); ?></strong>
        </span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>




<div class="row">
    <br>
    <br>

    <div id="product-tab" class="tabcontent" style="display: block;">
        <div class="col-md-12">
            <table id="added_products_table" class="table table-striped" style="text-align:center">
                <thead>
                    <tr>
                        <th>رقم المادة</th>
                        <th>الماده</th>
                        <th style="width:7%;">الكميه</th>
                        <th style="width:9%;">التكلفة</th>
                        <th style="width:9%;">اضافه / خضم</th>
                        <th style="width:9%;">سعر البيع</th>
                        <th style="width:9%;">
                            المخزن
                            <select class="select-stock select-stock-all">
                                <option value="">اختر المخزن</option>
                                <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($stock->id); ?>">
                                        <?php echo e($stock->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </th>
                        <th style="width:9%;">
                            المستودع
                            <select class="select-warehouse select-warehouse-all"
                                    required>
                                <option value="">اختر المستودع</option>
                                <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($warehouse->id); ?>">
                                        <?php echo e($warehouse->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </th>
                    </tr>
                </thead>
                <tbody id="table_body" class="productsadd">
                    <?php if(isset($edit)): ?>
                    <?php $__currentLoopData = $supplies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $supply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($supply->product()->first()): ?>
                    <tr
                        style="<?php echo e(isset( $product_id) && $supply->product_id == $product_id?'background-color: #5ec334  !important; ':''); ?>">
                        <input type="hidden" name="supply_id[]" value="<?php echo e($supply->id); ?>">
                        <input type="hidden" name="product[]" value="<?php echo e($supply->product()->first()->id); ?>">
                        <input type="hidden" name="product_code_type[]"
                            value="<?php echo e($supply->product()->first()->code_type); ?>">
                        <td><?php echo e($supply->product()->first()->code); ?></td>
                        <td><?php echo e($supply->product()->first()->name); ?></td>

                        <td><input value="<?php echo e($supply->quantity); ?>" type="number" data-number="<?php echo e($k); ?>" placeholder="الكميه"
                                min="0" class="quantities form-control productquantity quantity<?php echo e($k); ?>"
                                name="quantity[]">
                        </td>
                        <td><input value="<?php echo e(number_format($supply->cost,2)); ?>" type="number" step="0.01"
                                data-number="<?php echo e($k); ?>" placeholder="التكلفة" min="0"
                                class="quantities form-control productcost cost<?php echo e($k); ?>" name="cost[]">
                        </td>
                        <td><input type="number" step="0.01" data-number="<?php echo e($k); ?>" placeholder="النسبه" min="0"
                                class="form-control addon_perc addon_perc<?php echo e($k); ?>" value="<?php echo e($supply->addon_perc); ?>"
                                name="addon_perc[]">
                            <input type="number" step="0.01" data-number="<?php echo e($k); ?>" placeholder="المبلغ" min="0"
                                class="form-control addon addon<?php echo e($k); ?>" name="addon[]" value="<?php echo e($supply->addon); ?>">
                        </td>
                        <td><input value="<?php echo e(number_format($supply->price,2)); ?>" type="number" step="0.01"
                                data-number="<?php echo e($k); ?>" step="0.01" placeholder="السعر " min="0"
                                class="prices form-control productprice price<?php echo e($k); ?>" name="price[]"> </td>
                        <td>
                            <select name="stock_id[]" data-number="<?php echo e($k); ?>" class="select-stock" required>
                                <option value="">اختر المخزن</option>
                                <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($stock->id); ?>" <?php echo e($supply->stock_id==$stock->id? 'selected':''); ?>>
                                    <?php echo e($stock->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td>
                            <select name="warehouse_id[]" data-number="<?php echo e($k); ?>" class="select-warehouse warehouse<?php echo e($k); ?>"
                                required>
                                <option value="">اختر المستودع</option>
                                <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($warehouse->id); ?>" <?php echo e($supply->warehouse_id==$warehouse->id?
                                    'selected':''); ?>><?php echo e($warehouse->name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td class="totals totalfir<?php echo e($k); ?>"></td>
                        <td><i class="fa fa-times clickremrow"></i> </td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
        <?php echo $__env->make('admin.product_search.product_search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>


    <div class="col-md-12">
        <hr>
        <div class="clear">
            <button type="submit" class="btn btn-success">
                <i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

            </button>
        </div>
    </div>
    <?php $__env->startSection('script'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script>
        $(document).ready(function() {
    $(".selectproducted").select2();
    $(".selectwarehouse").select2();
  })
    </script>

    <script type="text/javascript">

        $('.select-stock-all').on('change', function () {
            var val = $(this).val();
            if(val) {
                $('.select-stock option[value=' + val + ']').prop('selected', true);
            } else {
                $('.select-stock option:first-child').prop('selected', true);
            }
        });

        $('.select-warehouse-all').on('change', function () {
            var val = $(this).val();
            if(val) {
                $('.select-warehouse option[value=' + val + ']').prop('selected', true);
            } else {
                $('.select-warehouse option:first-child').prop('selected', true);
            }
        });



        var added_products;
    $(document).ready(function() {

        $(document).on('change', '.cashtype', function() {
            num=$(this).data('num');
            value=$(this).val();
            if(value == 1){
            $(".unitbank"+num).show('slow');
            $(".unitbanknum"+num).show('slow');
            }else{
            $(".unitbank"+num).hide('slow');
            $(".unitbanknum"+num).hide('slow');
            }

        });

    });


    var k = '<?php if(isset($edit)): ?><?php echo e(count($supplies)); ?><?php else: ?><?php echo e(0); ?><?php endif; ?>';
    $(".add_products_btn").click(function() {
        var products = [];
        var parts = [];
        $.each($("input[name='product_id']:checked"), function() {
            if($(this).data('type')=='ES'||$(this).data('type')=='EA')
            {
                parts.push($(this).val());
            }
            else products.push($(this).val());
        });

        $.ajax({
            dataType: "json",
            url: "<?php echo e(route('admin.ajax_add')); ?>",
            data: {
                'product_ids': products,
                'part_ids': parts,
            },
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    var name='';
                    if(data[i].name!=null)
                            name = data[i].name;
                    $('#added_products_table tr:last').after('<tr><input type="hidden" name="product[]" value="' + data[i].id + '">  <input type="hidden" name="product_code_type[]" value="' + data[i].code_type + '"><td>' + data[i].code + '</td> <td> ' +name + '</td> <td><input type="number"   data-number="' + k + '" step="0.01"placeholder=" الكميه" min="0" class="prices form-control productquantity quantity' + k + '" name="quantity[]"> </td><td><input type="number" step="0.01"  data-number="' + k + '" placeholder="التكلفة" min="0"class="quantities form-control productcost cost' + k + '" name="cost[]">  <td><input type="number" step="0.01"  data-number="' + k + '" placeholder="النسبه" min="0" class="form-control addon_perc addon_perc' + k + '" name="addon_perc[]"><input type="number" step="0.01"  data-number="' + k + '" placeholder="المبلغ" min="0" class="form-control addon addon' + k + '" name="addon[]"></td> </td><td><input type="number" step="0.01"  data-number="' + k + '" placeholder="السعر" min="0"class="quantities form-control productprice price' + k + '" name="price[]"></td><td> <select name="stock_id[]" data-number="' + k + '" class="select-stock" required><option value="">اختر المخزن</option><?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($stock->id); ?>" ><?php echo e($stock->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></td><td><select name="warehouse_id[]" data-number="' + k + '" class="select-warehouse warehouse' + k + '" required><option value="">اختر المستودع</option> <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($warehouse->id); ?>" ><?php echo e($warehouse->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select></td> <td class="totals totalfir' + k + '"></td> <td><i class="fa fa-times clickremrow"></i> </td> </tr>');
                    $("#products_table").hide('slow');
                    $(".add_products_btn").hide('slow');
                    k++;
                }
            }
        });




    });

        $(document).on("keyup", ".addon", function() {
        num=$(this).data('number');
        val=$(this).val();
        cost=$(".cost"+num).val();
        if(cost != ""){
            $(".price"+num).val(+cost+ +val);
        }
        });

        $(document).on("keyup", ".addon_perc", function() {
            num=$(this).data('number');
        val=$(this).val();
        cost=$(".cost"+num).val();
        if(cost != ""){

            result=cost*val/100;
            $(".price"+num).val(+cost+ +result);
        }
        });
    $(document).on("click", ".clickremrow", function() {
            $(this).parents("tr:first").remove();
        });

    // $(document).on('change','.select-stock',function(){
    //   var selected_id = $(this).children("option:selected").val();
    //   var selected_number = $(this).data('number');
    //   $.ajax({
    //         dataType: "json",
    //         url: "<?php echo e(route('admin.supplies.get_warehouses')); ?>",
    //         data: {
    //             'stock_id': selected_id,
    //         },
    //         success: function(data) {
    //           $(".warehouse"+selected_number).empty();
    //           $(".warehouse"+selected_number).append('<option value="">اختر المستودع</option>');
    //             for (var i = 0; i < data.length; i++) {
    //                $(".warehouse"+selected_number).append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
    //             }
    //         }
    //     });
    // });

    </script>
    <?php $__env->appendSection(); ?>

    <?php $__env->startSection('style'); ?>
    <style>
        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 6px 10px;
            transition: 0.3s;
            font-size: 16px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #fff;
            border-bottom: 2px solid red;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;

            border-top: none;
        }


        .tabcontent {
            animation: fadeEffect 1s;
            /* Fading effect takes 1 second */
        }

        /* Go from zero to full opacity */
        @keyframes  fadeEffect {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>

    <style>
        td,
        th {
            padding: 5px 5px !important;
        }

        .select2 {
            width: 100% !important;
        }

        .select2-container {
            font-size: 14px !important;
            text-align: right !important;
            ;
        }

        th {
            text-align: center !important;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background: #dff0d8 !important;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background: #f2dede !important;
        }

        .totals {
            font-weight: bold;
        }

        .clickremrow {
            background: antiquewhite;
            padding: 12px;
            cursor: pointer;
            color: red;
        }

        .installment,
        .delayed,
        .installment_dates {
            display: none;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <?php $__env->stopSection(); ?>
