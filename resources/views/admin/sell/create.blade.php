@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">

                    <h4 class="card-title">
                        @if(request('main_type') === '1')
                            انشاء فاتورة بيع طلبات ورشه
                        @elseif (request('main_type') === '2')
                            انشاء فاتورة بيع طلبات الصيانه الخارجيه
                        @elseif (request('main_type') === '3')
                            انشاء فاتورة بيع داخليه
                        @elseif (request('main_type') === '4')
                            انشاء فاتورة بيع زيارة ميدانيه
                        @elseif (request('main_type') === '5')
                            انشاء فاتورة بيع مركز الاتصالات
                        @else
                            انشاء فاتورة بيع معرض
                        @endif
                    </h4>
                    <span class="pull-left">
                    </span>
                </div>
                {!! Form::open([
                'url' => route('sells.store'),
                'method', 'POST',
                'files'=> true,
                ]) !!}
                @include('admin.sell.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
@endsection
