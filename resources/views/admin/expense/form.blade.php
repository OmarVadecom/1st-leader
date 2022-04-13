<div class="row" style="background: #eaeaea; padding: 20px;">
    <div class="row">
        <div class="col-md-4">
            <div
                class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
                <label>الاسم</label>

                {!! Form::text("name", null , [
                "class" => "form-control",
                "placeholder" => 'الاسم',
                "required"
                ]) !!}
            </div>
        </div>
        <div class="col-md-4">
            <div
                class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
                <label>القسم</label>
                <select name="category_id" class="form-control" id="">
                    <option value="">اختر القسم</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ (isset($expense) && $expense->category_id == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div
                class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
                <label>الكود</label>
                {!! Form::text("code", null , [
                "class" => "form-control",
                "placeholder" => ' كود المصروف',
                ]) !!}
            </div>
        </div>
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
