<div class="tab-pane  fade apply-form" id="menu3">
    <div class="col-md-4">
        <div class="form-group">
            <label> التحيه</label>

            <?php echo Form::text("greeting",null, [
            "class" => "form-control",
            "placeholder" => 'التحيه',

            ]); ?>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>اللقب</label>

            <?php echo Form::text("title",null, [
            "class" => "form-control",
            "placeholder" => 'اللقب',
            ]); ?>

        </div>
    </div>
</div>