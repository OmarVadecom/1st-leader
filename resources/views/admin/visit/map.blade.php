@extends($pLayout. 'master')

@section('content')
<!-- File export table -->
<section id="file-export">
  <div class="row">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">
            الزيارات
            <a class="btn btn-primary" href="{{url('/')}}/mapvisits?type=all">خريطه الزيارات</a>
            <a class="btn btn-primary" href="{{url('/')}}/mapvisits?type=target">خريطه الزيارات
              المستهدفه</a>
            <a class="btn btn-primary" href="{{url('/')}}/mapvisits?type=done">خريطه الزيارات المنفذه</a>
          </h4>
        </div>
        <div id="map_canvas"></div>
      </div>
    </div>
  </div>
</section>

<style>
  #map_canvas {
    height: 500px;
    width: 100%;
    margin: 0px;
    padding: 0px
  }

  .gm-style-iw-d {
    margin-right: 10px;
  }
</style>

@endsection
@section('script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgT7WlFOpeuez5qKBL-yDXkuRpCUol0Rg"></script>
<script>
  var locations = [
    @foreach($visits as $visit)
  ['{{$visit->customer->name}}', '', '{{url("/")}}/visits/{{$visit->id}}/edit','{{$visit->lat}}','{{$visit->lng}}','{{$visit->type}}'],
  @endforeach
];

var geocoder;
var map;
var bounds = new google.maps.LatLngBounds();

function initialize() {
  map = new google.maps.Map(
    document.getElementById("map_canvas"), {
      center: new google.maps.LatLng(37.4419, -122.1419),
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
  geocoder = new google.maps.Geocoder();

  for (i = 0; i < locations.length; i++) {
    geocodeAddress(locations, i);
  }
}
google.maps.event.addDomListener(window, "load", initialize);

function geocodeAddress(locations, i) {
  var title = locations[i][0];
  var address = locations[i][1];
  var url = locations[i][2];
  var lat = locations[i][3];
  var lng = locations[i][4];
  var type= locations[i][5];
console.log(' lat '+lat+' lng '+lng);
if(type==1){
    var marker = new google.maps.Marker({
          icon: 'https://maps.google.com/mapfiles/ms/icons/red.png',
          position: {lat: parseFloat(lat), lng: parseFloat(lng)},
          map: map,
          title: title,
          animation: google.maps.Animation.DROP,
        })
}else{
    var marker = new google.maps.Marker({
          icon: 'https://maps.google.com/mapfiles/ms/icons/blue.png',
          position: {lat: parseFloat(lat), lng: parseFloat(lng)},
          map: map,
          title: title,
          animation: google.maps.Animation.DROP,
        })
}

        infoWindow(marker, map, title, address, url);
        bounds.extend(marker.getPosition());
        map.fitBounds(bounds);


}

function infoWindow(marker, map, title, address, url) {
  google.maps.event.addListener(marker, 'click', function() {
    var html = "<div><h3>" + title + "</h3><a target='_blank' href='" + url + "'>مشاهده الزياره</a></div>";
    iw = new google.maps.InfoWindow({
      content: html,
      maxWidth: 350
    });
    iw.open(map, marker);
  });
}



</script>

@endsection