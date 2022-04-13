@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
	<div class="row match-height">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">
						تعديل تصنيف
						<span class="pull-left">
						</span>
					</h4>
				</div>
				{!! Form::model($attachcat ,[
				'method' => 'PATCH',
				'route' => ['attachmentcat.update', $attachcat->id],
				'files' => true
				])
				!!}
				<input type="hidden" value="{{ $attachcat->id }}" name="id">
				<div class="card-body">
					<div class="card-block">


						@include('admin.attachments.form')

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