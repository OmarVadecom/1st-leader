
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 :: Page Not Found</title>

    <link href="https://vadecom.net/assets/site/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://vadecom.net/assets/site/css/errors.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                <div class="text-center">
                    <img style="width:200px;" src="{{url('/')}}{{getSettings('logo')}}"
                         alt="{{getSettings()}}"
                         class="logo"
                    >

                        <h1 class="error-title">
        <strong>
            404 :: Page Not Found
        </strong>
    </h1>

    <p>Visit our <a href="{{url('/')}}">homepage</a>.</p>                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://vadecom.net/assets/site/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>