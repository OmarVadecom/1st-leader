<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Markazi+Text:400,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
<button class="btn btn-info" id="print">طباعه</button>
<div style="direction:rtl;" id="printthis">
<header class="header">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-4 col-xs-12 col-xs-order">
                    <a href="index.html">
                    <img src="{{asset("site/img/logo.png")}}" alt="logo" class="img-fluid">
                    </a>
                </div>
                <div class="col-md-6" style="position: relative">
                    <ul class="about_data">
                        <li class="d-flex">
                            <span class="about_prop">هاتف :</span>
                            <span class="about_value"> {{$customer->phonenumber}}</span>
                        </li>
                        <li class="d-flex">
                            <span class="about_prop">فاكس :</span>
                            <span class="about_value"> {{$customer->fax}}</span>
                        </li>
                        <li class="d-flex">
                            <span class="about_prop">ص-ب :</span>
                            <span class="about_value"> 8715</span>
                        </li>
                        <li class="d-flex">
                            <span class="about_prop">س-ت :</span>
                            <span class="about_value">4030199739</span>
                        </li>
                        <li class="d-flex">
                            <span class="about_prop">العنوان :</span>
                            <span class="about_value"> {{$customer->street}}-{{$customer->region}}-{{$customer->region}}-{{$customer->country}}</span>
                        </li>
                        <li class="d-flex">

                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </header>
    <section class="main">
        <div class="container">
            <div class="row mb-4 align-items-center">
                <div class="col-md-12">
                    <h2 class="header-2">
                        استمارة توضيح موقع العميل
                    </h2>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="row no-gutters" style="border: 1px solid black">
                        <div class="col-md-2 date-sec" style="border: 1px solid black">
                            <h3 class="header-3" style="position: relative;top: 25%;}">
                                التاريخ
                            </h3>
                            <br>
                            <br>
                            <br>
                        </div>
                        <div class="col-md-10">
                        <span style="font-size: 30px; padding-right: 20px;">{{date("Y/m/d")}}</span>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row no-gutters" style="border: 1px solid black">
                        <div class="col-md-6 number-sec">
                            <h3 class="header-3">
                                رقم العرض
                            </h3>
                        </div>
                        <div class="col-md-6">
                            <span style="font-size: 17px; padding-right: 20px;">{{$visit->id}}</span>

                        </div>
                    </div>
                    <div class="row no-gutters" style="border: 1px solid black">
                        <div class="col-md-6 number-sec">
                            <h3 class="header-3">
                                رقم التعميد
                            </h3>
                        </div>
                        <div class="col-md-6">
{{$visit->priceoffers[1]->id}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="row no-gutters" style="border: 1px solid black">
                        <div class="col-md-2 date-sec">
                            <h3 class="header-3">
                                اسم الجهة
                            </h3>
                        </div>
                        <div class="col-md-10">
                                <span style="font-size: 17px; padding-right: 20px;">{{$customer->general_resp}}</span>

                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row no-gutters" style="border: 1px solid black">
                        <div class="col-md-4 date-sec">
                            <h3 class="header-3">
                                رقم السجل التجاري </h3>
                        </div>
                        <div class="col-md-6">
                            {{$customer->segl_number}}
                        </div>
                    </div>

                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="row no-gutters" style="border: 1px solid black">
                        <div class="col-md-2 date-sec">
                            <h3 class="header-3">
                                اسم العميل
                            </h3>
                        </div>
                        <div class="col-md-10">
                                <span style="font-size: 17px; padding-right: 20px;">{{$customer->name}}</span>

                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row no-gutters" style="border: 1px solid black">
                        <div class="col-md-4 date-sec">
                            <h3 class="header-3">
                                رقم الهوية
                            </h3>
                        </div>
                        <div class="col-md-6">
                            {{$customer->org_number}}
                        </div>
                    </div>

                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="row no-gutters" style="border: 1px solid black">
                        <div class="col-md-2 date-sec">
                            <h3 class="header-3">
                                اسم الشرف </h3>
                        </div>
                        <div class="col-md-10">
                                <span style="font-size: 17px; padding-right: 20px;">{{$customer->name_en}}</span>

                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row no-gutters" style="border: 1px solid black">
                        <div class="col-md-4 date-sec">
                            <h3 class="header-3">
                                رقم الهوية
                            </h3>
                        </div>
                        <div class="col-md-6">
                            {{$customer->org_number}}
                        </div>
                    </div>

                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-md-3">
                    <div class="row no-gutters" style="border: 1px solid black">
                        <div class="col-md-4 date-sec">
                            <h3 class="header-3">
                                المدينة </h3>
                        </div>
                        <div class="col-md-8">
                                <span style="font-size: 17px; padding-right: 20px;">{{$customer->city}}</span>

                        </div>

                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row no-gutters" style="border: 1px solid black">
                        <div class="col-md-4 date-sec">
                            <h3 class="header-3">
                                المنطقة
                            </h3>
                        </div>
                        <div class="col-md-8">
                                <span style="font-size: 17px; padding-right: 20px;">{{$customer->region}}</span>

                        </div>
                    </div>

                </div>
            </div>
            <div class="row no-gutters" style="border: 1px solid black">
                <div class="col-md-1 date-sec">
                    <h3 class="header-3">
                        العنوان </h3>
                </div>
                <div class="col-md-11">
                        <span style="font-size: 17px; padding-right: 20px;">{{$customer->street}}</span>

                </div>
            </div>
            <div class="row no-gutters" style="border: 1px solid black">
                <div class="col-md-1 date-sec flx">
                    <h3 class="header-3">
                        موقع الخريطة </h3>

                </div>
                <div class="col-md-11 flx">
                    <a class="link" href="https://www.google.com.sa/maps/@{{$visit->lat}},{{$visit->lng}},89m/data=!3m1!1e3?hl=ar" target="_blank">الموقع علي الخريطه</a>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
            <div class="row no-gutters" style="border: 1px solid black">
                <div class="col-md-12 date-sec">
                    <h3 class="header-3" style="font-weight: 700">
                        تنبهيات مهمة </h3>
                </div>
            </div>
             <div class="row no-gutters align-items-center" style="border: 1px solid black">
                <div class="col-md-1 date-sec">
                    <h3 class="header-3" style="font-weight: 700 ; position: relative;
    top: 4px;">
                        1 </h3>
                </div>
                <div class="col-md-11">
                    <p class="text">تشهد كافة الإجراءات المتبعة لدى مؤسسة القائد الأول بصحة البيانات المسجلة في هذا النموذج .</p>
                </div>
            </div>
             <div class="row no-gutters" style="border: 1px solid black">
                <div class="col-md-1 date-sec">
                    <h3 class="header-3" style="font-weight: 700; position: relative;
    top: 4px;">
                        2 </h3>
                </div>
                <div class="col-md-11">
               <p class="text">
                   تؤكد مؤسسة القائد الأول في هذا النموذج والنموذج المرفق للخريطة صحة ودقة بيانات موقع العميل بالإحداثيات العالمية المعتمدة من نظام خرائط GOOGLE .
               </p>
                </div>
            </div>
             <div class="row no-gutters" style="border: 1px solid black">
                <div class="col-md-1 date-sec">
                    <h3 class="header-3" style="font-weight: 700; position: relative;
    top: 4px;">
                        3 </h3>
                </div>
                <div class="col-md-11">
<p class="text">
    يؤكد العميل  والمشرف المعمد لديه على صحة البيانات المقدمة من جهته وإعتمادها كجزء من ضهن باقي الإجراءات الرسمية المتفق عليها بين الطرفين .
</p>
               </div>
            </div>
            <div class="row no-gutters">
                <div class="col-md-4">
                     <div class="col-md-12 date-sec p-4" style="border:  1px solid black">
                    <h4 class="header-4" style="font-weight: 700">
                        تنبهيات مهمة </h4>
                </div>
                </div>
                <div class="col-md-4">
                     <div class="col-md-12 date-sec p-4" style="border:  1px solid black">
                    <h4 class="header-4" style="font-weight: 700">
                        توقيع السكرتارية </h4>
                </div>
                </div>
                <div class="col-md-4">
                     <div class="col-md-12 date-sec p-4" style="border:  1px solid black">
                    <h4 class="header-4" style="font-weight: 700">
                        توقيع مدير المبيعات </h4>
                </div>
                </div>
            </div>
             <div class="row no-gutters">
                <div class="col-md-4" style="height: 300px">
                     <div class="col-md-12 p-4" style="border:  1px solid black ; height: 200px">

                </div>
                </div>
                <div class="col-md-4"  style="height: 300px">
                     <div class="col-md-12 p-4" style="border:  1px solid black; height: 200px">

                </div>
                </div>
                <div class="col-md-4" >
                     <div class="col-md-12 p-4" style="border:  1px solid black ; height: 200px">

                </div>
                </div>
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
                            المملكة العربية السعودية - جدة - طريق مكة كيلو 3 بجانب مطعم البيك - مركز الدريويش -مكتب رقم ( 2
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
<script src="{{ $panel_assets }}js/core/libraries/jquery.min.js" type="text/javascript"></script>

<script>
$("#print").click(function(){
    window.print();
})
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
    color: black;
    font-weight: 500;
    text-align: center;
}

.header-6 {
    font-size: 1.6rem;
}

.header-2
{
    font-size: 4rem;
    text-align: center;
    background-color: #ccc;
    color: #B71C1C
}

.header-5 {
    color: white;
    background-color: #B71C1C;
    font-size: 1.8rem;
    padding: 0rem 1rem;
}

.text {
    font-size: 1.7rem;
    font-weight: 700;
    margin-bottom: 0;
    color: #B71C1C
}



/* Header */

.date-sec , .number-sec
{
    background-color: #ccc;
    color: red;
    text-align: center;
}

.date-sec .header-3,
.number-sec .header-3
{
    font-size: 1.8rem;
    color: #B71C1C;
}

/* Client-info */
.about_data {
    font-size: 1.5rem;
    font-weight: 700;
    padding: 0.5rem 1rem;
    list-style: none;
}


.about_data .about_prop {
    padding: 0 0rem 0 5rem;
}


.about_data .d-flex
{
    width: auto;
}

.flx
{
display: flex;
    justify-content: center;
    align-items: center;
}

.link
{
    font-size: 2rem;
}

.offer-info {
    border: 1px solid;
    padding-left: 0;
    padding-right: 0;
}

.footer-places
{
    font-size: 1.5rem;
}

@media screen and (max-width: 767px) {
    html,
body
    {
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