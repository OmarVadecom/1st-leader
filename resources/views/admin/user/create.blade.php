@extends($pLayout. 'master')
@section('content')
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title">{{ trans('admin.create', ['name' => trans('admin.user')]) }}</h4>
  				</div>
          {!! Form::open([
              'url' => route('users.store'),
              'method', 'POST',
              'files' => true
              ]) !!}
  				<div class="card-body">
  					<div class="card-block">
  						<!--<p>Use <code>.nav-justified</code> class to set tabs justified.</p>-->

  						@include('admin.user.form')

  					</div>
  				</div>
          {!! Form::close() !!}
  			</div>
  		</div>
  	</div>
  </section>
@endsection

@section('script')
<script type="text/javascript">
  var role = $('#isAdmin').val();
  getRoles(role);
</script>
@endsection