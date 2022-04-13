@foreach($results as $data)
	
		<button type="button" class="btn btn-default menu-setter" data-url="/{{ $data->path }}" style="margin-bottom: 10px">
			{{ $data->name }}
		</button>
	
@endforeach
<script type="text/javascript">
	$('.menu-setter').on('click', function (e) {
  e.preventDefault();
  var urlL = $(this).attr('data-url');
  $('.link-input').val(urlL);
  $('#menu-modal').modal('hide');
});
</script>