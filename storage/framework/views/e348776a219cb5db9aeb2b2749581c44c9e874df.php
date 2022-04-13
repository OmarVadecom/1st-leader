<div class="tab-pane  active apply-form" id="menu1">
    <div class="col-md-4">
        <div class="form-group">
            <label>اسم المركز </label>

            <?php echo Form::text("center_name", (isset($client)) ? ( $client->center_name == "") ? $client->old_center :
            $client->center_name : '', [
            "class" => "form-control",
            "placeholder" => 'اسم المركز',

            ]); ?>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>المنطقه </label>

            <select name="region" class="form-control" id="region_id">
                <option value="">أختر المنطقه</option>
                <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($region->name); ?>" data-id="<?php echo e($region->id); ?>" <?php echo e((isset($client) && $client->region ==
                    $region->name) ? 'selected' : ''); ?>>
                    <?php echo e($region->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>العنوان </label>
            <?php echo Form::text("address",(isset($client)) ? ($client->address == "") ? $client->old_address :
            $client->address : '', [
            "class" => "form-control",
            "placeholder" => 'العنوان',
            ]); ?>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> السجل التجاري</label>

            <?php echo Form::text("segl_name",(isset($client)) ? ($client->segl_name == "") ? $client->old_segl_num :
            $client->segl_name : '', [
            "class" => "form-control",
            "placeholder" => 'رقم السجل',


            ]); ?>

        </div>
    </div>



    <div class="col-md-4">
        <div class="form-group">
            <label>المدينه </label>
            <select name="city" class="form-control" id="city_id">
                <option value="">أختر المدينه</option>
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option data-region="<?php echo e($city->region_id); ?>" class="cities" value="<?php echo e($city->name); ?>" <?php echo e((isset($client) &&
                    $client->city == $city->name) ? 'selected' : ''); ?>>
                    <?php echo e($city->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <?php if(\Request::get('status') == 0): ?>
    <div class="col-md-4">
        <div class="form-group">
            <label> الهاتف الثابت </label>

            <?php echo Form::text("phone",(isset($client)) ? ($client->phone == "") ? $client->old_phone :
            $client->phone : '', [
            "class" => "form-control",
            "placeholder" => 'الموبايل',


            ]); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label> حاله العميل</label>

            <div class="form-check" style="right: 55px;">
                <input class="form-check-input" type="checkbox" value="1" name="status" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    تحويل الي عميل جديد
                </label>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(\Request::get('status') == 1): ?>

    <div class="col-md-4">
        <div class="form-group">
            <label>تصنيف مركز الصيانه </label>

            <?php echo Form::text("maintainace_cat",null, [
            "class" => "form-control",
            "placeholder" => 'تصنيف مركز الصيانه',

            ]); ?>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> عدد العمال </label>

            <?php echo Form::text("worker_num",null, [
            "class" => "form-control",
            "placeholder" => 'عدد العمال',


            ]); ?>

        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label>اسم المنشأه</label>

            <?php echo Form::text("bui_name",null, [
            "class" => "form-control",
            "placeholder" => 'اسم المنشأه',


            ]); ?>

        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label>الرمز البريدي </label>

            <?php echo Form::text("postal_code",null, [
            "class" => "form-control",
            "placeholder" => 'الرمز البريدي',

            ]); ?>

        </div>
    </div>









    <?php endif; ?>
    <?php if(!isset($client)): ?>
    <style>
        .cities {
            display: none;
        }
    </style>
    <?php endif; ?>

    <?php $__env->startSection('script'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script>
        function initAutocomplete(lat, lng) {
        <?php if(isset($client) && $client->lat != ""): ?>
            var map = new google.maps.Map(document.getElementById('googleMap'), {
                center: {lat: <?php echo e($client->lat); ?>, lng: <?php echo e($client->lng); ?>},
                zoom: 13,
                mapTypeId: 'roadmap'
            });

            marker = new google.maps.Marker({
                position: {lat: <?php echo e($client->lat); ?>, lng: <?php echo e($client->lng); ?>},
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
    $(document).ready(function(){
    $(".select2").select2();
$("#region_id").change(function(){
region_id=$(this).find(':selected').attr('data-id');
$('.cities').hide();
$('.cities[data-region='+region_id+']').show();

    }).trigger('change');

});
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgT7WlFOpeuez5qKBL-yDXkuRpCUol0Rg&libraries=places&callback=initAutocomplete"
        async defer></script>
    <?php $__env->stopSection(); ?>
</div>