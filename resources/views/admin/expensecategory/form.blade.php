<div class="row" style="background: #eaeaea; padding: 20px;">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>الاسم</label>

        {!! Form::text("name", null, [
        "class" => "form-control",
        "placeholder" => 'الاسم',
        "required"
        ]) !!}
      </div><!-- /.form-group -->
    </div>
    <div class="col-md-6">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>الكود</label>

        {!! Form::text("code", null, [
        "class" => "form-control",
        "placeholder" => 'كود القسم',
        ]) !!}
      </div><!-- /.form-group -->
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
