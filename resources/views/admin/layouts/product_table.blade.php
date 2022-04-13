<div class="col-md-12">
    <table id="added_products_table" class="table table-striped" style="text-align:center">
        <thead>
        <tr>
            <th>رقم المادة</th>
            <th>الماده</th>
            <th style="width:7%;">الكميه</th>
            <th style="width:9%;"> السعر</th>
            <th>الاجمالي</th>
            <th style="width:8%;">الخصم</th>
            <th>الاجمالي قبل الضريبه</th>
            <th style="width:8%;">الضريبه</th>
            <th>الاجمالي بعد الضريبه</th>
        </tr>
        </thead>
        <tbody id="table_body" class="productsadd">
        @if(isset($edit))
            @foreach($items as $k => $item )
                @if(isset($item))
                    <tr><input type="hidden" name="product[]" value="{{$item->id}}">
                        <input type="hidden" name="product_code_type[]" value="{{$item->code_type or ''}}">
                        <td>{{$item->code}}</td>
                        <td> {{$item->name}}</td>
                        <td><input type="number" value="{{$quantities[$k]}}" data-number="{{$k}}" placeholder="الكميه"
                                   min="1"
                                   class="quantities form-control productquantity quantity{{$k}}" name="quantity[]">
                        </td>
                        <td><input type="number" value="{{round($prices[$k],2)}}" data-number="{{$k}}" step="any"
                                   placeholder="السعر" min="1" class="prices form-control productprice price{{$k}}"
                                   name="price[]">
                        </td>
                        <td class="totals totalfir{{$k}}">
                            {{round($prices[$k]*$quantities[$k],2)}}</td>
                        <td><input type="number" value="{{$discounts[$k]}}" data-number="{{$k}}" placeholder="الخصم %"
                                   min="0"
                                   class="form-control productdiscount discounts discount{{$k}}" style="width:85%"
                                   name="discount[]"><span style="float: left; margin-top: -32px;">%</span></td>
                        <td class="totals totalsdisc totaldisc{{$k}}">
                            @php $discount=$prices[$k] * $quantities[$k] * $discounts[$k]/100;
                    $total_after_disc=$prices[$k] * $quantities[$k] - $discount;
                            @endphp
                            {{round( $total_after_disc,2)}}
                        </td>
                        <td><input type="number" value="{{$taxes[$k]}}" data-number="{{$k}}" placeholder="الضريبه"
                                   min="0"
                                   class="prices form-control productdreba dareba{{$k}}" name="darebadis[]"
                                   style="width:85%"
                                   disabled> <input type="hidden" name="dareba[]" value="{{$taxes[$k]}}" id=""><span
                                style="float: left; margin-top: -32px;">%</span></td>
                        @php $dreba=$total_after_disc * $taxes[$k]/100; @endphp
                        <td class="totals total{{$k}}"><input id="total_input" type="number" step="any"
                                                              data-number="{{$k}}"
                                                              name="totals[]"
                                                              value="{{ round($total_after_disc + $dreba,2) }}"
                                                              class="totalinp{{$k}} form-control totalinp">
                        </td>
                        <td><i data-rownumber="{{$k}}" class="fa fa-times clickremrow"></i></td>
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
            <td colspan="1"><input type="text" value="{{isset($edit) || isset($priceOffer) ? $addon_disc : 0}}"
                                   style="text-align: center;" class="form-control totdisc"><input
                    value="{{isset($edit) ? $addon_disc : 0}}" type="hidden" name="addon_disc" class="totdiscinp">
            </td>

        </tr>
        <tr>
            <td colspan="7" style="width: 70%;"></td>
            <td colspan="2"> الاجمالي بعد الخصم و الضريبه</td>
            <td colspan="1" class="totalmoafter">0</td>
            <input type="hidden" name="totalafterdisc" class="totalmoinp">
        </tr>
        </tbody>
    </table>

    @if(!isset($delivery))
        @include('admin.product_search.product_search')
    @endif
</div>
