@if(Session::has('flash_message'))
	<script type="text/javascript">
		swal({
		  title: "{{ Session::get('flash_message') }}",
		  text: "{{ trans('admin.autoC', ['num' => trans('admin.sec')]) }}",
		  imageUrl: "{{ Request::root().'/cus/alert/alert.png' }}",
		  timer: 1000,
		  showConfirmButton: false
		});
	</script>
@endif

@if(Session::has('cusMessage'))
	<script type="text/javascript">
		swal({
		  title: "{{ Session::get('cusMessage') }}",
		  text: "{{ trans('admin.autoC', ['num' => trans('admin.sec')]) }}",
		  imageUrl: "{{ Request::root().'/public/cus/alert/alert2.png' }}",
		  timer: 1000,
		  showConfirmButton: false
		});
	</script>
@endif

@if(isset($delMessage))
	<script type="text/javascript">
		swal({
		  title: "{{ $delMessage }}",
		  text: "{{ trans('admin.autoC', ['num' => trans('admin.sec')]) }}",
		  imageUrl: "{{ Request::root().'/public/cus/alert/alert2.png' }}",
		  timer: 1000,
		  showConfirmButton: true
		});
	</script>
@endif