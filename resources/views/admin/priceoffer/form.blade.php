<div class="card-body">
    <div class="card-block">
        <div class="row">
            @if(\Request::get('status') == 1 || \Request::get('status') == 2)
            <div class="col-md-12">
                @if(isset($offer) && $offer->status == 1)
                <div class="form-group">
                    <div class="checkbox">
                        <label><input type="checkbox" name="status" value="2"> تحويل الي امر شراء </label>
                    </div>
                </div>
                @elseif(isset($offer) && $offer->status == 2)
                <div class="form-group">
                    <div class="checkbox">
                        <label><input type="checkbox" name="status" value="3"> تأكيد فاتوره الشراء </label>
                    </div>
                </div>
                @else
                <input type="hidden" name="status" value="1">
                @endif
                @if(\Request::get('pur_type'))
                <input type="hidden" name="pur_type" value="{{(\Request::get('pur_type'))}}">
                @else
                <input type="hidden" name="pur_type" value="0">

                @endif
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">المورد</label><br>
                    <select name="supplier_id" class="form-control" id="">
                        <option value="">اختر المورد</option>
                        @foreach($suppliers as $supplier)
                        <option value="{{$supplier->id}}" {{(isset($offer) && $offer->supplier==$supplier->name) ?
                            'selected' : '' }}>
                            {{$supplier->name}}</option>
                        @endforeach
                    </select>
                    <a href="{{route('supplier.create')}}" target="blank">اضافه مورد جديد</a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">الشركه</label><br>
                    <input type="text" class="form-control" name="supplier_comp"
                        value="{{isset($offer) ? $offer->supplier_comp : ''}}">

                </div>
            </div>
            @else
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">أختر الزبون</label><br>
                    <select name="customer" class="form-control selectproduct" required>
                        <option value="">اختر الزبون</option>
                        @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @if(isset($edit)||isset($verify)) {{ $customer->
                            id==$offer->customer_id ? 'selected' : '' }} @endif
                            {{(isset($visit) && $customer->id==$visit->customer_id) ? 'selected' : ''}}
                            {{(\Request::get('client') != '' && $customer->id==\Request::get('client')) ? 'selected' :
                            ''}}>
                            {{ $customer->name }}
                        </option>
                        @endforeach
                    </select><br>
                    <a href="{{url('/')}}/customers/create">اضافه زبون جديد </a>

                </div>
            </div>
            @endif
            <input type="hidden" name="parent" value="{{\Request::get('parent')}}">
            <div class="{{(\Request::get('status') == 1 || \Request::get('status') == 2) ? 'col-md-2' : 'col-md-3'}}">
                <div class="form-group">
                    <label for="title">التاريخ</label>
                    <input value=" {{$offer->date or date('Y-m-d')}}" required name="date" class="form-control">
                </div>
            </div>

            <div class="{{(\Request::get('status') == 1 || \Request::get('status') == 2) ? 'col-md-2' : 'col-md-3'}}">
                <div class="form-group">
                    <label for="title">الوقت</label>
                    <input value="{{$offer->time or date('h:i:s A')}}" required name="time" class="form-control">
                </div>
            </div>

            <div class="{{(\Request::get('status') == 1 || \Request::get('status') == 2) ? 'col-md-2' : 'col-md-3'}}">
                <div class="form-group">
                    <label for="title">مدة العرض</label>
                    <input required value="{{$offer->offer_duration or ''}}" name="offer_duration" class="form-control">
                </div>
            </div>


        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">ملاحظات</label>
                    <textarea name="notes" id="" class="form-control">{{$offer->notes or ''}}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">البيان</label>
                    <textarea name="declaration" class="form-control">{{$offer->declaration or ''}}</textarea>
                </div>
            </div>
        </div>
        <hr>
        <div class="tab">
            <button type="button" class="tablinks active" onclick="openTab(event, 'product-tab')">العرض</button>
            <button type="button" class="tablinks" onclick="openTab(event, 'details-tab')">تفاصيل العرض</button>
            @if(isset($verify))
            <button type="button" class="tablinks " onclick="openTab(event, 'verify-tab')">التعميد</button>
            @endif
            <button type="button" class="tablinks" onclick="openTab(event, 'attach-tab')">اضافه مرفق</button>
        </div>

        <div id="product-tab" class="tabcontent" style="display: block;">
            @php
            if(isset($edit)){
            $items=$offer_products ;
            $quantities=$offer_products_quantities;
            $prices=$offer_products_prices;
            $discounts=$offer_products_discounts;
            $taxes=$offer_products_taxes;
            $addon_disc=$offer->addon_disc;
            }
            @endphp
            @include('admin.layouts.product_table')

        </div>
        <div id="details-tab" class="tabcontent ">
            <div class="container">
                <div class="row">
                    <label> تفاصيل العرض</label>
                    <button type="button" onclick="addOfferDetail()" class="btn btn-primary">+</button>
                </div>
                <div id="offer-details" style="margin-top: 20px;" class="row">

                    @if(isset($edit)||isset($verify))
                    @foreach($offer_products_offer_details as $element)
                    <div id="single-offer-detail">
                        <div class="col-md-1">
                            <button onclick="removeOfferDetail(this);" type="button" class="btn btn-danger">-</button>
                        </div>

                        <div class="col-md-11">
                            <div class="form-group">
                                <input value="{{$element}}" name="offer_details[]" class="form-control">
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div id="single-offer-detail">
                        <div class="col-md-1">
                            <button onclick="removeOfferDetail(this);" type="button" class="btn btn-danger">-</button>
                        </div>

                        <div class="col-md-11">
                            <div class="form-group">
                                <input value="" name="offer_details[]" class="form-control">
                            </div>
                        </div>
                    </div>

                    @endif
                </div>

                <div class="row">
                    <label> تفاصيل العميل</label>
                    <button type="button" onclick="addClientDetail()" class="btn btn-primary">+</button>
                </div>
                <div id="client-details" style="margin-top: 20px;" class="row">
                    @if(isset($edit)||isset($verify))
                    @foreach($offer_products_client_details as $element)
                    <div id="single-client-detail">
                        <div class="col-md-1">
                            <button onclick="removeClientDetail(this);" type="button" class="btn btn-danger">-</button>
                        </div>

                        <div class="col-md-11">
                            <div class="form-group">
                                <input value="{{$element}}" name="client_details[]" class="form-control">
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div id="single-client-detail">
                        <div class="col-md-1">
                            <button onclick="removeClientDetail(this);" type="button" class="btn btn-danger">-</button>
                        </div>

                        <div class="col-md-11">
                            <div class="form-group">
                                <input value="" name="client_details[]" class="form-control">
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        @if(isset($verify))
        <div id="verify-tab" class="tabcontent " style="display: none;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">اجمالي القيمة </label>
                            <input disabled value="{{$total_price}} ر.س." required name="date" class="form-control">
                            <input type="hidden" id="total_price" name="total_price" value="{{$total_price}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">نوع البيع</label><br>
                            <select name="inv_type" id="inv_type" class="form-control">
                                <option value="">اختر حاله البيع</option>
                                <option value="1">دفع نقدي</option>
                                <option value="2">دفع علي دفعات</option>
                                <option value="0">دفع اجل</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row installment">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title">نسبة الدفعه الاولي %</label>
                                <input type="text" name="startpayment" placeholder="الدفعه الاولي المدفوعه"
                                    class="form-control" id="startpayment">

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="title">قيمه الدفعه الاولي</label>
                                <input  type="text" id="startpaymentvalue" placeholder="الدفعه الاولي المدفوعه"
                                    class="form-control" id="">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="title">عدد الدفعات</label>
                                <input type="number" name="installmentnum" placeholder="عدد الدفعات"
                                    class="form-control" id="installmentnum">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="title">قيمة الدفعات</label>
                                <input disabled type="number" placeholder="قيمة الدفعات" class="form-control"
                                    id="unitprice">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title">الجدوله</label>
                                <select name="installment_type" class="form-control" id="installment_type">
                                    <option value="">اختر الجدوله</option>
                                    <option value="1">بدايه كل شهر ميلادي</option>
                                    <option value="2">نهايه كل شهر ميلادي</option>
                                    <option value="3">بعد شهر من التركيب</option>
                                    <option value="4">تواريح محدده</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <br>
                            <button type="button" id="createtable" class="btn btn-primary">انشاء جدول للدفعات</button>
                            <p class="errortable" style="color: red;"> من فضلك ادخل البيانات كامله..! </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table showunitstable">
                                <thead>
                                    <th>م</th>
                                    <th width="15%">قيمه الدفعه</th>
                                    <th width="9%">نوعه </th>
                                    <th>البنك </th>
                                    <th width="10%">رقمه </th>
                                    <th width="10%">تاريخ الاستحقاق <br> من</th>
                                    <th width="10%">تاريخ الاستحقاق <br> الي</th>
                                    <th width="15%">ملاحظه </th>

                                </thead>
                                <tbody class="paymentstable">
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>


                <div class="row delayed">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">تاريخ الاستحقاق من</label>
                                <input type="date" name="datefrom" placeholder="من" class="form-control">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title"> الي</label>
                                <input type="date" name="dateto" placeholder="الي" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        -<div id="attach-tab" class="tabcontent " style="display: none;">
            <div class="container">
                <div class="row" >
                    <div class="col-md-8"><h2>اضافة مرفقات لعروض الاسعار المعمدة على دفعات</h2>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form action="{{route('priceoffer.multiuploads',$offer->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="">اضافة مرفقات :</label>
                            <br />
                            <select name="type">
                                <option disabled selected>اختر نوع المرفق</option>
                                <option value="كفالة غرم">كفالة غرم</option>
                                <option value=" كمبياله"> كمبياله</option>
                                <option value=" بيع اجل"> بيع اجل</option>
                                <option value=" كروكى "> كروكى </option>
                            </select>
                            <br>
                            <br>
                            <input type="file" class="form-control" name="attach" multiple />
                            <br /><br />
                            <input type="submit" class="btn btn-primary" value="Upload" />
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" value="0" name="prstatus" id="prstatus">
        <div class="col-md-12">
            <hr>
            <div class="clear">
                @if(isset($verify))
                <button type="submit" class="btn btn-success">
                    <i class="icon-check2"></i> تعميد
                </button>
                @else
                <button type="submit" class="btn btn-success">
                    <i class="icon-check2"></i> حفظ
                </button>
                @if(isset($edit))
                @if(\Request::get('status') != 1 && \Request::get('status') != 2)
                <a href="{{ route('priceoffer.edit',$offer->id) }}?q=verify" class="btn btn-primary">
                    <i class="icon-check2"></i> تعميد
                </a>
                @endif
                @endif
                @endif
                <a href="{{ route('priceoffer.index') }}" class="btn btn-danger">
                    <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
                </a>
            </div>
        </div>
    </div>
</div>

@section('script')
@include('admin.layouts.script')
@append

@include('admin.layouts.style.form_style')
