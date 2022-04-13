<div class="tab-pane  active" id="menu1">

    <div class="row bordered">
        <div class="col-md-6">
            <h3 style="text-align: center">منتجات داخليه</h3>
            <table class="table table-striped" style="text-align:center">
                <thead>
                    <tr>
                        <th width="60%">الماده</th>
                        <th width="20%">الكميه</th>
                    </tr>
                </thead>
                <tbody class="productsadd">
                    @if(isset($visit))
                    @foreach($inproducts as $key=>$inproduct)
                    <tr>
                        <td>
                            <select style="width:350px;" name="in_product[]"
                                class="form-control selectproduct selectproducted">
                                @foreach($products as $singleproduct)
                                <option value="{{ $singleproduct->id }}" {{(isset($inproduct) && $inproduct->id ==
                                    $singleproduct->id)? 'selected' : ''}}>
                                    {{ $singleproduct->name }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <input type="number" value="{{$inquantities[$key]}}" placeholder="الكميه" min="1"
                                class="form-control productquantity" name="in_quantity[]">

                        </td>
                        <td>
                            <i class="fa fa-times clickremrow"></i>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td>
                            <select style="width:350px;" name="in_product[]" data-number="0"
                                class="form-control selectproduct selectproducted">
                                <option value="">اختر المنتج</option>
                                @foreach($products as $product)
                                <option data-price="{{$product->price}}" data-unit="{{$product->unit_1}}"
                                    data-quantity="{{$product->quantity}}" value="{{ $product->id }}">
                                    {{ $product->name }}
                                </option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <input type="number" value="1" placeholder="الكميه" min="1"
                                class="form-control productquantity" name="in_quantity[]">
                        </td>
                        <td>
                            <i class="fa fa-times clickremrow"></i>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <button id="add-product" style="float:left; margin-top:10px;" class="btn btn-success">اضف منتج أخر</button>

        </div>

        <div class="col-md-6">
            <h4 style="text-align: center">منتجات خارجيه</h4>
            <table class="table table-striped" style="text-align:center">
                <thead>
                    <tr>
                        <th width="60%">الماده</th>
                        <th width="20%">الكميه</th>
                    </tr>
                </thead>
                <tbody class="productsadd_2">
                    @if(isset($visit))
                    @foreach($outproducts as $key=>$outproduct)
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="out_product[]" value="{{$outproduct}}" id="">
                        </td>
                        <td>
                            <input type="number" value="{{$outquantities[$key]}}" placeholder="الكميه" min="1"
                                class="form-control productquantity" name="out_quantity[]">

                        </td>
                        <td>
                            <i class="fa fa-times clickremrow"></i>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td>
                            <input type="text" class="form-control" name="out_product[]" value="" id="">
                        </td>
                        <td>
                            <input type="number" value="1" placeholder="الكميه" min="1"
                                class="form-control productquantity" name="out_quantity[]">
                        </td>
                        <td>
                            <i class="fa fa-times clickremrow"></i>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <button id="add-product_2" style="float:left; margin-top:10px;" class="btn btn-success">اضف منتج
                أخر</button>
        </div>









    </div>

















</div>