<div class="tab-pane  fade" id="menu1">
  <div class="col-md-12 unitsrows">
    <div class="row">
      <div class="col-md-5">
        <div class="form-group">
          <label>الوحده 1</label>
          {!! Form::text("units[]", isset($units) ? $units[0] : "" , [
          'class' => 'form-control',
          'placeholder' => 'الوحده ',
          ]) !!}
        </div><!-- /.form-group -->
        <div class="form-group">
          <label><input type="radio" value="1" {{(isset($units) && $unit_default==1) ? 'checked' : '' }}
              name="unit_default[]"> الافتراضي
          </label>
          <br><br>
        </div><!-- /.form-group -->
      </div><!-- /.form-group -->
      <div class="col-md-5">
        <div class="form-group">
          <label>رمز الباركود</label>
          {!! Form::text("units_barcode[]", isset($units) ?$units_barcode[0] : "" , [
          'class' => 'form-control',
          'placeholder' => 'رمز الباركود',
          ]) !!}
        </div><!-- /.form-group -->
      </div>


      <div class="col-md-2">
        <button id="add-unit" style="float: left;margin-top: 24px;" class="btn btn-success">اضافه وحده اخري</button>
      </div>
    </div>

    @if(isset($units) && count($units) > 1)
    @foreach($units as $index=>$unit)
    @php
    if ($index > 1) continue;
    @endphp
    <input type="hidden" id="indexnum" value="{{$index+2}}">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group"> <label>الوحده {{$index+2}}</label> {!! Form::text("units[]", $unit, [ "class" =>
          "form-control",
          "placeholder" => "الوحده", ]) !!} </div><!-- /.form-group -->
      </div>
      <div class="col-md-4">
        <div class="form-group"> <label>عامل التحويل</label> {!! Form::number("units_cons[]",$units_cons[$index] , [
          "class" => "form-control", "placeholder" => "عامل التحويل", ]) !!} </div>
        <!-- /.form-group -->
      </div>
      <div class="col-md-4">
        <div class="form-group"> <label>رمز الباركود</label> {!! Form::text("units_barcode[]", $units_barcode[$index] ,
          [ "class" =>
          "form-control", "placeholder" => "رمز الباركود", ]) !!} </div><!-- /.form-group -->
      </div>
    </div>
    <div class="form-group"> <label><input type="radio" value="{{$index+2}}" {{(isset($units) &&
          $unit_default==$index+2) ? 'checked' : '' }} name="unit_default[]"> الافتراضي </label>
      <br><br>
    </div><!-- /.form-group -->
    @endforeach
    @endif
    <hr>





    {{-- <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>الوحده 2</label>
          {!! Form::text("unit_2", isset($product) ? $unit_2 : "", [
          'class' => 'form-control',
          'placeholder' => 'الوحده 2',
          ]) !!}
        </div><!-- /.form-group -->
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label>عامل التحويل</label>
          {!! Form::text("unit_2_con", isset($product) ? $unit_2_con : "" , [
          'class' => 'form-control',
          'placeholder' => 'عامل التحويل',
          ]) !!}
        </div><!-- /.form-group -->
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>رمز الباركود</label>
          {!! Form::text("unit_2_label", isset($product) ? $unit_2_con : "" , [
          'class' => 'form-control',
          'placeholder' => 'رمز الباركود',
          ]) !!}
        </div><!-- /.form-group -->

      </div>
    </div>
    <div class="form-group">
      <label><input type="radio" value="2" name="unit_status" {{(isset($product) && $unit_status==2) ? 'checked' : ''
          }}> الافتراضي
      </label>
      <br><br>
    </div><!-- /.form-group --> --}}




  </div>
</div>