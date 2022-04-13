@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
	<div class="row match-height">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">ملخص حركه المنتجات</h4>
				</div>
				{!! Form::open([
				'url' => route('admin.poststockreport'),
				'method', 'POST'
				]) !!}
				<div class="card-body">
					<div class="card-block">
						<div class="row">

							<div class="col-md-4">
								<div class="col-md-12">
									<div class="form-group">
										<label for="title">اختر المستودع</label>
										<select class="form-control" name="warehouse" id="store">
											<option value="all">كل المستودعات </option>
											@foreach($warehouses as $warehouse)
											<option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="col-md-12">
									<div class="form-group">
										<label for="title">اختر المخزون</label>
										<select class="form-control" name="stock" id="store">
											<option value="all">كل المخزون </option>
											@foreach($stocks as $stock)
											<option value="{{$stock->id}}">{{$stock->name}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="title">اختر المنتج</label>
									<select class="form-control selectproduct" name="product" id="store">
										<option value="all">كل المنتجات </option>
										@foreach($products as $product)
										<option value="{{$product->id}}">{{ $product->name }} | {{ $product->code }}
										</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-6">
								<div class="col-md-12">
									<div class="form-group">
										<label for="title">من تاريخ</label>
										<input type="date" name="date_from" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="title">الي تاريخ</label>
									<input type="date" name="date_to" class="form-control">
								</div>
							</div>
						</div>


						<div class="col-md-12">
							<hr>
							<div class="clear">
								<button type="submit" class="btn btn-primary subm">
									<i class="icon-check2"></i> {{ trans('admin.save') }}
								</button>
								<a href="/" class="btn btn-danger">
									<i class="fa fa-times"></i> {{ trans('admin.cancel') }}
								</a>
							</div>
						</div>



					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</section>
<style>
	.select2-container {
		margin-top: 5px !important;
		width: 100% !important;
		direction: rtl;
		text-align: right;
	}
</style>


@endsection

@section('script')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
	$(".selectproduct").select2();
</script>

@endsection