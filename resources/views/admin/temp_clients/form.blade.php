<div class="row special-forms" style="background: #eaeaea; padding: 20px;">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>رقم الموديل</label>
        {!! Form::select('product_id', $products, null, ['class' => 'form-control select2']) !!}
      </div><!-- /.form-group -->

      <div class="form-group">
        <label>رقم القطعه</label>
        @if(isset($client) && $client->status == 1)
        {!! Form::text("code", null , [
        "class" => "form-control",
        "placeholder" => 'رقم القطعه',
        "disabled"
        ]) !!}
        @else
        {!! Form::text("code", null , [
        "class" => "form-control",
        "placeholder" => 'رقم القطعه',
        ]) !!}
        @endif

      </div><!-- /.form-group -->
      <div class="form-group">
        <label> النوع</label>
        {!! Form::text("type", null, [
        "class" => "form-control",
        "placeholder" => 'الاسم العربي',
        "required"
        ]) !!}
      </div><!-- /.form-group -->
      <div class="form-group">
        <label>السنه</label>
        <select name="year" class="form-control">
          <option value="">اختر السنه</option>
          <option value="2000" {{(isset($client) && $client->year==2000) ? 'selected' : ''}}>2000</option>
          <option value="2001" {{(isset($client) && $client->year==2001) ? 'selected' : ''}}>2001</option>
          <option value="2002" {{(isset($client) && $client->year==2002) ? 'selected' : ''}}>2002</option>
          <option value="2003" {{(isset($client) && $client->year==2003) ? 'selected' : ''}}>2003</option>
          <option value="2004" {{(isset($client) && $client->year==2004) ? 'selected' : ''}}>2004</option>
          <option value="2005" {{(isset($client) && $client->year==2005) ? 'selected' : ''}}>2005</option>
          <option value="2006" {{(isset($client) && $client->year==2006) ? 'selected' : ''}}>2006</option>
          <option value="2007" {{(isset($client) && $client->year==2007) ? 'selected' : ''}}>2007</option>
          <option value="2008" {{(isset($client) && $client->year==2008) ? 'selected' : ''}}>2008</option>
          <option value="2009" {{(isset($client) && $client->year==2009) ? 'selected' : ''}}>2009</option>
          <option value="2010" {{(isset($client) && $client->year==2010) ? 'selected' : ''}}>2010</option>
          <option value="2011" {{(isset($client) && $client->year==2011) ? 'selected' : ''}}>2011</option>
          <option value="2012" {{(isset($client) && $client->year==2012) ? 'selected' : ''}}>2012</option>
          <option value="2013" {{(isset($client) && $client->year==2013) ? 'selected' : ''}}>2013</option>
          <option value="2014" {{(isset($client) && $client->year==2014) ? 'selected' : ''}}>2014</option>
          <option value="2015" {{(isset($client) && $client->year==2015) ? 'selected' : ''}}>2015</option>
          <option value="2016" {{(isset($client) && $client->year==2016) ? 'selected' : ''}}>2016</option>
          <option value="2017" {{(isset($client) && $client->year==2017) ? 'selected' : ''}}>2017</option>
          <option value="2018" {{(isset($client) && $client->year==2018) ? 'selected' : ''}}>2018</option>
          <option value="2019" {{(isset($client) && $client->year==2019) ? 'selected' : ''}}>2019</option>
          <option value="2020" {{(isset($client) && $client->year==2020) ? 'selected' : ''}}>2020</option>
          <option value="2021" {{(isset($client) && $client->year==2021) ? 'selected' : ''}}>2021</option>
        </select>
      </div><!-- /.form-group -->
      {{-- <input type="hidden" name="status" value="{{Request::get('status')}}"> --}}

      @if(!isset($edit))
      <div class="form-group">
        <label for="title">رفع اكسل</label>
        <input class="form-control" type="file" name="excel">
      </div>
      <div class="col-md-12">
        @if($errors->has('excel'))
        <span class="help-block" style="color: red">
          <strong>{{ $errors->first('excel') }}</strong>
        </span>
        @endif
      </div>
      @endif


    </div>

    <div class="col-md-6">
      <div class="form-group modal-body" style="margin: 0px 0px 5px 0px; padding: 0px;">
        <div id="googleMap" style="width:100%; height:300px;"></div>
      </div>
      <input type="hidden" name="lat" value="{{(isset($client) && $client->lat != '') ? $client->lat : '23.8859'}}"
        id="lat">
      <input type="hidden" name="lng" value="{{(isset($client) && $client->lat != '') ? $client->lng : '45.0792'}}"
        id="lng">



    </div>
  </div>
</div>
<br>
<style>
  .imgdiv {
    width: 100%;
    height: 310px;
    border: 1px solid #ccc;
    position: relative;
  }

  .nav-tabs {
    margin-bottom: 25px;
    background: #e4e4e4;
  }

  .nav-tabs .navvlink {
    color: #000 !important;
  }

  .nav-link.active {
    color: black !important;
  }

  .nav-tabs .nav-link:hover {
    /* border: none; */
  }

  .select2 {
    width: 100% !important;
  }
</style>
<ul class=" nav nav-tabs">
  <li class="nav-item navbitem">
    <a class="nav-link navvlink active" data-toggle="tab" href="#menu1">بيانات العميل</a>
  </li>

  @if(\Request::get('status') == 1)
  <li class="nav-item navbitem">
    <a class="nav-link navvlink" data-toggle="tab" href="#menu4">بيانات التواصل</a>
  </li>
  <li class="nav-item navbitem">
    <a class="nav-link navvlink" data-toggle="tab" href="#menu2">بيانات العميل القديم</a>
  </li>
  <li class="nav-item navbitem">
    <a class="nav-link navvlink" data-toggle="tab" href="#menu3">ترويسات التخاطب</a>
  </li>
  @endif
</ul>

<!-- Tab panes -->
<div class="tab-content">
  @include('admin.temp_clients.tabs.client')
  @if(\Request::get('status') == 1)
  @include('admin.temp_clients.tabs.converse')
  @include('admin.temp_clients.tabs.old_client')
  @include('admin.temp_clients.tabs.contact')

  <input type="hidden" name="status" value="1">
  @endif
</div>
<div class="col-md-12">
  <hr>
  <div class="clear">
    <button type="submit" class="btn btn-success">
      <i class="icon-check2"></i> {{ trans('admin.save') }}
    </button>
    <a href="{{ route('tmpclients.index') }}?status={{Request::get('status')}}" class="btn btn-danger">
      <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
    </a>
  </div>
</div>