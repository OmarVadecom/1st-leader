<!DOCTYPE HTML>
<html lang="ar" dir="rtl">

<head>
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
	<meta name="description" content="First-Leader">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo e($panel_assets); ?>css/invoice.css">
	<link href="https://fonts.googleapis.com/css?family=Markazi+Text:400,500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
	<title>CATALOG-<?php echo e($product->code); ?></title>
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
							<?php echo e($product->code); ?></span></p>
					<br><br>
					<p class="p_class"><span class="p_span" style="width: 20%;"> الاسم اللاتيني</span><span
							class="text_span en-font"> <?php echo e($product->name_en); ?></span>
					</p>
					<br><br>
					<p class="p_class"><span class="p_span" style="width: 20%;"> الاسم العربي</span><span
							class="text_span"> <?php echo e($product->name); ?></span>
					</p>
				</div>
				<div class="col-md-5">
					<table class="table">
						<tr>
							<td colspan="4" style="border: none;">
								<img class="proimg" src="<?php echo e(url('/')); ?>/uploads/products-attachments/<?php echo e($product->image); ?>"
									alt="<?php echo e($product->name); ?>">
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
									src="<?php echo e((isset($product->brand)) ? url('/').'/uploads/brands_images/'.$product->brand->image : ''); ?>"
									alt="">
							</td>
							<td> <img class="icoimg" style="width: 70px;"
									src="<?php echo e((isset($product->origin)) ? url('/').'/uploads/countries/'.$product->origin->image : ''); ?>"
									alt="">
							</td>
							<td> <img class="icoimg" style="width: 70px;"
									src="<?php echo e((isset($product->country)) ? url('/').'/uploads/countries/'.$product->country->image : ''); ?>"
									alt="">
							</td>
							<td>
								<?php if($product->insurance == '3 اشهر'): ?>
								<img style="width: 60px;" class="icoimg"
									src="<?php echo e(url('/')); ?>/uploads/insurances_images/3months.png" alt="">
								<?php elseif($product->insurance == '6 اشهر'): ?>
								<img style="width: 60px;" class="icoimg"
									src="<?php echo e(url('/')); ?>/uploads/insurances_images/6months.png""
								  alt="">
								  <?php elseif($product->insurance == '1 سنه'): ?>
								  <img style=" width: 60px;" class="icoimg" src="<?php echo e(url('/')); ?>/uploads/insurances_images/1Year.png""
								  alt="">
								  <?php elseif($product->insurance == '2 سنه'): ?>
								  <img style=" width: 60px;" class="icoimg" src="<?php echo e(url('/')); ?>/uploads/insurances_images/2Year.png""
								  alt="">
								  <?php endif; ?>
							</td>
						</tr>
					</table>
				</div>
			</div>



			<?php
			$descriptions = explode('%,%', $product->description);
			$title_description = explode('%,%', $product->title_description);
			$img_description=explode(',', $product->img_description);
			$attachments=explode(',',$product->attachments);
$attachment_names = explode(',', $product->attachment_names);
$attachment_links = explode(',', $product->attachment_links);
$attachment_status = explode(',', $product->attachment_status);

$spec_chec=0;
$attach_check=0;
			?>
<?php if(count($descriptions) > 0): ?>
<?php $__currentLoopData = $descriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$desc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class=" row">
								<?php if(isset($title_description[$key]) && $title_description[$key] != ""): ?>
								<div class="col-md-12">
									<p class="p_class"><span class="p_span en-font"
											style="text-align: left; width: 100%;padding-left: 10px;"><?php echo e($title_description[$key]); ?>

										</span>
									</p>
								</div>
								<?php endif; ?>

								<div class="<?php echo e((isset($img_description[$key]) && $img_description[$key] != "") ? "
									col-md-8" : "col-md-12"); ?>">
									<p class="desc_content en-font" style="text-align: left"><?php echo e($desc); ?></p>
								</div>
								<?php if(isset($img_description[$key]) && $img_description[$key] != ""): ?>
								<div class="col-md-4">
									<img class="proimg" src="<?php echo e(url('/')); ?>/uploads/products-desc-imgs/<?php echo e($img_description[$key]); ?>"
										alt="<?php echo e($product->name); ?>">
								</div>
								<?php endif; ?>
				</div>


				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>

				<br><br>
				<div class="row spec_chec">
					<div class="col-md-12">
						<p class="p_class"><span class="p_span" style="width: 100%;"> المواصفات الفنيه
							</span>
						</p>
					</div>


					<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
					$specs=App\Models\ProductSection::where('section_id',$section->id)->where('product_id',$product->id)->get();
					?>
					<?php if(count($specs) > 0 && $specs[0] != ""): ?>
					<?php $spec_chec=1; ?>
					<div class="col-md-7">
						<p class="p_class" style="border: none; margin-bottom: 0px;"><span class="p_span"
								style="width: 100%; font-size: 18px;">
								<?php echo e($section->name); ?>

							</span>
						</p>
						<?php $__currentLoopData = $specs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<p class="p_class"><span class="p_span"
								style="background:#fff;width: 19%;border-left: 1px solid #ccc;">
								<?php echo e($spec->name); ?>

							</span>
							<span class="text_span en-font"> <?php echo e($spec->description); ?></span>
						</p>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					<div class="col-md-5">

					</div>
				</div>

				<div class="row attach_check">
					<div class="col-md-12">
						<p class="p_class"><span class="p_span" style="width: 100%;"> الوسائط
							</span>
						</p>
					</div>

					<?php if($attachments[0] != "" || $attachment_links[0] != "" || $attachment_names[0] != ""): ?>
					<?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$filename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if(isset($attachment_status[$key]) && $attachment_status[$key] == 1): ?>
					<?php
					$attach_check=1;
					$attach=\App\Models\AttachmentCat::Where('name',$attachment_names[$key])->first();
					if($attach){
					$attachimg=url('/').'/uploads/attachcat/'.$attach->image;
					}else{
					$attachimg=asset('panel/app-assets/images/emptyimg.jpg');
					}
					?>
					<div class="col-md-2 centeritems">
						<img src="<?php echo e($attachimg); ?>" alt="<?php echo e($attachment_names[$key]); ?>"
							style="width: 75px;padding: 6px;margin: auto;display: block;">
						<?php if($filename != ""): ?>
						<br>
						<a href="<?php echo e(url('/')); ?>/uploads/products-attachments/<?php echo e($filename); ?>" class="file<?php echo e($key); ?> filename en-font"
							download><?php echo e($attachment_names[$key] != "" ? $attachment_names[$key] : "تحميل"); ?>

						</a><br>
						<?php endif; ?>
						<?php if(isset($attachment_links[$key]) && $attachment_links[$key] != ""): ?>
						<a href="<?php echo e($attachment_links[$key]); ?>" class="filename en-font"
							target="_blank"><?php echo e($attachment_names[$key]); ?></a>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				</div>
				<footer class="divFooter" style="font-size: 1.9rem; font-weight: bold; ">
					<hr class="border-danger" style="border-width: 5px;">
					<div class="row align-items-center justify-content-center text-center">
						<div class="col-md-6">
							<span class="m-2">
								<?php echo e(getSettings('site_address_footer')); ?>

							</span>
							<span class="m-2" dir="ltr">
								<span dir="ltr"><?php echo e(getSettings('site_phone')); ?></span> : هاتف
							</span>
							<span class="m-2" dir="ltr">
								<span dir="ltr"><?php echo e(getSettings('site_fax')); ?></span> : فاكس
							</span>
							<span class="m-2" dir="ltr">
								<span dir="ltr"><?php echo e(getSettings('site_po')); ?></span> : ص-ب
							</span>
						</div>
						<div class="col-md-6 en-font" dir="ltr">
							<span class="m-2">
								<?php echo e(getSettings('site_address_footer','','en')); ?> </span>

							<span class="m-2" dir="ltr">
								tel: <?php echo e(getSettings('site_phone','','en')); ?>

							</span>
							<span class="m-2" dir="ltr">
								fax: <?php echo e(getSettings('site_fax','','en')); ?> </span>
							<span class="m-2" dir="ltr">
								P.O.Box : <?php echo e(getSettings('site_po','','en')); ?> </span>
						</div>
					</div>
					<div class="row align-items-center justify-content-center">
						<p class="text-center">
							<a class="mail-address en-font" href="mailto:<?php echo e(getSettings('site_email')); ?>">
								Email: <?php echo e(getSettings('site_email')); ?>

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
	@media  print {
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

	@media  print {
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

	<?php if($attach_check==0): ?> .attach_check {
		display: none;
	}

	<?php endif; ?> <?php if($spec_chec==0): ?> .spec_chec {
		display: none;
	}

	<?php endif; ?>
</style>

</html>