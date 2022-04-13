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
    <title><?php echo $__env->yieldContent('title'); ?></title>
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="row">
                <!-- Arabic Address-->
                <div class="col-md-4">
                    <h1 class="header-1 b-red mb-2 text-center"><?php echo e(getSettings()); ?></h1>
                    <p class="text-center font-weight-bold p-desc"><?php echo e(getSettings('site_desc')); ?></p>
                    <div class="d-flex">
                        <div>
                            <span class="about_prop">هاتف :</span>
                            <span class="about_value en-font"> &#x200E;<?php echo e(getSettings('site_phone')); ?></span>
                        </div>
                        <div>
                            <span class="about_prop">فاكس :</span>
                            <span class="about_value en-font"> &#x200E;<?php echo e(getSettings('site_fax')); ?></span>
                        </div>

                    </div>
                    <div>
                        <span class="about_prop">ص-ب :</span>
                        <span class="about_value en-font"> <?php echo e(getSettings('site_po')); ?> - جده <?php echo e(getSettings('site_zip')); ?></span>
                    </div>
                    <div>
                        <span class="about_prop">س-ت :</span>
                        <span class="about_value en-font"><?php echo e(getSettings('site_cr')); ?></span>
                    </div>
                    <div>
                        <span class="about_prop">العنوان :</span>
                        <span class="about_value "><?php echo e(getSettings('site_address')); ?></span>
                    </div>
                </div>
                <!-- Logo -->
                <div class="col-md-4 col-xs-12 col-xs-order">
                    <a href="index-update.html" class="mb-2">
                        <img src="<?php echo e(url('/')); ?>/uploads/logo/<?php echo e(getSettings('site_logo')); ?>" alt="<?php echo e(getSettings()); ?>"
                            class="img-fluid">
                    </a>
                    <p class="text-center">
                        <a class="mail-address en-font" href="mailto:<?php echo e(getSettings('site_email')); ?>" class="">
                            Email: <?php echo e(getSettings('site_email')); ?>

                        </a>
                    </p>

                </div>
                <!--English Address-->
                <div class="col-md-4 en-font">
                    <h1 dir="ltr" class="header-1 b-red mb-2 text-center" style="font-size:2.6rem;">
                        <?php echo e(getSettings('title',null,'en')); ?>.</h1>
                    <p class="text-center font-weight-bold p-desc"><?php echo e(getSettings('site_desc','','en')); ?></p>
                    <div class="d-flex" dir="ltr">
                        <div dir="auto">
                            <span class="about_prop">tel :</span>
                            <span dir="ltr" class="about_value"> <?php echo e(getSettings('site_phone','','en')); ?></span>
                        </div>
                        <div dir="ltr">
                            <span class="about_prop">fax :</span>
                            <span class="about_value"> <?php echo e(getSettings('site_fax','','en')); ?></span>
                        </div>
                    </div>
                    <div dir="ltr" class="text-left">
                        <span class="about_prop">P.O.Box :</span>
                        <span class="about_value"> <?php echo e(getSettings('site_po','','en')); ?> - Zip-Code:
                            <?php echo e(getSettings('site_zip','','en')); ?></span>
                    </div>
                    <div dir="ltr" class="text-left">
                        <span class="about_prop">C.R :</span>
                        <span class="about_value"><?php echo e(getSettings('site_cr','','en')); ?></span>
                    </div>
                    <div dir="ltr" class="text-left">
                        <span class="about_prop">Address :</span>
                        <span class="about_value"><?php echo e(getSettings('site_address','','en')); ?></span>
                    </div>
                </div>
            </div>

        </div>
    </header>

    <div class="container">


        <?php echo $__env->yieldContent('content'); ?>


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
    $('#printInvoice').click(function(){
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
.editbtu{
    display:none;
}

        .divFooter {
            position: fixed;
            bottom: 0;
        }

  tr    { page-break-inside:avoid; page-break-after:auto;}
  td    { page-break-inside:avoid; page-break-after:auto; }

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
</style>

<?php echo $__env->yieldContent('script'); ?>


</html>
