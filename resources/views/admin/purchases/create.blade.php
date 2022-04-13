@extends($pLayout. 'master')
@section('content')
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title">
                        @if(request('type') === '0')
                            انشاء فاتورة شراء محليه
                        @else
                            انشاء فاتورة شراء دوليه
                        @endif
                    </h4>
  				</div>
          {!! Form::open([
              'url' => route('purchases.store'),
			  'method', 'POST',
			  'files'=> true,
              ]) !!}
  				<div class="card-body">
  					<div class="card-block">
  						@include('admin.purchases.form')
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
