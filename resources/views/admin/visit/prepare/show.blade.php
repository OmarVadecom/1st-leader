@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export">
	<div class="row">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">
						تفاصيل أمر التحضير
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
													<td>إسم المنتج: {{$product->name_en}} | {{$product->code}}</td>
													<td>الكميه: {{$quantities[$key]}} </td>
												</tr>
												@endforeach

											</table>

										</td>
									</tr>
									<tr style="background: antiquewhite;">
										<th>حاله التحضير</th>
										<td>
										                    @if ((isset($visit->visit) && $visit->visit->prepare_order == 1) || ($visit->prepare == 1)) 

											<i style="color:green" class="fa fa-check"></i> تم تحضيرها
											@else
											<i style="color:red" class="fa fa-times"></i> لم يتم تحضيرها
											@endif
											<form id="confirmsub" method="post"
												action="{{route('admin.prepare_orders.update')}}">
												@csrf
												<input type="hidden" name="visit_id" value="{{$visit->visit_id}}">
										<input type="hidden" name="price_id" value="{{$visit->id}}">
																	
																	
												<div class="inputcheckform" style="margin-top: 20px;">
												    
												    
										@if($visit->delivery != 1)
													<input id="radio_id" type="checkbox" class="checkbtnC" name="status"
								                    @if ((isset($visit->visit) && $visit->visit->prepare_order == 1) || ($visit->prepare == 1)) 
													checked="checked" @endif />
													@endif
													<br>
													<textarea name="prepare_notes" placeholder="ملاحظات"
														class="form-control prepare_notes">{{$visit->prepare_notes}}</textarea>
													<br>

													<button type="submit" class="btn btn-primary">
														<i class="icon-check2"></i> {{ trans('admin.save') }}
													</button>

												</div>
											</form>
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
							<a href="{{url('/')}}/preparing_orders/{{$previous}}" class="btn btn-success notprint">
								<i class="fa fa-arrow-right"></i>    السابق
							</a>
							@endif
							@if($next != null)
							<a href="{{url('/')}}/preparing_orders/{{$next}}"  class="btn btn-success notprint">
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

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>

<script>
	$(function () {
 $("#print").click(function(){
$('#file-export').print();
})

$('#confirmsub').submit(function(event){
     if(!confirm("هل انت متأكد من حاله التحضير؟")){
        event.preventDefault();
      }
    });

	if($('#radio_id').is(":checked")){
	$(".prepare_notes").show('slow');

}

// 	$("#radio_id").change(function() {
//     if(this.checked) {
// 		$(".prepare_notes").show('slow');
// 		   }else{
// 			$(".prepare_notes").hide('slow');
// 		}
// });


})
</script>
@endsection