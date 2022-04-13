<div class="row" style="background: #eaeaea; padding: 20px;">
    <div class="row">
        <div class="col-md-2">
            <div
                class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
                <label>الاسم</label>

                {!! Form::text("name", isset($brand) ? $brand->brand : "", [
                "class" => "form-control",
                "placeholder" => 'الاسم',
                "required"
                ]) !!}
            </div><!-- /.form-group -->
        </div>
        <div class="col-md-2">
            <div
                class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
                <label>رقم الترميز للبراند</label>

                {!! Form::text("brandcode", isset($brand) ? $brand->brand : "", [
                "class" => "form-control",
                "placeholder" => 'رقم البراند',
                "required"
                ]) !!}
            </div><!-- /.form-group -->
        </div>

        <div class="col-md-2">
            <div
                class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
                <label>البلد</label>
                <select name="country_id" class="form-control" id="">
                    <option value="">اختر بلد المنشأ</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}"
                            {{ (isset($brand) && $brand->country_id == $country->id) ? 'selected' : '' }}>
                            {{ $country->name }}</option>
                    @endforeach
                </select>
            </div><!-- /.form-group -->
        </div>
        <div class="col-md-2">
            <div
                class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
                <label>الترتيب</label>
                {!! Form::number("sort", isset($brand) ? $brand->brand : "", [
                "class" => "form-control",
                "placeholder" => 'الترتيب',
                "required"
                ]) !!}
            </div><!-- /.form-group -->
        </div>
        <div class="col-md-2">
            <div
                class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
                <label>صوره البراند</label>
                <br>
                <input type="file" name="image">
                <input type="hidden" name="oldimage"
                    value="{{ ($brand) ? $brand->image : '' }}">
            </div><!-- /.form-group -->

        </div>
        <div class="col-md-2">
            @if(isset($brand))
                <img style="width:120px; margin-top:20px;"
                    src="{{ url('/') }}/uploads/brands_images/{{ $brand->image }}" alt="">
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
