<div class="row" style="background: #eaeaea; padding: 20px;">
    <div class="row">
        <div class="col-md-6">
            <div
                class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
                <label>اسم الدوله</label>

                {!! Form::text("name", isset($country) ? $country->name : "", [
                "class" => "form-control",
                "placeholder" => 'الاسم',
                "required"
                ]) !!}
            </div><!-- /.form-group -->
        </div>

        <div class="col-md-3">
            <label>صوره الدوله</label>
            <br>
            <input type="file" name="image">
            <input type="hidden" name="oldimage"
                value="{{ (isset($country)) ? $country->image : '' }}">
        </div>
        <div class="col-md-3">
            @if(isset($country))
                <img src="{{ asset('uploads/countries/'.$country->image) }}"
                    style="width: 100px;margin-top: -20px;" alt="">
            @endif
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
