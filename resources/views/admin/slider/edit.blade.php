@extends($pLayout. 'master')
@section('content')
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title">{{ trans('admin.edit', ['name' => trans('admin.slider')]) }}</h4>
  				</div>

              {!! Form::model($slider ,[
                  'method' => 'PATCH',
                  'route' => ['slider.update', $slider->id],
                  'files' => true
                ]) 
              !!}
          <input type="hidden" value="{{ $slider->id }}" name="id">
  				<div class="card-body">
  					<div class="card-block">
  						

  						@include('admin.slider.form')

  					</div>
  				</div>
          {!! Form::close() !!}
  			</div>
  		</div>
  	</div>
  </section>
@endsection

@section('script')
  <script type="text/javascript" src="https://cdn.rawgit.com/jadus/jquery-sortScroll/v1.3.0/jquery.sortScroll.min.js"></script>

  <script type="text/javascript">
    $(".sort-scroll-container").sortScroll({
    animationDuration: 1000,// duration of the animation in ms
    cssEasing: "ease-in-out",// easing type for the animation
    keepStill: true,// if false the slider doesn't scroll to follow the element
    fixedElementsSelector: ""// a jQuery selector so that the plugin knows your fixed elements (like the fixed nav on the left)
});
  </script>
@endsection