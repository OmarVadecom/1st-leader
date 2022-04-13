@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">انشاء زبون</h4>
                </div>
                {!! Form::open([
                'url' => route('customers.store'),
                'method', 'POST',
                'files' => true
                ]) !!}
                <div class="card-body">
                    <div class="card-block">
                        <!--<p>Use <code>.nav-justified</code> class to set tabs justified.</p>-->

                        @include('admin.customers.form')

                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection
