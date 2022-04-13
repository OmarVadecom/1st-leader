<div class="tab-pane  fade apply-form" id="menu4">

    <div class="col-md-4">
        <div class="form-group">
            <label> الهاتف الثابت </label>

            {!! Form::text("phone",(isset($client)) ? ($client->phone == "") ? $client->old_phone :
            $client->phone : '', [
            "class" => "form-control",
            "placeholder" => 'الموبايل',


            ]) !!}
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label> اسم المسئول</label>

            {!! Form::text("responsable",(isset($client)) ? ($client->responsable == "") ? $client->old_responsable :
            $client->responsable : '', [
            "class" => "form-control",
            "placeholder" => 'المسؤول',

            ]) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> اسم الفني</label>

            {!! Form::text("technical",(isset($client)) ? ($client->technical == "") ? $client->old_technical :
            $client->technical : '', [
            "class" => "form-control",
            "placeholder" => 'الفني',

            ]) !!}
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label> الايميل </label>

            {!! Form::text("email",(isset($client)) ? ($client->email == "") ? $client->old_email :
            $client->email : '', [
            "class" => "form-control",
            "placeholder" => 'الايميل',


            ]) !!}
        </div>
    </div>



    <div class="col-md-4">
        <div class="form-group">
            <label> رقم المسئول</label>

            {!! Form::text("mobile",(isset($client)) ? ($client->mobile == "") ? $client->old_mobile :
            $client->mobile : '', [
            "class" => "form-control",
            "placeholder" => 'الموبايل',

            ]) !!}
        </div>
    </div>




    <div class="col-md-4">
        <div class="form-group">
            <label> رقم الفني</label>

            {!! Form::text("technical_num",(isset($client)) ? ($client->technical_num == "") ?
            $client->old_technical_num
            :
            $client->technical_num : '', [
            "class" => "form-control",
            "placeholder" => 'رقم الفني',

            ]) !!}
        </div>
    </div>





    @if(\Request::get('status') == 1)

    <div class="col-md-4">
        <div class="form-group">
            <label> الباسوورد </label>

            {!! Form::text("password",null, [
            "class" => "form-control",
            "placeholder" => 'الباسوورد',


            ]) !!}
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label> رقم الفاكس </label>

            {!! Form::text("fax",null, [
            "class" => "form-control",
            "placeholder" => 'رقم الفاكس ',


            ]) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> المشرف </label>

            {!! Form::text("supervisor",null, [
            "class" => "form-control",
            "placeholder" => 'المشرف',


            ]) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> TeamViewer ID </label>

            {!! Form::text("truecaller_id",null, [
            "class" => "form-control",
            "placeholder" => 'Truecaller ID',


            ]) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> AnyDisk ID </label>

            {!! Form::text("anydesk_id",null, [
            "class" => "form-control",
            "placeholder" => 'AnyDisk ID',


            ]) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> الموقع الالكتروني </label>

            {!! Form::text("website",null, [
            "class" => "form-control",
            "placeholder" => 'الموقع الالكتروني',


            ]) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> TeamViewer Password </label>

            {!! Form::text("truecaller_pass",null, [
            "class" => "form-control",
            "placeholder" => 'Truecaller Password',


            ]) !!}
        </div>
    </div>




    <div class="col-md-4">
        <div class="form-group">
            <label> AnyDisk Password </label>

            {!! Form::text("anydesk_pass",null, [
            "class" => "form-control",
            "placeholder" => 'AnyDisk Pass',


            ]) !!}
        </div>
    </div>




    @endif
</div>