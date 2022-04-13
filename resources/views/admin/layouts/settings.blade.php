@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        اعدادات السيستم
                        <span class="pull-left">
                        </span>
                    </h4>
                </div>
                {!! Form::model($offer ,[
                'method' => 'PATCH',
                'route' => ['sells.update', $offer->id],
                'files' => true
                ])
                !!}
                <input type="hidden" value="{{ $offer->id }}" name="id">
                <div class="card-body">
                    <div class="card-block">


                        @include('admin.sell.form')

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