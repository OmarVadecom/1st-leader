<div class="row" style="background: #eaeaea; padding: 20px;">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>اسم المركز</label>

        {!! Form::text("center_name",null, [
        "class" => "form-control",
        "placeholder" => 'اسم المركز',
        "required"
        ]) !!}
      </div><!-- /.form-group -->
    </div>

    <div class="col-md-4">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>رقم القطعه</label>

        {!! Form::text("code", null, [
        "class" => "form-control",
        "placeholder" => 'رقم القطعه',
        "required"
        ]) !!}
      </div><!-- /.form-group -->
    </div>


    <div class="col-md-4">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>السجل التجاري</label>
        {!! Form::text("segl_num", null, [
        "class" => "form-control",
        "placeholder" => 'السجل التجاري',
        "required"
        ]) !!}
      </div><!-- /.form-group -->
    </div>
  </div>

  @if(isset($letter))
  <div class="col-md-12">
    <div class="form-group">
      <label>رفع الخطاب الموثق</label><br>
      <input type="file" name="file">
    </div>
    @if(@is_array(getimagesize(url('/').'/uploads/letters/'.$letter->filename)))
    <img style="width:100%" src="{{url('/')}}/uploads/letters/{{$letter->filename}}">
    @else
    <a href="{{url('/')}}/uploads/letters/{{$letter->filename}}" download>{{$letter->filename}}</a>
    @endif
  </div>
  @endif
  <div class="col-md-12">
    <hr>
    <div class="clear">
      <button type="submit" class="btn btn-success">
        <i class="icon-check2"></i>
        @if(isset($letter))
        حفظ
        @else
        طباعه
        @endif
      </button>
      <a href="{{ route('letter.index') }}" class="btn btn-danger">
        <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
      </a>
    </div>
  </div>