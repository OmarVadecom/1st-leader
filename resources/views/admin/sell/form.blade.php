<div class="card-body">
    <div class="card-block">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">أختر الزبون</label><br>
                    <select name="customer" class="form-control selectproduct" required>
                        <option value="">اختر الزبون</option>
                        @foreach( $customers as $customer )
                            <option
                                {{ (isset($delivery) && $delivery->customer_id === $customer->id) ? 'selected' : '' }}
                                {{ (isset($offer) && $customer->id === $offer->customer_id) ? 'selected' : '' }}
                                value="{{ $customer->id }}"
                            >
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                    <br>
                    <a href="{{ url('/') }}/customers/create">اضافه زبون جديد </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                    <label> الحساب المقابل</label>
                    <select name="box_id" class="form-control select2" id="" required>
                        <option value="">اختر الحساب</option>
                        @foreach($boxs as $box)
                            <option
                                {{ (isset($offer) && $offer->box_id == $box->id ) ? 'selected' : ''}}
                                value="{{ $box->id }}"
                            >
                                {{ $box->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <input type="hidden" name="invoice_num" value="{{ request('invoice_num') ?? 0 }}" />
            @if(isset($maintenance))
                <input type="hidden" name="maintenance_id" class="form-control" value="{{ $maintenance ?? null }}" />
                <input type="hidden" name="invtype" class="form-control" value="2" />
                <input type="hidden" name="main_type" class="form-control" value="{{ request()->get('main_type') }}" />
            @elseif(request()->get('main_type') !== null)
                @if(request('main_type') === '1')
                    <input type="hidden" name="invtype" class="form-control" value="2" />
                    <input type="hidden" name="main_type" class="form-control" value="" />
                @else
                    <input type="hidden" name="invtype" class="form-control" value="{{ request()->get('main_type') }}" />
                    <input type="hidden" name="main_type" class="form-control" value="{{ request()->get('main_type') }}" />
                @endif
            @else
                <input type="hidden" name="invtype" class="form-control" value="{{ isset($delivery) ? 1 : 0 }}" />
            @endif
            <input type="hidden" name="delivery" class="form-control" value="{{ isset($delivery) ? $delivery->id : '' }}">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">التاريخ</label>
                    <input value=" {{ $offer->date or date('Y-m-d') }}" name="date" class="form-control" required />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">الوقت</label>
                    <input value="{{ $offer->time or date('h:i:s A') }}" name="time" class="form-control" required />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="title">المستودع</label>
                    <select name="warehouse" class="form-control" required>
                        <option value="">اختر المستودع</option>
                        @foreach($warehouses as $warehouse)
                            <option
                                {{ (isset($offer) && $offer->warehouse_id === $warehouse->id) ? 'selected' : '' }}
                                value="{{ $warehouse->id }}"
                            >
                                {{$warehouse->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="invoice_type">نوع الفاتورة</label>
                    <select name="invoice_type" class="form-control" id="invoice_type">
                        <option value="">اختر نوع الفاتورة</option>
                        <option
                            {{ (isset($offer) && $offer->invoice_type === 'cache') ? 'selected' : '' }}
                            value="cache"
                        >
                            فاتورة بيع نقديه
                        </option>
                        <option
                            {{ (isset($offer) && $offer->invoice_type === 'deferred') ? 'selected' : '' }}
                            value="deferred"
                        >
                            فاتورة بيع اجله
                        </option>
                    </select>
                    <input
                        value="{{ (isset($offer) && $offer->invoice_type === 'deferred' && $offer->down_payment !== null) ? $offer->down_payment : '' }}"
                        style="{{ (isset($offer) && $offer->invoice_type === 'deferred') ? 'display: block' : 'display: none' }}"
                        placeholder="ادخل الدفعه المقدمه"
                        class="form-control mt-2"
                        name="down_payment"
                        id="down_payment"
                        type="text"
                        {{ isset($offer) && $offer->invoice_type === 'deferred' ? 'required' : '' }}
                    />
                    @if( isset($edit, $offer) && $offer->invoice_type === 'deferred' && $offer->down_payment !== null && $offer->total_money !== null )
                        <p>
                            <a
                                href="{{ route('sanadat.create') }}?type=1&client={{ $offer->customer_id }}&box={{ $offer->box_id }}&sell={{ $offer->id }}"
                                style="color: #961d1d;font-weight: bold"
                                target="_blank"
                            >
                                <span>المبلغ المتبقي : </span>
                                <span>{{ str_replace(',', '', $offer->total_money) - $offer->sand()->sum('cost') }}</span>
                            </a>
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">ملاحظات</label>
                    <textarea name="notes" id="" class="form-control">{{ (isset($offer)) ? $offer->notes : '' }}</textarea>
                </div>
            </div>
        </div>

        @php
            if( isset($edit) ) {
                $quantities = $offer_products_quantities;
                $addon_disc = $offer->addon_disc;
                $discounts  = $offer_products_discounts;
                $prices     = $offer_products_prices;
                $taxes      = $offer_products_taxes;
                $items      = $offer_products;
            }
            if( isset($del_products_ids) && count($del_products_ids) > 0 ) {
                $quantities   = $delivery_quantities;
                $addon_disc   = '';
                $fillarray    = array_fill(0, count($del_products_ids), 0);
                $discounts    = $fillarray;
                $prices       = $fillarray;
                $items        = $delivery_products_ids;
                $taxes        = $fillarray;
                $edit         = true;
            }
        @endphp
        @include('admin.layouts.product_table')
        <input type="hidden" value="0" name="prstatus" id="prstatus">
        <div class="col-md-12">
            <hr>
            <div class="clear">
                <button type="submit" class="btn btn-success">
                    <i class="icon-check2"></i>
                    {{ trans('admin.save') }}
                </button>
                <button type="submit" class="btn btn-success" id="submitprint">
                    <i class="icon-check2"></i> حفظ وطباعه
                </button>
                @if((isset($offer) && $offer->main_type === 2 && $offer->type === 2) || request()->get('main_type') === '2')
                    <a href="{{ route('admin.sellsmnt.index') }}?main_type=2" class="btn btn-danger">
                        <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
                    </a>
                @elseif ((isset($offer) && $offer->type === 2) || request()->get('main_type') === '1')
                    <a href="{{ route('admin.sellsmnt.index') }}?main_type=1" class="btn btn-danger">
                        <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
                    </a>
                @elseif ((isset($offer) && $offer->type === 3) || request()->get('main_type') === '3')
                    <a href="{{ route('admin.sellsint.index') }}" class="btn btn-danger">
                        <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
                    </a>
                @elseif ((isset($offer) && $offer->type === 4) || request()->get('main_type') === '4')
                    <a href="{{ route('admin.sellsmnt.index') }}?main_type=4" class="btn btn-danger">
                        <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
                    </a>
                @elseif ((isset($offer) && $offer->type === 5) || request()->get('main_type') === '5')
                    <a href="{{ route('admin.sellsmnt.index') }}?main_type=5" class="btn btn-danger">
                        <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
                    </a>
                @else
                    <a href="{{ route('sells.index') }}" class="btn btn-danger">
                        <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

@section('script')
    @include('admin.layouts.script')
    <script>
        $('#invoice_type').on('click', function () {
            var invoiceType = $(this).val();
            if(invoiceType === 'deferred') {
                $('#down_payment').prop('required', true).fadeIn(300);
            } else {
                $('#down_payment').prop('required', false).fadeOut(300);
            }
        })
    </script>
@append

@include('admin.layouts.style.form_style')
