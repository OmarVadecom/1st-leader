@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
  <div class="row match-height">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">اعدادات السيستم</h4>
        </div>
        {!! Form::open([
        'url' => route('admin.settings.update'),
        'method', 'POST',
        'files' => true
        ]) !!}
        <div class="card-body">
          <div class="card-block">
            <!--<p>Use <code>.nav-justified</code> class to set tabs justified.</p>-->
            <ul class="nav nav-tabs nav-justified">
              @foreach (getAllLangFromDB() as $key => $lang)
              <li class="nav-item">
                <a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="{{ $lang->code }}-tab" data-toggle="tab"
                  href="#{{ $lang->code }}" aria-controls="{{ $lang->code }}"
                  aria-expanded="{{ $key == 0 ? 'true' : 'false' }}">{{ $lang->name }}</a>
              </li>
              @endforeach
            </ul>

            <div class="tab-content px-1 pt-1">
              @foreach ($dbLangs as $key => $lang)
              <div role="tabpanel" class="tab-pane fade {{ $key == 0 ? 'active in' : '' }}" id="{{ $lang->code  }}"
                aria-labelledby="{{ $lang->code }}-tab" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}">
                @foreach($settings as $setting)
                @if($setting->lang != $lang->code)
                @continue
                @endif
                <div class="form-group">
                  <label for="{{ $setting->name.'['.$setting->lang.']'}}">{{ $setting->slug }}</label>
                  @if($setting->type == 'text')
                  {!! Form::text($setting->name.'['. $setting->lang .']', $setting->value, ['class' => 'form-control'])
                  !!}

                  @elseif($setting->type == 'textarea')
                  {!! Form::textarea($setting->name.'['.$setting->lang.']', $setting->value, ['class' =>
                  'form-control']) !!}

                  @elseif($setting->type == 'editor')
                  {!! Form::textarea($setting->name .'['.$setting->lang.']', $setting->value, ['class' => 'form-control
                  ckeditor']) !!}

                  @elseif($setting->type == 'hidden')
                  {!! Form::hidden($setting->name .'['.$setting->lang.']', $setting->value, ['class' => 'form-control'])
                  !!}

                  @elseif($setting->type == 'select')
                  {!! Form::select($setting->name .'['.$setting->lang.']', $setting->select_options, $setting->value,
                  ['class' => 'form-control']) !!}

                  @elseif($setting->type == 'color')
                  {!! Form::color($setting->name .'['.$setting->lang.']', $setting->value, ['class' => 'form-control'])
                  !!}

                  @elseif($setting->type == 'aceeditor')
                  {!! Form::textarea($setting->name.'['.$setting->lang.']', $setting->value, ['class' =>
                  'form-control']) !!}


                  <div id="{{$setting->name.'['.$setting->lang.']'}}" style="height:350px;">
                    {!!$setting->value!!}
                  </div>

                  @elseif($setting->type == 'file')
                  <br>
                  <input class="btn btn-primary" type="file" accept=".jpg,.png,.jpeg"
                    name="{{$setting->name.'['. $setting->lang .']'}}"><br>
                  @if($setting->value != null)
                  <img src="{{url('/')}}/uploads/logo/{{$setting->value}}" alt="{{$setting->name}}"
                    style="width:280px; margin-top:10px;">
                  @endif
                  @else
                  @endif
                </div>
                @endforeach
              </div>
              @endforeach
              <!--<div class="form-group">
                       <label for="">{{ trans('admin.simages') }}</label>

                      <a href="{{-- route('simage.index') --}}">{{-- route('simage.index') --}}</a>
                </div>-->

              <div class="clear">
                <button type="submit" class="btn btn-primary">
                  <i class="icon-check2"></i> {{ trans('admin.save') }}
                </button>
              </div>
            </div>

          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section>
@endsection