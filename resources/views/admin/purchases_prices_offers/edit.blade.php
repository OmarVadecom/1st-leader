@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @if(request('type') === '0')
                            @if($PurchasePriceOffer->status === 0)
                                تعديل عرض سعر محلي
                            @else
                                تعديل امر شراء محلي
                            @endif
                        @else
                            @if($PurchasePriceOffer->status === 0)
                                تعديل عرض سعر دولي
                            @else
                                تعديل امر شراء دولي
                            @endif
                        @endif
                    </h4>
                </div>
                {!! Form::model($PurchasePriceOffer ,[
                'method' => 'PATCH',
                'route' => ['purchases-prices-offers.update', $PurchasePriceOffer->id],
                ])
                !!}
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
