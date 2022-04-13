<!DOCTYPE html>
<html lang="{{ getCurrentLang() }}" data-textdirection="{{ getCurrentDir() }}" class="loading">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description"
    content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
  <meta name="keywords"
    content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="PIXINVENT">
  <title>{{ trans('admin.cp') }}</title>
  <link rel="apple-touch-icon" sizes="60x60" href="{{ $panel_assets }}images/ico/apple-icon-60.png">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ $panel_assets }}images/ico/apple-icon-76.png">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ $panel_assets }}images/ico/apple-icon-120.png">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ $panel_assets }}images/ico/apple-icon-152.png">
  <link rel="shortcut icon" type="image/x-icon" href="{{ $panel_assets }}images/ico/favicon.ico">
  <link rel="shortcut icon" type="image/png" href="{{ $panel_assets }}images/ico/favicon-32.png">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="default">
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  @if (getCurrentDir() == 'ltr')
  @include('admin.layouts.style.ltr')
  @elseif (getCurrentDir() == 'rtl')
  @include('admin.layouts.style.rtl')
  @else
  @include('admin.layouts.style.ltr')
  @endif

  @if(isset($datatable))
  @if($datatable == true)
  <!-- BEGIN Datatable CSS-->
  <link rel="stylesheet" type="text/css" href="{{ $panel_assets }}datatables/dataTables.bootstrap4.min.css">
  <!-- END Datatable CSS-->
  <style type="text/css">
    .datatabeBTNS {
      margin: 10px 5px;
    }
  </style>
  @endif
  @endif
  <!-- Sweetalert -->
  {!! Html::style('cus/alert/sweetalert.css') !!}


  <!-- Checkbox -->
  {!! Html::style('cus/checkbox/css/vswitch.min.css') !!}
  {!! Html::style('cus/checkbox/css/vswitch-blue.min.css') !!}

  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

  @yield('style')
    <style type="text/css">
        @media print {
            .no-print {
                display: none;
            }
            .dataTables_wrapper .row:first-child, .dataTables_wrapper .row:last-child {
                display: none;
            }
            .margin-top-print {
                margin-top: -110px
            }
            @page { size: landscape;  margin: 0mm; }
        }
    </style>
</head>

<body data-open="click" data-menu="vertical-menu" data-col="2-columns"
  class="vertical-layout vertical-menu 2-columns  fixed-navbar  margin-top-print">
  <div id="file-manger-section"></div>
