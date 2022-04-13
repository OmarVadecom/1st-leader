<?php
$warehouses = App\Models\Warehouse::all();
?>
<div class="product-search">
    <div id="select_product">
        <br><br>

        <form class="row">
            <div class="col-sm-6">
                <input id="search_box" placeholder="ابحث عن المنتجات" type="text" class="prices form-control">
            </div>


            <div class="col-sm-3">
                <button id="search_button" type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
            <div class="col-sm-3">
                <button id="add_products" type="button" style="float:left; margin-top:10px;position: relative;"
                    class="btn btn-success add_products_btn">اضف
                    المنتجات</button>
            </div>
        </form>
        <br><br>

        <table id="products_table" class="table table-striped">
            <thead>
                <th>الرقم</th>

                <th>الاسم</th>
                <?php if(!isset($preparation)): ?>
                    <th>السعر</th>
                <?php endif; ?>
                <th>الكمية</th>
                <th>المتاح</th>
                <th>المحجوز</th>
                <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th><?php echo e($warehouse->name); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <th><input class="check-all-products" type="checkbox" /></th>
            </thead>

            <tbody class="productsadd">
                <!-- added by jquery -->
            </tbody>
        </table>

        <button id="add_products" type="button" style="float:left; margin-top:10px;"
            class="btn btn-success add_products_btn">اضف
            المنتجات</button>
    </div>
</div>

<?php $__env->startSection('script'); ?>
<script>

    $('.check-all-products').click(function () {
        $('.check-product').prop('checked', this.checked);
    });

    $("#search_button").click(function () {
        $.ajax({
            dataType: "json",
            url: "<?php echo e(route('admin.ajax_search')); ?>",
            data: {
                'keyword': $('#search_box').val(),
                'flag': $('#maintenance_sr').val()
            },
            success: function (data) {
                added_products = data;
                $("#products_table td").remove();
                var warehouse_count = "<?php echo e(count($warehouses)); ?>";
                var warehouses = JSON.parse('<?php echo json_encode($warehouses->toArray()); ?>');


                for (var i = 0; i < data.length; i++) {
                    var price = 0;
                    var name = '';
                    if (typeof data[i].addon[0] !== 'undefined')
                        price = data[i].addon[0].prices;
                    if (data[i].name != null)
                        name = data[i].name;
                    delivered = data[i].delivered;
                    sold = data[i].sold;
                    reserved = data[i].reserved;
                    $("#products_table").show('slow');
                    $(".add_products_btn").show('slow');

                    var quantities_html = "";
                    total_in = 0;
                    for (var j = 0; j < warehouse_count; j++) {
                        var warehouse_quantity = 0;
                        var warehouse_out = 0;
                        if (typeof (data[i].supplies) != "undefined" && data[i].supplies !== null) {
                            for (var k = 0; k < data[i].supplies.length; k++) {
                                if (data[i].supplies[k].warehouse_id == warehouses[j].id)
                                    warehouse_quantity += +data[i].supplies[k].quantity;
                                price = data[i].supplies[k].price;
                            }
                        }
                        str = 'ware_id_' + warehouses[j].id;
                        warehouse_rem = warehouse_quantity - data[i][str];
                        quantities_html += '<td>' + warehouse_rem + '</td>';
                        total_in += +warehouse_quantity;
                    };
                    if (price == '') {
                        price = 0;
                    }
                    remains = total_in - delivered;
                    remains = remains - sold;
                    available = remains - reserved;
                    $('#products_table tr:last').after('<tr style="text-align:center;">  <td >' +
                        data[i].code + '</td> <td>' + name +
                        '</td>  <?php if(!isset($preparation)): ?> <td>' + parseFloat(price).toFixed(2) +
                        '</td> <?php endif; ?> <td>' + remains + '</td> <td>' + available +
                        '</td> <td>' + reserved + '</td> ' + quantities_html +
                        ' <td><input class="check-product" data-type="' + data[i].code_type +
                        '" type="checkbox" value="' + data[i].id + '" data-price="' +
                        parseFloat(price).toFixed(2) + '" name="product_id"></td> </tr>');
                }
            }
        });
    });

</script>

<?php $__env->appendSection(); ?>
