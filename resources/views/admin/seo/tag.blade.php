<table class="table table-striped table-bordered " id="data" dir="ltr">
	<tr>
		<th>Tag</th>
		<th>Value</th>
	</tr>
@foreach($data as $key => $val)
@if($key != 'metaTags')
<tr>
	<td>{{ $key }}</td>
	<td>{{ $val }}</td>
</tr>
@else
@if(!empty($val))
	@foreach($val as $k => $v)
	<tr>
		<td>{{ $k }}</td>
		<td>{{ html_entity_decode($v['html'], ENT_QUOTES) }}</td>
	</tr>
		
	@endforeach
	@endif
@endif
@endforeach
</table>

