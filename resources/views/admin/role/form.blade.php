<div class="tab-content px-1 pt-1">
  @foreach ($dbLangs as $key => $lang)
  <div role="tabpanel" class="tab-pane fade {{ $key == 0 ? 'active in' : '' }}" id="{{ $lang->code  }}"
    aria-labelledby="{{ $lang->code }}-tab" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}">
    <div class="col-md-12">
      <div class="form-group">
        <label for="title">{{ trans('admin.name', ['name' => trans('admin.role', [], $lang->code)], $lang->code)
          }}</label>

        {!! Form::text('name['.$lang->code.']',
        checkVar($act, $role, $lang->code, 'name','name.'.$lang->code),
        array('class'=>'form-control')) !!}
        @if ($errors->has('name.'.$lang->code))
        <span class="help-block">
          <strong>{{ $errors->first('name.'.$lang->code) }}</strong>
        </span>
        @endif
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
        <label for="title">{{ trans('admin.comment', [], $lang->code) }}
        </label>

        {!! Form::textarea('comment['.$lang->code.']',
        checkVar($act, $role, $lang->code, 'comment','comment.'.$lang->code),
        array(
        'class'=>'form-control',
        'maxlength' => 250)
        ) !!}
        @if ($errors->has('comment.'.$lang->code))
        <span class="help-block">
          <strong>{{ $errors->first('comment.'.$lang->code) }}</strong>
        </span>
        @endif
      </div>
    </div>

  </div>
  @endforeach

  <div class="col-md-12">
    <hr>
    <h4><i class="fa fa-bookmark"></i> {{ trans('admin.shared_values') }}</h4>
    <div class="col-md-6 col-sm-4">
      <div class="form-group">
        <label for="status">{{ trans('admin.permissions') }}</label>
        <select class="permission-select js-states form-control" multiple="multiple" name="permissions[]">
          @foreach(admin_permissions() as $perm)
          <optgroup label="{{ trans('admin.'. $perm) }}">
            @foreach($permissions as $permission)
            @if($permission->for == $perm)
            <option value="{{ $permission->id }}" @if(old('permissions')) @if(in_array($permission->id,
              old('permissions')))
              selected
              @endif
              @elseif($role != null)
              @foreach($role->permissions as $permiss)
              @if($permiss->id == $permission->id)
              selected
              @break
              @endif
              @endforeach
              @endif
              >
              {{ trans('admin.'.$permission->name, ['name' => trans('admin.'. $perm)]) }}
            </option>
            @endif
            @endforeach
          </optgroup>
          @endforeach
        </select>
        @if ($errors->has('permissions'))
        <span class="help-block">
          <strong>{{ $errors->first('permissions') }}</strong>
        </span>
        @endif
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
        <label for="status">{{ trans('admin.status') }}</label>

        <input type="checkbox" class="checkbtnC" name="status" @if($act=='edit' ) @if($role->status == 1)
        checked="checked" @endif @else checked="checked" @endif />

      </div>
    </div>
  </div>
  <div class="col-md-12">
    <hr>
    <div class="clear">
      <button type="submit" class="btn btn-primary">
        <i class="icon-check2"></i> {{ trans('admin.save') }}
      </button>
      <a href="{{ route('role.index') }}" class="btn btn-danger">
        <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
      </a>
    </div>
  </div>
</div>