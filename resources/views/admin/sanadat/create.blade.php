@extends($pLayout. 'master')
@section('content')
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
					  @if(\Request::get('type') == 1)
  					<h4 class="card-title">إضافه سند قبض</h4>

					  @else
  					<h4 class="card-title">إضافه سند صرف</h4>

					  @endif
  				</div>
          {!! Form::open([
              'url' => route('sanadat.store'),
			  'method', 'POST',
			  'files'=> true,
              ]) !!}
  				<div class="card-body">
  					<div class="card-block">
  						@include('admin.sanadat.form')
  					</div>
  				</div>
          {!! Form::close() !!}
  			</div>
  		</div>
  	</div>
  </section>
@endsection

@section('script')

@endsection
