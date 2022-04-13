@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @if(request('type') === '0')
                            انشاء عرض سعر محلي
                        @else
                            انشاء عرض سعر دولي
                        @endif
                    </h4>
                </div>
                {!! Form::open([
                'url' => route('purchases-prices-offers.store'),
                'method', 'POST'
                ]) !!}
                <div class="card-body">
                    <div class="card-block">
                        @include('admin.purchases_prices_offers.form')
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')

@endsection
