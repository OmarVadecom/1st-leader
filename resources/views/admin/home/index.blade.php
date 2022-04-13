@extends($pLayout . 'master')
@section('content')


    <div class="row home-linking">
        <div class="col-xl-2 col-lg-6 col-xs-12">
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">الاصناف
                </h4>
                <a style="font-size: 16px;" href="{{ route('product.index') }}">
                    المنتجات </a>
                @if(Auth::user()->id == 9)
                    <a style="font-size: 16px;" href="{{ route('parts.index') }}">قطع
                        الغيار </a>
                @endif    
            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">
                    المبيعات
                </h4>
                <a style="font-size: 16px;" href="{{ route('admin.sold_report.index') }}">
                    تم بيعه
                </a>
                <a style="font-size: 16px;" href="{{ route('admin.sells-of-day') }}">
                    تقرير المبيعات
                </a>
            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">
                    ادارة المحاسبه
                </h4>
                <a style="font-size: 16px;" href="{{ route('expense.index') }}">
                    بنود مصاريف
                </a>
                <a style="font-size: 16px;" href="{{ route('expensecategory.index') }}">
                    اقسام مصاريف
                </a>
                <a style="font-size: 16px;" href="{{ route('moneybox.index') }}">
                    الحسابات التفصيليه
                </a>
            </div>
        </div>

        <div class="col-xl-2 col-lg-6 col-xs-12">
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">المخزون </h4>
                <a style="font-size: 16px;" href="{{ route('warehouse.index') }}"> المستودعات
                </a>
                <a style="font-size: 16px;" href="{{ route('stock.index') }}">
                    المخزون </a>
                @if(Auth::user()->id == 1 || Auth::user()->id == 7 || Auth::user()->id == 9)
                    <a style="font-size: 16px;" href="{{ route('supplies.index') }}">
                        بضاعه اول المده </a>
                @endif
                @if(Auth::user()->id == 1 || Auth::user()->id == 7 || Auth::user()->id == 9)
                    <a style="font-size: 16px;" href="{{ route('transport.index') }}">
                        أوامر نقل بضاعه </a>
                @endif
            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">المتابعه </h4>
                <a style="font-size: 16px;" href="#">
                    المنتجات المحجوزة
                </a>
                <a style="font-size: 16px;" href="#">
                    المنتجات المتوفرة
                </a>
            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">السندات الماليه </h4>
                <a style="font-size: 16px;" href="{{ route('sanadat.index') }}?type=1">
                    سندات الصرف
                </a>
                <a style="font-size: 16px;" href="{{ route('sanadat.index') }}?type=2">
                    سندات القبض
                </a>
            </div>
        </div>

        <div class="col-xl-2 col-lg-6 col-xs-12">
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">ملخص الحركه</h4>
                <a style="font-size: 16px;" href="{{ route('admin.buy_report.index') }}">تم
                    شراءه </a>
            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">المشتريات</h4>
                <a style="font-size: 16px;" href="{{ route('purchases.index') }}?type=0">
                    المشتريات المحليه
                </a>
                <a style="font-size: 16px;" href="{{ route('purchases.index') }}?type=1">
                    المشتريات الدوليه
                </a>
            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">التحصيل</h4>
                <a style="font-size: 16px;" href="#">
                    قائمه الاوراق الماليه
                </a>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">العمليات الحسابيه
                </h4>
                <a style="font-size: 16px;" href="{{ route('admin.stockreport') }}">
                    المتابعه </a>

            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title"> الانماط المساعده </h4>
                <a style="font-size: 16px;" href="{{ route('product-categories.index') }}">
                    المجموعات </a>
                <a style="font-size: 16px;" href="{{ route('brands.index') }}">
                    البرندات </a>
                <a style="font-size: 16px;" href="{{ route('country.index') }}">
                    الدول </a>
                <a style="font-size: 16px;" href="{{ route('gifts.index') }}">
                    الهدايا </a>
                <a style="font-size: 16px;" href="{{ route('color.index') }}">
                    الالوان </a>
                <a style="font-size: 16px;" href="{{ route('attachmentcat.index') }}">
                    تصنيفات المرفقات </a>
                <a style="font-size: 16px;" href="{{ route('sections.index') }}">
                    تصنيفات المواصفات الفنيه </a>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-xs-12">
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title">عملاء Fasep </h4>
                {{-- <a style="font-size: 16px;" href="{{ route('letter.index') }}">
                خطابات العملاء </a> --}}
                <a style="font-size: 16px;" href="{{ route('tmpclients.index') }}?status=0">
                    قاعده بيانات العملاء </a>
                <a style="font-size: 16px;" href="{{ route('tmpclients.index') }}?status=1">
                    عملاء جديده </a>
            </div>
            <div class="card" style="padding: 20px;">
                <h4 class="home-card-title"> خدمات ما بعد البيع </h4>
                <a style="font-size: 16px;" href="{{ route('admin.sellsmnt.index') }}?main_type=1">
                    الورشه
                </a>
                <a style="font-size: 16px;" href="{{ route('admin.sellsmnt.index') }}?main_type=2">
                    الصيانه الخارجيه
                </a>
                <a style="font-size: 16px;" href="{{ route('admin.sellsmnt.index') }}?main_type=4">
                    الزيارة الميدانيه
                </a>
                <a style="font-size: 16px;" href="{{ route('admin.sellsmnt.index') }}?main_type=5">
                    مركز الاتصالات
                </a>
            </div>
            @if(in_array(auth()->id(), [1, 9]))
                <div class="card" style="padding: 20px;">
                    <h4 class="home-card-title"> الضمان </h4>
                    <a style="font-size: 16px;" href="{{ route('warranties.index') }}">
                        تقارير الضمان
                    </a>
                    <a style="font-size: 16px;" href="{{ route('warranties.create') }}">
                        انشاء تقرير ضمان جديد
                    </a>
                </div>
            @endif
        </div>
    </div>

    <style>
        .home-linking .card {
            padding: 20px !important;
        }

        .home-linking a {
            color: #961D1D;
            display: block;
            padding: 0;
            margin: 0;
            margin-bottom: 2px;
            list-style-type: circle !important;

        }

        .home-card-title {
            display: block !important;
            border-bottom: 1px solid #ccc !important;
            text-align: center;
            padding-bottom: 10px;
            font-weight: bold;
            font-size: 16px;
        }
    </style>
@endsection
