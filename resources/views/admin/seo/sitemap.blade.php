@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export" >
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ trans('admin.sitemap') }}
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in" style="min-height: 450px">
                    <div class="card-block card-dashboard">
                        {!! Form::open([
                          'url'    => route('admin.seo.sitemap'),
                          'method' => 'POST',
                          'files'  => true
                        ]) !!}

                        <div class="col-xs-4">
                            {!! Form::file('file',null, 
                            array('class'=>'form-control', 'required' => true)) !!}
                            @if ($errors->has('file'))
                            <span class="help-block">
                                <strong style="color: red">{{ $errors->first('file') }}</strong>
                            </span>
                           @endif
                        </div>
                        <div class="col-xs-6">
                            <span class="input-group-btn">
                                <button class="btn btn-primary"><i class="fa fa-upload"></i></button>
                            </span>    
                        </div>
                        
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection


@section('script')

@endsection