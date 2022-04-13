


@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export">
	<div class="row">
		<div class="col-xs-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">
						{{ trans('admin.pages') }}
					</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
							{!! getCreateBtn(route('page.create'), 'pages.create') !!}
							{!! getDeleteBtn(route('admin.page.deletes'), 'pages.delete') !!}

						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block card-dashboard">

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
										<th>{{ trans('admin.title', [], $lang->code)  }}</th>
										<td>{{ $page->langWith($lang->code)->title }}</td>
									</tr>
									<tr>
										<th>{!! trans('admin.slug', [], $lang->code) !!}</th>
										<td>{{ $page->slug }}</td>
									</tr>
									@if($page->modules_array != null)
									<tr>
										<th>{!! trans('modules.modules', [], $lang->code) !!}</th>
										<td>
											@foreach($page->modules_array as $k => $module)
											@if($module != null)
											@foreach($module as $km => $mod)
											{{ $k+1 }} - {{ modules($km) }}<br>
											@endforeach
											@endif
											@endforeach
										</td>
									</tr>
									@endif
									<tr>
										<th>{!! trans('admin.seo_keys', [], $lang->code) !!}</th>
										<td>{!! $page->keys !!}</td>
									</tr>
									<tr>
										<th>{!! trans('admin.seo_desc', [], $lang->code) !!}</th>
										<td>{!! $page->descrip !!}</td>
									</tr>
									<tr>
										<th>{!! trans('admin.created_at', [], $lang->code) !!}</th>
										<td>{!! $page->created_at !!}</td>
									</tr>
									<tr>
										<th>{!! trans('admin.updated_at', [], $lang->code) !!}</th>
										<td>{!! $page->updated_at !!}</td>
									</tr>
									<tr>
										<th>{!! trans('admin.status', [], $lang->code) !!}</th>
										<td>{!! getStatus($page->show, $lang->code) !!}</td>
									</tr>

								</table>
							</div>
							@endforeach
						</div>
						<a href="{{ route('page.index') }}" class="btn btn-danger">{{ trans('admin.back') }}</a>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

@endsection


@section('script')
@endsection

