<div class="row">
    <div class="col-md-6">

        <div class="col-md-6">
            <div class="form-group">
                <label for="title"> التاريخ</label><br>
                <input type="date" class="form-control" value="<?php echo e((isset($visit) ? $visit->date : '')); ?>" name="date"
                    placeholder="التاريخ" id="" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="title"> الوقت</label><br>
                <input type="time" class="form-control" value="<?php echo e((isset($visit) ? $visit->hour : '')); ?>" name="time"
                    placeholder="الوقت" id="" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="title">أختر الزبون</label><br>
                <select name="customer" class="form-control selectproduct" required>
                    <option value="">اختر الزبون</option>
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($customer->id); ?>" <?php echo e((isset($visit) && $customer->id==$visit->customer_id) ?
                        'selected' : ''); ?>>
                        <?php echo e($customer->name); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select><br>
                <a href="<?php echo e(url('/')); ?>/customers/create">اضافه زبون جديد </a>
                <?php if($errors->has('customer')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('customer')); ?></strong>
                </span>
                <?php endif; ?>
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group">
                <label for="title"> حاله الزياره</label><br>
                <select name="visittype" id="" class="form-control" required>
                    <option value="">اختر حاله الزياره</option>
                    <option <?php echo e((isset($visit) && $visit->type == 0) ? 'selected' : ''); ?> value="0">زياره مستهدفه</option>
                    <option <?php echo e((isset($visit) && $visit->type == 1) ? 'selected' : ''); ?> value="1">زياره جاريه</option>
                </select>


            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="title"> البيان</label><br>
                <input type="text" value="<?php echo e((isset($visit) ? $visit->inform : '')); ?>" class="form-control" name="inform"
                    placeholder="البيان" id="">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="title"> المرفقات: </label>
                <input accept=".jpg,.png,.jpeg" type="file" name="cardimage">
                <?php if(isset($visit)): ?>
                <input type="hidden" value="<?php echo e($visit->card_image); ?>" name="oldcardimage">
                <br />
                <img src="<?php echo e(url('/')); ?>/uploads/card_images/<?php echo e($visit->card_image); ?>" style="width:100px;padding: 7px;">
                <a href="<?php echo e(url('/')); ?>/uploads/card_images/<?php echo e($visit->card_image); ?>" download><?php echo e($visit->card_image); ?></a>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="title">ملاحظات</label>
                <textarea name="notes" id="" class="form-control"><?php echo e((isset($visit)) ? $visit->notes : ''); ?></textarea>
            </div>

        </div>
        <button style="display:none" class="location"></button>






        
    </div>
    <div class="col-md-6">
        <div class="form-group modal-body" style="margin: 0px 0px 5px 0px; padding: 0px;">
            <label for="title">موقع الزياره علي الخريطه</label>
            <div id="googleMap" style="width:100%; height:300px;"></div>
        </div>



        <input type="hidden" name="lat" value="<?php echo e(isset($visit) ? $visit->lat : '23.8859'); ?>" id="lat">
        <input type="hidden" name="lng" value="<?php echo e(isset($visit) ? $visit->lng : '45.0792'); ?>" id="lng">



    </div>
</div>




<ul class=" nav nav-tabs">
    <li class="nav-item navbitem">
        <a class="nav-link navvlink active" data-toggle="tab" href="#menu1">الزياره</a>
    </li>
    <li class="nav-item navbitem">
        <a class="nav-link navvlink" data-toggle="tab" href="#menu2"> تقييمات العميل</a>
    </li>
    <li class="nav-item navbitem">
        <a class="nav-link navvlink" data-toggle="tab" href="#menu3">تقييمات المندوب</a>
    </li>
    <li class="nav-item navbitem">
        <a class="nav-link navvlink" data-toggle="tab" href="#menu4">بيانات السوق</a>
    </li>
</ul>


<div class="tab-content">
    <br>
    <?php echo $__env->make('admin.visit.tabs.visit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('admin.visit.tabs.rating_customer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('admin.visit.tabs.rating_repre', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('admin.visit.tabs.market', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>







<div class="col-md-12">
    <hr>
    <div class="clear">
        <button type="submit" class="btn btn-success">
            <i class="icon-check2"></i> <?php echo e(trans('admin.save')); ?>

        </button>
        <?php if(isset($visit) && $userAuth->can('sliders.create')): ?>
        <?php if(count($visit->priceoffers)==0): ?>
        <a class="btn btn-info" href="<?php echo e(url('/')); ?>/priceoffer/create?visit=<?php echo e($visit->id); ?>&type=0"><i
                class="fa fa-print"></i>
            انشاء
            عرض سعر غير معمد
        </a>
        <?php elseif(count($visit->priceoffers)==1): ?>

        <a class="btn btn-info" href="<?php echo e(url('/')); ?>/offer/<?php echo e($visit->priceoffers[0]->id); ?>"><i class="fa fa-print"></i>
            طباعه عرض سعر غير معمد
        </a>


        <a class="btn btn-primary" href="<?php echo e(url('/')); ?>/priceoffer/create?visit=<?php echo e($visit->id); ?>&type=1"><i
                class="fa fa-plus"></i>
            انشاء
            عرض سعر معمد
        </a>
        <?php elseif(count($visit->priceoffers)==2): ?>
        <a class="btn btn-info" href="<?php echo e(url('/')); ?>/offer/<?php echo e($visit->priceoffers[0]->id); ?>"><i class="fa fa-print"></i>
            طباعه عرض السعر الغير معمد
        </a>
        <a class="btn btn-primary" href="<?php echo e(url('/')); ?>/offer/<?php echo e($visit->priceoffers[1]->id); ?>"><i class="fa fa-print"></i>
            طباعه عرض السعر المعمد
        </a>
        <?php endif; ?>
        <?php endif; ?>
        <a href="<?php echo e(route('product.index')); ?>" class="btn btn-danger">
            <i class="fa fa-times"></i> <?php echo e(trans('admin.cancel')); ?>

        </a>

        <?php if(isset($visit)): ?>
        <div style="float:left;">
            <?php if($previous != null): ?>
            <a href="<?php echo e(url('/')); ?>/visits/<?php echo e($previous); ?>/edit" class="btn btn-success notprint">
                <i class="fa fa-arrow-right"></i> السابق
            </a>
            <?php endif; ?>
            <?php if($next != null): ?>
            <a href="<?php echo e(url('/')); ?>/visits/<?php echo e($next); ?>/edit" class="btn btn-success notprint">
                التالي <i class="fa fa-arrow-left"></i>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>



<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<style>
    th {
        text-align: center;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background: #dff0d8 !important;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background: #f2dede !important;
    }

    .select2-selection {
        text-align: right !important;
        height: 35px !important;
    }

    .table th,
    .table td {
        padding: 15px 16px;
    }

    .clickremrow {
        background: antiquewhite;
        padding: 12px;
        cursor: pointer;
        color: red;
    }

    .select2-container {
        width: 100% !important;
    }

    .bordered {
        border: 1px solid #ccc;
        padding: 15px;
        margin: 0px;
        /* border-radius: 8px; */
    }

    .nav-tabs {
        margin-bottom: 25px;
        background: #e4e4e4;
    }

    .nav-tabs .navvlink {
        color: #000 !important;
    }

    .nav-link.active {
        color: black !important;
    }

    .nav-tabs .nav-link:hover {
        /* border: none; */
    }

    .fa-star {
        color: #ffc12b;
        font-size: 15px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $(document).ready(function(){
i=0;

$("#add-product").click(function(){
    i++;
$(".productsadd").append('<tr> <td> <select style="width:350px;" name="in_product[]" data-number="0" class="form-control selectproduct selectproducted"> <option value="">اختر المنتج</option> <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option data-price="<?php echo e($product->price); ?>" data-unit="<?php echo e($product->unit_1); ?>" data-quantity="<?php echo e($product->quantity); ?>" value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?> </option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select> </td> <td> <input type="number" value="1" placeholder="الكميه" min="1" class="form-control productquantity" name="in_quantity[]"> </td> <td> <i class="fa fa-times clickremrow"></i> </td> </tr>');
$('.selectproduct').select2();
return false;
})


$("#add-product_2").click(function(){
    i++;
$(".productsadd_2").append('<tr> <td> <select style="width:350px;" name="out_product[]" data-number="0" class="form-control selectproduct selectproducted"> <option value="">اختر المنتج</option> <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option data-price="<?php echo e($product->price); ?>" data-unit="<?php echo e($product->unit_1); ?>" data-quantity="<?php echo e($product->quantity); ?>" value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?> </option> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </select> </td> <td> <input type="number" value="1" placeholder="الكميه" min="1" class="form-control productquantity" name="out_quantity[]"> </td> <td> <i class="fa fa-times clickremrow"></i> </td> </tr>');
$('.selectproduct').select2();
return false;
})


$("#add-market").click(function(){
    i++;
$(".marketadd").append('<tr> <td> <input type="text"  placeholder="الماركه"  class="form-control" name="market_brand[]"> </td> <td> <input type="text"  placeholder="النوع"  class="form-control" name="market_type[]"> </td> <td> <input type="text"  placeholder="الموديل"  class="form-control" name="market_model[]"> </td> <td> <i class="fa fa-times clickremrow"></i> </td> </tr>');
return false;
})


$('.starmainrate').click(function(){
    stars=$(this).data('id');
    $(".mainrate").val(stars);
    for(i=1; i<=stars; i++){
        $(".mainrate"+i).css('color','#ffc12b');
    }
       for(i=(stars+1); i<6; i++){
        $(".mainrate"+i).css('color','#ccc');
    }
})
$('.starlocationrate').click(function(){
    stars=$(this).data('id');
    $(".locationrate").val(stars);
    for(i=1; i<=stars; i++){
        $(".locationrate"+i).css('color','#ffc12b');
    }
       for(i=(stars+1); i<6; i++){
        $(".locationrate"+i).css('color','#ccc');
    }
})

$('.starworkrate').click(function(){
    stars=$(this).data('id');
    $(".workrate").val(stars);
    for(i=1; i<=stars; i++){
        $(".workrate"+i).css('color','#ffc12b');
    }
       for(i=(stars+1); i<6; i++){
        $(".workrate"+i).css('color','#ccc');
    }
})

$('.stardel').click(function(){
    stars=$(this).data('id');
    $(".delegate").val(stars);
    for(i=1; i<=stars; i++){
        $(".delegate"+i).css('color','#ffc12b');
    }
       for(i=(stars+1); i<6; i++){
        $(".delegate"+i).css('color','#ccc');
    }
})

$('.stardelcl').click(function(){
    stars=$(this).data('id');
    $(".delegatecl").val(stars);
    for(i=1; i<=stars; i++){
        $(".delegatecl"+i).css('color','#ffc12b');
    }
       for(i=(stars+1); i<6; i++){
        $(".delegatecl"+i).css('color','#ccc');
    }
})


$('.starmanvi').click(function(){
    stars=$(this).data('id');
    $(".managervis").val(stars);
    for(i=1; i<=stars; i++){
        $(".managevi"+i).css('color','#ffc12b');
    }
       for(i=(stars+1); i<6; i++){
        $(".managevi"+i).css('color','#ccc');
    }
})


$('.starmande').click(function(){
    stars=$(this).data('id');
    $(".managerdele").val(stars);
    for(i=1; i<=stars; i++){
        $(".managede"+i).css('color','#ffc12b');
    }
       for(i=(stars+1); i<6; i++){
        $(".managede"+i).css('color','#ccc');
    }
})


$('.selectproduct').select2();


$(document).on('change','.selectproducted',function(){
num=$(this).data('number');
price=$(this).find(':selected').data('price');
unit=$(this).find(':selected').data('unit');

$('.unit'+num).html("<span style='display:block;margin-top: 4px;' class='unitpro'>"+unit+"</span>");
$('.price'+num).val(price);
})


$(document).on("click",".clickremrow",function() {
  $(this).parents("tr:first").remove();
})

})
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