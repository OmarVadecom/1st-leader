<a href="#" data-toggle="dropdown" class="nav-link nav-link-label">
    <i style="margin-left: 11px;font-weight: bold">W</i>
    <span class="tag tag-pill tag-default tag-info tag-default tag-up"> {{ count(getWarrantyNotifications()) }} </span>
</a>
<ul class="dropdown-menu dropdown-menu-media dropdown-menu-right" style="overflow-y: scroll;min-height: 10px;max-height: 300px;margin-top: 4px;padding: 5px 0 0">
    <li class="dropdown-menu-header">
        <h6 class="dropdown-header m-0">
            <span class="grey darken-2">
                تنبيهات الضمانات
            </span>
            <span class="notification-tag tag tag-default tag-info float-xs-right m-0">
                {{ count(getWarrantyNotifications()) }} تنبيه جديد
            </span>
        </h6>
    </li>
    @foreach(getAllWarrantyNotifications() as $warrantyNotification)
        <li class="list-group">
            @if($warrantyNotification->product_id !== null)
                <a href="{{ url('/') . '/warranties/create?notify=' . $warrantyNotification->id . '&product=' . $warrantyNotification->product_id }}" class="list-group-item"
                    @if($warrantyNotification->reading_status == 0)
                        style="background: #f3f3f3"
                    @endif
                >
            @else
                <a href="{{ url('/') . '/warranties/create?notify=' . $warrantyNotification->id . '&part=' . $warrantyNotification->part_id }}" class="list-group-item"
                    @if($warrantyNotification->reading_status == 0)
                        style="background: #f3f3f3"
                    @endif
                >
            @endif
                <div class="media">
                    <div class="media-left">
                        <span class="avatar avatar-online rounded-circle" style="width: 35px">
                            <img src="{{ $panel_assets . 'images/portrait/small/avatar-s-1.png' }}" alt="avatar" style="max-width: 95%" />
                            <i></i>
                        </span>
                    </div>
                    <div class="media-body">
                        @if($warrantyNotification->product_id !== null)
                            <h6 class="media-heading">منتج <strong>{{ $warrantyNotification->product->name }}</strong> في <strong>{{ $warrantyNotification->model_type }}</strong> داخل الضمان</h6>
                        @else
                            <h6 class="media-heading">جزء <strong>{{ $warrantyNotification->part->name }}</strong> في <strong>{{ $warrantyNotification->model_type }}</strong> داخل الضمان</h6>
                        @endif
                        <p class="notification-text font-small-3 text-muted" style="margin-top: 10px;margin-bottom: 5px"> برقم {{ $warrantyNotification->code }} </p>
                        <small>
                            <time class="media-meta text-muted">
                                {{ date('d-m-Y', strtotime( $warrantyNotification->created_at )) }}
                            </time>
                        </small>
                    </div>
                </div>
            </a>
        </li>
    @endforeach
{{--    <li class="dropdown-menu-footer">--}}
{{--        <a href="{{ route('warranties.index') }}" class="dropdown-item text-muted text-xs-center" style="padding: 10px 0;">--}}
{{--            كل الضمانات--}}
{{--        </a>--}}
{{--    </li>--}}
</ul>
