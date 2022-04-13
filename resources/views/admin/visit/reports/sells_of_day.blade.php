@extends($pLayout. 'master')
@section('content')
    <section id="justified-top-border">
        <div class="row match-height">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">تقرير المبيعات</h4>
                    </div>
                    {!! Form::open([
                    'url' => route('admin.reports-sells.index'),
                    'method', 'get'
                    ]) !!}
                    <div class="card-body">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title">أختر الزبون</label><br>
                                        <select name="customer" class="form-control selectproduct">
                                            <option value="">اختر الزبون</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}
                                                </option>
                                            @endforeach
                                        </select><br>
                                        <a href="{{url('/')}}/customers/create">اضافه زبون جديد </a>
                                        @if ($errors->has('customer'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('customer') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">من تاريخ</label>
                                            <input type="date" name="date_from" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="title">الي تاريخ</label>
                                        <input type="date" name="date_to" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr>
                                <div class="clear">
                                    <button type="submit" class="btn btn-primary subm">
                                        <i class="icon-check2"></i> {{ trans('admin.save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
    <style>
        .select2-container {
            margin-top: 5px !important;
            width: 100% !important;
            direction: rtl;
            text-align: right;
        }
    </style>

@endsection

@section('script')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(".selectproduct").select2();
    </script>

@endsection
