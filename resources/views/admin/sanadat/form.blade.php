<div class="row" style="background: #eaeaea; padding: 20px;">
    <div class="row">
        <input type="hidden" name="type" value="{{isset($sanad) ? $sanad->type : \Request::get('type')}}">
        <input type="hidden" name="acc_type" id="acc_type" value=@if(isset($sanad))'{{ $sanad->acc_type }}'@elseif( request()->has('client') && request()->get('client') !== 0)'client'@else''@endif>

        <input type="hidden" name="sell_id" value="{{ request()->has('sell') ? request()->get('sell') : '' }}" />

        @if(request()->get('type') === '1')
            <div class="col-md-4">
                <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                    <label>النوع</label>
                    <select name="p_type" class="form-control" id="" required>
                        <option value="">اختر النوع</option>
                        <option value="1" {{ ((isset($sanad) && $sanad->p_type === 1) || request()->has('sell') ) ? 'selected' : '' }}>
                            اجل - نقدي
                        </option>
                        <option value="2" {{ (isset($sanad) && $sanad->p_type === 2 ) ? 'selected' : '' }}>
                            بنكي - تحويل
                        </option>
                    </select>
                </div>
            </div>
        @else
            <div class="col-md-4">
                <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                    <label>النوع</label>
                    <select name="ex_type" class="form-control" id="">
                        <option value="">اختر النوع</option>
                        <option value="1" {{ (isset($sanad) && $sanad->ex_type === 1 ) ? 'selected' : '' }}>
                            نقدي
                        </option>
                        <option value="2" {{ (isset($sanad) && $sanad->ex_type === 2 ) ? 'selected' : '' }}>
                            عهده
                        </option>
                        <option value="3" {{ (isset($sanad) && $sanad->ex_type === 3 ) ? 'selected' : '' }}>
                            بنكي - تحويل
                        </option>
                    </select>
                </div>
            </div>
        @endif
        <div class="col-md-4">
            <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                <label> الحساب التفصيلي</label>
                <select name="box_id" class="form-control select2" id="">
                    <option value="">اختر الحساب</option>
                    @foreach( $boxs as $box )
                        <option
                            {{ ((isset($sanad) && $sanad->box_id == $box->id) || (request()->has('box') && request()->get('box') == $box->id)) ? 'selected' : '' }}
                            value="{{ $box->id }}"
                        >
                            {{ $box->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        @if( request()->get('type') === '1' )
            <div class="col-md-4">
                <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                    <label> الحساب المقابل</label>
                    <select name="cl_sup_id" class="form-control select2" id="cl_sup_id">
                        <option value="">اختر النوع</option>
                        <optgroup label="العملاء">
                            @foreach($clients as $client)
                                <option
                                    {{ ( (isset($sanad) && $sanad->acc_type === 'client' && $sanad->cl_sup_id === $client->id) || (request()->has('client') && request()->get('client') == $client->id) ) ? 'selected' : '' }}
                                    value="{{ $client->id }}"
                                    data-type="client"
                                >
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </optgroup>
                        <optgroup label="الموردون المحليون">
                            @foreach( $local_suppliers as $local )
                                <option
                                    {{ (isset($sanad) && $sanad->acc_type === 'supplier' && $sanad->cl_sup_id === $local->id) ? 'selected' : '' }}
                                    value="{{ $local->id }}"
                                    data-type="supplier"
                                >
                                    {{ $local->name }}
                                </option>
                            @endforeach
                        </optgroup>
                        <optgroup label="الموردون الدوليون">
                            @foreach( $int_suppliers as $int )
                                <option
                                    {{ (isset($sanad) && $sanad->acc_type === 'supplier' && $sanad->cl_sup_id === $int->id) ? 'selected' : '' }}
                                    value="{{ $int->id }}"
                                    data-type="supplier"
                                >
                                    {{ $int->name }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
        @else
            <div class="col-md-4">
                <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                    <label> الحساب المقابل</label>
                    <select name="expense_id" class="form-control select2" id="" required>
                        <option value="">اختر النوع</option>
                        @foreach( $categories as $cat )
                            <optgroup label="{{ $cat->name }}">
                                @foreach( $cat->expenses as $exp )
                                    <option
                                        {{ (isset($sanad) && $sanad->expense_id === $exp->id) ? 'selected' : '' }}
                                        value="{{ $exp->id }}"
                                    >
                                        {{ $exp->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>
    @php
        if( request()->has('sell') ) {
            $sell = \App\Models\Sells::find(request()->get('sell'));
            $sumSandsForThisInvoiceSell = (str_replace(',', '', $sell->total_money)  - $sell->sand()->sum('cost'));
        }
    @endphp
    <div class="row">
        <div class="col-md-4">
            <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                <label>التكلفه</label>
                {!! Form::number("cost", null , [
                    "placeholder"   => (request()->has('sell') && $sumSandsForThisInvoiceSell) ? 'المبلغ المتبقي : ' . $sumSandsForThisInvoiceSell : 'التكلفه',
                    "class"         => "form-control",
                    "min"           => 1,
                    "max"           => (request()->has('sell') && $sumSandsForThisInvoiceSell) ? $sumSandsForThisInvoiceSell : '',
                    "required"
                ]) !!}
                <p class="p-0 m-0" style="font-weight: bold; color: #961d1d">{{ (request()->has('sell') && $sumSandsForThisInvoiceSell) ? 'المبلغ المتبقي : ' . $sumSandsForThisInvoiceSell : '' }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                <label>التاريخ</label>
                {!! Form::date("date", null , [
                    "class" => "form-control",
                    "placeholder" => 'التاريخ',
                    "required"
                ]) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="title">الوقت</label>
                <input value="{{ isset($sanad) ? $sanad->time : date('h:m:s A') }}" type="time" name="time" class="form-control" required />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                <label>البيان</label>
                {!! Form::textarea("notes", null , [
                    "class" => "form-control",
                    "placeholder" => 'البيان',
                    "required"
                ]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="clear">
                <button type="submit" class="btn btn-success">
                    <i class="icon-check2"></i> {{ trans('admin.save') }}
                </button>
            </div>
        </div>
    </div>
</div>
<style>
    .select2-container {
        text-align: right;
    }
</style>
@section('script')
    <script>
        $(".select2").select2();
        $("#cl_sup_id").change(function () {
            type = $(this).find(':selected').data('type')
            $("#acc_type").val(type);
        })
    </script>
@endsection
