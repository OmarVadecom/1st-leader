@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
            اختر براند
          </h4>
    </div>
    <div class="card-header">
@foreach($brands as $brand)
<div class="col-xs-2">
    <a href="{{url('/')}}/searchparts/{{$brand->id}}">

<img style="width: 100%;" src="{{url('/')}}/uploads/brands_images/{{$brand->image}}">
    </a>
</div>
@endforeach
</div>
            </div>
        </div>
@endsection