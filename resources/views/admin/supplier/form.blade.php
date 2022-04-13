<div class="row" style="background: #eaeaea; padding: 20px;">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
        <label>الاسم</label>

        {!! Form::text("name", null, [
        "class" => "form-control",
        "placeholder" => 'الاسم',
        "required"
        ]) !!}
      </div><!-- /.form-group -->
    </div>

    <div class="col-md-4">
      <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
        <label> الاسم اللاتيني</label>
        {!! Form::text("name_en", null, [
        "class" => "form-control",
        "placeholder" => 'الاسم اللاتيني',
        "required"
        ]) !!}
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
        <label> الجوال</label>
        {!! Form::text("phone", null, [
        "class" => "form-control",
        "placeholder" => 'الجوال',
        "required"
        ]) !!}
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
        <label> البريد الالكتروني</label>
        {!! Form::email("email", null, [
        "class" => "form-control",
        "placeholder" => 'البريد الالكتروني',
        "required"
        ]) !!}
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
        <label> العنوان</label>
        {!! Form::text("address", null, [
        "class" => "form-control",
        "placeholder" => 'العنوان',
        "required"
        ]) !!}
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
        <label> الوظيفه</label>
        {!! Form::text("job", null, [
        "class" => "form-control",
        "placeholder" => 'الوظيفه',
        "required"
        ]) !!}
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
        <label> النوع</label><br>
        <label class="radio-inline" style="margin-left: 100px;"><input type="radio" name="type" value="0"
            {{(isset($supplier) && $supplier->type == 0) ? 'checked' : 'checked'}}> محلي </label>
        <label class="radio-inline"><input type="radio" name="type" value="1" {{(isset($supplier) && $supplier->type ==
          1) ? 'checked' : ''}}> دولي </label>
      </div>
    </div>


    <div class="col-md-12">
      <hr>
      <div class="clear">
        <button type="submit" class="btn btn-success">
          <i class="icon-check2"></i> {{ trans('admin.save') }}
        </button>
      </div>
    </div>