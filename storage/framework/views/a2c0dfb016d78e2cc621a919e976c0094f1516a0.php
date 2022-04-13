<?php if($errors->any()): ?>
<div class="container alert alert-danger">
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div><?php echo e($error); ?></div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>

<div class="card-body">
    <div class="card-block">
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">التاريخ</label>
                        <?php echo Form::date('date',date('Y-m-d'),['class'=>'form-control','required'=>true]); ?>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">الوقت</label>
                        <?php echo Form::time('time',date('h:i:s A'),['class'=>'form-control','required'=>true]); ?>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">أختر الزبون</label><br>
                        <?php echo Form::select('customer_id',[''=>'اختر
                        الزبون']+$customers,isset($visit)?$customers[$visit->customer_id]:null,['class'=>'form-control','required'=>true]); ?>

                        <a href="<?php echo e(url('/')); ?>/customers/create">اضافه زبون جديد </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">البيان</label>
                        <?php echo Form::textarea('declaration',null,['class'=>'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">ملاحظات</label>
                        <?php echo Form::textarea('notes',null,['class'=>'form-control' ]); ?>

                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group modal-body">
                    <label for="title">موقع التسليم علي الخريطه</label>
                    <div id="googleMap" style="width:100%; height:250px;"></div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label style="padding-right:0px" class="form-check-label" for="inlineCheckbox1">ربط
                            تلقائي</label>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="tab">
            <button type="button" class="tablinks active" onclick="openTab(event, 'product-tab')">امر التحضير</button>
            <button type="button" class="tablinks" onclick="openTab(event, 'details-tab')">تفاصيل الامر</button>
            <button type="button" class="tablinks " onclick="openTab(event, 'verify-tab')">سندات محاسبيه</button>
        </div>

        <div id="product-tab" class="tabcontent" style="display: block;">
            <div class="col-md-12">
                <table id="added_products_table" class="table table-striped" style="text-align:center">
                    <thead>
                        <tr>
                            <th>رقم المادة</th>
                            <th>الماده</th>
                            <th>الوحده</th>
                            <th style="width:10%;">الكميه</th>
                            <?php if(isset($preparation)): ?>
                            <th style="width:6%;">تم تحضير</th>
                            <?php endif; ?>
                            <th style="width:10%;">المحضر</th>
                            <th style="width:10%;">المعلق</th>
                            <th>المستودع</th>
                            <th>المستخدم</th>
                        </tr>
                    </thead>
                    <tbody id="table_body" class="productsadd">
                        <?php if(isset($edit)): ?>
                        <?php $__currentLoopData = $preparation_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <input type="hidden" name="product[]" value="<?php echo e($product->id); ?>">
                            <input type="hidden" name="product_code_type[]" value="<?php echo e($product->code_type); ?>">
                            <td> <?php echo e($product->product->code); ?> </td>
                            <td> <?php echo e(isset($product->product->name) ? $product->product->name : ''); ?></td>
                            <td class="<?php echo e($k); ?>"></td>
                            <td>
                                <span class="quantity<?php echo e($k); ?>"><?php echo e($product->quantity); ?></span>
                            </td>
                            <td><span class="preparedpro<?php echo e($k); ?>"><?php echo e($product->prepared); ?></span></td>
                            <td>
                                <?php if($product->remains != 0): ?>
                                <input type="number" value="" data-number="<?php echo e($k); ?>" placeholder="المحضر" min="0"
                                    max="<?php echo e($product->remains); ?>"
                                    class="prices form-control productprepared prepared<?php echo e($k); ?>" name="prepared[]">

                                <?php else: ?>
                                <span> <i style="color:green" class="fa fa-check"></i></span>
                                <input type="hidden" value="<?php echo e($product->prepared); ?>" name="prepared[]">
                                <?php endif; ?>
                            </td>
                            <td><span class="remains<?php echo e($k); ?>"> <?php echo e($product->remains); ?></span></td>
                            <td>
                                <select class="form-control" name="warehouse_id[]">
                                    <option value="">اختر المستودع</option>
                                    <?php $__currentLoopData = $warhouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php echo e($warehouse->id==$product->warehouse_id?'selected':''); ?>

                                        value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="user[]">
                                    <option value="">اختر المستخدم</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>" <?php echo e($user->id == $product->user_id?'selected':''); ?>>
                                        <?php echo e($user->name); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>

                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
            <?php if(!isset($edit)): ?>
            <?php echo $__env->make('admin.product_search.product_search',['preparation'=>true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php endif; ?>

        </div>
        <div id="details-tab" class="tabcontent ">
            <div class="row bordered aligned-row">
                <div class="col-md-1" style="background: orange">
                    <div class="center">تقييمات المحضر</div>
                </div>
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> اسم المندوب: </label>
                                <?php echo Form::text('representative_name',null,['class'=>'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> رقم الهاتف: </label>
                                <?php echo Form::text('representative_phone_number',null,['class'=>'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> اسم المحضر: </label>
                                <?php echo Form::text('preparator_name',null,['class'=>'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> نوع التحضير: </label>
                                <?php echo Form::text('type',null,['class'=>'form-control']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="title">
                                    حاله التحضير:
                                </label>
                                <?php echo Form::select('status',[''=>'حالة التحضير','partial'=>'جزئي',
                                'complete'=>'كامل'],null,['class'=>'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="title">
                                    نسبه الاكتمال:
                                </label>
                                <?php echo Form::text('progress',null,['class'=>'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="title">ملاحظات التحضير</label>
                                <?php echo Form::textarea('preparation_notes',null,['class'=>'form-control' ,'rows'=>3]); ?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <br>
            <div class="row bordered aligned-row">
                <div class="col-md-1" style="background: #b4ff00">
                    <div class="center">بيانات الموصل</div>
                </div>

                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> اسم الموصل: </label>
                                <?php echo Form::text('deliverer_name',null,['class'=>'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> رقم الموصل: </label>
                                <?php echo Form::text('deliverer_phone_number',null,['class'=>'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title">نوع الموصل: </label>
                                <?php echo Form::text('delivery_type',null,['class'=>'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> ملاحظات: </label>
                                <?php echo Form::textarea('delivery_notes',null,['class'=>'form-control']); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row bordered aligned-row">
                <div class="col-md-1" style="background: #00f3ff">
                    <div class="center">بيانات المستلم</div>
                </div>

                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> اسم المستلم: </label>
                                <?php echo Form::text('recipient_name',null,['class'=>'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> المدينه : </label>
                                <?php echo Form::text('reciept_city',null,['class'=>'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> المنطقه: </label>
                                <?php echo Form::text('reciept_region',null,['class'=>'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> الشارع: </label>
                                <?php echo Form::text('reciept_street',null,['class'=>'form-control']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="title"> رقم هاتف المستلم: </label>
                                <?php echo Form::text('recipient_phone_number',null,['class'=>'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="title"> ملاحظات: </label>
                                <?php echo Form::textarea('reciept_notes',null,['class'=>'form-control']); ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div id="verify-tab" class="tabcontent ">
            <div class="row bordered aligned-row">
                <div class="col-md-1" style="background: #b4ff00">
                    <div class="center">سند صرف عهده</div>
                </div>
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> اسم المحضر: محمد احمد محمد</label>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> رقم حساب العهده: 1234</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title">قيمه العهده: 250</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> باقي العهده: 2000</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                                <th>مدين</th>
                                <th>دائن</th>
                                <th>حساب المصروف</th>
                                <th>التاريخ</th>
                                <th>البيان</th>
                                <th>الحساب المقابل</th>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>2000</td>
                                    <td>0</td>
                                    <td>250</td>
                                    <td>22-10-2020</td>
                                    <td>مصروف تحضير بضاعه</td>
                                    <td>0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <input type="hidden" value="0" name="prstatus" id="prstatus">
        <div class="col-md-12">
            <hr>
            <div class="clear">
                <button type="submit" class="btn btn-success">
                    <i class="icon-check2"></i> حفظ
                </button>
                <a href="<?php echo e(route('preparations.index')); ?>" class="btn btn-danger">
                    <i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

                </a>
            </div>
        </div>



    </div>
</div>
<style>
    .errortable,
    .showunitstable {
        display: none;
    }

    th {
        vertical-align: middle;
    }

    button {
        font-weight: normal;
    }

    .rowhidden {
        display: none;
    }

    .center {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%);
        font-size: 16px;
        font-weight: 600;
        text-align: center;
    }

    .aligned-row {
        display: flex;
        flex-flow: row wrap;
    }

    .bordered {
        border: 1px solid #ccc;
        padding: 15px;
        border-radius: 8px;
    }

    td {
        text-align: center;
    }
</style>
<?php $__env->startSection('script'); ?>
<script>
    $(document).ready(function() {
        $(".addondiscbtu").click(function(){
            row_id=$(this).data('row-id');
           $(".row"+row_id).fadeToggle('slow');
            return false;
        })


        i = 1;
        $("#add-product").click(function() {
            i++;
            $(".productsadd").append('<tr> <td> <select style="width:250px;" data-number="' + i + '" name="product[]" class="form-control selectproduct selectproducted" required> <option value="">اختر المنتج</option> <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleproduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option data-unit="<?php echo e($singleproduct->unit_1); ?>" data-price="<?php echo e($singleproduct->price); ?>" value="<?php echo e($singleproduct->id); ?>"> <?php echo e($singleproduct->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select> </td> <td class="unit' + i + '"> </td> <td> <input type="number" value="1" data-number="' + i + '" placeholder="السعر" min="1" step="0.01" class="prices form-control productprice price' + i + '" name="price[]"> </td> <td> <input type="number" value="1" data-number="' + i + '" placeholder="الكميه" min="1" class="quantities form-control productquantity quantity' + i + '" name="quantity[]"> </td> <td class="totals totalfir' + i + '"></td> <td> <input type="number" value="5" data-number="' + i + '" placeholder="الضريبه" min="0" class="prices form-control productdreba dareba' + i + '" name="darebadis[]" style="width:85%" disabled> <input type="hidden" name="dareba[]" value="5" id=""><span style="float: left; margin-top: -32px;">%</span> </td> <td class="totals totalsec' + i + '"></td> <td> <input type="number" value="0" data-number="' + i + '" placeholder="الخصم %" min="0" class="form-control productdiscount discounts discount' + i + '" style="width:85%" name="discount[]"><span style="float: left; margin-top: -32px;">%</span> </td> <td class="totals total' + i + '"> </td> <input type="hidden" name="totals[]" class="totalinp"><td> <i class="fa fa-times clickremrow"></i> </td> </tr>');

            $('.selectproduct').select2();
            return false;
        })
        $(document).on('keyup','.addondiscoutvalue', function() {
            num = $(this).data('row_id');
            total=$(".totalinp"+num).val();
            discount=$(this).val();
            if(discount == ""){
            discount=0;
            }
            discountvalue = total * (discount / 100);
            totaldisc=+total + +discountvalue;
            totaldisc=Math.round((totaldisc + Number.EPSILON) * 100) / 100;
            $(".total" + num).html(totaldisc);
            // $(".totalinp"+num).val(totaldisc);
        })
        $(document).on('keyup', '.productprepared, .productquantity', function() {
            num = $(this).data('number');
            quantity = $('.quantity' + num).val();
            if(quantity == ""){
                quantity = $('.quantity' + num).text();
            }
            prepared = $(".prepared" + num).val();
            preparedpro=$(".preparedpro" + num).text();
            total=quantity-preparedpro;
            $(".remains"+num).text(total-prepared);
        })

        $('.selectproduct').select2();


        $(document).on('change', '.selectproducted', function() {
            num = $(this).data('number');
            price = $(this).find(':selected').data('price');
            unit = $(this).find(':selected').data('unit');

            $('.unit' + num).html("<span style='display:block;margin-top: 4px;' class='unitpro'>" + unit + "</span>");
            // $('.price'+num).val(price);
        })

        $(document).on("click", ".clickremrow", function() {
            $(this).parents("tr:first").remove();
        })





        var count = 0;
        $("#addinputf").click(function() {
            count += 1;

            limit = $("#installmentnum").val();
            if (limit != '' && limit < count + 1) {
                return false;
            }
            $(".installment_dates").append('<div class="col-md-3"> <input type="date" name="installment_dates[]" class="form-control" placeholder="تاريخ دفعه" id=""> </div>');
            return false;
        })


        $("#inv_type").change(function() {
            if ($(this).val() == 2) {
                $(".installment").show('slow');
            } else {
                $(".installment").hide('slow');
            }
        })





        $("#submitprint").click(function() {
            $("#prstatus").val(1);
        })
        $("#lfm").hide();
    })






</script>


<script type="text/javascript">
    var added_products;

    var k ='<?php if(isset($edit)||isset($verify)): ?> <?php echo e(count($preparation_products)); ?> <?php else: ?><?php echo e(0); ?><?php endif; ?>';
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
                    $('#added_products_table tr:last').after('<tr><input type="hidden" name="product[]" value="' + data[i].id + '"> <input type="hidden" name="product_code_type[]" value="' + data[i].code_type + '"> <td>' + data[i].code + ' </td> <td> ' +name + '</td> <td class="unit'+k+'"></td> <td><input type="number" value="" data-number="' + k + '" placeholder="الكميه" min="1" class="quantities form-control productquantity quantity' + k + '" name="quantity[]"></td> <td><input type="number" value="" data-number="'+k+'" placeholder="المحضر" min="0" class="prices form-control productprepared prepared' + k + '" name="prepared[]"> </td> <td><span class="remains'+k+'"></span></td> <td><select class="form-control" name="warehouse_id[]"> <option value="">اختر المستودع</option> <?php $__currentLoopData = $warhouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($warehouse->id); ?>"><?php echo e($warehouse->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select> </td><td> <select class="form-control" name="user[]"> <option value="">اختر المستخدم</option><?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select> </td> <td><i class="fa fa-times clickremrow"></i> </td> </tr>');
                    $("#products_table").hide('slow');
                    $(".add_products_btn").hide('slow');
                    k++;
                }
            }
        });

    });
</script>

<script>
    function openTab(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>


<script>
    function addOfferDetail() {
        $("#offer-details").append('<div id="single-offer-detail" ><div class="col-md-1"> <button onclick="removeOfferDetail(this);" type="button" class="btn btn-danger" >-</button></div><div class="col-md-11"> <div class="form-group"> <input name="offer_details[]" class="form-control"></div></div></div>');
    }


    function removeOfferDetail(data) {
        $(data).parent().parent().remove();
    }


    function addClientDetail() {
        $("#client-details").append('<div id="single-client-detail" ><div class="col-md-1"> <button onclick="removeClientDetail(this);" type="button" class="btn btn-danger" >-</button></div><div class="col-md-11"> <div class="form-group"> <input name="offer_details[]" class="form-control"></div></div></div>');
    }


    function removeClientDetail(data) {
        $(data).parent().parent().remove();
    }
</script>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgT7WlFOpeuez5qKBL-yDXkuRpCUol0Rg&libraries=places&callback=initAutocomplete"
    async defer></script>




<script>
    function initAutocomplete(lat, lng) {
        <?php if(isset($visit)): ?>
            var map = new google.maps.Map(document.getElementById('googleMap'), {
                center: {lat: <?php echo e($visit->lat); ?>, lng: <?php echo e($visit->lng); ?>},
                zoom: 13,
                mapTypeId: 'roadmap'
            });

            marker = new google.maps.Marker({
                position: {lat: <?php echo e($visit->lat); ?>, lng: <?php echo e($visit->lng); ?>},
                map: map
            });

        <?php else: ?>
            console.log("ana f el map");
            var map = new google.maps.Map(document.getElementById('googleMap'), {
                center: {lat: 21.4767899, lng: 39.2023801},
                zoom: 13,
                mapTypeId: 'roadmap'
            });
            marker = new google.maps.Marker({
                position: {lat: 21.4767899, lng: 39.2023801},
                map: map
            });
        <?php endif; ?>

        var input = document.getElementById('pac-input');
        if(input === null){
            $(".modal-body").append("<input id=\"pac-input\" onPaste=\"\" onkeydown=\"if (event.keyCode == 13) {return false;}\"\n" +
                "                           class=\"controls form-control\" type=\"text\" placeholder=\"Search Box\" style=\"position: absolute;\n" +
                "    z-index: 0;\n" +
                "    right: 0px;\n" +
                "    top: 0px;\n" +
                "    width: 50%;\">");

            var input = document.getElementById('pac-input');

        }

        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];

        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            markers.forEach(function (marker) {
                marker.setMap(null);
            });
            markers = [];

            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }


                markers.push(new google.maps.Marker({
                        map: map,
                        title: place.name,
                        position: place.geometry.location,
                        draggable: true
                    })
                );




                var last_marker = markers[markers.length - 1];
                console.log(last_marker.map.center.lat());
                console.log(last_marker.map.center.lng());
                document.getElementById('lat').value = markers[0].position.lat();
                document.getElementById('lng').value = markers[0].position.lng();

                $("#lat").val(markers[0].position.lat());
                $("#lng").val(markers[0].position.lng());
                console.log($("#lat").val());
                console.log(markers[0].position.lat());
                google.maps.event.addListener(last_marker, 'dragend', function (event) {
                    $("#lat").val(event.latLng.lat());
                    $("#lng").val(event.latLng.lng());
                    document.getElementById('lat').value = event.latLng.lat();
                    document.getElementById('lng').value = event.latLng.lng();
                });


                if (place.geometry.viewport) {

                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }


            });
            map.fitBounds(bounds);
        });

    }

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
    .installment_dates {
        display: none;
    }
</style>
<?php $__env->stopSection(); ?>