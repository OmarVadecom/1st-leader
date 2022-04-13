<!DOCTYPE HTML>
<html>
    <head>

        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
        <meta name="description" content="First-Leader">
        <meta charset="UTF-8">

        <title>تقرير ضمان</title>

        <link
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            crossorigin="anonymous"
            rel="stylesheet"
        />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
        <link href="https://fonts.googleapis.com/css?family=Markazi+Text:400,500&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
        <link rel="stylesheet" href="<?php echo e($panel_assets); ?>css/invoice.css" />

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

                .editbtu {
                    display: none;
                }

                .divFooter {
                    position: fixed;
                    bottom: 0;
                }

                tr {
                    page-break-inside: avoid;
                    page-break-after: auto;
                }

                td {
                    page-break-inside: avoid;
                    page-break-after: auto;
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

            .product-table span,
            .product-value span {
                display: table;
                margin: 0 auto !important;
            }

            .about_value {
                height: 100%;
            }

            th,
            td {
                padding: .5rem !important;
                font-size: 16px;
                font-weight: bold;
                text-align: center;
            }

            .main_pro_image {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .fa-star {
                color: #ffc12b;
                font-size: 15px;
            }

            @media  print {
                .editbtu {
                    display: none;
                }

                table {
                    page-break-inside: avoid !important;
                    border-collapse: collapse;
                }

                .divFooter {
                    position: relative !important;
                }
            }

            .logo-show-warranty {
                margin-top: -20px
            }

        </style>

    </head>
    <body>
        <header class="header mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 en-font">
                        <div class="address-english-info w-75 text-left">
                            <h1 class="header-1 b-red mb-2 text-center" style="font-size:2.6rem;">
                                <?php echo e(getSettings('title',null,'en')); ?>.
                            </h1>
                            <p class="font-weight-bold p-desc" style="padding-left: 5px">
                                <?php echo e(getSettings('site_desc','','en')); ?>

                            </p>
                            <div dir="ltr" class="text-left">
                                <span class="about_prop">Address :</span>
                                <span class="about_value"><?php echo e(getSettings('site_address','','en')); ?></span>
                            </div>
                            <div>
                                <span class="about_prop">P.O.Box :</span>
                                <span class="about_value">
                                    <?php echo e(getSettings('site_po','','en')); ?> - Zip-Code: <?php echo e(getSettings('site_zip','','en')); ?>

                                </span>
                            </div>
                            <div>
                                <span class="about_prop">Tax Number :</span>
                                <span class="about_value"><?php echo e(getSettings('site_vat')); ?></span>
                            </div>
                            <div>
                                <span class="about_prop">Email :</span>
                                <span class="about_value"><?php echo e(getSettings('site_email')); ?></span>
                            </div>
                            <div>
                                <span class="about_prop">fax :</span>
                                <span class="about_value"> <?php echo e(getSettings('site_fax','','en')); ?></span>
                            </div>
                            <div>
                                <span class="about_prop">tel :</span>
                                <span class="about_value"><?php echo e(getSettings('site_phone','','en')); ?></span>
                            </div>
                            <div>
                                <span class="about_prop">C.R :</span>
                                <span class="about_value"><?php echo e(getSettings('site_cr','','en')); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 col-xs-order">
                        <a href="<?php echo e(route('admin.home')); ?>" class="mb-2">
                            <img src="<?php echo e(url('/')); ?>/uploads/logo/<?php echo e(getSettings('site_logo')); ?>" alt="<?php echo e(getSettings()); ?>" class="img-fluid logo-show-warranty" />
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-12 text-center" style="border: 1px solid #ccc;padding: 7px 0">
                    <h3 class="header-3">
                        Warranty Report
                        <a
                            href="<?php echo e(route('warranties.edit', $warranty->id)); ?>"
                            class="editbtu"
                            target="_blank"
                        > - Edit</a>
                    </h3>
                </div>
            </div>
            <div class="row no-gutters" style="margin-bottom: 40px;">
                <div class="col-md-6">
                    <div class="row no-gutters text-left" style="border: 1px solid #ccc; border-top: 0">
                        <div class="col-12" style="border-bottom: 1px solid #ccc;padding:6px 5px">
                            <?php if($warranty->product_id): ?>
                                <?php if(isset($warranty->product)): ?>
                                    <span class="about_prop en-font">Product : <?php echo e($warranty->product->name); ?></span>
                                <?php else: ?>
                                    <span class="about_prop en-font">Product : -</span>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if(isset($warranty->part)): ?>
                                    <span class="about_prop en-font">Part : <?php echo e($warranty->part->name); ?></span>
                                <?php else: ?>
                                    <span class="about_prop en-font">Part : -</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-12" style="border-bottom: 1px solid #ccc;padding:7px 5px">
                            <span class="about_prop en-font">Date : <?php echo e($warranty->date_create_warranty); ?></span>
                        </div>
                        <div class="col-12" style="padding:7px 5px">
                            <span class="about_prop en-font">Code : <?php echo e($warranty->code . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT)); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 m-auto" style="border: 1px solid #CCC;border-top: 0;border-left: 0;padding: 10px 0 0">
                    <div class="row no-gutters  text-center">
                        <img width="150" height="200" src="<?php echo e(asset('panel/app-assets/images/barcode.png')); ?>" alt="" class="img-fluid m-auto" />
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="border-bottom-0">Technical Report</th>
                        <th class="border-bottom-0">Recommendation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo e($warranty->tech_report); ?></td>
                        <td><?php echo e($warranty->recommend); ?></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered" style="margin: 40px 0">
                <thead>
                    <tr>
                        <th colspan="2" style="background: #FFFF99">Pictorial Notes</th>
                    </tr>
                    <tr>
                        <th>The Description</th>
                        <th>Picture</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="position: relative;">
                                <?php echo e($note); ?>

                            </td>
                            <td>
                                <?php if(isset($attachments[$i]) && $attachments[$i] != ""): ?>
                                    <img src="<?php echo e(url('/')); ?>/uploads/warranty-attachments/<?php echo e($attachments[$i]); ?>" style="width:150px" alt="" />
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <footer class="divFooter" style="font-size: 1.9rem; font-weight: bold; ">
                <hr class="border-danger" style="border-width: 5px;">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-md-6 en-font" dir="ltr">
                        <span class="m-2 d-block">
                            <?php echo e(getSettings('site_address_footer','','en')); ?>

                        </span>
                        <span class="m-2" dir="ltr">
                            tel: <?php echo e(getSettings('site_phone','','en')); ?>

                        </span>
                        <span class="m-2" dir="ltr">
                            fax: <?php echo e(getSettings('site_fax','','en')); ?>

                        </span>
                        <span class="m-2" dir="ltr">
                            P.O.Box : <?php echo e(getSettings('site_po','','en')); ?>

                        </span>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center">
                    <p class="text-center">
                        <a class="mail-address en-font">
                            Email: <?php echo e(getSettings('site_email')); ?>

                        </a>
                    </p>
                </div>
            </footer>
        </div>

        <script
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            crossorigin="anonymous"
        ></script>
        <script
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            crossorigin="anonymous"
        ></script>
        <script
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            crossorigin="anonymous"
        ></script>
        <script>
            $('#printInvoice').on('click', function () {
                window.print();
            });
        </script>
    </body>
</html>
