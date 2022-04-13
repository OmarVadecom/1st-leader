<!DOCTYPE html>
<html lang="en">
<head>
  <title>{{\Request::get('inv')}} - QR Code</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ $panel_assets }}css/invoice.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
      .table td,th {
   text-align: center;   
   padding: 28px !important;
}
th{
    background-color: #009ADE;
    color: #fff;
    font-weight: 400;
}
  </style>
</head>
<body>

<div class="container" style="padding-right: 60px; padding-left: 60px;">
    <br><br>
  <h2 class ="en-font" style="text-align: center">{{\Request::get('inv')}} - QR Code Decoding</h2><br>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th width="20%" class ="en-font">Tag</th>
        <th width="40%" class ="en-font">Hex Value</th>
        <th width="40%" class ="en-font">Hex to String</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th class ="en-font">01 Seller Name</th>
        <td class ="en-font">{{bin2hex(\Request::get('seller'))}}</td>
        <td >{{\Request::get('seller')}}</td>
      </tr>
      <tr>
        <th class ="en-font">02 Vat Number</th>
        <td class ="en-font">{{bin2hex(\Request::get('vat_num'))}}</td>
        <td class ="en-font">{{\Request::get('vat_num')}}</td>
      </tr>
      <tr>
        <th class ="en-font">03 TimeStamp</th>
        <td class ="en-font">{{bin2hex(\Request::get('time'))}}</td>
        <td class ="en-font">{{\Request::get('time')}}</td>
      </tr>
      <tr>
        <th class ="en-font">04 Invoice Amount</th>
        <td class ="en-font">{{bin2hex(\Request::get('total'))}}</td>
        <td class ="en-font">{{\Request::get('total')}}</td>
      </tr>
      <tr>
        <th class ="en-font">05 Vat Amount</th>
        <td class ="en-font">{{bin2hex(\Request::get('vat'))}}</td>
        <td class ="en-font">{{\Request::get('vat')}}</td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>
