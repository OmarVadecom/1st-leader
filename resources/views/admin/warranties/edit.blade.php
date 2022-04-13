@extends($pLayout. 'master')
@section('content')
    <section id="justified-top-border">
        <div class="row match-height">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            تعديل تقرير ضمان
                        </h4>
                    </div>
                    {!!
                        Form::model($warranty ,[
                            'method'    => 'PATCH',
                            'route'     => ['warranties.update', $warranty->id],
                            'files'     => true
                        ])
                    !!}
                    <div class="card-body">
                        <div class="card-block">
                            @include('admin.warranties.form')
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
