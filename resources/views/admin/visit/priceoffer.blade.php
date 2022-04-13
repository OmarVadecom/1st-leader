@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">تقديم عرض سعر</h4>
                </div>
                {!! Form::open([
                'url' => route('offerprice.print'),
                'method', 'POST',
                'files' => true
                ]) !!}
                <div class="card-body">
                    <div class="card-block">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">أختر الزبون</label>
                                <select name="customer_id" class="form-control" required>
                                    <option value="">اختر الزبون</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <a href="{{url('/')}}/customers/create">اضافه زبون جديد </a>
                                @if ($errors->has('customer'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('customer') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">نوع عرض السعر</label>
                                <select name="offer_type" class="form-control" required>
                                    <option value="">اختر نوع عرض السعر</option>
                                    <option value="1">عرض سعر غير معمد</option>
                                    <option value="2">عرض سعر معمد</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">ملاحظات</label>
                                <textarea name="notes" id=""
                                    class="form-control">{{(isset($visit)) ? $visit->notes : '' }}</textarea>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">ملف الاكسيل</label>
                                <br>
                                <input type="file" name="excelfile" required>

                                <button type="submit" class="btn btn-primary">
                                    <i class="icon-check2"></i> {{ trans('admin.save') }}
                                </button>

                            </div>
                        </div> --}}





                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
</section>
@endsection