<div class="row" style="background: #eaeaea; padding: 20px;">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
        <label>الاسم</label>

        {!! Form::text("name", isset($stock) ? $stock->name : "", [
        "class" => "form-control",
        "placeholder" => 'الاسم',
        "required"
        ]) !!}
      </div><!-- /.form-group -->
    </div>


    <!-- <div class="col-md-6">
      <div class="form-group{{ $errors->has("name") ? " has-error" : "" }}">
        <label>المستودع</label>
        <select name="stock" class="form-control" id="">
          <option value="">اختر المستودع</option>
          @foreach($stocks as $stock)
          <option value="{{$stock->id}}">{{$stock->name}}</option>
          @endforeach
        </select>
      </div>
    </div> -->


  </div>

  <div class="col-md-12">
    <hr>
    <div class="clear">
      <button type="submit" class="btn btn-success">
        <i class="icon-check2"></i> {{ trans('admin.save') }}
      </button>
    </div>
  </div>