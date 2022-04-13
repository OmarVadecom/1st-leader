@extends($pLayout. 'master')
@section('content')
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title">{{ trans('admin.socials') }}</h4>
  				</div>
          {!! Form::open([
              'url' => route('admin.social.update'),
              'method', 'POST'
              ]) !!}
  				<div class="card-body">
  					<div class="card-block">

  					
                     @foreach($socials as $setting)
                       <div class="form-group">
                       <label for="{{ $setting->name}}">{{ trans('admin.' . $setting->name) }}</label>

                       {!! Form::text($setting->name, $setting->link, ['class' => 'form-control']) !!}

                       
                     </div>
                     @endforeach
                <div class="clear">
                  <button type="submit" class="btn btn-primary">
  									<i class="icon-check2"></i> {{ trans('admin.save') }}
  								</button>
                </div>
  				

  					</div>
  				</div>
          {!! Form::close() !!}
  			</div>
  		</div>
  	</div>
  </section>
@endsection
