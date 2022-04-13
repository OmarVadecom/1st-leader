<!DOCTYPE HTML>
<html lang="ar" dir="rtl">

<head>
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
	<meta name="description" content="First-Leader">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ $panel_assets }}css/invoice.css">
	<link href="https://fonts.googleapis.com/css?family=Markazi+Text:400,500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
	<title>CATALOG-{{$product->code}}</title>
</head>

<style>
	.title_center {
		text-align: center;
		font-weight: bold;
		padding: 10px;
		margin-bottom: 0px;
	}

	.proimg {
		width: 250px;
		margin: auto;
		display: block;
	}

	.table td,
	.table th {
		text-align: center;
	}

	span.p_span {
		text-align: center;
		display: inline-block;
		background: #e4e4e4;
		color: #dc2727;
	}

	.text_span {
		width: 80%;
		display: inline-block;
		text-align: center;

	}

	p.p_class {
		font-size: 18px;
		border: 1px solid #ccc;
		font-weight: bold;
	}

	.space {
		height: 120px;
	}

	.desc_content {
		font-size: 18px;
		padding-right: 15px;

	}

	a.filename {
		font-size: 14px;
		text-align: center;
		color: #dc2727;
		display: block;
	}
</style>

<body>
	<header class="header">
		<div class="container">
			<h1 class="title_center header-1 b-red en-font">CATALOG</h1>
			<div class="row ">
				<div class="col-md-7">
					<div class="space"></div>
					<p class="p_class"><span class="p_span" style="width: 20%;"> الرقم</span><span
							class="text_span en-font">
							{{$product->code}}</span></p>
					<br><br>
					<p class="p_class"><span class="p_span" style="width: 20%;"> الاسم اللاتيني</span><span
							class="text_span en-font"> {{$product->name_en}}</span>
					</p>
					<br><br>
					<p class="p_class"><span class="p_span" style="width: 20%;"> الاسم العربي</span><span
							class="text_span"> {{$product->name}}</span>
					</p>
				</div>
				<div class="col-md-5">
					<table class="table">
						<tr>
							<td colspan="4" style="border: none;">
								<img class="proimg" src="{{url('/')}}/uploads/products-attachments/{{$product->image}}"
									alt="{{$product->name}}">
							</td>
						</tr>
						<tr style="border: 1px solid;">
							<th style="border: 1px solid #a8a8a8;">الماركه</th>
							<th style="border: 1px solid #a8a8a8;">المنشأ</th>
							<th style="border: 1px solid #a8a8a8;">الصناعه</th>
							<th style="border: 1px solid #a8a8a8;">الضمان</th>
						</tr>
						<tr>
							<td> <img class="icoimg" style="width: 60px;"
									src="{{(isset($product->brand)) ? url('/').'/uploads/brands_images/'.$product->brand->image : ''}}"
									alt="">
							</td>
							<td> <img class="icoimg" style="width: 70px;"
									src="{{(isset($product->origin)) ? url('/').'/uploads/countries/'.$product->origin->image : ''}}"
									alt="">
							</td>
							<td> <img class="icoimg" style="width: 70px;"
									src="{{(isset($product->country)) ? url('/').'/uploads/countries/'.$product->country->image : ''}}"
									alt="">
							</td>
							<td>
								@if($product->insurance == '3 اشهر')
								<img style="width: 60px;" class="icoimg"
									src="{{url('/')}}/uploads/insurances_images/3months.png" alt="">
								@elseif($product->insurance == '6 اشهر')
								<img style="width: 60px;" class="icoimg"
									src="{{url('/')}}/uploads/insurances_images/6months.png""
								  alt="">
								  @elseif($product->insurance == '1 سنه')
								  <img style=" width: 60px;" class="icoimg" src="{{url('/')}}/uploads/insurances_images/1Year.png""
								  alt="">
								  @elseif($product->insurance == '2 سنه')
								  <img style=" width: 60px;" class="icoimg" src="{{url('/')}}/uploads/insurances_images/2Year.png""
								  alt="">
								  @endif
							</td>
						</tr>
					</table>
				</div>
			</div>



			@php
			$descriptions = explode('%,%', $product->description);
			$title_description = explode('%,%', $product->title_description);
			$img_description=explode(',', $product->img_description);
			$attachments=explode(',',$product->attachments);
$attachment_names = explode(',', $product->attachment_names);
$attachment_links = explode(',', $product->attachment_links);
$attachment_status = explode(',', $product->attachment_status);

$spec_chec=0;
$attach_check=0;
			@endphp
@if(count($descriptions) > 0)
@foreach($descriptions as $key=>$desc)
<div class=" row">
								@if(isset($title_description[$key]) && $title_description[$key] != "")
								<div class="col-md-12">
									<p class="p_class"><span class="p_span en-font"
											style="text-align: left; width: 100%;padding-left: 10px;">{{$title_description[$key]}}
										</span>
									</p>
								</div>
								@endif

								<div class="{{(isset($img_description[$key]) && $img_description[$key] != "") ? "
									col-md-8" : "col-md-12" }}">
									<p class="desc_content en-font" style="text-align: left">{{$desc}}</p>
								</div>
								@if(isset($img_description[$key]) && $img_description[$key] != "")
								<div class="col-md-4">
									<img class="proimg" src="{{url('/')}}/uploads/products-desc-imgs/{{$img_description[$key]}}"
										alt="{{$product->name}}">
								</div>
								@endif
				</div>


				@endforeach
				@endif

				<br><br>
				<div class="row spec_chec">
					<div class="col-md-12">
						<p class="p_class"><span class="p_span" style="width: 100%;"> المواصفات الفنيه
							</span>
						</p>
					</div>


					@foreach($sections as $section)
					@php
					$specs=App\Models\ProductSection::where('section_id',$section->id)->where('product_id',$product->id)->get();
					@endphp
					@if(count($specs) > 0 && $specs[0] != "")
					@php $spec_chec=1; @endphp
					<div class="col-md-7">
						<p class="p_class" style="border: none; margin-bottom: 0px;"><span class="p_span"
								style="width: 100%; font-size: 18px;">
								{{$section->name}}
							</span>
						</p>
						@foreach($specs as $spec)
						<p class="p_class"><span class="p_span"
								style="background:#fff;width: 19%;border-left: 1px solid #ccc;">
								{{$spec->name}}
							</span>
							<span class="text_span en-font"> {{$spec->description}}</span>
						</p>
						@endforeach
					</div>
					@endif
					@endforeach

					<div class="col-md-5">

					</div>
				</div>

				<div class="row attach_check">
					<div class="col-md-12">
						<p class="p_class"><span class="p_span" style="width: 100%;"> الوسائط
							</span>
						</p>
					</div>

					@if($attachments[0] != "" || $attachment_links[0] != "" || $attachment_names[0] != "")
					@foreach($attachments as $key=>$filename)
					@if(isset($attachment_status[$key]) && $attachment_status[$key] == 1)
					@php
					$attach_check=1;
					$attach=\App\Models\AttachmentCat::Where('name',$attachment_names[$key])->first();
					if($attach){
					$attachimg=url('/').'/uploads/attachcat/'.$attach->image;
					}else{
					$attachimg=asset('panel/app-assets/images/emptyimg.jpg');
					}
					@endphp
					<div class="col-md-2 centeritems">
						<img src="{{$attachimg}}" alt="{{$attachment_names[$key]}}"
							style="width: 75px;padding: 6px;margin: auto;display: block;">
						@if($filename != "")
						<br>
						<a href="{{url('/')}}/uploads/products-attachments/{{$filename}}" class="file{{$key}} filename en-font"
							download>{{$attachment_names[$key] != "" ? $attachment_names[$key] : "تحميل"}}
						</a><br>
						@endif
						@if(isset($attachment_links[$key]) && $attachment_links[$key] != "")
						<a href="{{$attachment_links[$key]}}" class="filename en-font"
							target="_blank">{{$attachment_names[$key]}}</a>
						@endif
					</div>
					@endif
					@endforeach
					@endif
				</div>
				<footer class="divFooter" style="font-size: 1.9rem; font-weight: bold; ">
					<hr class="border-danger" style="border-width: 5px;">
					<div class="row align-items-center justify-content-center text-center">
						<div class="col-md-6">
							<span class="m-2">
								{{getSettings('site_address_footer')}}
							</span>
							<span class="m-2" dir="ltr">
								<span dir="ltr">{{getSettings('site_phone')}}</span> : هاتف
							</span>
							<span class="m-2" dir="ltr">
								<span dir="ltr">{{getSettings('site_fax')}}</span> : فاكس
							</span>
							<span class="m-2" dir="ltr">
								<span dir="ltr">{{getSettings('site_po')}}</span> : ص-ب
							</span>
						</div>
						<div class="col-md-6 en-font" dir="ltr">
							<span class="m-2">
								{{getSettings('site_address_footer','','en')}} </span>

							<span class="m-2" dir="ltr">
								tel: {{getSettings('site_phone','','en')}}
							</span>
							<span class="m-2" dir="ltr">
								fax: {{getSettings('site_fax','','en')}} </span>
							<span class="m-2" dir="ltr">
								P.O.Box : {{getSettings('site_po','','en')}} </span>
						</div>
					</div>
					<div class="row align-items-center justify-content-center">
						<p class="text-center">
							<a class="mail-address en-font" href="mailto:{{getSettings('site_email')}}">
								Email: {{getSettings('site_email')}}
							</a>
						</p>
					</div>
				</footer>


			</div>
		</div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js "
	integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin=" anonymous "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js "
	integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1 " crossorigin="anonymous ">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js "
	integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM " crossorigin="anonymous ">
</script>
<script>
	$('#printInvoice').click(function () {
        window.print();

    });
</script>
<style>
	@media print {
		#spacer {
			height: 2em;
		}

		/* height of footer + a little extra */
		#footer {
			position: fixed;
			bottom: 0;
		}
	}

	tfoot {
		visibility: hidden;
	}

	@media print {
		#spacer {
			height: 200px;
		}

		table {
			page-break-inside: auto
		}

		.divFooter {
			position: relative;
			bottom: 0;
		}

		tr {
			page-break-inside: avoid;
			page-break-after: auto
		}

		.row {
			page-break-inside: avoid;
			page-break-after: auto
		}

		thead {
			display: table-header-group
		}

		tfoot {
			display: table-footer-group;
			visibility: hidden;
		}
	}

	tfoot tr td {
		border: none;
	}

	@if($attach_check==0) .attach_check {
		display: none;
	}

	@endif @if($spec_chec==0) .spec_chec {
		display: none;
	}

	@endif
</style>

</html>