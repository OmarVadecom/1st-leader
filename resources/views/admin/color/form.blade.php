<div class="row" style="background: #eaeaea; padding: 20px;">
    <div class="row">
        <div class="col-md-6">
            <div
                class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
                <label> اللون</label>

                {!! Form::text("name", isset($color) ? $color->name : "", [
                "class" => "form-control",
                "placeholder" => 'اللون',
                "required"
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
