@extends($pLayout. 'master')
@section('content')
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title">{{ trans('admin.edit', ['name' => trans('admin.page-categories')]) }}</h4>
  				</div>

              {!! Form::model($page ,[
                  'method' => 'PATCH',
                  'route' => ['page-categories.update', $page->id],
                  'files' => true
                ]) 
              !!}
          <input type="hidden" value="{{ $page->id }}" name="id">
  				<div class="card-body">
  					<div class="card-block">
  						

  						@include('admin.pageCategory.form')

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
    keepStill: true,// if false the page doesn't scroll to follow the element
    fixedElementsSelector: ""// a jQuery selector so that the plugin knows your fixed elements (like the fixed nav on the left)
});
  </script>
@endsection