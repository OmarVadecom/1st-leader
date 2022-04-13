@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
	<div class="row match-height">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">
                        تقرير ورشه
                        <span style="color:#b71c1c">
							{{ $maint->code . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT) }}
                        </span>
                    </h4>
				</div>
				{!! Form::open([
				'url' => route('maintenance_report.store'),
				'method', 'POST',
				'files'=> true,
				]) !!}
				<div class="card-body">
					<div class="card-block">
						@include('admin.maintenance_report.form')
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
