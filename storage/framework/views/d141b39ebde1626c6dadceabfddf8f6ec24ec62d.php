<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract of Sale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">    <link rel="stylesheet" href="<?php echo e(asset('panel/app-assets/css/invoice.css')); ?>">
    <link href="https://fonts.googleapis.com/css?family=Markazi+Text:400,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo e(asset('contract_style.css')); ?>">
    <script src="<?php echo e(asset('jquery.printPage.js')); ?>"></script>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="row">
                <!-- Arabic Address-->
                <div class="col-md-4">

                        <br><br>
                    <h1 class="header-1 b-red mb-2 text-center">شركة القائد الاول للألات و المعدات</h1>
                    <p class="text-center font-weight-bold p-desc">وكلاء و موزعون لألات صيانة السيارات و العناية بها</p>
                    <div class="d-flex">
                        <div>
                            <span class="about_prop">هاتف :</span>
                            <span class="about_value en-font"> &#x200E;00966-12-6330444</span>
                        </div>
                        <div>
                            <span class="about_prop">فاكس :</span>
                            <span class="about_value en-font"> &#x200E;33225</span>
                        </div>

                    </div>
                    <div>
                        <span class="about_prop">ص-ب :</span>
                        <span class="about_value en-font"> 33225 - جده </span>
                    </div>
                    <div>
                        <span class="about_prop">س-ت :</span>
                        <span class="about_value en-font">4030199739</span>
                    </div>
                    <div>
                        <span class="about_prop">العنوان :</span>
                        <span class="about_value ">طريق مكة كيلو 3 مقابل بنك ساب</span>
                    </div>
                </div>
                <!-- Logo -->
                <div class="col-md-4 col-xs-12 col-xs-order">
                    <a href="index-update.html" class="mb-2">
                        <img src="http://127.0.0.1:8000/uploads/logo/1609173085.png" alt="شركة القائد الاول للألات و المعدات"
                            class="img-fluid">
                    </a>
                    <p class="text-center">
                        <a class="mail-address en-font" href="mailto:info@1st-leader.com" class="">
                            Email: info@1st-leader.com
                        </a>
                    </p>

                </div>
                <!--English Address-->
                <div class="col-md-4 en-font">
                    <h1 dir="ltr" class="header-1 b-red mb-2 text-center" style="font-size:2.6rem;">
                        First Leader for Machinery &amp; Equipment.</h1>
                    <p class="text-center font-weight-bold p-desc">Authorised Dealer For Service Equipments of cars Serivce</p>
                    <div class="d-flex" dir="ltr">
                        <div dir="auto">
                            <span class="about_prop">tel :</span>
                            <span dir="ltr" class="about_value"> 00966-12-6330555</span>
                        </div>
                        <div dir="ltr">
                            <span class="about_prop">fax :</span>
                            <span class="about_value"> 00966-12-6330555</span>
                        </div>
                    </div>
                    <div dir="ltr" class="text-left">
                        <span class="about_prop">P.O.Box :</span>
                        <span class="about_value"> 33225 - Zip-Code:
                            33225</span>
                    </div>
                    <div dir="ltr" class="text-left">
                        <span class="about_prop">C.R :</span>
                        <span class="about_value">4030199739</span>
                    </div>
                    <div dir="ltr" class="text-left">
                        <span class="about_prop">Address :</span>
                        <span class="about_value">Makkah Kilo 3 Road next to Al-Beek Restaurant - Drwysh Center - Office No. (2)</span>
                    </div>
                </div>
            </div>

        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="title">
                <h2>إتفاقية بيع معدات بالاجل - مقسطة على دفعات</h2>
                <h4> رقم العميل <span></span></h4>
            </div>
            <div class="content">
                <label class="font-weight-bold">لقد تم الاتفاق بين كل من شركة القائد الاول للمعدات الصناعية طرف اول و السيد / </label>
                <span><?php echo e($offer->customer->name); ?></span>
                <br>
                <label> طرف ثاني و عنوانه :</label> <span> <?php echo e($offer->customer->country); ?> </span>
                <label>&ensp; ص.ب : </label> <span> <?php echo e($offer->customer->street); ?> </span>
                <label >&ensp;بمدينة : </label> <span> <?php echo e($offer->customer->reg_city); ?></span>
                <br>
                <label >&ensp;الرمز البريدي : </label><span> <?php echo e($offer->customer->reg_city); ?> </span>
                <label >&ensp;تليفون : </label><span> <?php echo e($offer->customer->resp_phone); ?></span>
                <label >&ensp;رقم الهوية : </label><span> <?php echo e($offer->customer->dreb_phone); ?></span>
                <label >&ensp;تاريخ : </label><span> <?php echo e($offer->date); ?></span>
                <br>
                <label >&ensp;بكفالة السيد : </label><span> <?php echo e($offer->resp_name_sponsor); ?></span>

                <label >و عنوانه</label> <span>..........</span>
                <br>
                <label >ص.ب</label> <span>..........</span>
                <label >رقم الهوية</label><span>..........</span>
                <label >تاريخ</label><span>..........</span>
                <br>
                <label class="font-weight-bold"> أولا : قبل الطرف الاول ان يبيع للطرف الثاني معدات من نوع</label>
                <span>

                </span>
                <br>
                <label >&ensp;  فاتورة معمدة رقم</label> <span> <?php echo e($offer_number); ?> </span>
                <br>
                <label >&ensp; مسجلة يتاريخ : </label><span> <?php echo e($offer->date); ?></span>
                <label >&ensp;  بمبلغ إجمالي : </label><span> <?php echo e($total_price); ?></span>

                <br>
                <label > فقط على أن يدفع الطرف الثاني للطرف الاول 35 %من اصل القيمة كدفعة أولى مبلغ وقدره</label>
                <span> <?php echo e($percent_format); ?></span>
                <br>
                <label >وقدره كتابة :</label><span> <?php echo e($word_percent); ?></span> <!--there is concatenation here +    ريال سعودي لاغير  -->
                <br>
                <label > بموجب سند الوارد رقم </label><span>..........</span>
                <label >تاريخ</label><span>..........</span>
                <label > و الباقي بذمة الطرف الثاني للطرف الاول المبلغ المتبقي من العرض و قدره رقما</label><span> <?php echo e($percent_remainder); ?></span>
                <br>
                <label > و قدره كتابة : </label><span> <?php echo e($word_remainder); ?></span><!--there is concatenation here +    ريال الغير  -->
                <br>
                <label >على أن يقسط الباقي على الطرف الثاني بموجب كمبيالات تدفع شهريا بموجب البيان التالي :</label>
                <br>
                <label class="pay">علي (<span></span> ) دفع مالية شهريا لمدة (<span></span> )  سنة</label>
                <label class="pay">من تاريخ / <span></span> </label>
                <label class="pay"> الي تاريخ / <span></span> </label>
            </div>
        </div>

        <div class="row">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2">م</th>
                        <th rowspan="2">قيمة الكمبيالة</th>
                        <th rowspan="2">رقمها</th>
                        <th rowspan="2">الفئة</th>

                        <th colspan="2">تاريخ الاستحقاق</th>
                        <th rowspan="2">ملاحظة</th>
                        </tr>
                        <tr>
                        <th rowspan="2">من</th>
                        <th rowspan="2">الي</th>
                        </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $funds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $fund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index +1); ?></td>
                        <td><?php echo e($fund->money); ?></td>
                        <td>رقمها</td>
                        <td>الفئة</td>
                        <td><?php echo e($fund->date_from); ?></td>
                        <td><?php echo e($fund->date_to); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="second-content">
                <label>   <span class="font-weight-bold">ثانيا</span> : قدم الطرف الثاني للطرف الاول كفالة غرم وأداءوتضامن مقدمة من</label>
                <span><?php echo e($offer->resp_name_sponsor); ?></span>
                <br>
                <label >برقم خطاب كفالة غرم رقم ............ و تاريخ
                    <span>day </span> /
                    <span> month </span> /
                    <span> year </span>  يتعهد الكفيل الغارم بموجبه
                </label>
                <br>
                <label>   <span class="font-weight-bold">ثالثا</span> : يقر الطرف الثاني بأنه استلم المعدات موضوع البيع بحالة سليمة و خلية من أي عيوب و انه قد عاينها المعاينة التامة النافية للجهالة . </label>
                <br>
                <label>   <span class="font-weight-bold">رابعا</span> : يحق للطـــــــرف الاول استلام المعدات من قبل الطرف الثاني و التصرف فيها في حالة اذا تأخر الطــرف الثـــــاني و كفيله عن دفع القسط لمدة اسبوع واحد من تاريخ استحقـــاقه
                    <br>
                    مهما كانت الاسباب , كما يحق للطرف الاول بيع المعدات دون الرجوع الى الطرف الثاني على ان يحسم ثمنها من مجموع المطلوب منه . فإذا بقي بعد البيع مبلغ لم يسدد للطرف
                    <br>
                    الاول من ثمن المعدات فعلى الطرف الثاني و كفيله دفع المبلغ الباقي دون تأخير كما لا يحق للطرف الثاني و كفيله الدعاء فيما بعد ان المعدات بيعت بعد سحبها بكثير او قليل .
                </label>
                <br>
                <label>   <span class="font-weight-bold">خامسا</span> :  يقهر و يعتبر الطرف الثاني بأنه استلم المعدات المبينة أوصفاها بعالية من الطرف الاول جديدة كاملة و بحالة تشغيل ممتازة و خالية من كل عيب .
                </label>
                <br>
                <label>   <span class="font-weight-bold">سادسا</span> : اذا لا سمح الله فقدت المعدات او اعطبت لدرجة ال يمكن تصليحها , فالطرف الثاني او كفيله مكلف بدفع جميع الاقساط الباقية من القيمة بدون أي اعتراض على ذلك .
                </label>
                <br>
                <label>   <span class="font-weight-bold">سابعا</span> : من المتفق عليه بأنه يحق للطرف الاول في حالة تمنع او تاخير الطرف الثاني او كفيله عن السداد لمدة شهر إقامة الدعوى لدى المراجع الرسمية.
                    <br>
                    المختصة بكامل المبلغ المستحق و غير المستحق .
                </label>
                <br>
                <label>   <span class="font-weight-bold">ثامنـــا</span> : يقر و يعترف الطرف الثاني و كفيله بأنهما وقعا هذه االتفاقية بعد قرائتها و فهما ما بها و هما بكامل وعيها و إدراكهما الشرعيين.
                </label>
                <br>
                <label>   <span class="font-weight-bold">تاسعا</span> :  علمت هذه الاتفاقية من ثلاث نسخ في يد كل من الطرفين نسخة و النسخة الثالثة بيد الكفيل للعمل بموجبها و على هذه الشروط و تم بالرضا و الاتفاق .
                </label>
                <br>
                <label>حررت هذه الاتفاقية بتاريخ
                    <span>day </span> /
                    <span> month </span> /
                    <span> year </span>
                </label>
                <label>14 هـ في مدينة <span>........</span></label>
                <br><br>
                <div class="d-flex justify-content-around">
                    <div>
                    <label >طرف أول  (بائع)  </label>
                    <br><span>sign</span>
                    </div>
                    <div>
                        <label >طرف ثاني  (بائع)  </label>
                        <br><span>sign</span>
                    </div>
                    <div>
                        <label >كفيل الطرف الثاني  (الضامن)  </label>
                        <br><span>sign</span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <center style="margin-bottom: 10px"> <i class="fa fa-print fa-2x "></i> <a href="javascript:window.print();" class="btn btn-primary" style="border-radius: 15px"><h1>Print Page</h1>  </a></center>
    </div>
</body>
</html>
