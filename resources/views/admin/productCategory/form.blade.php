<div class="col-md-7">
    <hr>
    <h4><i class="fa fa-bookmark"></i> {{ trans('admin.shared_values') }}</h4>

    <div class="col-md-12">
        <div class="form-group">
            <label for="title">رمز المجموعه</label>
            {!! Form::text('slug',($product) ? $product->slug : '',array('class'=>'form-control')) !!}

        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="title">اسم المجموعه</label>

            {!! Form::text('name',($product) ? $product->name : '',
            array('class'=>'form-control')) !!}

        </div>

    </div>


    <div class="col-md-12">
        <div class="form-group">
            <label for="status">{{ trans('admin.status') }}</label>

            <input type="checkbox" class="checkbtnC" name="status" @if($act=='edit' ) @if($product->status == 1)
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
        <a href="{{ route('product-categories.index') }}" class="btn btn-danger">
            <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
        </a>
    </div>
</div>
