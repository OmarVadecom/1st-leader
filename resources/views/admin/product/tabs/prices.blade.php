<div class="tab-pane fade" id="menu2">
    <div class="row pricesadd">

        @if(isset($prices))
            @foreach($prices as $index=>$price)

                <div class="col-md-12">
                    <h5>سعر الوحده {{ $index+1 }}</h5>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>السعر </label>
                            {!! Form::number("prices[]", $price, [
                            'class' => 'form-control',
                            'placeholder' => 'السعر',
                            ]) !!}
                        </div><!-- /.form-group -->
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>الخصم المتاح </label>
                            {!! Form::number("prices_discounts[]", $prices_discounts[$index], [
                            'class' => 'form-control',
                            'placeholder' => 'الخصم المتاح',
                            ]) !!}
                        </div><!-- /.form-group -->
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>الفئه المستهدفه</label>
                            <select name="prices_targets[]" class="form-control">
                                <option value="">اختر الفئه</option>
                                <option value="1"
                                    {{ ($prices_targets[$index]==1) ? 'selected' : '' }}>
                                    العميل
                                </option>
                                <option value="2"
                                    {{ ($prices_targets[$index]==2) ? 'selected' : '' }}>
                                    الشركات
                                </option>
                            </select>
                        </div><!-- /.form-group -->
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12">
                <h5>سعر الوحده 1</h5>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>السعر </label>
                        {!! Form::number("prices[]", "", [
                        'class' => 'form-control',
                        'placeholder' => 'السعر',
                        ]) !!}
                    </div><!-- /.form-group -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>الخصم المتاح </label>
                        {!! Form::number("prices_discounts[]", "", [
                        'class' => 'form-control',
                        'placeholder' => 'الخصم المتاح',
                        ]) !!}
                    </div><!-- /.form-group -->
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>الفئه المستهدفه</label>
                        <select name="prices_targets[]" class="form-control">
                            <option value="">اختر الفئه</option>
                            <option value="1"> العميل
                            </option>
                            <option value="2"> الشركات
                            </option>
                        </select>
                    </div><!-- /.form-group -->
                </div>
            </div>
        @endif
    </div>
    <hr>
    <div class="row" style="background: #e6e6e6">
        <div class="col-md-12">
            <h5 style="padding-top: 10px; "> العروض</h5>
            <div class="col-md-6">
                <div
                    class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label>خصم اضافي</label>
                    {!! Form::number("discount", isset($product) ? $product->discount : "", [
                    'class' => 'form-control',
                    'placeholder' => 'خصم اضافي',
                    ]) !!}
                </div><!-- /.form-group -->
            </div>


            <div class="col-md-6">
                <div
                    class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label> الكميه</label>
                    {!! Form::number("discountquantity", isset($product) ? $product->discountquantity : "", [
                    'class' => 'form-control',
                    'placeholder' => 'الكميه ',
                    ]) !!}
                </div><!-- /.form-group -->
            </div>
        </div>
    </div>


</div>
