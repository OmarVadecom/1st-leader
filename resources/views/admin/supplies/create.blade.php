@extends($pLayout. 'master')
@section('content')
@php
$last_id = \DB::table('warehouses_entries')->max('id')+1;
$last_id=str_pad($last_id, 4, '0', STR_PAD_LEFT);
$last_id = 'ENT-'.$last_id;
@endphp
<section id="justified-top-border">
	<div class="row match-height">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"> إضافه ادخال جديد <span style="color:#b71c1c">{{$last_id}}</span></h4>
				</div>
				{!! Form::open([
				'url' => route('supplies.store'),
				'method', 'POST',
				'files'=> true,
				]) !!}
				<div class="card-body">
					<div class="card-block">
						@include('admin.supplies.form')
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