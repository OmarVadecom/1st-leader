<table class="table table-bordered">

    <thead>
        <tr>
            <th>م</th>
            <th>رقم الصنف</th>
            <th>البيان</th>
            @if(isset($show_img))
            <th> المنشأ</th>
            <th> الصناعه</th>
            @endif
            <th>الكمية</th>
            <th>السعر </th>
            <th>الخصم</th>
            <th>الاجمالي قبل الضريبه</th>
            <th>الضريبه {{getSettings('site_vat_value')}}%</th>
            <th>السعر بعد الضريبه</th>
            <th>الاجمالي</th>
            @if(isset($show_img))
            <th>الصوره</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @php
        $total=0;
        $total_discount=0;
        $total_vat=0;
        $total_quantitiy_price=0;
        $total_before_vat=0;
        $addon_disc_general=0;
        $colspan=7;
        if(isset($show_img)){
            $colspan=10;
        }
        @endphp
        @foreach($items as $key=>$product)
        @if(isset($product))
        @php
        $subtotal=round($quantities[$key] * $prices[$key],2);
        $total_quantitiy_price+=$subtotal;
        $totalsecond=$subtotal*($discounts[$key]/100);
        $total_discount+=$totalsecond;
        $totalbeforevat=$subtotal-$totalsecond;
        $total_before_vat+=$totalbeforevat;
        $totalvatval=$totalbeforevat*(getSettings('site_vat_value')/100);
        $total_vat+=$totalvatval;
        $totalvat=round($totalbeforevat+$totalvatval,2);
        $total +=$totalvat;
        @endphp
        <tr>
            <td class="en-font">{{$key+1}}</td>
            <td class="en-font">{{$product->code}}</td>
            <td>{{$product->name}} | <span class="en-font">{{$product->name_en}}</span></td>
            @if(isset($show_img))
            <td class="en-font"><img class="icoimg" style="width: 30px;"
                    src="{{ (isset($product->brand) ? url('/').'/uploads/brands_images/'.$product->brand->image : '') }}"
                    alt=""></td>
            <td class="en-font"><img class="icoimg" style="width: 30px;"
                    src="{{ (isset($product->origin) ? url('/').'/uploads/countries/'.$product->origin->image : '') }}"
                    alt=""></td>
            @endif
            <td class="en-font">{{$quantities[$key]}}</td>
            <td class="en-font">{{$prices[$key]}}</td>
            <td class="en-font">({{$discounts[$key]}}%) {{$totalsecond}}</td>
            <td class="en-font">{{$subtotal}}</td>

            <td class="en-font">{{round($totalvatval,2)}}</td>
            <td class="en-font">{{$totalvat}}</td>
            <td class="en-font">{{$totalvat}}</td>
            @if(isset($show_img))
            <td>
                @if(isset($product->code_type))
                <img src="{{ url('/') }}/uploads/parts-attachments/{{ $product->image }}" style="width:80px;">
                @else
                <img src="{{ url('/') }}/uploads/products-attachments/{{ $product->image }}" style="width:80px;">
                @endif
            </td>
            @endif
        </tr>
        @endif
        @endforeach
        <tr>
            <td colspan="{{$colspan}}"></td>
            <td colspan="2"> الصافي:</td>
            <td class="en-font">{{$total_quantitiy_price}}</td>
        </tr>
        <tr>
            <td colspan="{{$colspan}}"></td>
            <td colspan="2"> الخصم:</td>
            <td class="en-font">{{number_format(round($total_discount,2))}}</td>
        </tr>
        @if(isset($addon_disc) && $addon_disc != "" && $addon_disc != 0)
        <tr>
            <td colspan="{{$colspan}}"></td>
            <td colspan="2"> الخصم الاضافي:</td>
            <td class="en-font">{{$addon_disc}}</td>
        </tr>
        @endif
        @php
        if(isset($addon_disc) && $addon_disc != "" && $addon_disc != 0){
        $total_before_vat=$total_before_vat-$addon_disc;
        $total_vat=$total_before_vat*(getSettings('site_vat_value')/100);
        $total=$total_before_vat+$total_vat;
        }
        @endphp
        <tr>
            <td colspan="{{$colspan}}"></td>
            <td colspan="2"> الاجمالي قبل الضريبه:</td>
            <td class="en-font">{{number_format(round($total_before_vat,2))}}</td>
        </tr>

        <tr>
            <td colspan="{{$colspan}}"></td>
            <td colspan="2"> الضريبه {{getSettings('site_vat_value')}}%:</td>
            <td class="en-font">{{round($total_vat,2)}}</td>
        </tr>

        <tr>
            <td colspan="{{$colspan}}"></td>
            <td colspan="2"> القيمة الاجمالية:</td>
            <td class="en-font">{{number_format(round($total,2))}}</td>
        </tr>
        <tr>
            <td colspan="2">{{$sell_show ? 'البائع' : 'المورد'}}</td>
            <td colspan="{{$colspan+1}}"></td>
        </tr>
    <tfoot>
        <tr>
            <td id="spacer"></td>
        </tr>
    </tfoot>
    </tbody>

</table>
<style>
    .product-table span,
    .product-value span {
        display: table;
        margin: 0 auto !important;
    }

    .about_value {
        height: 100%;
    }

    th,
    td {
        font-size: 16px;
        font-weight: bold;
        text-align: center;
    }
</style>
