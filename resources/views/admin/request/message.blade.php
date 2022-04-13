@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ trans('admin.contacts') }}
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            {!! getDeleteBtn(route('admin.contact.deletes'), 'contacts.delete') !!}

                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <table class="table table-striped table-bordered">
                            @if($message->name != null)
                            <tr>
                                <th>{{ trans('admin.sender')  }}</th>
                                <td>{{ $message->name }}</td>
                            </tr>
                            @endif

                            @if($message->email != null)
                            <tr>
                                <th>{{ trans('admin.email')  }}</th>
                                <td>{{ $message->email }}</td>
                            </tr>
                            @endif

                            @if($message->phone != null)
                            <tr>
                                <th>{{ trans('admin.phone')  }}</th>
                                <td>{{ $message->phone }}</td>
                            </tr>
                            @endif

                            @if($message->title != null)
                            <tr>
                                <th>{!! trans('admin.subject') !!}</th>
                                <td>{{ $message->title  }}</td>
                            </tr>
                            @endif

                            @if($message->message != null)
                            <tr>
                                <th>{!! trans('admin.message') !!}</th>
                                <td>{{ $message->message }}</td>
                            </tr>
                            @endif

                            <tr>
                                <th>{!! trans('admin.status') !!}</th>
                                <td>{!! getMsgStatus($message->show, $message->id) !!}</td>
                            </tr>

                            <tr>
                                <th>{!! trans('admin.send_date') !!}</th>
                                <td>{{ $message->created_at }}</td>
                            </tr>

                        </table>
                        <a href="{{ route('contact.index') }}" class="btn btn-primary">{{ trans('admin.back') }}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection


@section('script')
@endsection

