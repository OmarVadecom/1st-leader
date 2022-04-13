<div class="card-body">
    <div class="card-block">
        <div class="row">
            <input value="{{ $type or '' }}" name="type" type="hidden" />
            @if(\Route::currentRouteName() === 'purchases-prices-offers.edit')
                @if($PurchasePriceOffer->status === 0)
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <label for="status">
                                    <input id="status" type="checkbox" name="status" value="1">
                                    تحويل الي امر شراء
                                </label>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            <div class="col-md-4">
                <div class="form-group">
                    <label for="supplier">المورد</label><br>
                    <select name="supplier_id" class="form-control" id="supplier" required>
                        <option value="">اختر المورد</option>
                        @foreach($suppliers as $supplier)
                        <option @if(isset($PurchasePriceOffer) && $PurchasePriceOffer->supplier_id === $supplier->id)
                            selected
                            @endif
                            value="{{ $supplier->id }}"
                            >
                            {{ $supplier->name }}
                        </option>
                        @endforeach
                    </select>
                    <a href="{{ route('supplier.create') }}" target="blank">اضافه مورد جديد</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">التاريخ</label>
                    <input value="{{ isset($PurchasePriceOffer) ? $PurchasePriceOffer->date : date('Y-m-d') }}"
                        class="form-control" name="date" required />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">الوقت</label>
                    <input value="{{ isset($PurchasePriceOffer) ? $PurchasePriceOffer->time : date('h:i:s A') }}"
                        class="form-control" name="time" required />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="offer_duration">مدة العرض</label>
                    <input
                        value="{{ isset($PurchasePriceOffer) ? $PurchasePriceOffer->offer_duration : old('offer_duration') }}"
                        name="offer_duration" class="form-control" required />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="notes"> ملاحظات </label>
                    <textarea class="form-control" name="notes" id="notes"
                        required>{{ isset($PurchasePriceOffer) ? $PurchasePriceOffer->notes : old('notes') }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="declaration"> البيان </label>
                    <textarea name="declaration" class="form-control"
                        required>{{ isset($PurchasePriceOffer) ? $PurchasePriceOffer->declaration : old('declaration') }}</textarea>
                </div>
            </div>
        </div>
        <div class="row"></div>
        <hr>
        <div class="tab">
            <button type="button" class="tablinks active" onclick="openTab(event, 'product-tab')">العرض</button>
        </div>

        @php
        if(isset($edit)){
        $items=$purchase_price_offer_products;
        $quantities=$purchase_price_offer_quantities;
        $prices=$purchase_price_offer_prices;
        $discounts=$purchase_price_offer_discounts;
        $taxes=$purchase_price_offer_dreba;
        $addon_disc=$PurchasePriceOffer->addon_discount;
        }
        @endphp
        @include('admin.layouts.product_table')
        <div class="col-md-12">
            <hr>
            <div class="clear">
                <button type="submit" class="btn btn-success">
                    <i class="icon-check2"></i> حفظ
                </button>
                @if(\Route::currentRouteName() === 'purchases-prices-offers.edit' && $PurchasePriceOffer->status === 1)
                    @if(request('type') !== NULL)
                        <a href="{{ route('admin.purchases-orders.index') . '?type=' . request('type') }}" class="btn btn-danger">
                            <i class="fa fa-times"></i> إلغاء
                        </a>
                    @endif
                @else
                    @if(request('type') !== NULL)
                        <a href="{{ route('purchases-prices-offers.index') . '?type=' . request('type') }}" class="btn btn-danger">
                            <i class="fa fa-times"></i> إلغاء
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
</div>

@section('script')
@include('admin.layouts.script')
@append

<!-- /*/*/*/*/*/ Style Section  /*/*/*/*/*/*/*/-->
@include('admin.layouts.style.form_style')
<!-- /*/*/*/*/*/ Style Section  /*/*/*/*/*/*/*/-->
