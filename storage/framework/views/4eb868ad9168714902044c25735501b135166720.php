<!--<footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  © 2017 <a href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank" class="text-bold-800 grey darken-2">PIXINVENT </a>, All rights reserved. </span><span class="float-md-right d-xs-block d-md-inline-block">Hand-crafted &amp; Made with <i class="icon-heart5 pink"></i></span></p>
    </footer>-->

<!-- BEGIN VENDOR JS-->
<script src="<?php echo e($panel_assets); ?>js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>vendors/js/ui/tether.min.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>vendors/js/ui/unison.min.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>vendors/js/extensions/pace.min.js" type="text/javascript"></script>
<!-- CK Editor -->
<script src="<?php echo e($panel_assets); ?>js/ckeditor/ckeditor.js"></script>
<script src="<?php echo e($panel_assets); ?>vendors/js/extensions/pace.min.js" type="text/javascript"></script>

<script src="<?php echo e($panel_assets); ?>js/ace/ace.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>

<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="<?php echo e($panel_assets); ?>vendors/js/charts/chart.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN ROBUST JS-->
<script src="<?php echo e($panel_assets); ?>js/core/app-menu.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>js/core/app.js" type="text/javascript"></script>
<!-- END ROBUST JS-->
<!-- BEGIN PAGE LEVEL JS-->
<!--<script src="<?php echo e($panel_assets); ?>js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>-->
<!-- Sweetalert -->
<?php echo Html::script('cus/alert/sweetalert.min.js'); ?>


<!-- Checkbox -->
<?php echo Html::script('cus/checkbox/js/jquery.vswitch.min.js'); ?>

<!-- END PAGE LEVEL JS-->

<!-- Datatable  -->
<script src="<?php echo e($panel_assets); ?>datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

<script src="<?php echo e($panel_assets); ?>datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>datatables/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->

<!-- BEGIN PAGE LEVEL JS-->
<script src="<?php echo e($panel_assets); ?>datatables/datatable-advanced.min.js" type="text/javascript"></script>


<?php if(isset($act)): ?>
<?php if($act == 'datatable'): ?>
<!-- Datatable  -->
<script src="<?php echo e($panel_assets); ?>datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

<script src="<?php echo e($panel_assets); ?>datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>datatables/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->

<!-- BEGIN PAGE LEVEL JS-->
<script src="<?php echo e($panel_assets); ?>datatables/datatable-advanced.min.js" type="text/javascript"></script>

<?php endif; ?>
<?php endif; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<script>
    $("#print").click(function(){
        $('input:checkbox:not(:checked)').parent('td').parent('tr').toggleClass('no-print');
        if($('input:checked').parent('td').parent('tr').hasClass( "no-print" )) {
            $('input:checked').parent('td').parent('tr').removeClass( "no-print" );
        }
        window.print();
    });
</script>
<!-- Start custom Script -->
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function(){
    $("form").submit(function(){
    if ( confirm("هل انت متأكد؟") == false ) {
      return false ;
   } else {
      return true ;
   }
});
// $("select").select2();
})



    var copy   = "<?php echo e(trans('admin.copy')); ?>";
    var excel  = "<?php echo e(trans('admin.excel')); ?>";
    var pdf    = "<?php echo e(trans('admin.pdf')); ?>";
    var lang   = "<?php echo e(url($panel_assets . 'datatables/'. trans('admin.lang'))); ?>";
    var delMsg = "<?php echo e(trans('admin.delMsg')); ?>";
    var pickSome = "<?php echo e(trans('admin.pickSome')); ?>";
    var token  = "<?php echo e(csrf_token()); ?>";
    var load = "<i class='fa fa-spinner fa-spin' style='color:#FFF'>";
    var slugUrl = "";
    var messagePin = 'pin success';
    method = new Array();
    <?php $__currentLoopData = linkRef(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        method['<?php echo e($key); ?>'] = '<?php echo e($value); ?>';
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    links_array = new Array();
    links_array['get_module'] = "<?php echo e(route('admin.get.module')); ?>";
    links_array['get_menu_content'] = "<?php echo e(route('admin.menu.content.ajax')); ?>";
    links_array['pin_page'] = "<?php echo e(route('admin.page.pin')); ?>";
</script>
<script src="<?php echo e($panel_assets); ?>js/script.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>js/inputs.js" type="text/javascript"></script>
<script src="<?php echo e($panel_assets); ?>js/modules.js" type="text/javascript"></script>

<?php if(isset($act) && in_array($act, ['create', 'edit'])): ?>
<script type="text/javascript">
    $('.copyTarget').on('change', function(){
                $('.target-button-area').fadeIn();
                $(this).fadeIn();
            });


$("#addmedialink").click(function(){


$(".inmedia").append("<div class='col-md-12' style='margin:15px'><div class='form-group'><label for='title'><?php echo e(trans('admin.mediatype')); ?></label><select class='form-control' name='media_type[]'><option value=''>Choose Media Type</option><option value='youtube'>Youtube</option><option value='pdf'>PDF</option></select></div><div class='form-group'><label for='title'><?php echo e(trans('admin.url')); ?></label><input type='text' class='form-control' name='links[]'></div></div>");


})

$(document).on("click","#imagescroll",function() {

    $('html, body').animate({scrollTop:$('#lfm').position().top}, 'slow');


})

$(document).on("click",".disable-mod",function() {

    id=$(this).data('id');
    modname=$(this).data('namemod');
    $("#ar-"+id).append("<input type='hidden' value='disable' name='mod["+id+"]["+modname+"][modulestatus][ar][]'>");

    $("#en-"+id).append("<input type='hidden' value='disable' name='mod["+id+"]["+modname+"][modulestatus][en][]'>");

    $(this).addClass('active-mod').removeClass('disable-mod');

})




$(document).on("click",".active-mod",function() {

    id=$(this).data('id');
    modname=$(this).data('namemod');

    $( "input[name*='mod["+id+"]["+modname+"][modulestatus][ar][]']" ).remove();
    $( "input[name*='mod["+id+"]["+modname+"][modulestatus][en][]']" ).remove();


    $(this).addClass('disable-mod').removeClass('active-mod');

})













</script>
<?php endif; ?>




<!-- End custom Script -->
<?php echo $__env->yieldContent('script'); ?>
<?php echo $__env->make($pLayout.'alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>

</html>
