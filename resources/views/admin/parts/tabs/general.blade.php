<div class="tab-pane  active" id="home">
    <div class="row">
        <div class="col-md-6">


            <div class="form-group">
                <label>الشركه </label> <br>
                <select name="brand_id" class="form-control tagsadd">
                    <option value="">أختر الشركه </option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ (isset($product) && $brand->id==$product->brand_id) ? 'selected' : '' }}>
                            {{ $brand->name }}</option>
                    @endforeach
                </select>
            </div><!-- /.form-group -->

            <div class="form-group">
                <label> المنشأ</label>
                <br>
                <select name="origin_id" class="form-control tagsadd">
                    <option value="">اختر المنشأ</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}"
                            {{ (isset($product) && $country->id==$product->origin_id) ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </div><!-- /.form-group -->


            <div class="form-group">
                <label> الصناعه</label><br>
                <select name="country_id" class="form-control tagsadd">
                    <option value=""> الصناعه</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}"
                            {{ (isset($product) && $country->id==$product->country_id) ? 'selected' : '' }}>
                            {{ $country->name }}</option>
                    @endforeach
                </select>
            </div><!-- /.form-group -->


            <div class="form-group">
                <label>اللون</label>
                <br>
                <select name="color" class="form-control tagsadd">
                    <option value="">اختر اللون</option>
                    @foreach($colors as $color)
                        <option value="{{ $color->id }}"
                            {{ (isset($product) && $color->id==$product->color) ? 'selected' : '' }}>
                            {{ $color->name }}</option>
                    @endforeach
                </select>
            </div><!-- /.form-group -->

            <div class="form-group">
                <label>التفعيلات</label><br>
                <div class="col-md-6">
                    <label><input type="checkbox" name="maintenance" value="1"
                            {{ (isset($product) && $product->maintenance==1) ? 'checked' : '' }}>
                        الصيانه </label>
                </div>
                <div class="col-md-6">

                    <label><input type="checkbox" name="hidden" value="1"
                            {{ (isset($product) && $product->hidden==1) ? 'checked' : '' }}>
                        اخفاء </label>

                </div>
            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">
                <label>نوع المنتج</label>
                <select class="form-control" name="type">
                    <option value="">اختر نوع المنتج</option>
                    <option value="1"
                        {{ (isset($product) && $product->type==1) ? 'selected' : '' }}>
                        مستودعي</option>
                    <option value="2"
                        {{ (isset($product) && $product->type==2) ? 'selected' : '' }}>
                        مخزون</option>
                </select>
            </div>

            <div class="form-group">
                <label>رمز الترقيم</label>
                <select class="form-control" name="code_type" required>
                    <option value="">رمز الترقيم</option>
                    <option value="EA"
                        {{ (isset($product) && $product->code_type=='EA') ? 'selected' : '' }}>
                        EA</option>
                    <option value="ES"
                        {{ (isset($product) && $product->code_type=='ES') ? 'selected' : '' }}>
                        ES</option>
                </select>
            </div>





            <div class="form-group">
                <label>فئه المنتج </label>
                <select class="form-control" name="product_type">
                    <option value="">اختر فئه المنتج</option>
                    <option value="1"
                        {{ (isset($product) && $product->product_type==1) ? 'selected' : '' }}>
                        رئيسي</option>
                    <option value="2"
                        {{ (isset($product) && $product->product_type==2) ? 'selected' : '' }}>
                        تجميعي</option>
                </select>
            </div>

            <div class="form-group">
                <label>كرت الضمان</label>
                <select class="form-control" name="insurance">
                    <option value="">اختر كرت الضمان</option>
                    <option value="3 اشهر"
                        {{ ($product && $product->insurance == '3 اشهر') ? 'selected' : '' }}>
                        3 اشهر</option>
                    <option value="6 اشهر"
                        {{ ($product && $product->insurance == '6 اشهر') ? 'selected' : '' }}>
                        6 اشهر</option>
                    <option value="1 سنه"
                        {{ ($product && $product->insurance == '1 سنه') ? 'selected' : '' }}>
                        1 سنه</option>
                    <option value="2 سنه"
                        {{ ($product && $product->insurance == '2 سنه') ? 'selected' : '' }}>
                        2 سنه</option>
                </select>
            </div>
        </div>
    </div>


    <h5 style="text-align:center;"> المنتجات الداخليه</h5>

    <table class="table">
        <tr>
            <th width="30%">رقم القطعه</th>
            <th width="30%">الشركه </th>
            <th width="40%">الصوره </th>
        </tr>
        @if(isset($productsin))
            @foreach($productsin as $productin)
                <tr>
                    <td>{{ (isset($productin->code)) ? $productin->code : '' }}
                    </td>
                    <td>{{ (isset($productin->brand)) ? $productin->brand->name : '' }}
                    </td>
                    <td><img style="width:100px"
                            src="{{url('/')}}/uploads/products-attachments/{{ (isset($productin->image) ? $productin->image : '') }}"
                            alt="{{ $productin->name }}"></td>
                </tr>
            @endforeach
        @endif
    </table>
    <br>
    <br>
    <hr>
    <h5 style="text-align:center;"> المنتجات الخارجيه</h5>
    <table class="table">
        <tr>
            <th width="30%">رقم القطعه</th>
            <th width="30%">الشركه </th>
            <th width="40%">الصوره </th>
        </tr>
        @if(isset($product))
            @foreach($productsout as $productout)
                <tr>
                    <td>{{ (isset($productout->code)) ? $productout->code : '' }}
                    </td>
                    <td>{{ $productout->company }}</td>
                    <td><img style="width:100px" src="{{url('/')}}/uploads/products-parts-out/{{ $productout->image }}"
                            alt="{{ $productout->name }}"></td>
                </tr>

            @endforeach
        @endif
    </table>
    <br>
</div>
