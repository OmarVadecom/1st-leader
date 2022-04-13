<div class="tab-pane  fade" id="menu14">
  <div class="row">
    <div class="col-md-12">
      @if(isset($charts) && $charts[0] != "")
      @foreach($charts as $key=>$chart)
      <input id="filechart{{$key}}_name" type="hidden" name="charts_names[]" value="{{$charts_names[$key]}}">
      <input id="filechart{{$key}}_description" type="hidden" name="charts_description[]"
        value="{{$charts_description[$key]}}"> @endforeach
      @endif

      <div id="filesinputparts" class="form-group">
        <label for="title">اسم المستند </label><br>
        <div class="row">
          <div class="col-md-3">
            {!! Form::text("charts_names[]", "", [
            "class" => "form-control",
            "placeholder" => "اسم المستند",
            ]) !!}
          </div>
          <div class="col-md-4">
            {!! Form::text("charts_description[]", "", [
            "class" => "form-control",
            "placeholder" => "وصف المستند",
            ]) !!}
          </div>
          <div class="col-md-3">
            <input accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file" name="charts[]">
          </div>
          <div class="col-md-2">
            <button id="addinputparts" class="btn btn-primary"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <br>
      </div>
    </div>


    @if(isset($charts) && $charts[0] != "")
    <div class="col-md-12">
      <div class="card-body collapse in">
        <div class="card-block card-dashboard">
          <table class="table table-striped table-bordered " id="data" style="width:100%;">
            <thead>
              <tr>
                <th>اسم المستند</th>
                <th width="60%">وصف المستند</th>
                <th>تحميل </th>
                <th>حذف </th>
              </tr>
            </thead>
            <tbody>
              @foreach($charts as $key=>$chart)
              <tr>
                <td>{{$charts_names[$key]}}</td>
                <td>{{$charts_description[$key]}}</td>
                <td> <a href="{{url('/')}}/uploads/products-charts/{{$chart}}" class="filechart{{$key}}" download><input
                      id="file{{$key}}" type="hidden" name="charts_edit[]" value="{{$chart}}"> {{$chart}}</a></td>
                <td><i id="btu-filechart{{$key}}" style="color:red" class="fa fa-times clickremchart"></i></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif

  </div>
</div>