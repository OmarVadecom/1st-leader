@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
	<div class="row match-height">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">
                        @if(request('type') === '0')
                            تعديل فاتورة شراء محليه
                        @else
                            تعديل فاتورة شراء دوليه
                        @endif
						<span class="pull-left"></span>
					</h4>
				</div>
				{!! Form::model($purchase ,[
				'method' => 'PATCH',
				'route' => ['purchases.update', $purchase->id],
				'files' => true
				])
				!!}
				<input type="hidden" value="{{ $purchase->id }}" name="id">
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
