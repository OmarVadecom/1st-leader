@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
	<div class="row match-height">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">
						تعديل سند
						<span class="pull-left">
						</span>
					</h4>
				</div>
				{!! Form::model($sanad ,[
				'method' => 'PATCH',
				'route' => ['sanadat.update', $sanad->id],
				'files' => true
				])
				!!}
				<input type="hidden" value="{{ $sanad->id }}" name="id">
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