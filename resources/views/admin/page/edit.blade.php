@extends($pLayout. 'master')
@section('content')
@php

$pageurl=str_replace("//", "/", $page->url);
$pageurl=str_replace(":/", "://", $pageurl);

@endphp



  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title">
               {{ trans('admin.edit', ['name' => trans('admin.page')]) }}
               @if(getCurrentdir()=='rtl')
              <span class="pull-left" style="margin-left: 12px; margin-top: -5px;" >
                                  <a href="{{ $pageurl }}" class="btn btn-primary" target="_blank"><i class="fa fa-eye"></i> عرض</a>
            </span>
                  @else
                                <span class="pull-right" style="margin-right: 12px; margin-top: -5px;" >
                                <a href="{{ $pageurl }}" class="btn btn-primary" target="_blank"><i class="fa fa-eye"></i> Preview</a>
            </span>
                  @endif

            </h4>
  				</div>

              {!! Form::model($page ,[
                  'method' => 'PATCH',
                  'route' => ['page.update', $page->id],
                  'files' => true
                ])
              !!}
          <input type="hidden" value="{{ $page->id }}" name="id">
  				<div class="card-body">
  					<div class="card-block">


  						@include('admin.page.form')

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
              <style>
      .active-mod{
          color:#ccc;
          cursor:pointer;
          
      }
      .disable-mod{
                color:green;
                cursor:pointer;
      }

  </style>
@endsection