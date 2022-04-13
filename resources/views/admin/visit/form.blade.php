<div class="row">
    <div class="col-md-6">

        <div class="col-md-6">
            <div class="form-group">
                <label for="title"> التاريخ</label><br>
                <input type="date" class="form-control" value="{{(isset($visit) ? $visit->date : '')}}" name="date"
                    placeholder="التاريخ" id="" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="title"> الوقت</label><br>
                <input type="time" class="form-control" value="{{(isset($visit) ? $visit->hour : '')}}" name="time"
                    placeholder="الوقت" id="" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="title">أختر الزبون</label><br>
                <select name="customer" class="form-control selectproduct" required>
                    <option value="">اختر الزبون</option>
                    @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{(isset($visit) && $customer->id==$visit->customer_id) ?
                        'selected' : ''}}>
                        {{ $customer->name }}
                    </option>
                    @endforeach
                </select><br>
                <a href="{{url('/')}}/customers/create">اضافه زبون جديد </a>
                @if ($errors->has('customer'))
                <span class="help-block">
                    <strong>{{ $errors->first('customer') }}</strong>
                </span>
                @endif
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group">
                <label for="title"> حاله الزياره</label><br>
                <select name="visittype" id="" class="form-control" required>
                    <option value="">اختر حاله الزياره</option>
                    <option {{(isset($visit) && $visit->type == 0) ? 'selected' : ''}} value="0">زياره مستهدفه</option>
                    <option {{(isset($visit) && $visit->type == 1) ? 'selected' : ''}} value="1">زياره جاريه</option>
                </select>


            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="title"> البيان</label><br>
                <input type="text" value="{{(isset($visit) ? $visit->inform : '')}}" class="form-control" name="inform"
                    placeholder="البيان" id="">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="title"> المرفقات: </label>
                <input accept=".jpg,.png,.jpeg" type="file" name="cardimage">
                @if(isset($visit))
                <input type="hidden" value="{{$visit->card_image}}" name="oldcardimage">
                <br />
                <img src="{{url('/')}}/uploads/card_images/{{$visit->card_image}}" style="width:100px;padding: 7px;">
                <a href="{{url('/')}}/uploads/card_images/{{$visit->card_image}}" download>{{$visit->card_image}}</a>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="title">ملاحظات</label>
                <textarea name="notes" id="" class="form-control">{{(isset($visit)) ? $visit->notes : '' }}</textarea>
            </div>

        </div>
        <button style="display:none" class="location"></button>






        {{-- <div class="form-group">
            <label for="status">حاله عرض السعر</label>
            <input type="checkbox" class="checkbtnC" name="status" @if(isset($visit) && $visit->status == 1)
            checked="checked" @endif />
        </div> --}}
    </div>
    <div class="col-md-6">
        <div class="form-group modal-body" style="margin: 0px 0px 5px 0px; padding: 0px;">
            <label for="title">موقع الزياره علي الخريطه</label>
            <div id="googleMap" style="width:100%; height:300px;"></div>
        </div>



        <input type="hidden" name="lat" value="{{isset($visit) ? $visit->lat : '23.8859'}}" id="lat">
        <input type="hidden" name="lng" value="{{isset($visit) ? $visit->lng : '45.0792'}}" id="lng">



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
    @include('admin.visit.tabs.visit')
    @include('admin.visit.tabs.rating_customer')
    @include('admin.visit.tabs.rating_repre')
    @include('admin.visit.tabs.market')
</div>







<div class="col-md-12">
    <hr>
    <div class="clear">
        <button type="submit" class="btn btn-success">
            <i class="icon-check2"></i> {{ trans('admin.save') }}
        </button>
        @if(isset($visit) && $userAuth->can('sliders.create'))
        @if(count($visit->priceoffers)==0)
        <a class="btn btn-info" href="{{url('/')}}/priceoffer/create?visit={{$visit->id}}&type=0"><i
                class="fa fa-print"></i>
            انشاء
            عرض سعر غير معمد
        </a>
        @elseif(count($visit->priceoffers)==1)

        <a class="btn btn-info" href="{{url('/')}}/offer/{{$visit->priceoffers[0]->id}}"><i class="fa fa-print"></i>
            طباعه عرض سعر غير معمد
        </a>


        <a class="btn btn-primary" href="{{url('/')}}/priceoffer/create?visit={{$visit->id}}&type=1"><i
                class="fa fa-plus"></i>
            انشاء
            عرض سعر معمد
        </a>
        @elseif(count($visit->priceoffers)==2)
        <a class="btn btn-info" href="{{url('/')}}/offer/{{$visit->priceoffers[0]->id}}"><i class="fa fa-print"></i>
            طباعه عرض السعر الغير معمد
        </a>
        <a class="btn btn-primary" href="{{url('/')}}/offer/{{$visit->priceoffers[1]->id}}"><i class="fa fa-print"></i>
            طباعه عرض السعر المعمد
        </a>
        @endif
        @endif
        <a href="{{ route('product.index') }}" class="btn btn-danger">
            <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
        </a>

        @if(isset($visit))
        <div style="float:left;">
            @if($previous != null)
            <a href="{{url('/')}}/visits/{{$previous}}/edit" class="btn btn-success notprint">
                <i class="fa fa-arrow-right"></i> السابق
            </a>
            @endif
            @if($next != null)
            <a href="{{url('/')}}/visits/{{$next}}/edit" class="btn btn-success notprint">
                التالي <i class="fa fa-arrow-left"></i>
            </a>
            @endif
        </div>
        @endif
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
$(".productsadd").append('<tr> <td> <select style="width:350px;" name="in_product[]" data-number="0" class="form-control selectproduct selectproducted"> <option value="">اختر المنتج</option> @foreach($products as $product) <option data-price="{{$product->price}}" data-unit="{{$product->unit_1}}" data-quantity="{{$product->quantity}}" value="{{ $product->id }}">{{ $product->name }} </option> @endforeach </select> </td> <td> <input type="number" value="1" placeholder="الكميه" min="1" class="form-control productquantity" name="in_quantity[]"> </td> <td> <i class="fa fa-times clickremrow"></i> </td> </tr>');
$('.selectproduct').select2();
return false;
})


$("#add-product_2").click(function(){
    i++;
$(".productsadd_2").append('<tr> <td> <select style="width:350px;" name="out_product[]" data-number="0" class="form-control selectproduct selectproducted"> <option value="">اختر المنتج</option> @foreach($products as $product) <option data-price="{{$product->price}}" data-unit="{{$product->unit_1}}" data-quantity="{{$product->quantity}}" value="{{ $product->id }}">{{ $product->name }} </option> @endforeach </select> </td> <td> <input type="number" value="1" placeholder="الكميه" min="1" class="form-control productquantity" name="out_quantity[]"> </td> <td> <i class="fa fa-times clickremrow"></i> </td> </tr>');
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
        @if (isset($visit))
            var map = new google.maps.Map(document.getElementById('googleMap'), {
                center: {lat: {{$visit->lat}}, lng: {{$visit->lng}}},
                zoom: 13,
                mapTypeId: 'roadmap'
            });

            marker = new google.maps.Marker({
                position: {lat: {{$visit->lat}}, lng: {{$visit->lng}}},
                map: map
            });

        @else
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
        @endif

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