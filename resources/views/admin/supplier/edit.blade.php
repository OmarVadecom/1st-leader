@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
	<div class="row match-height">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">
						تعديل مورد
						<span class="pull-left">
						</span>
					</h4>
				</div>
				{!! Form::model($supplier ,[
				'method' => 'PATCH',
				'route' => ['supplier.update', $supplier->id],
				'files' => true
				])
				!!}
				<input type="hidden" value="{{ $supplier->id }}" name="id">
				<div class="card-body">
					<div class="card-block">
						@include('admin.supplier.form')
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