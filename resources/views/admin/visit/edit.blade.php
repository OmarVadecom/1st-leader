@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
	<div class="row match-height">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">
						تعديل زياره
					</h4>
				</div>

				{!! Form::model($visit ,[
				'method' => 'PATCH',
				'route' => ['visits.update', $visit->id],
				'files' => true
				])
				!!}
				<input type="hidden" value="{{ $visit->id }}" name="id">
				<div class="card-body">
					<div class="card-block">


						@include('admin.visit.form')

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