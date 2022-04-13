<!--<footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  © 2017 <a href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank" class="text-bold-800 grey darken-2">PIXINVENT </a>, All rights reserved. </span><span class="float-md-right d-xs-block d-md-inline-block">Hand-crafted &amp; Made with <i class="icon-heart5 pink"></i></span></p>
    </footer>-->

<!-- BEGIN VENDOR JS-->
<script src="{{ $panel_assets }}js/core/libraries/jquery.min.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}vendors/js/ui/tether.min.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}vendors/js/ui/unison.min.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}vendors/js/extensions/pace.min.js" type="text/javascript"></script>
<!-- CK Editor -->
<script src="{{ $panel_assets }}js/ckeditor/ckeditor.js"></script>
<script src="{{ $panel_assets }}vendors/js/extensions/pace.min.js" type="text/javascript"></script>

<script src="{{ $panel_assets }}js/ace/ace.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>

<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{ $panel_assets }}vendors/js/charts/chart.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN ROBUST JS-->
<script src="{{ $panel_assets }}js/core/app-menu.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}js/core/app.js" type="text/javascript"></script>
<!-- END ROBUST JS-->
<!-- BEGIN PAGE LEVEL JS-->
<!--<script src="{{ $panel_assets }}js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>-->
<!-- Sweetalert -->
{!! Html::script('cus/alert/sweetalert.min.js') !!}

<!-- Checkbox -->
{!! Html::script('cus/checkbox/js/jquery.vswitch.min.js') !!}
<!-- END PAGE LEVEL JS-->

<!-- Datatable  -->
<script src="{{ $panel_assets }}datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

<script src="{{ $panel_assets }}datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}datatables/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->

<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ $panel_assets }}datatables/datatable-advanced.min.js" type="text/javascript"></script>


@if(isset($act))
@if($act == 'datatable')
<!-- Datatable  -->
<script src="{{ $panel_assets }}datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

<script src="{{ $panel_assets }}datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}datatables/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->

<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ $panel_assets }}datatables/datatable-advanced.min.js" type="text/javascript"></script>

@endif
@endif
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



    var copy   = "{{ trans('admin.copy') }}";
    var excel  = "{{ trans('admin.excel') }}";
    var pdf    = "{{ trans('admin.pdf') }}";
    var lang   = "{{ url($panel_assets . 'datatables/'. trans('admin.lang')) }}";
    var delMsg = "{{ trans('admin.delMsg') }}";
    var pickSome = "{{ trans('admin.pickSome') }}";
    var token  = "{{ csrf_token() }}";
    var load = "<i class='fa fa-spinner fa-spin' style='color:#FFF'>";
    var slugUrl = "";
    var messagePin = 'pin success';
    method = new Array();
    @foreach(linkRef() as $key => $value)
        method['{{ $key }}'] = '{{ $value }}';
    @endforeach

    links_array = new Array();
    links_array['get_module'] = "{{ route('admin.get.module') }}";
    links_array['get_menu_content'] = "{{ route('admin.menu.content.ajax') }}";
    links_array['pin_page'] = "{{ route('admin.page.pin') }}";
</script>
<script src="{{ $panel_assets }}js/script.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}js/inputs.js" type="text/javascript"></script>
<script src="{{ $panel_assets }}js/modules.js" type="text/javascript"></script>

@if(isset($act) && in_array($act, ['create', 'edit']))
<script type="text/javascript">
    $('.copyTarget').on('change', function(){
                $('.target-button-area').fadeIn();
                $(this).fadeIn();
            });


$("#addmedialink").click(function(){


$(".inmedia").append("<div class='col-md-12' style='margin:15px'><div class='form-group'><label for='title'>{{ trans('admin.mediatype')}}</label><select class='form-control' name='media_type[]'><option value=''>Choose Media Type</option><option value='youtube'>Youtube</option><option value='pdf'>PDF</option></select></div><div class='form-group'><label for='title'>{{ trans('admin.url') }}</label><input type='text' class='form-control' name='links[]'></div></div>");


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
@endif




<!-- End custom Script -->
@yield('script')
@include($pLayout.'alert')
</body>

</html>
