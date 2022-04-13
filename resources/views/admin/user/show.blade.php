@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ trans('admin.users') }}
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            
                            {!! getCreateBtn(route('users.create'), 'users.create') !!}

                            <!--<li><a data-action="reload" onclick="getContant()"><i class="icon-reload"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                            <li><a data-action="close"><i class="icon-cross2"></i></a></li>-->
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <table class="table">
							<thead>
								<tr>
									<th>{{ trans('admin.name', ['name' => trans('admin.user') ]) }}</th>
									<th>{!! trans('admin.email') !!}</th>
									<th>{!! trans('admin.role') !!}</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{{ $data->full_name }}</td>
									<td>{{ $data->email }}</td>
									<td>{{ $data->user_type }} {{ $data->isAdmin ? '( ' .$data->role_name . ' )' : '' }}</td>
								</tr>
							</tbody>
						</table>
						 <a href="{{ route('users.edit', $data->id) }}" class="btn btn-primary">
		                    <i class="fa fa-pencil"></i>
		                 </a>
		                 <a href="{{ route('users.index') }}" class="btn btn-danger">
		                    <!--<i class="fa fa-times"></i>--> {{ trans('admin.cancel') }}
		                 </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>



@endsection


