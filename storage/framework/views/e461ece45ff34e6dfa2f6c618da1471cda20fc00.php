<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(getSettings()); ?> | <?php echo e(trans('site.cp')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
<!--<link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">-->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">


    <style type="text/css">

        body {

            font-family: 'Cairo', sans-serif !important;
            background: url('panel/background.jpg');
            background-size: cover;

        }

        h1 {
            font-family: 'Cairo', sans-serif !important;

        }

        .account-wall {
            background-color: #f7f7f7cf !important;
            border-radius: 8px;
            margin-top: 25% !important;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin .form-signin-heading, .form-signin .checkbox {
            margin-bottom: 10px;
        }

        .form-signin .checkbox {
            font-weight: normal;
        }

        .form-signin .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .account-wall {
            margin-top: 20px;
            padding: 40px 0px 20px 0px;
            background-color: #f7f7f7;
            -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }

        .login-title {
            color: #555;
            font-size: 18px;
            font-weight: 400;
            display: block;
        }

        .profile-img {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }

        .need-help {
            margin-top: 10px;
        }

        .new-account {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container" style="margin-top: 30px">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <h1 class="text-center login-title">تسجيل الدخول</h1>
                <?php if($errors->has('email')): ?>
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($errors->has('password')): ?>
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </div>
                    </div>
                <?php endif; ?>
                <form class="form-signin" method="POST" action="<?php echo e(route('login')); ?>" aria-label="<?php echo e(__('Login')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="email" name="email" class="form-control" placeholder="<?php echo e(trans('site.email')); ?>"
                           value="<?php echo e(old('email')); ?>" required autofocus>
                    <input type="password" class="form-control" name="password"
                           placeholder="<?php echo e(trans('site.password')); ?>" style="margin-top: 10px" required>
                    <select
                        style="padding: 0!important;margin-bottom:10px"
                        class="form-control"
                        id="yearSelected"
                        name="year"
                    >
                    </select>

                    <button class="btn btn-lg btn-primary btn-block" type="submit">
                        <?php echo e(trans('site.login')); ?></button>
                    <label class="checkbox pull-left">
                        <input type="checkbox" value="remember-me" name="remember"
                               id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                        <?php echo e(trans('site.remember')); ?>

                    </label>
                    <a href="https://vadecom.net/ar" target="_blank" class="pull-right need-help">Made by
                        vadecom </a><span class="clearfix"></span>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo e($panel_assets); ?>js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script>
    $( document ).ready(function() {
        var currentYear = new Date().getFullYear();
        var valueOption = 2018;
        var numOfDifferenceYears = currentYear - valueOption;
        for($i = 1; $i <= numOfDifferenceYears; $i++) {
            if(valueOption < currentYear) {
                if(currentYear === (parseFloat(valueOption) + parseFloat($i))) {
                    $('#yearSelected').append($('<option>', {
                        value: (parseFloat(valueOption) + parseFloat($i)),
                        text: (parseFloat(valueOption) + parseFloat($i))
                    }).prop('selected', true));
                } else {
                    $('#yearSelected').append($('<option>', {
                        value: (parseFloat(valueOption) + parseFloat($i)),
                        text: (parseFloat(valueOption) + parseFloat($i))
                    }));
                }

            }
        }
    });
</script>

</body>
</html>








