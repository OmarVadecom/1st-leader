<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Markazi+Text:400,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
<div style="direction:rtl">

    <header class="header">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-4 col-xs-12 col-xs-order">
                    <a href="index.html">
                        <img src="{{asset('site/img/logo.png')}}" alt="logo" class="img-fluid">
                    </a>
                </div>
                <div class="col-md-6" style="position: relative">
                    <h4 class="header-4">
                        عرض السعر
                    </h4>
                    <div class="row justify-content-start align-items-center Price-show">
                        <div class="col-2">
                            <h6 class="header-6">اليوم</h6>
                        </div>
                        <div class="col-10 date">
                            <!-- Date Of Today -->
                        </div>

                    </div>
                    <div class="row justify-content-start align-items-center Price-show">

                        <div class="col-2">
                            <h6 class="header-6">الوقت</h6>
                        </div>
                        <div class="col-10 time">
                            <!-- time Of Today -->
                        </div>
                    </div>
                    <div class="row justify-content-start align-items-center Price-show">
                        <div class="col-2">
                            <h6 class="header-6">مدة العرض</h6>
                        </div>
                        <div class="col-10 time">
                            One Week
                        </div>

                    </div>
                    <div class="row justify-content-start align-items-center Price-show">

                        <div class="col-2">
                            <h6 class="header-6">رقم العرض</h6>
                        </div>
                        <div class="col-10 time">
                            AMN - 0000
                        </div>
                    </div>
                    <div class="row justify-content-start align-items-center Price-show">

                        <div class="col-2">
                            <h6 class="header-6">رقم الحساب</h6>
                        </div>
                        <div class="col-10 time">
                            CSTM- 0000
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <section class="Personal_info">
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-6" class="client-info">
                    <h5 class="header-5">
                        بيانات العميل
                    </h5>
                    <ul class="about_data">
                        <li class="d-flex">
                            <span class="about_prop">السيد :</span>
                            <span class="about_value"> {{$customer->name}}</span>
                        </li>
                        <li class="d-flex">
                            <span class="about_prop">الشركة :</span>
                            <span class="about_value"> {{$customer->general_resp}}</span>
                        </li>
                        <li class="d-flex">
                            <span class="about_prop">العنوان :</span>
                            <span class="about_value">
                                {{$customer->street}}-{{$customer->region}}-{{$customer->region}}-{{$customer->country}}</span>
                        </li>
                        <li class="d-flex">
                            <span class="about_prop">إيميل :</span>
                            <span class="about_value"> <a href="#">{{$customer->email}}</a></span>
                        </li>
                        <li class="d-flex">
                            <span class="about_prop">رقم الهاتف :</span>
                            <span class="about_value">{{$customer->phonenumber}}</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 offer-info">
                    <h5 class="header-5">
                        تفاصيل العرض
                    </h5>
                    <ul class="about_data">
                        <li>هذه الأسعار شاملة للتركيب والتوصيل للموقع العميل</li>
                        <li>يتم التفاهم على طريقة السداد بعد المراجعة النهائية للأسعار.</li>
                        <li>الضمان يشمل العيوب الفنية والمصنعية لمدة سنة - ماعدى أجهزة النيتروجين.</li>
                        <li>أي خلل فني بسبب مشاكل التغذية الكهربائية في موقع العميل لا يشملها الضمان.</li>
                        <li>الأعمال المدنية تعتبر على العميل - وملتزمون بالدعم الفني والإستشاري بخصوصها</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="table-data">
        <div class="container">
            <div class="row mt-4">


                <table class="table table-striped table-responsive-md table-1" border=1>
                    <thead>
                        <tr>
                            <th>م</th>
                            <th>رقم الصنف</th>
                            <th>البيان</th>
                            <th>الصناعه</th>
                            <th>الوحده</th>
                            <th>الكميه</th>
                            <th>سعر البيع</th>
                            <th>الخصم</th>
                            <th>القيمه الاجماليه</th>
                            <th>رابط كاتالوج الصنف </th>
                        </tr>
                    </thead>



                </table>


                <br><br>
            </div>
        </div>
    </section>


    <footer class="footer">
        <div class="container">
            <div class="row ">
                <p class="text text-center w-100">
                    لمزيد من الإستفسار بخصوص هذا العرض الرجوع باستفساركم للسيد م/ هاشم عبدلله إسكندر
                    Mobile : +966 54 255 1213
                </p>
                <div class="container">
                    <div class="row justify-content-center footer-places">
                        <div class="col-md-6 text-center">
                            المملكة العربية السعودية - جدة - طريق مكة كيلو 3 بجانب مطعم البيك - مركز الدريويش -مكتب رقم
                            ( 2
                        </div>
                        <div class="col-md-6 text-center">
                            Tel: +966 12 633 0444 - Fax: +966 12 633 0555
                        </div>
                        <hr>
                    </div>
                    <div class="row justify-content-center footer-places">
                        <div class="col-md-6 text-center">
                            <a style="color: #B71C1C ; font-size: 2rem;" href="#">www.1st-leader.com</a>
                        </div>
                        <div class="col-md-6 text-center">
                            <a style="color: #B71C1C ; font-size: 2rem;" href="#">sales@1st-leader.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
</div>
<script>
    // date of today
var todayDate = new Date().toISOString().slice(0,10);
document.querySelector('.date').innerHTML = todayDate;

// time of Now
var today = new Date();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
document.querySelector('.time').innerHTML = time;
</script>


<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        font-size: 62.5%;
        box-sizing: inherit;
        font-family: 'Markazi Text', serif;
        text-align: right;

    }

    .container {
        max-width: 1300px;
    }


    /* typography*/
    .header-4 {
        font-size: 2rem;
        color: #B71C1C;
        font-weight: 500;
        text-align: center;
    }

    .header-6 {
        font-size: 1.6rem;
    }

    .header-5 {
        color: white;
        background-color: #B71C1C;
        font-size: 1.8rem;
        padding: 0rem 1rem;
    }

    .text {
        font-size: 1.7rem;
        font-weight: 500;
        margin-bottom: 0;
    }



    /* Header */

    .Price-show {
        font-size: 2rem;
    }

    .date,
    .time {
        border: 1px solid;
        text-align: start;
    }


    /* Client-info */
    .about_data {
        font-size: 1.5rem;
        font-weight: 700;
        padding: 0.5rem 1rem;
        list-style: none;
    }

    .about_data .about_prop {
        width: 20%;
    }

    .offer-info {
        border: 1px solid;
        padding-left: 0;
        padding-right: 0;
    }

    .footer-places {
        font-size: 1.5rem;
    }


    /* table data */

    .table {
        font-size: 1.6rem;
    }

    .table-1 thead {
        background-color: #B71C1C;
        color: white;
        text-align: center;
        width: 100%;
    }


    .table-striped>tbody>tr:nth-child(odd)>td,
    .table-striped>tbody>tr:nth-child(odd)>th {
        background-color: #f2dcdb !important;
    }

    .table-striped>tbody>tr:nth-child(even)>td,
    .table-striped>tbody>tr:nth-child(even)>th {
        background-color: #e6e6e6 !important;
    }




    .table .table-striped>tbody>tr:nth-child(even)>td,
    .table .table-striped>tbody>tr:nth-child(even)>th {
        background-color: #e6e6e6 !important;
    }

    .total-prop {
        text-align: left;
        background-color: #B71C1C;
        color: white;
    }

    .total-value {
        background-color: #A6A6A6;
        color: #B71C1C;
        text-align: center;
        font-weight: 700;
    }

    .client-comments {
        background-color: #B71C1C;
        color: white;
        text-align: center;
        font-weight: 700;
    }

    .about_prop-2 {
        width: 65%;
        text-align: center;
        font-weight: 700;
    }

    .footer-places {
        font-size: 1.5rem;
        font-weight: 700;
    }

    hr {
        background-color: black;
        width: 2px;
        width: 100%;
        margin: auto;
    }


    @media screen and (max-width: 767px) {

        html,
        body {
            font-size: 37.5%;
        }

        .col-xs-order {
            order: 1 !important;
        }

        .time,
        .date {
            margin-bottom: 1rem;
        }
    }
</style>