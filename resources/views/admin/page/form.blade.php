<div class="col-md-7">
  <hr>
  <h4><i class="fa fa-bookmark"></i> {{ trans('admin.shared_values') }}</h4>

  <div class="col-md-12">
    <div class="form-group">
      <div class="col-md-3">
        <label for="title">{{ trans('admin.slug') }}</label>
      </div>
      <div class="col-md-3">
        <span class="input-group-addon" style="height: 33px">
          @php
          $getslug=request()->get('thankspage');
          @endphp
          <input type="checkbox" id="check-slug" aria-label="" @if($page !='' || $getslug !='' ) checked @endif>
        </span>
      </div>
      <div class="col-md-6">
        @if($getslug)
        {!! Form::text('slug',$getslug,array('class'=>'form-control sluginput', 'id' => 'slug-'. getCurrentLang(),
        'readonly')) !!}
        @else
        {!! Form::text('slug',null,array('class'=>'form-control sluginput', 'id' => 'slug-'. getCurrentLang(), $page ==
        '' ? '' : 'readonly')) !!}
        @endif

        @if ($errors->has('slug'))
        <span class="help-block">
          <strong>{{ $errors->first('slug') }}</strong>
        </span>
        @endif
      </div>
    </div>
    <br>
  </div>







  <div class="col-md-12">
    <div class="form-group">
      <label for="title">{{ trans('admin.category') }}</label>
      {!! Form::select('category_id', $cats,null,array('class'=>'form-control')) !!}
      @if ($errors->has('category_id'))
      <span class="help-block">
        <strong>{{ $errors->first('category_id') }}</strong>
      </span>
      @endif
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      <label for="icon">
        {{ trans('admin.image') }}
        <a href="#file-manger-section">
          {{ trans('admin.choose_file') }}
        </a>
      </label>
      <div class="input-group">
        <span class="input-group-btn">
          <span id="meta-image" style="color: #FFF" class="btn btn-primary">
            {{ trans('admin.show_alt') }}
          </span>
        </span>
        {!! Form::text('image[0][image]', getImageValue($page, 'image'),
        array('class'=>'form-control image-type', 'id' => '')) !!}
      </div>

      @if($page != null)
      <img style="margin-top:15px;max-width: 150px;max-height:150px;" src="{{ $page->image_path }}">
      @endif


    </div>
    <div class="meta-image-content" style="display: none;">
      @foreach ($dbLangs as $key => $lang)
      <div class="form-group">
        <label for="icon">{{ trans('admin.alt', ['name' => $lang->name]) }}</label>
        <div class="input-group">
          {!! Form::text('image[0][title]['.$lang->code.']',getImageValue($page, 'title', $lang->code),
          array('class'=>'form-control')) !!}
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      <label for="status">{{ trans('admin.status') }}</label>

      <input type="checkbox" class="checkbtnC" name="status" @if($act=='edit' ) @if($page->status == 1)
      checked="checked" @endif @else checked="checked" @endif />

    </div>
  </div>


  <div class="modulesss">
    <div class="col-md-12">
      <section id="accordion">
        <div class="row">
          <div class="col-xs-12 mt-1">
            <h4>{{ trans('modules.modules') }}</h4>
            <hr>
          </div>
        </div>
        <div class="row match-height">
          <div class="col-lg-12">
            <div class="mb-1">
              <!--<h5 class="mb-0">Basic Accordion</h5>
          <p>Basic accordion toggle.</p>-->
            </div>
            <div id="accordionWrapa1" role="tablist" aria-multiselectable="true">
              <div class="sort-scroll-container" data-animation-duration="1000" data-css-easing="ease-in-out"
                data-keep-still=true data-fixed-elements-selector=".navigation">
                <div class="card" id="put-model-data">
                  @if(old('mod') != null)
                  @foreach(old('mod') as $k => $module)
                  @php $num = str_random(6) . rand(0, 5957514); @endphp
                  @foreach($module as $km => $modu)
                  @include('modules.admin.default', ['km' => $km, 'num' => $num, 'data' => (array)$modu])
                  @endforeach
                  @endforeach
                  @elseif($page != null)
                  @foreach($page->modules_array as $k => $module)
                  @php $num = str_random(6) . rand(0, 5957514); @endphp
                  @foreach($module as $km => $modu)
                  @include('modules.admin.default', ['km' => $km, 'num' => $num, 'data' => (array)$modu])
                  @endforeach
                  @endforeach
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <div class="col-md-12">
      <div class="col-md-10">
        <div class="form-group">
          <label for="icon">{{ trans('modules.module') }}</label>
          <div class="input-group">
            <span class="input-group-btn">

            </span>
            {!! Form::select('modules',modules(), null,
            array('class'=>'form-control', 'id' => 'select-module')) !!}
          </div>
        </div>
      </div>
      <div class="col-md-2" style="margin-top: 28px">
        <span class="btn btn-success" id="add-module">{{ trans('admin.add') }}</span>
      </div>

    </div>
  </div>
</div>

<div class="col-xs-5">
  <ul class="nav nav-tabs nav-justified">
    @foreach ($dbLangs as $key => $lang)
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
      <div class="col-md-12">
        <div class="form-group">
          <label
            for="title">{{ trans('admin.title', ['name' => trans('admin.page', [], $lang->code)], $lang->code) }}</label>

          {!! Form::text('title['.$lang->code.']',
          checkVar($act, $page, $lang->code, 'title','title.'.$lang->code),
          array('class'=>'form-control slugable', 'data-slug' => $lang->code)) !!}
          @if ($errors->has('title.'.$lang->code))
          <span class="help-block">
            <strong>{{ $errors->first('title.'.$lang->code) }}</strong>
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-12" style="display: none;">
        <div class="form-group">
          <label for="title">{{ trans('admin.content', [], $lang->code) }}</label>

          {!! Form::textarea('content['.$lang->code.']',
          checkVar($act, $page, $lang->code, 'content','content.'.$lang->code),
          array('class'=>'form-control ckeditor')) !!}
          @if ($errors->has('content.'.$lang->code))
          <span class="help-block">
            <strong>{{ $errors->first('content.'.$lang->code) }}</strong>
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label for="title">{{ trans('admin.seo_desc', [], $lang->code) }}
            <!--<small style="cursor: pointer;color:#8e1d26" onclick="tranferDescription('content[{{$lang->code}}]', '{{$lang->code}}', 155)">{{ trans('admin.pickFrom') }}</small>-->
          </label>

          {!! Form::textarea('description['.$lang->code.']',
          checkVar($act, $page, $lang->code, 'description','description.'.$lang->code),
          array(
          'class'=>'form-control',
          'id' => 'description'. $lang->code)
          ) !!}
          @if ($errors->has('description.'.$lang->code))
          <span class="help-block">
            <strong>{{ $errors->first('description.'.$lang->code) }}</strong>
          </span>
          @endif
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group">
          <label for="title">{{ trans('admin.seo_keys', [], $lang->code) }}
            <!--<small style="cursor: pointer;color:#8e1d26" onclick="tranferKeywords('content[{{$lang->code}}]', '{{$lang->code}}')">{{ trans('admin.pickFrom') }}</small>-->
          </label>
          {!! Form::textarea('keywords['.$lang->code.']',
          checkVar($act, $page, $lang->code, 'keywords','keywords.'.$lang->code),
          array(
          'class'=>'form-control',
          'id' => 'keywords'. $lang->code)
          ) !!}
          @if ($errors->has('keywords.'.$lang->code))
          <span class="help-block">
            <strong>{{ $errors->first('keywords.'.$lang->code) }}</strong>
          </span>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
<input type="hidden" id="savecontinue" name="statcon" value="notcontinue">
<div class="col-md-12">
  <hr>
  <div class="clear">
    <button type="submit" class="btn btn-primary">
      <i class="icon-check2"></i> {{ trans('admin.save') }}
    </button>

    <button type="submit" class="btn btn-primary" id="savecontinuebtu">
      <i class="icon-check2"></i> {{ trans('admin.savecontinue') }}
    </button>

    <a href="{{ route('page.index') }}" class="btn btn-danger">
      <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
    </a>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
  $(document).ready(function(){
$("#savecontinuebtu").click(function(){
    $("#savecontinue").val("continue");
})
})
</script>