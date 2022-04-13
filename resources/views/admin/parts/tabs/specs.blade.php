<div class="tab-pane  fade" id="menu4">
  <div class="col-md-9">
    <div id="addspecifications" class="form-group">
      <label>المواصفات الفنيه</label><br>
      @if(isset($specs_names))
      @foreach($specs_names as $key=>$spec_name)
      <div class="col-md-3">
        <select class="form-control specs_type" data-numb="1" id="specs_type" name="specs_names[]">
          <option value="0" {{($spec_name==0) ? 'selected' : '' }}>المسمي</option>
          <option value="الطول" {{($spec_name=='الطول' ) ? 'selected' : '' }}>الطول </option>
          <option value="العرض" {{($spec_name=='العرض' ) ? 'selected' : '' }}>العرض </option>
          <option value="الارتفاع" {{($spec_name=='الارتفاع' ) ? 'selected' : '' }}>الارتفاع </option>
          <option value="القوه الهيدروليكيه" {{($spec_name=='القوه الهيدروليكيه' ) ? 'selected' : '' }}>القوه
            الهيدروليكيه </option>
          <option value="الكهرباء" {{($spec_name=='الكهرباء' ) ? 'selected' : '' }}>الكهرباء </option>
          <option value="سرعه الدوران" {{($spec_name=='سرعه الدوران' ) ? 'selected' : '' }}>سرعه الدوران </option>
        </select>
      </div>


      <div class="col-md-3">
        {!! Form::text("specs_name[]", ($specs_name[$key] != '') ? $specs_name[$key] : '', [
        "class" => "form-control nameattr-1",
        "id" => "nameattr",
        "placeholder" => "المسمي",
        ]) !!}
      </div>


      <div class="col-md-6 colm9-1" style="margin-bottom:10px">
        {!! Form::text("specs_desc[]", $specs_desc[$key], [
        "class" => "form-control",
        "placeholder" => "الوصف",
        ]) !!}
      </div>

      @endforeach
      @else
      <div class="col-md-3">
        <select class="form-control specs_type" data-numb="1" id="specs_type" name="specs_names[]">
          <option value="0">المسمي</option>
          <option value="الطول">الطول</option>
          <option value="العرض">العرض</option>
          <option value="الارتفاع">الارتفاع</option>
          <option value="القوه الهيدروليكيه">القوه الهيدروليكيه</option>
          <option value="الكهرباء">الكهرباء</option>
          <option value="سرعه الدوران">سرعه الدوران</option>
        </select>
      </div>


      <div class="col-md-3">
        {!! Form::text("specs_name[]", "", [
        "class" => "form-control nameattr-1",
        "id" => "nameattr",
        "placeholder" => "المسمي",
        ]) !!}

      </div>


      <div class="col-md-6 colm9-1" style="margin-bottom:10px">
        {!! Form::text("specs_desc[]", "", [
        "class" => "form-control",
        "placeholder" => "الوصف",
        ]) !!}

      </div>
      @endif
    </div><!-- /.form-group -->
  </div>
  <div class="col-md-3">
    <button id="add-specfic" style="float: left; margin-top: 20px;" class="btn btn-success">اضافه وصف اخر</button>
  </div>

</div>