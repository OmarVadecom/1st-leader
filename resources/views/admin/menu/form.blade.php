<div class="col-md-7">
  <hr>
  <h4><i class="fa fa-bookmark"></i> {{ trans('admin.shared_values') }}</h4>


   <div class="col-md-6">
      <div class="form-group">
        <label for="link_method">{{ trans('admin.link_method') }}</label>
        {!! Form::select("link_method", linkMethods(), null, [
          'class' => 'form-control link_method',
          'onchange' => 'getLinkFromType(this)',
          'required'
          ]) !!}
        @if ($errors->has('link_method'))
          <span class="help-block">
              <strong>{{ $errors->first('link_method') }}</strong>
          </span>
        @endif
    </div>
  </div>



 <div class="col-md-6">
    <div class="form-group">
    <label for="target">{{ trans('admin.target') }}</label>
        {!! Form::select("target", targets(), null,
        ['class' => 'form-control',
          'required'
        ]) !!}
        @if ($errors->has('target'))
        <span class="help-block">
            <strong>{{ $errors->first('target') }}</strong>
        </span>
        @endif
    </div>
  </div>

      <div class="col-md-12">
        <div class="form-group">
          <label for="parent">{{ trans('admin.parent') }}</label>
          {!! Form::select("parent_id", $parents, null,
          ['class' => 'form-control',
          ]) !!}
          @if ($errors->has('parent_id'))
          <span class="help-block">
              <strong>{{ $errors->first('parent_id') }}</strong>
          </span>
          @endif
        </div>
      </div>


      <div class="col-md-12 content-page-type">
                        <div class="form-group">
                         <label for="link">{{ trans('admin.link') }} 

                          <small class="link-prev">
                          @if($menu != null)
                           {{ linkRef($menu->link_method) }}</small>
                           <small id="link-place">{{ $menu->link }}</small>
                           @else
                           </small>
                           <small id="link-place"></small>
                          @endif
                          
                        </label>

                         {!! Form::text("link", null, [
                          'class'    => 'form-control link-input',
                          'onkeyup' => 'writeAlink();',
                          ]) !!}
                         @if ($errors->has('link'))
                          <span class="help-block">
                              <strong>{{ $errors->first('link') }}</strong>
                          </span>
                         @endif
                       </div>
                    </div>

<div class="col-md-12">
  <div class="form-group">
   <label for="status">{{ trans('admin.status') }}</label>

   <input type="checkbox" class="checkbtnC" name="status" @if($act == 'edit') @if($menu->status == 1) checked="checked" @endif @else checked="checked"  @endif />

 </div>
</div>

</div>

<div class="col-xs-5">
  <ul class="nav nav-tabs nav-justified">
    @foreach ($dbLangs as $key => $lang)
    <li class="nav-item">
      <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="{{ $lang->code }}-tab" data-toggle="tab" href="#{{ $lang->code }}" aria-controls="{{ $lang->code }}" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}">{{ $lang->name }}</a>
    </li>
    @endforeach
  </ul>

  <div class="tab-content px-1 pt-1">

    @foreach ($dbLangs as $key => $lang)
    <div role="tabpanel" class="tab-pane fade {{ $key == 0 ? 'active in' : '' }}" id="{{ $lang->code  }}" aria-labelledby="{{ $lang->code }}-tab" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}">
     <div class="col-md-12">
      <div class="form-group">
       <label for="title">{{ trans('admin.title', ['name' => trans('admin.page', [], $lang->code)], $lang->code) }}</label>

       {!! Form::text('title['.$lang->code.']', 
       checkVar($act, $menu, $lang->code, 'title','title.'.$lang->code), 
       array('class'=>'form-control slugable', 'data-slug' => $lang->code)) !!}
       @if ($errors->has('title.'.$lang->code))
       <span class="help-block">
        <strong>{{ $errors->first('title.'.$lang->code) }}</strong>
      </span>
      @endif
    </div>
  </div>




</div>
@endforeach
</div>
</div>

<div class="col-md-12">
  <hr>
  <div class="clear">
    <button type="submit" class="btn btn-primary">
     <i class="icon-check2"></i> {{ trans('admin.save') }}
   </button>
   <a href="{{ route('menu.index') }}" class="btn btn-danger">
    <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
  </a>
</div>
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="menu-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ trans('admin.link') }}</h4>
      </div>
      <div class="modal-body" id="menu-content">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
          {{ trans('admin.cancel') }}
        </button>
        <button type="button" class="btn btn-primary" id="menu-set">{{ trans('admin.set') }}</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->