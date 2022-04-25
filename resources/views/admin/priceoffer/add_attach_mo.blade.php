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
        <div class="col-md-6 ">
            <form action="{{route('priceoffer.multiuploads',$offer->id)}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="showattach" id="showAttach">
                    <div class="d-flex">
                        <label for="">اضافة مرفقات :</label>
                    <br />
                    <button type="button" onclick="addAttachment()" class="btn btn-primary ">+</button>
                    <select name="type">
                        <option disabled selected>اختر نوع المرفق</option>
                        <option value="كفالة غرم">كفالة غرم</option>
                        <option value=" كمبياله"> كمبياله</option>
                        <option value=" بيع اجل"> بيع اجل</option>
                        <option value=" كروكى "> كروكى </option>
                    </select>
                    </div>
                    <br>
                    <br>
                    <input type="file" class="form-control" name="attach" multiple />
                    <br /><br />
                    <input type="submit" class="btn btn-primary" value="Upload" />
                </div>
            </form>
        </div>
    </div>
</div>



@endsection


<script>
function addAttachment()
{

    $("#showAttach").append(`
                    <div>
                    <div class="Attachment d-flex"  style="margin-top: 10px;">
                        <label >اضافة مرفقات :</label>
                    <br />
                    <button type="button" onclick="removeAttachment(this)" class="btn btn-primary ">-</button>
                    <button type="button" onclick="addAttachment()" class="btn btn-primary ">+</button>
                    <select name="type">
                        <option disabled selected>اختر نوع المرفق</option>
                        <option value="كفالة غرم">كفالة غرم</option>
                        <option value=" كمبياله"> كمبياله</option>
                        <option value=" بيع اجل"> بيع اجل</option>
                        <option value=" كروكى "> كروكى </option>
                    </select>
                    </div>
                    <br>
                    <br>
                    <input type="file" class="form-control" name="attach" multiple />
                    <br /><br />
                    <input type="submit" class="btn btn-primary my-4" value="Upload" />
                    </div>
                `);
}
function removeAttachment(data)
{
    $(data).parent().parent().remove();
}
</script>




{{-- @include('admin.layouts.script') --}}
