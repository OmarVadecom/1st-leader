<div class="card-body">
    <div class="card-block">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" name="status" value="3">
                @if(\Request::get('pur_type'))
                <input type="hidden" name="pur_type" value="{{(\Request::get('pur_type'))}}">
                @else
                <input type="hidden" name="pur_type" value="0">

                @endif
            </div>
            <div class="col-md-3">
                <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                    <label> الحساب التفصيلي</label>
                    <select name="box_id" class="form-control select2" id="">
                        <option value="">اختر الحساب</option>
                        @foreach($boxs as $box)
                        <option value="{{$box->id}}" {{(isset($offer) && $offer->box_id == $box->id) ? 'selected' :
                            ''}}>
                            {{$box->name}}</option>
                        @endforeach
                    </select>
                </div><!-- /.form-group -->
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
            <input type="hidden" name="parent" value="{{\Request::get('parent')}}">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">التاريخ</label>
                    <input value=" {{$offer->date or date('Y-m-d')}}" required name="date" class="form-control">
                </div>
            </div>



        </div>


        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">الوقت</label>
                    <input value="{{$offer->time or date('H:i:s')}}" required name="time" class="form-control">
                </div>
            </div>

            <div class="col-md-5">
                <div class="form-group">
                    <label for="title">ملاحظات</label>
                    <textarea name="notes" id="" class="form-control">{{$offer->notes or ''}}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="title">البيان</label>
                    <textarea name="declaration" class="form-control">{{$offer->declaration or ''}}</textarea>
                </div>
            </div>
        </div>


        <div class="row">

        </div>



        <hr>

        <div class="tab">
            <button type="button" class="tablinks active" onclick="openTab(event, 'product-tab')">الفاتوره</button>
            <!-- <button type="button" class="tablinks" onclick="openTab(event, 'details-tab')">تفاصيل العرض</button>-->
            @if(isset($verify))
            <button type="button" class="tablinks " onclick="openTab(event, 'verify-tab')">التعميد</button>
            @endif

        </div>

        <div id="product-tab" class="tabcontent" style="display: block;">
            <div class="col-md-12">
                <table id="added_products_table" class="table table-striped" style="text-align:center">
                    <thead>
                        <tr>
                            <th>رقم المادة</th>
                            <th>الماده</th>
                            <th>الوحده</th>
                            <th style="width:7%;">الكميه</th>
                            <th style="width:9%;">السعر </th>
                            <th>الاجمالي</th>
                            <th style="width:8%;">الضريبه</th>
                            <th>الاجمالي بعد الضريبه</th>
                            <th style="width:8%;">الخصم</th>
                            <th>الاجمالي بعد الخصم</th>
                        </tr>
                    </thead>
                    <tbody id="table_body" class="productsadd">

                        @if(isset($edit)||isset($verify))
                        @foreach($offer_products as $k => $product )
                        @if($product)
                        <tr><input type="hidden" name="product[]" value="{{$product->id}}">
                            <input type="hidden" name="product_code_type[]" value="{{$product->code_type or ''}}">
                            <td>{{$product->code}}<br><button class="addondiscbtu" data-row-id="{{$k}}">خصم
                                    اضافي</button></td>
                            <td> {{$product->name}}</td>
                            <td class="unit{{$k}}"></td>
                            <td><input type="number" value="{{$offer_products_quantities[$k]}}" data-number="{{$k}}"
                                    placeholder="الكميه" min="1"
                                    class="quantities form-control productquantity quantity{{$k}}" name="quantity[]"
                                    required>
                            </td>
                            <td><input type="number" value="{{round($offer_products_prices[$k],2)}}"
                                    data-number="{{$k}}" step="any" placeholder="السعر" min="1"
                                    class="prices form-control productprice price{{$k}}" name="price[]" required> </td>
                            <td class="totals totalfir{{$k}}">
                                {{round($offer_products_prices[$k]*$offer_products_quantities[$k],2)}}</td>
                            <td><input type="number" value="{{$offer_products_taxes[$k]}}" data-number="{{$k}}"
                                    placeholder="الضريبه" min="0" class="prices form-control productdreba dareba{{$k}}"
                                    name="darebadis[]" style="width:85%" disabled> <input type="hidden" name="dareba[]"
                                    value="{{$offer_products_taxes[$k]}}" id=""><span
                                    style="float: left; margin-top: -32px;">%</span> </td>
                            <td class="totals totalsec{{$k}}">
                                @php $dreba=$offer_products_prices[$k] * $offer_products_quantities[$k] *
                                $offer_products_taxes[$k]/100; @endphp
                                {{round( $offer_products_prices[$k] * $offer_products_quantities[$k] + $dreba,2) }}
                            </td>
                            <td><input type="number" value="{{$offer_products_discounts[$k]}}" data-number="{{$k}}"
                                    placeholder="الخصم %" min="0"
                                    class="form-control productdiscount discounts discount{{$k}}" style="width:85%"
                                    name="discount[]" required><span style="float: left; margin-top: -32px;">%</span>
                            </td>
                            <td class="totals total{{$k}}"> {{round($offer_products_totals[$k],2)}} </td><input
                                id="total_input" value="{{$offer_products_totals[$k]}}" type="hidden" name="totals[]"
                                class="totalinp{{$k}} totalinp">
                            <td><i data-rownumber="{{$k}}" class="fa fa-times clickremrow"></i> </td>
                        </tr>

                        <tr class="row{{$k}}">
                            <td colspan="8"><input type="text" placeholder=" تفاصيل الخصم" class="form-control"
                                    name="note_discount[]"
                                    value="{{(isset($addon_notes[$k])) ? $addon_notes[$k] : ''}}"></td>
                            <td><input type="number" class="form-control addondiscoutvalue" data-row_id="{{$k}}"
                                    name="note_discount_value[]"
                                    value="{{(isset($addon_discounts[$k])) ? $addon_discounts[$k] : ''}}"
                                    placeholder="الخصم">
                            </td>

                        </tr>
                        @endif
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <table class="table table-striped" style="text-align:center">
                    <tbody>
                        <tr>
                            <td colspan="7" style="width: 70%;"></td>
                            <td colspan="2">الاجمالي</td>
                            <td colspan="1" class="totalmo">0</td>

                        </tr>
                        <tr>
                            <td colspan="6"></td>
                            <td colspan="3">خصم اضافي</td>
                            <td colspan="1"><input type="text" value="{{isset($edit) ? $offer->addon_disc : ''}}"
                                    name="addon_disc" style="text-align: center;" class="form-control totdisc"></td>

                        </tr>
                        <tr>
                            <td colspan="7" style="width: 70%;"></td>
                            <td colspan="2">الاجمالي بعد الخصم</td>
                            <td colspan="1" class="totalmoafter">0</td>
                            <input type="hidden" name="totalafterdisc" class="totalmoinp">
                        </tr>
                    </tbody>
                </table>

            </div>
            @include('admin.product_search.product_search')

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
                                <input disabled type="text" id="startpaymentvalue" placeholder="الدفعه الاولي المدفوعه"
                                    class="form-control" id="">
                            </div>
                        </div>



                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> قيمة الضريبة</label>
                                <input type="text" id="tax" name="tax" placeholder="قيمة الضريبة" class="form-control">
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="title"> الدفعه الاولي</label>
                                <input disabled id="startwithtax" type="text" placeholder="الدفعه الاولي "
                                    class="form-control" id="">
                            </div>
                        </div> --}}

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
                <!--
                    <div class="row">
                        <div class="col-md-12 installment_dates">
                            <div class="col-md-2">
                                <input type="date" name="installment_dates[]" class="form-control" placeholder="تاريخ دفعه" id="">
                            </div>
                            <div class="col-md-1">
                                <button id="addinputf" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div> -->
            </div>
        </div>
        @endif


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
<style>
    .errortable,
    .showunitstable {
        display: none;
    }

    th {
        vertical-align: middle;
    }

    button {
        font-weight: normal;
    }

    .rowhidden {
        display: none;
    }
</style>
@section('script')
<script>
    $(document).ready(function() {
        $(document).on("click",".addondiscbtu",function() {
            row_id=$(this).data('row-id');
           $(".row"+row_id).fadeToggle('slow');
            return false;
        })


        $(document).on('keyup mouseup','.addondiscoutvalue', function() {
            num = $(this).data('row_id');
            discount=$(this).val();
            if(discount == ""){
            discount=0;
            }

            //get second total before discount to handle total
            totalsecond=$(".totalsec" + num).text();
            var r = /\d+/;
            totalsecond=totalsecond.match(r);
            discountbefore= $('.discount' + num).val();
            discountvalue = totalsecond * (discountbefore / 100);
            total = totalsecond - discountvalue;
            //-------------------


            discountvalue = total * (discount / 100);
            totaldisc=+total + +discountvalue;
            totaldisc=Math.round((totaldisc + Number.EPSILON) * 100) / 100;
            $(".total" + num).html(totaldisc);
            $(".totalinp"+num).val(totaldisc);
        })
        $(document).on('keyup', '.productprice, .productquantity, .productdreba, .productdiscount', function() {
            num = $(this).data('number');
            price = $('.price' + num).val();
            quantity = $('.quantity' + num).val();
            dreba = $(".dareba" + num).val();
            discount = $('.discount' + num).val();
            total=$('.totalinp' + num).val();

             if(total != "" && price == ""){
               price=total;
               $('.price' + num).val(total);
              }
            totalfirst = price * quantity;
            drebavalue = totalfirst * (dreba / 100);
            totalsecond = totalfirst + drebavalue;
            console.log(totalsecond+' '+totalfirst+' '+drebavalue);
            discountvalue = totalsecond * (discount / 100);
            totalthird = totalsecond - discountvalue;
            $(".totalfir" + num).html(totalfirst);
            $(".totalsec" + num).html(totalsecond);
            // $(".total" + num).html(totalthird);
            $(".totalinp"+num).val(totalthird);
            //el5asm el edafy
            addondisc=$(".addondiscoutvalue[data-row_id="+num+"]").val();
            if(addondisc != "" || addondisc != 0){
            discountval = totalthird * (addondisc / 100);
            totaldisc=+totalthird + +discountval;
            totaldisc=Math.round((totaldisc + Number.EPSILON) * 100) / 100;
            $(".totalinp"+num).val(totaldisc);
            $(".total" + num).html(totaldisc);
            }

          //----------------------------------
var sumtotal = 0;
$('.totalinp').each(function(){
    sumtotal += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
});
$(".totalmo").text(sumtotal);

            total=$(".totalmo").text();
disc=$(".totdisc").val();
$(".totalmoafter").text(total-disc);
$(".totalmoinp").val(total-disc);
        })
//check total after vat on keyup totalinp
@if(isset($edit))
var sumtotal = 0;
$('.totalinp').each(function(){
    sumtotal += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
$(".totalmo").text(sumtotal);
});
    total=$(".totalmo").text();
disc=$(".totdisc").val();
$(".totalmoafter").text(total-disc);
$(".totalmoinp").val(total-disc);
@endif
        $(document).on('keyup','.totalinp', function() {
            num = $(this).data('number');
            total=$(this).val();
            $(".totalsec" + num).html(total);
            $('.discount' + num).val(0);
            quantity = $('.quantity' + num).val();
            dreba = $(".dareba" + num).val();
            dr_val=parseFloat("1."+dreba);
            oldprice = (total/dr_val).toFixed(2);
            $(".totalfir" + num).html(oldprice);
            if(quantity != ""){
            unitprice=oldprice/quantity;
            $('.price' + num).val(unitprice);
             }else{
                $('.price' + num).val(oldprice);
                $('.quantity' + num).val(1);
             }
var sumtotal = 0;
$('.totalinp').each(function(){
    sumtotal += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
});
$(".totalmo").text(sumtotal);
total=$(".totalmo").text();
disc=$(".totdisc").val();
$(".totalmoafter").text(total-disc);
$(".totalmoinp").val(total-disc);
        })
        $('.selectproduct').select2();




        $(document).on("click", ".clickremrow", function() {
            $(this).parents("tr:first").remove();
            var sumtotal = 0;
$('.totalinp').each(function(){
    sumtotal += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
});
$(".totalmo").text(sumtotal);
total=$(".totalmo").text();
disc=$(".totdisc").val();
$(".totalmoafter").text(total-disc);
$(".totalmoinp").val(total-disc);
        })





        var count = 0;
        $("#addinputf").click(function() {
            count += 1;

            limit = $("#installmentnum").val();
            if (limit != '' && limit < count + 1) {
                return false;
            }
            $(".installment_dates").append('<div class="col-md-3"> <input type="date" name="installment_dates[]" class="form-control" placeholder="تاريخ دفعه" id=""> </div>');
            return false;
        })


        $("#inv_type").change(function() {
            if ($(this).val() == 2) {
                $(".installment").show('slow');
                $(".delayed").hide('slow');
            } else if($(this).val() == 0) {
                $(".installment").hide('slow');
                $(".delayed").show('slow');

            }else{
                $(".delayed").hide('slow');
                $(".installment").hide('slow');

            }
        })


        $(document).on('change', '#installment_type', function() {
            if ($(this).val() == 4) {
                $(".installment_dates").show('slow');
            } else {
                $(".installment_dates").hide('slow');
            }
        })


        $("#submitprint").click(function() {
            $("#prstatus").val(1);
        })
        $("#lfm").hide();
    })


    $("#startpayment").keyup(function(){
        price=$("#total_price").val();
        value=$(this).val();
        $("#startpaymentvalue").val(price*value/100);

        // if($("#tax").val() != ""){
        // tax=$("#tax").val();
        // price=$("#startpaymentvalue").val();
        // $("#startwithtax").val(+tax + +price);
        // }
        if($("#installmentnum").val() != "" && $("#tax").val() != ""){
        // startwithtax=$("#startwithtax").val();
        startwithtax=$("#startpaymentvalue").val();

        totalprice=$("#total_price").val();
        number=$("#installmentnum").val();
        sub=totalprice-startwithtax;
        unitprice=sub/number;
        unitprice=Math.round((unitprice + Number.EPSILON) * 100) / 100
        $("#unitprice").val(unitprice);
        }
    })


    // $("#tax").keyup(function(){
    //     value=$(this).val();
    //     price=$("#startpaymentvalue").val();
    //     $("#startwithtax").val(+value + +price);
    //     if($("#installmentnum").val() != ""){
    //         number=$("#installmentnum").val();
    //         totalprice=$("#total_price").val();
    //         price=$("#startwithtax").val();
    //         sub=totalprice-price;
    //         unitprice=sub/number;
    //         unitprice=Math.round((unitprice + Number.EPSILON) * 100) / 100
    //        $("#unitprice").val(unitprice);
    //     }
    // })

$("#installmentnum").keyup(function(){
number=$(this).val();
price=$("#total_price").val();
price =price.replace(" ر.س.", "");
// start=$("#startwithtax").val();
start=$("#startpaymentvalue").val();
sub=price-start;
unitprice=sub/number;
unitprice=Math.round((unitprice + Number.EPSILON) * 100) / 100
$("#unitprice").val(unitprice);
})
$(".totdisc").keyup(function(){
total=$(".totalmo").text();
disc=$(this).val();
$(".totalmoafter").text(total-disc);
$(".totalmoinp").val(total-disc)
})
$("#createtable").click(function(){
if($("#startpayment").val() == "" || $("#tax").val() == "" || $("#installmentnum").val() == "" || $("#installment_type").val()==""){
    $(".errortable").show('slow');
}else{
    $(".errortable").hide('slow');
    $(".showunitstable").show('slow');
    $(".paymentstable").html('')
    // start=$("#startwithtax").val();
    start=$("#startpaymentvalue").val();
    counts=$("#installmentnum").val();
    totalprice=$("#total_price").val();
    type=$("#installment_type").val();

    var date = new Date();
    var month = date.getMonth();
    var newDate = new Date(date.setMonth(date.getMonth()+1));
    sub=totalprice-start;
    unitprice=$("#unitprice").val();
    for(i=0; i<counts; i++){
    var date = new Date();
    var month = date.getMonth();
    ie=i+1;
    var newDate = new Date(date.setMonth(date.getMonth()+ie));
    startmonth=new Date(newDate.getFullYear(), newDate.getMonth(), 1);
    endmonth=new Date(newDate.getFullYear(), newDate.getMonth() + 1, 0);
    var start_date = startmonth.getDate();
    var start_month = startmonth.getMonth() + 1; //Months are zero based
    var start_year = startmonth.getFullYear();

    var end_date = endmonth.getDate();
    var end_month = endmonth.getMonth() + 1; //Months are zero based
    var end_year = endmonth.getFullYear();

    if(start_month<10){
        start_month='0'+start_month;
    }
    if(start_date < 10){
        start_date='0'+start_date;
    }
    if(end_date < 10){
    end_date='0'+end_date;
    }
    if(end_month < 10){
    end_month='0'+end_month;
    }

    startmonth=start_year + "-" + start_month + "-" + start_date;
    endmonth=end_year + "-" + end_month + "-" + end_date;
    if(type==1){
    datevalue=startmonth;
    }else if(type == 2){
    datevalue=endmonth;
    }else if(type == 3){
        datevalue='install';
    }else{
        datevalue='';
    }
    if(datevalue=='install'){
        $(".paymentstable").append('<tr> <td>'+ie+'</td> <td><input type="number" name="unit_price[]" value="'+unitprice+'" class="form-control"></td> <td><select data-num="'+ie+'" name="unit_type[]" class="form-control cashtype" id=""> <option value="1">شيك</option> <option value="0">كمبياله</option> </select></td> <td><select name="unit_bank[]" class="form-control unitbank'+ie+'" id=""> <option value="البنك الأهلي التجاري">البنك الأهلي التجاري</option> <option value="بنك ساب">بنك ساب</option> <option value="البنك السعودي الفرنسي">البنك السعودي الفرنسي</option> <option value="البنك الأول">البنك الأول</option> <option value="البنك السعودي للاستثمار">البنك السعودي للاستثمار</option> <option value="البنك العربي الوطني">البنك العربي الوطني</option> <option value="بنك البلاد">بنك البلاد</option> <option value="بنك الجزيرة">بنك الجزيرة</option> <option value="بنك الرياض">بنك الرياض</option> <option value="بنك سامبا">بنك سامبا</option> <option value="مصرف الراجحي">مصرف الراجحي</option> <option value="مصرف الإنماء">مصرف الإنماء</option> <option value="بنك الخليج الدولي">بنك الخليج الدولي</option> </select></td> <td><input  type="text" name="unit_bank_number[]" class="form-control unitbanknum'+ie+'" id=""> </td> <td>بعد شهر من التركيب</td> <td>بعد شهر من التركيب</td> <td><textarea name="unit_notes[]" class="form-control" rows="2"></textarea></td> </tr>');
    }else{
        $(".paymentstable").append('<tr> <td>'+ie+'</td> <td><input type="number" name="unit_price[]" value="'+unitprice+'" class="form-control"></td> <td><select  data-num="'+ie+'" name="unit_type[]" class="form-control cashtype" id="">  <option value="1">شيك</option> <option value="0">كمبياله</option> </select></td> <td><select  name="unit_bank[]" class="form-control unitbank'+ie+'" id=""> <option value="البنك الأهلي التجاري">البنك الأهلي التجاري</option> <option value="بنك ساب">بنك ساب</option> <option value="البنك السعودي الفرنسي">البنك السعودي الفرنسي</option> <option value="البنك الأول">البنك الأول</option> <option value="البنك السعودي للاستثمار">البنك السعودي للاستثمار</option> <option value="البنك العربي الوطني">البنك العربي الوطني</option> <option value="بنك البلاد">بنك البلاد</option> <option value="بنك الجزيرة">بنك الجزيرة</option> <option value="بنك الرياض">بنك الرياض</option> <option value="بنك سامبا">بنك سامبا</option> <option value="مصرف الراجحي">مصرف الراجحي</option> <option value="مصرف الإنماء">مصرف الإنماء</option> <option value="بنك الخليج الدولي">بنك الخليج الدولي</option> </select></td> <td><input type="text" name="unit_bank_number[]" class="form-control unitbanknum'+ie+'" id=""> </td> <td><input type="date" name="date_from[]" class="form-control" placeholder="من" value="'+datevalue+'" required></td> <td><input type="date" name="date_to[]" class="form-control" placeholder="الي" value="'+datevalue+'" required></td> <td><textarea name="unit_notes[]" class="form-control" rows="2"></textarea></td> </tr>');
    }
}
}
})
</script>


<script type="text/javascript">
    var added_products;
    $(document).ready(function() {

        $(document).on('change', '.cashtype', function() {
            num=$(this).data('num');
            value=$(this).val();
            if(value == 1){
            $(".unitbank"+num).show('slow');
            $(".unitbanknum"+num).show('slow');
            }else{
            $(".unitbank"+num).hide('slow');
            $(".unitbanknum"+num).hide('slow');
            }


        });

    });

    var k = '@if(isset($edit)||isset($verify)){{count($offer_products)}}@else{{0}}@endif';
    $(".add_products_btn").click(function() {
        var products = [];
        var parts = [];
        $.each($("input[name='product_id']:checked"), function() {
            if($(this).data('type')=='ES'||$(this).data('type')=='EA')
            {
                parts.push($(this).val());
            }
            else products.push($(this).val());
        });

        $.ajax({
            dataType: "json",
            url: "{{route('admin.ajax_add')}}",
            data: {
                'product_ids': products,
                'part_ids': parts,
            },
            success: function(data) {
                // $('#added_products_table').find("tr:gt(0)").remove();
                for (var i = 0; i < data.length; i++) {
                    var name='';
                    if(data[i].name!=null)
                            name = data[i].name;
                    $('#added_products_table tr:last').after('<tr><input type="hidden" name="product[]" value="' + data[i].id + '">  <input type="hidden" name="product_code_type[]" value="' + data[i].code_type + '"> <td>' + data[i].code + '<br><button class="addondiscbtu" data-row-id="'+k+'">خصم اضافي</button> </td><td> ' +name + '</td><td class="unit1"></td><td><input type="number"  data-number="' + k + '" placeholder="الكميه" min="1"class="quantities form-control productquantity quantity' + k + '" name="quantity[]" required></td><td><input type="number"  data-number="' + k + '" step="any" placeholder="السعر" value="'+data[i].price+'" min="1" class="prices form-control productprice price' + k + '" name="price[]" required> </td><td class="totals totalfir' + k + '"></td> <td><input type="number" value="15" data-number="' + k + '" placeholder="الضريبه" min="0"class="prices form-control productdreba dareba' + k + '" name="darebadis[]" style="width:85%" disabled> <input type="hidden" name="dareba[]" value="15" id=""><span style="float: left; margin-top: -32px;">%</span> </td><td class="totals totalsec' + k + '"></td> <td><input type="number" value="0" data-number="' + k + '" placeholder="الخصم %" min="0"class="form-control productdiscount discounts discount' + k + '"style="width:85%" name="discount[]" required><span style="float: left; margin-top: -32px;">%</span> </td><td class="totals total' + k + '"> <input id="total_input" type="number" step="any" data-number="' + k + '" name="totals[]" class="totalinp' + k + ' form-control totalinp"> </td> <td><i class="fa fa-times clickremrow"></i> </td></tr><tr class="row'+k+' rowhidden"> <td colspan="8"><input type="text" placeholder=" تفاصيل الخصم" class="form-control" name="note_discount[]"></td> <td><input type="number" class="form-control addondiscoutvalue" data-row_id="'+k+'" name="note_discount_value[]" value="" placeholder="الخصم"></td> </tr>');
                    $("#products_table").hide('slow');
                    $(".add_products_btn").hide('slow');
                    k++;
                }
            }
        });




    });
</script>

<script>
    function openTab(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>


<script>
    function addOfferDetail() {
        $("#offer-details").append('<div id="single-offer-detail" ><div class="col-md-1"> <button onclick="removeOfferDetail(this);" type="button" class="btn btn-danger" >-</button></div><div class="col-md-11"> <div class="form-group"> <input name="offer_details[]" class="form-control"></div></div></div>');
    }


    function removeOfferDetail(data) {
        $(data).parent().parent().remove();
    }


    function addClientDetail() {
        $("#client-details").append('<div id="single-client-detail" ><div class="col-md-1"> <button onclick="removeClientDetail(this);" type="button" class="btn btn-danger" >-</button></div><div class="col-md-11"> <div class="form-group"> <input name="offer_details[]" class="form-control"></div></div></div>');
    }


    function removeClientDetail(data) {
        $(data).parent().parent().remove();
    }
</script>

@append

@section('style')
<style>
    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 6px 10px;
        transition: 0.3s;
        font-size: 16px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #fff;
        border-bottom: 2px solid red;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border-top: none;
    }


    .tabcontent {
        animation: fadeEffect 1s;
        /* Fading effect takes 1 second */
    }

    /* Go from zero to full opacity */
    @keyframes fadeEffect {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>

<style>
    td,
    th {
        padding: 5px 5px !important;
    }

    .select2 {
        width: 100% !important;
    }

    .select2-container {
        font-size: 14px !important;
        text-align: right !important;
        ;
    }

    th {
        text-align: center !important;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background: #dff0d8 !important;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background: #f2dede !important;
    }

    .totals {
        font-weight: bold;
    }

    .clickremrow {
        background: antiquewhite;
        padding: 12px;
        cursor: pointer;
        color: red;
    }

    .installment,
    .delayed,
    .installment_dates {
        display: none;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@endsection