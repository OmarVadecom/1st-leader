
@extends($pLayout. 'master')
@section('content')
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title">{{ trans('admin.edit', ['name' => trans('admin.role')]) }}</h4>
  					   <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

                            {!! getCreateBtn(route('role.create'), 'roles.create') !!}

                            @if($data->id != 1)
                            {!! getDeleteOneBtn(route('role.destroy', $data->id), 'roles.delete') !!}
                            @endif

                            <!--<li><a data-action="reload" onclick="getContant()"><i class="icon-reload"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            <li><a data-action="close"><i class="icon-cross2"></i></a></li>-->
                        </ul>
                    </div>
  				</div>

  				<ul class="nav nav-tabs nav-justified">
	@foreach ($dbLangs as $key => $lang)
	<li class="nav-item">
		<a class="nav-link {{ $key == 0 ? 'active' : '' }}" id="{{ $lang->code }}-tab" data-toggle="tab" href="#{{ $lang->code }}" aria-controls="{{ $lang->code }}" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}">{{ $lang->name }}</a>
	</li>
	@endforeach
</ul>

<div class="tab-content px-1 pt-1">
	@foreach ($dbLangs as $key => $lang)
	<div role="tabpanel" class="tab-pane fade {{ $key == 0 ? 'active in' : '' }}" id="{{ $lang->code  }}" aria-labelledby="{{ $lang->code }}-tab" aria-expanded="{{ $key == 0 ? 'true' : 'false' }}">

		<table class="table table-striped table-bordered">
		
				<tr>
					<th>{{ trans('admin.name', ['name' => trans('admin.role', [], $lang->code)], $lang->code)  }}</th>
					<td>{{ $data->langWith($lang->code)->name }}</td>
				</tr>
				<tr>
					<th>{!! trans('admin.comment', [], $lang->code) !!}</th>
					<td>{{ $data->langWith($lang->code)->comment }}</td>
				</tr>
				<tr>
					<th>{!! trans('admin.status', [], $lang->code) !!}</th>
					<td>{!! getStatus($data->show, $lang->code) !!}</td>
				</tr>
			
		</table>
	</div>
	@endforeach
						 <a href="{{ route('role.edit', $data->id) }}" class="btn btn-primary">
		                    <i class="fa fa-pencil"></i>
		                 </a>
		                 <a href="{{ route('role.index') }}" class="btn btn-danger">
		                    <i class="fa fa-times"></i> {{ trans('admin.cancel') }}
		                 </a>
		                 <br><br>
</div>
              
  			</div>
  		</div>
  	</div>
  </section>
@endsection
