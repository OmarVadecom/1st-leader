@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">تعديل زبون</h4>
                </div>

                {!! Form::model($customer ,[
                'method' => 'PATCH',
                'route' => ['customers.update', $customer->id],
                'files' => true
                ])
                !!}
                <div class="card-body">
                    <div class="card-block">
                        <!--<p>Use <code>.nav-justified</code> class to set tabs justified.</p>-->
                        <input type="hidden" id="id" value="{{ $customer->id }}" name="id">
                        @include('admin.customers.form')

                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection
