<div class="tab-pane  fade apply-form" id="menu2">
    <div class="col-md-4">
        <div class="form-group">
            <label>اسم المركز </label>
            <?php echo Form::text("old_center",null, [
            "class" => "form-control",
            "placeholder" => 'اسم المركز',
            'disabled'=>'disabled'
            ]); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>المنطقه </label>
            <?php echo Form::text("old_region",null, [
            "class" => "form-control",
            "placeholder" => 'المنطقه',
            'disabled'=>'disabled'
            ]); ?>


        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label>العنوان </label>
            <?php echo Form::text("old_address",null, [
            "class" => "form-control",
            "placeholder" => 'العنوان',
            'disabled'=>'disabled'
            ]); ?>


        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> السجل التجاري</label>
            <?php echo Form::text("old_segl_num",null, [
            "class" => "form-control",
            "placeholder" => 'رقم السجل',

            'disabled'=>'disabled'

            ]); ?>

        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label>المدينه </label>
            <?php echo Form::text("old_city",null, [
            "class" => "form-control",
            "placeholder" => 'المدينه',
            'disabled'=>'disabled'
            ]); ?>


        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label> الهاتف الثابت </label>
            <?php echo Form::text("old_phone",null, [
            "class" => "form-control",
            "placeholder" => 'الموبايل',
            'disabled'=>'disabled'



            ]); ?>


        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label> اسم المسئول</label>
            <?php echo Form::text("old_responsable",null, [
            "class" => "form-control",
            "placeholder" => 'المسؤول',
            'disabled'=>'disabled'
            ]); ?>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> اسم الفني</label>

            <?php echo Form::text("old_technical",null, [
            "class" => "form-control",
            "placeholder" => 'الفني',
            'disabled'=>'disabled'
            ]); ?>


        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> الايميل </label>
            <?php echo Form::text("old_email",null, [
            "class" => "form-control",
            "placeholder" => 'الايميل',
            'disabled'=>'disabled'


            ]); ?>


        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label> رقم المسئول</label>
            <?php echo Form::text("old_mobile",null, [
            "class" => "form-control",
            "placeholder" => 'الموبايل',
            'disabled'=>'disabled'
            ]); ?>

        </div>
    </div>




    <div class="col-md-4">
        <div class="form-group">
            <label> رقم الفني</label>
            <?php echo Form::text("old_technical_num",null, [
            "class" => "form-control",
            "placeholder" => 'رقم الفني',
            'disabled'=>'disabled'


            ]); ?>


        </div>
    </div>





</div>