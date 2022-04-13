@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
	<div class="row match-height">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">
						@if(request('main_type') === '1')
                            تعديل فاتورة بيع طلبات ورشه
                        @elseif (request('main_type') === '2')
                            تعديل فاتورة بيع طلبات الصيانه الخارجيه
						@elseif (request('main_type') === '3')
							تعديل فاتورة بيع داخليه
                        @elseif (request('main_type') === '4')
                            تعديل فاتورة بيع زيارة ميدانيه
                        @elseif (request('main_type') === '5')
                            تعديل فاتورة بيع مركز الاتصالات
                        @else
                            تعديل فاتورة بيع معرض
                        @endif
						<span class="pull-left">
						</span>
					</h4>
				</div>
				{!! Form::model($offer ,[
				'method' => 'PATCH',
				'route' => ['sells.update', $offer->id],
				'files' => true
				])
				!!}
				<input type="hidden" value="{{ $offer->id }}" name="id">
				@include('admin.sell.form')
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</section>
@endsection
