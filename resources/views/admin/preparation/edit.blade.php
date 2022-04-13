@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4> امر تحضير</h4>
                </div>
                {!! Form::model($preparation,[
                'url' => route('preparations.update',$preparation->id),
                'method'=> 'PUT',
                'files'=> true,
                ]) !!}
                @include('admin.preparation.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

@endsection
