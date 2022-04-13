@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        تعديل قسم مصاريف
                        <span class="pull-left">
                        </span>
                    </h4>
                </div>
                {!! Form::model($category ,[
                'method' => 'PATCH',
                'route' => ['expensecategory.update', $category->id],
                'files' => true
                ])
                !!}
                <input type="hidden" value="{{ $category->id }}" name="id">
                <div class="card-body">
                    <div class="card-block">


                        @include('admin.expensecategory.form')

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
