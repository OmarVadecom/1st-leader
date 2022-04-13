<div class="tab-pane  fade apply-form" id="menu2">
    <div class="col-md-4">
        <div class="form-group">
            <label>اسم المركز </label>
            {!! Form::text("old_center",null, [
            "class" => "form-control",
            "placeholder" => 'اسم المركز',
            'disabled'=>'disabled'
            ]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>المنطقه </label>
            {!! Form::text("old_region",null, [
            "class" => "form-control",
            "placeholder" => 'المنطقه',
            'disabled'=>'disabled'
            ]) !!}

        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label>العنوان </label>
            {!! Form::text("old_address",null, [
            "class" => "form-control",
            "placeholder" => 'العنوان',
            'disabled'=>'disabled'
            ]) !!}

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> السجل التجاري</label>
            {!! Form::text("old_segl_num",null, [
            "class" => "form-control",
            "placeholder" => 'رقم السجل',

            'disabled'=>'disabled'

            ]) !!}
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label>المدينه </label>
            {!! Form::text("old_city",null, [
            "class" => "form-control",
            "placeholder" => 'المدينه',
            'disabled'=>'disabled'
            ]) !!}

        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label> الهاتف الثابت </label>
            {!! Form::text("old_phone",null, [
            "class" => "form-control",
            "placeholder" => 'الموبايل',
            'disabled'=>'disabled'



            ]) !!}

        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label> اسم المسئول</label>
            {!! Form::text("old_responsable",null, [
            "class" => "form-control",
            "placeholder" => 'المسؤول',
            'disabled'=>'disabled'
            ]) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> اسم الفني</label>

            {!! Form::text("old_technical",null, [
            "class" => "form-control",
            "placeholder" => 'الفني',
            'disabled'=>'disabled'
            ]) !!}

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> الايميل </label>
            {!! Form::text("old_email",null, [
            "class" => "form-control",
            "placeholder" => 'الايميل',
            'disabled'=>'disabled'


            ]) !!}

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> رقم المسئول</label>
            {!! Form::text("old_mobile",null, [
            "class" => "form-control",
            "placeholder" => 'الموبايل',
            'disabled'=>'disabled'
            ]) !!}
        </div>
    </div>




    <div class="col-md-4">
        <div class="form-group">
            <label> رقم الفني</label>
            {!! Form::text("old_technical_num",null, [
            "class" => "form-control",
            "placeholder" => 'رقم الفني',
            'disabled'=>'disabled'


            ]) !!}

        </div>
    </div>





</div>