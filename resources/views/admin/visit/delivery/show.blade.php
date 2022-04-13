@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export">
	<div class="row">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">
						تفاصيل أمر التسليم
					</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>

				</div>
				<div class="card-body collapse in">
					<div class="card-block card-dashboard">
						<div class="tab-content px-1 pt-1">
							@foreach ($dbLangs as $key => $lang)
							<div role="tabpanel" class="tab-pane fade {{ $key == 0 ? 'active in' : '' }}"
								id="{{ $lang->code  }}" aria-labelledby="{{ $lang->code }}-tab"
								aria-expanded="{{ $key == 0 ? 'true' : 'false' }}">

								<table class="table table-striped table-bordered">

									<tr>
										<th>اسم المندوب</th>
										<td>{{ $visit->user->name }}</td>
									</tr>
									<tr>
										<th>اسم العميل</th>
										<td>{{ $visit->customer->name }}</td>
									</tr>
									<tr>
										<th>المنتجات المطلوب تحضيرها</th>

										<td>
											<table class="table table-striped table-dark">

												@foreach($allproducts as $key=>$product)
												<tr style="background:#FFF">
													<td>إسم المنتج: {{$product->name_en}}</td>
													<td>الكميه: {{$quantities[$key]}} </td>
												</tr>
												@endforeach

											</table>

										</td>
									</tr>
									<tr>
										<th>حاله التحضير</th>

										@if($visit->prepare == 1)
										<td><i style="color:green" class="fa fa-check"></i> تم تحضيرها</td>
										@else
										<td><i style="color:red" class="fa fa-times"></i> لم يتم تحضيرها</td>
										@endif
									</tr>

									<tr style="background: antiquewhite;">
										<th>حاله الاستلام</th>
										<td>
											@if($visit->delivery == 1)
											<i style="color:green" class="fa fa-check"></i> تم تسليمها
											<br>
											<span style="padding:10px;font-weight: bold;padding-right: 17px;">لوحه
												السياره</span><br>
											<img style="width:200px;padding: 10px;padding-right: 17px;"
												src="{{asset('uploads/car_numbers')}}/{{$visit->license_image}}"><br>
											<span style="padding:10px;padding-right: 17px;font-weight: bold;">صوره هويه
												السائق</span><br>
											<img style="width:200px;padding: 10px;padding-right: 17px;"
												src="{{asset('uploads/drivers')}}/{{$visit->driver_image}}">

											@else
											<i style="color:red" class="fa fa-times"></i> لم يتم تسليمها

											<form id="confirmsub" method="post" enctype="multipart/form-data"
												action="{{route('admin.delivery_orders.update')}}">
												@csrf
												<input type="hidden" name="price_id" value="{{$visit->id}}">
												<div class="inputcheckform" style="margin-top: 20px;">
													<input id="radio_id" type="checkbox" class="checkbtnC" name="status"
										@if($visit->delivery == 1)
													checked="checked" @endif />
													<div class="images">
														<div class="form-group">
															<label for="title">لوحه السياره</label>
															<br>
															<input type="file" accept=".jpg,.png,.jpeg" name="carnumber"
																required>
														</div>
														<div class="form-group">
															<label for="title">صوره هويه السائق</label>
															<br>
															<input accept=".jpg,.png,.jpeg" type="file" name="cardriver"
																required>
														</div>
													</div>
													<br>
													<button style="margin-top: -6px;" type="submit"
														class="btn btn-primary">
														<i class="icon-check2"></i> {{ trans('admin.save') }}
													</button>
												</div>
											</form>
											@endif
										</td>

									</tr>
								</table>
							</div>
							@endforeach
						</div>
						<a href="{{ route('admin.preparing_orders.index') }}"
							class="btn btn-danger">{{ trans('admin.back') }}</a>
						<button id="print" class="btn btn-primary">طباعه</button>

						@if(isset($visit))
						<div style="float:left;" >
							@if($previous != null)
							<a href="{{url('/')}}/delivery_orders/{{$previous}}" class="btn btn-success notprint">
								<i class="fa fa-arrow-right"></i>    السابق
							</a>
							@endif
							@if($next != null)
							<a href="{{url('/')}}/delivery_orders/{{$next}}"  class="btn btn-success notprint">
								 التالي <i class="fa fa-arrow-left"></i>
							</a>
							@endif
						</div>
						@endif


					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
<style>
	.images {
		display: none;

	}

	table {
		font-size: 14px;
	}
</style>

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>

<script>
	$(function () {
 $("#print").click(function(){
$('#file-export').print();
})


$('#confirmsub').submit(function(event){
     if(!confirm("هل انت متأكد من حاله التسليم؟")){
        event.preventDefault();
      }
    });

if($('#radio_id').is(":checked")){
	$(".images").show('slow');

}

	$("#radio_id").change(function() {
    if(this.checked) {
		$(".images").show('slow');
		   }else{
			$(".images").hide('slow');
		}
});




})
</script>
@endsection