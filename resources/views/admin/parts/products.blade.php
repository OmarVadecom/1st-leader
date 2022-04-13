@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        اختر المنتج
                    </h4>
                </div>
                <div class="card-header">
                    @foreach($products as $product)
                        <div class="col-xs-2">
                            <a href="{{ url('/') }}/showproduct/{{ $product->id }}">
                                <img style="width: 100%;"
                                    src="{{ url('/') }}/uploads/products-attachments/{{ $product->image }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endsection
