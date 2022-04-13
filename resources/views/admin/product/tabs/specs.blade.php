<div class="tab-pane  fade" id="menu4">
  <div class="col-md-9">
    <div id="addspecifications" class="form-group">
      <label>المواصفات الفنيه</label><br>
      <div class="col-md-12">
        <label>صوره المواصفات الفنيه</label><br>
        <input type="file" name="main_desc_img">
        @if(isset($product) && $product->spec_main_img != "")
        <img style="width:150px;" src="{{url('/')}}/uploads/spec_images/{{$product->spec_main_img}}">
        <input type="hidden" name="old_main_desc_img" value="{{$product->spec_main_img}}">
        @endif
        <br><br>
      </div>

      @if(isset($product->sections) && count($product->sections) > 0)
      @foreach($product->sections as $key=>$spec)
      <div class="row">
        <div class="col-md-3">
          <select class="form-control" name="specs_sections[]">
            <option value="">اختر التصنيف</option>
            @foreach($sections as $section)
            <option value="{{$section->id}}" {{($spec->section_id == $section->id) ? 'selected' :
              ''}}>{{$section->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3">
          <select class="form-control specs_select2_type" data-numb="1" name="specs_names[]">
            <option value="{{$spec->name}}">{{$spec->name}}</option>
          </select>
        </div>
        <div class="col-md-5 colm9-1" style="margin-bottom:10px">
          {!! Form::text("specs_desc[]", $spec->description, [
          "class" => "form-control",
          "placeholder" => "الوصف",
          "style" => 'direction: ltr',
          ]) !!}
        </div>
        <div class="col-md-1">
          <i class="fa fa-close removethis"></i>
        </div>
      </div>
      @endforeach
      @elseif(isset($specs_names))
      @foreach($specs_names as $key=>$spec_name)
      <div class="row">
        <div class="col-md-3">
          <select class="form-control" name="specs_sections[]">
            <option value="">اختر التصنيف</option>
            @foreach($sections as $section)
            <option value="{{$section->id}}">{{$section->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3">
          <select class="form-control specs_select2_type" data-numb="1" name="specs_names[]">
            <option value="{{$spec_name}}">{{$spec_name}}</option>
          </select>
        </div>

        <div class="col-md-5 colm9-1" style="margin-bottom:10px">
          {!! Form::text("specs_desc[]", $specs_desc[$key], [
          "class" => "form-control",
          "placeholder" => "الوصف",
          "style" => 'direction: ltr',
          ]) !!}
        </div>
        <div class="col-md-1">
          <i class="fa fa-close removethis"></i>
        </div>
      </div>
      @endforeach
      @else
      <div class="col-md-3">
        <select class="form-control" name="specs_sections[]">
          <option value="">اختر التصنيف</option>
          @foreach($sections as $section)
          <option value="{{$section->id}}">{{$section->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-3">
        <select class="form-control specs_select2_type" data-numb="1" name="specs_names[]">
          <option value="الطول">الطول</option>
          <option value="العرض">العرض</option>
          <option value="الارتفاع">الارتفاع</option>
          <option value="القوه الهيدروليكيه">القوه الهيدروليكيه</option>
          <option value="الكهرباء">الكهرباء</option>
          <option value="سرعه الدوران">سرعه الدوران</option>
        </select>
      </div>

      <div class="col-md-6 colm9-1" style="margin-bottom:10px">
        {!! Form::text("specs_desc[]", "", [
        "class" => "form-control",
        "placeholder" => "الوصف",
        "style" => 'direction: ltr',
        ]) !!}

      </div>
      @endif
    </div><!-- /.form-group -->
  </div>
  <div class="col-md-3">
    <button id="add-specfic" style="float: left; margin-top: 20px;" class="btn btn-success">اضافه وصف اخر</button>
  </div>

</div>
<style>
  .removethis {
    padding: 10px;
    background: antiquewhite;
    color: red;
  }
</style>