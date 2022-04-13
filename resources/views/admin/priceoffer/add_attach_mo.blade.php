@extends($pLayout. 'master')

@section('content')
    <!doctype html>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-8"><h2>اضافة مرفقات لعروض الاسعار المعمدة على دفعات</h2>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="{{route('priceoffer.multiuploads',$offer->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="">اضافة مرفقات :</label>
                <br />
                <select name="type">
                    <option disabled selected>اختر نوع المرفق</option>
                    <option value="كروكي">كروكي</option>
                    <option value="كفيل">كفيل</option>
                </select>
                <br>
                <br>
                <input type="file" class="form-control" name="attach" multiple />
                <br /><br />
                <input type="submit" class="btn btn-primary" value="Upload" />
            </form>
        </div>
    </div>
</div>

@endsection
