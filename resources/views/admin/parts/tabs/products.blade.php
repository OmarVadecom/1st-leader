<div class="tab-pane fade" id="menu30">
    <h5 style="text-align:center; margin-bottom:15px;">المنتجات المسجله</h5>
    <div class="col-md-1">
    </div>
    <div class="col-md-8">
        <div id="addproductsin" class="form-group">
            @if(isset($productsin))
                @foreach($productsin as $productin)
                    <select name="products_in[]" class="form-control tagsadd" id="">
                        <option value="">اختر المنتج</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}"
                                {{ ($product->id == $productin->id) ? 'selected' : '' }}>
                                {{ $product->name }} |
                                {{ $product->code }} </option>
                        @endforeach
                    </select><br>
                @endforeach
            @else
                <select name="products_in[]" class="form-control tagsadd" id="">
                    <option value="">اختر المنتج</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} | {{ $product->code }} </option>
                    @endforeach

                </select>
            @endif
            <br>
        </div><!-- /.form-group -->
    </div>
    <div class="col-md-3">
        <button id="add-pro-in" style="float: left;" class="btn btn-success">اضافه منتج اخر</button>
    </div>

    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
        <hr>
        <h5 style="text-align:center; margin-bottom:15px;"> وتحتوي علي (قطع غيار)</h5>
        <div class="col-md-1">
        </div>
        <div class="col-md-8">
            <div id="addpartsin" class="form-group">
                @if(isset($partsin) && $partsin[0] != "")
                    @foreach($partsin as $partin)
                        <select name="parts_in[]" class="form-control tagsadd" id="">
                            <option value="">اختر القطعه</option>
                            @foreach($parts as $singlepart)
                                <option value="{{ $singlepart->id }}"
                                    {{ ($singlepart->id == $partin) ? 'selected' : '' }}>
                                    {{ $singlepart->name }} | {{ $singlepart->code }} </option>
                            @endforeach
                        </select><br>
                    @endforeach
                @else
                    <select name="parts_in[]" class="form-control tagsadd" id="">
                        <option value="">اختر القطعه</option>
                        @foreach($parts as $singlepart)
                            <option value="{{ $singlepart->id }}">{{ $singlepart->name }} |
                                {{ $singlepart->code }} </option>
                        @endforeach
                    </select>
                @endif
                <br>
            </div><!-- /.form-group -->
        </div>
        <div class="col-md-3">
            <button id="add-part-in" style="float: left;" class="btn btn-success">اضافه قطعه اخري</button>
        </div>
    </div>
    <div class="col-md-12">
        <hr>
        <br><br>
        <h5 style="text-align:center; margin-bottom:15px;">المنتجات الغير مسجله</h5>

        <table class="table table-striped" style="text-align:center">
            <thead>
                <tr>
                    <th style="width:20%">رقم القطعه </th>
                    <th style="width:15%">الشركه</th>
                    <th style="width:20%">اسم الوكيل</th>
                    <th style="width:20%">الصوره </th>
                    <th style="width:1%"></th>
                </tr>
            </thead>
            <tbody class="pro-in-add">
                <div class="form-group ">
                    @if(isset($productsout))
                        @foreach($productsout as $productout)
                            <tr>
                                <td>
                                    <input type="text" value="{{ $productout->code }}" class="form-control"
                                        name="product_out_code[]">
                                </td>
                                <td>
                                    <input type="text" value="{{ $productout->company }}" min="1" class="form-control"
                                        name="product_out_company[]">
                                </td>
                                <td>
                                    <input type="text" value="{{ $productout->wakel }}" class="form-control"
                                        name="product_out_wakel[]">
                                </td>
                                <td>
                                    <input type="file" class="form-control" name="product_out-files[]">
                                    <input type="hidden" value="{{ $productout->image }}" name="old_outimage[]"
                                        class="form-control">

                                    <img style="width:100px" src="{{url('/')}}/uploads/products-parts-out/{{ $productout->image }}"
                                        alt="{{ $productout->name }}">
                                </td>
                                <td>
                                    <i class="fa fa-times clickremmarket"></i>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                <input type="text" placeholder="رقم الفطعه" class="form-control"
                                    name="product_out_code[]">
                            </td>
                            <td>
                                <input type="text" placeholder="الشركه" min="1" class="form-control"
                                    name="product_out_company[]">
                            </td>
                            <td>
                                <input type="text" placeholder="اسم الوكيل " class="form-control"
                                    name="product_out_wakel[]">
                            </td>
                            <td>
                                <input type="file" class="form-control" name="product_out-files[]">
                            </td>
                            <td>
                                <i class="fa fa-times clickremproin"></i>
                            </td>
                        </tr>
                    @endif
                </div>
            </tbody>
        </table>
        <button id="add-product-pro-in" style="float:left; margin-top:10px; margin-bottom:10px;"
            class="btn btn-success">اضف
            بيانات أخري</button>
    </div>


</div>
