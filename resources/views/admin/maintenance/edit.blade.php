@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @if(request('main_type') === '2')
                            تعديل طلب صيانه خارجيه
                        @elseif(request('main_type') === '4')
                            تعديل زيارة ميدانيه
                        @elseif(request('main_type') === '5')
                            تعديل مركز الاتصالات
                        @else
                            تعديل طلب ورشه
                        @endif
                        <span class="pull-left">
                        </span>
                    </h4>
                </div>
                {!! Form::model($maintenance ,[
                'method' => 'PATCH',
                'route' => ['maintenance.update', $maintenance->id],
                'files' => true
                ])
                !!}
                <input type="hidden" value="{{ $maintenance->id }}" name="id">
                <div class="card-body">
                    <div class="card-block">


                        @include('admin.maintenance.form')

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
