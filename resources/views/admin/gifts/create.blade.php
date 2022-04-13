@extends($pLayout. 'master')
@section('content')
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title">إضافه هديه جديده</h4>
  				</div>
          {!! Form::open([
              'url' => route('gifts.store'),
			  'method', 'POST',
			  'files'=> true,
              ]) !!}
  				<div class="card-body">
  					<div class="card-block">
  						@include('admin.gifts.form')
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
