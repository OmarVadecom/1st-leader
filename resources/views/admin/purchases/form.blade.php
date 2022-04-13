<div class="card-body">
    <div class="card-block">
        <div class="row">
            <input value="{{ $offer_id or '' }}" name="offer_id" type="hidden" />
            <input value="{{ $type or '' }}" name="type" type="hidden" />
            <div class="col-md-3">
                <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                    <label> الحساب التفصيلي</label>
                    <select name="box_id" class="form-control select2" id="" required>
                        <option value="">اختر الحساب</option>
                        @foreach( $boxes as $box )
                            <option value="{{ $box->id }}" {{ (isset($purchase) && $purchase->box_id === $box->id) ? 'selected' : '' }}>
                                {{ $box->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">المورد</label><br>
                    <select name="supplier_id" class="form-control" id="" required>
                        <option value="">اختر المورد</option>
                        @foreach( $suppliers as $supplier )
                            <option value="{{ $supplier->id }}"
                                {{ (isset($purchase) && $purchase->supplier_id === $supplier->id) || ( isset($purchaseOffer) && $purchaseOffer->supplier_id === $supplier->id ) ? 'selected' : '' }}
                            >
                                {{$supplier->name}}
                            </option>
                        @endforeach
                    </select>
                    <a href="{{route('supplier.create')}}" target="blank">اضافه مورد جديد</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="date">التاريخ</label>
                    <input value="@if(isset($purchase)){{ $purchase->date }}@elseif(isset($purchaseOffer)){{ $purchaseOffer->date }}@else{{ date('Y-m-d') }}@endif"
                           id="date" name="date" class="form-control" required
                    />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="time">الوقت</label>
                    <input value="@if(isset($purchase)){{ $purchase->time }}@elseif(isset($purchaseOffer)){{ $purchaseOffer->time }}@else{{ date('h:i:s A') }}@endif"
                           id="time" name="time" class="form-control" required
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="notes">ملاحظات</label>
                    <textarea name="notes" id="notes" class="form-control" required>@if(isset($purchase)){{ $purchase->notes }}@elseif(isset($purchaseOffer)){{ $purchaseOffer->notes }}@endif</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="declaration">البيان</label>
                    <textarea name="declaration" id="declaration" class="form-control" required>@if(isset($purchase)){{ $purchase->declaration }}@elseif(isset($purchaseOffer)){{ $purchaseOffer->declaration }}@endif</textarea>
                </div>
            </div>
        </div>
        @php
            if( isset($edit) ) {
                $quantities = $purchase_quantities;
                $addon_disc = $purchase->addon_discount;
                $discounts  = $purchase_discounts;
                $prices     = $purchase_prices;
                $items      = $purchase_products;
                $taxes      = $purchase_dreba;
            }
        @endphp
        @include('admin.layouts.product_table')
        <div class="row">
            <input type="hidden" value="0" name="prstatus" id="prstatus">
            <div class="col-md-12">
                <hr>
                <div class="clear">
                    <button type="submit" class="btn btn-success">
                        <i class="icon-check2"></i> حفظ
                    </button>
                    @if(request('type'))
                        <a href="{{ route('purchases.index') . '?type=' . request('type') }}" class="btn btn-danger">
                            <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
                        </a>
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
