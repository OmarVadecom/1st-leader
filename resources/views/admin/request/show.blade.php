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
                            @if($message->client_name != null)
                            <tr>
                                <th>{{ trans('admin.sender')  }}</th>
                                <td>{{ $message->client_name }}</td>
                            </tr>
                            @endif

                            @if($message->client_email_address != null)
                            <tr>
                                <th>{{ trans('admin.email')  }}</th>
                                <td>{{ $message->client_email_address }}</td>
                            </tr>
                            @endif

                            @if($message->client_phone_number != null)
                            <tr>
                                <th>{{ trans('admin.phone')  }}</th>
                                <td>{{ $message->client_phone_number }}</td>
                            </tr>
                            @endif

                            @if($message->category != null)
                            <tr>
                                <th>{!! trans('admin.category') !!}</th>
                                <td>{{ $message->category  }}</td>
                            </tr>
                            @endif


                            @if($message->package != null)
                            <tr>
                                <th>{!! trans('admin.package') !!}</th>
                                <td>{{ $message->package  }}</td>
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
                        <a href="{{ route('requests.index') }}" class="btn btn-danger">{{ trans('admin.back') }}</a>
                        @if($next != '')
                        <a href="/vc-admin/requests/{{$next}}"  class="pull-right btn btn-success">Next</a> 
                        @endif
                        @if($prev != '')
                        <a href="/vc-admin/requests/{{$prev}}" style="margin-right:5px" class="pull-right btn btn-success">Prev</a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection


@section('script')
@endsection

