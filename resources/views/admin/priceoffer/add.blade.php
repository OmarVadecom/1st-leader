@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    @if(isset($type) && $type==0)
                    <h4 class="card-title">إنشاء عرض سعر غير معمد
                        @elseif(isset($type) && $type==1)
                        <h4 class="card-title">إنشاء عرض سعر معمد
                            @else
                            <h4 class="card-title">إنشاء عرض سعر
                                @endif
                            </h4>
                </div>
                {!! Form::open([
                'url' => route('admin.saveoffer'),
                'method', 'POST',
                ]) !!}
                    @include('admin.priceoffer.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

@endsection
