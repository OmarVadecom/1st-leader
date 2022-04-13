@extends($pLayout . 'master')

@section('content')

<div class="row">
    <div class="col-xl-12 alert alert-warning text-center" style="text-align: center;">
        <b><i class="fa fa-exclamation-circle"></i></b> {{ trans('admin.403') }}
    </div>
</div>
@endsection