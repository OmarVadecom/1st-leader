@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    @php
                    $last_id = \DB::table('delivery')->max('id')+1;
                    $last_id=str_pad($last_id, 4, '0', STR_PAD_LEFT);
                    $last_id = 'DLV-'.$last_id;
                    @endphp
                    <h4>
                        انشاء امر تسليم
                        {{\Request::get('m') ? 'طلب صيانه' : ''}}
                        <span style="color:#b71c1c">{{ $last_id}} </span></h4>
                </div>
                {!! Form::open([
                'url' => route('delivery.store'),
                'method', 'POST',
                'files'=> true,
                ]) !!}
                @include('admin.delivery.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

@endsection