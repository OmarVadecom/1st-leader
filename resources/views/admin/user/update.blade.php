@extends($pLayout. 'master')
@section('content')
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title">{{ trans('admin.edit', ['name' => trans('admin.user')]) }}</h4>
  				</div>

             {!! Form::open([
              'url' => route('users.update.info'),
              'method', 'POST',
              'files' => true,
              ]) !!}
  				<div class="card-body">
  					<div class="card-block">
  						<!--<p>Use <code>.nav-justified</code> class to set tabs justified.</p>-->
              <input type="hidden" id="id" value="{{ $userAuth->id }}" name="id">
  						
              <div class="col-md-6">

                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label>{{ trans('admin.name', ['name' => trans('admin.user')]) }}</label>

                    {!! Form::text("name", $userAuth->name, [
                    'class' => 'form-control',
                    'placeholder' => trans('admin.name', ['name' => trans('admin.user')]),
                    'required'
                    ]) !!}
                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                  </div><!-- /.form-group -->

                   
                  <div class="form-group">
                    <div class="col-md-6">
                       <label>{{ trans('admin.password') }}</label><br />
                    <a href="#" onclick="changePass();">{{ trans('admin.changePass') }}</a><br /><br /><br /><br />
                    </div>
                  </div>

                </div><!-- /.col -->


                <div class="col-md-6">
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label>{{ trans('admin.email') }}</label>
                    {!! Form::email("email", $userAuth->email, [
                    'class' => 'form-control',
                    'placeholder' => trans('admin.email'),
                    'required'
                    ]) !!}
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong style="color:red">{{ $errors->first('email') }}</strong>
                    </span>
                    @endif        
                  </div><!-- /.form-group -->
                 

                </div><!-- /.col -->           
                 
                  
                <div class="col-md-12">
                  <hr>
                  <div class="clear">
                  <button type="submit" class="btn btn-primary">
                    <i class="icon-check2"></i> {{ trans('admin.save') }}
                  </button>
                </div>
                </div>

                 
<div class="modal fade changePass" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ trans('admin.changePass') }}</h4>
      </div>
      <div class="modal-body">
        <span>{{ trans('admin.password') }}</span>
        <input type="password" id="password" placeholder="{{ trans('admin.password') }}" class="form-control">
        <br />
        <div class="errors" style="display: none"></div>
        <div class="load" style=""></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.cancel') }}</button>
        @php $word = trans('admin.updated', ['name' => trans('admin.password')]) @endphp
        <button type="button" class="btn btn-primary" data-url="{{route('admin.changePass.ajax') }}" onclick="updatePassRequest(this, '{{ $word }}')">{{ trans('admin.save') }}</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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

</script>
@endsection
