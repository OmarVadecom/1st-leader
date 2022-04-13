<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>{{\Request::get('inv')}} تقرير المبيعات</title>
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
        th, tr.total {
            background-color: #009ADE;
            color: #fff;
            font-weight: 400;
        }
        .visible-print-media {
            display: none;
        }
        @media print {
            .link-sell {
                display: none;
            }
            .visible-print-media {
                display: inline;
            }
        }
    </style>
</head>
<body>

<div class="container" style="padding-right: 60px; padding-left: 60px;">
    <br><br>
    <h2 class ="en-font" style="text-align: center"> تقارير المبيعات </h2><br>
    <p style="text-align: center; font-size: 18px;"> من  <span class="en-font" style="color:#009ADE;padding: 0px 6px;"> {{date('d-m-Y',strtotime($from))}} </span> الي <span style="color:#009ADE;padding: 0px 6px;" class="en-font"> {{date('d-m-Y',strtotime($to))}} </span></p>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>التاريخ</th>
            <th>رقم الفاتورة</th>
            <th>اسم الزبون</th>
            <th>الاجمالي بدون ضريبه</th>
            <th>الضريبه</th>
            <th>الاجمالي</th>
        </tr>
        </thead>
        <tbody>
            @foreach($sells as $sell)
                <tr>
                    <td class ="en-font">{{  $sell->date }}</td>
                    <td class ="en-font">
                        <a href="{{ route('sells.show', $sell->id) }}" target="_blank" class="link-sell"> {{ $sell->code }} </a>
                        <span class="visible-print-media"> {{ $sell->code }} </span>
                    </td>
                    <td class ="en-font">{{  $sell->client->name }}</td>
                    <td class ="en-font">{{ str_replace(',', '', $sell->total_money) - $sell->total_vat }}</td>
                    <td  class ="en-font">{{ $sell->total_vat }}</td>
                    <td class ="en-font">{{  $sell->total_money }}</td>
                </tr>
            @endforeach
            <tr class="total">
                <td></td>
                <td></td>
                <td></td>
                <td class ="en-font">{{ number_format(((float)$total - (float)$vat), 3) }}</td>
                <td class ="en-font">{{ $vat }}</td>
                <td class ="en-font">{{ $total }}</td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
