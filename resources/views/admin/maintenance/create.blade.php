@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                @php
                    if(request('main_type') === '2'){
                        $last_id = \App\Models\Maintenance::where('main_type',2)->currentYear()->count() + 1;
                        $last_id = str_pad($last_id, 4, '0', STR_PAD_LEFT);
                        $last_id = 'OJB-'.$last_id;
                    } elseif(request('main_type') === '4') {
                        $last_id = \App\Models\Maintenance::where('main_type', 4)->currentYear()->count() + 1;
                        $last_id = str_pad($last_id, 4, '0', STR_PAD_LEFT);
                        $last_id = 'OVT-' . $last_id;
                    } elseif(request('main_type') === '5') {
                        $last_id = \App\Models\Maintenance::where('main_type', 5)->currentYear()->count() + 1;
                        $last_id = str_pad($last_id, 4, '0', STR_PAD_LEFT);
                        $last_id = 'CAL-' . $last_id;
                    } else {
                        $last_id = \App\Models\Maintenance::whereNull('main_type')->orWhere('main_type', 1)->currentYear()->count() + 1;
                        $last_id = str_pad($last_id, 4, '0', STR_PAD_LEFT);
                        $last_id = 'MNT-'.$last_id;
                    }
                @endphp
                <div class="card-header">
                    <h4 class="card-title">
                        @if(request('main_type') === '2')
                            استلام صيانه خارجيه
                        @elseif(request('main_type') === '4')
                            استلام زيارة ميدانيه
                        @elseif(request('main_type') === '5')
                            استلام مركز الاتصالات
                        @else
                            استلام ورشه
                        @endif
                        <span style="color:#b71c1c">
                            {{ $last_id }}</span>
                    </h4>
                </div>
                {!! Form::open([
                'url' => route('maintenance.store'),
                'method', 'POST',
                'files'=> true,
                ]) !!}
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
