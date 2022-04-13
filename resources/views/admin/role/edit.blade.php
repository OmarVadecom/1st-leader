@extends($pLayout. 'master')
@section('content')
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title">{{ trans('admin.edit', ['name' => trans('admin.role')]) }}</h4>
  				</div>

              {!! Form::model($role ,[
                  'method' => 'PATCH',
                  'route' => ['role.update', $role->id],
                  'files' => true
                ]) 
              !!}
              <input type="hidden" id="id" value="{{ $role->id }}" name="id">
  				<div class="card-body">
  					<div class="card-block">
  						<!--<p>Use <code>.nav-justified</code> class to set tabs justified.</p>-->
  						<ul class="nav nav-tabs nav-justified">
                @foreach ($dbLangs as $key => $lang)
                  <li class="nav-item">
    								<a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="{{ $lang->code }}-tab" data-toggle="tab" href="#{{ $lang->code }}" aria-controls="{{ $lang->code }}" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}">{{ $lang->name }}</a>
    							</li>
                @endforeach
  						</ul>

  						@include('admin.role.form')

  					</div>
          {!! Form::close() !!}
          </div>
  			</div>
  		</div>
  	</div>
  </section>
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
@endsection

@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script type="text/javascript">
  
  $(".permission-select").select2({
    placeholder: "Select a state"
});
</script>
@endsection