<!-- navbar-fixed-top-->
<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header" style="background: #ffffff;">
            <ul class="nav navbar-nav">
                <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a style="z-index:55555555;"
                                                                               class="nav-link nav-menu-main menu-toggle hidden-xs"><i
                            class="icon-menu5 font-large-1" style="color: #000;"></i></a></li>
                <li style="width: 100%;" class="nav-item"><a style="width: 100%;margin-left: -7px;padding: 11px 0px;"
                                                             href="{{ route('admin.home') }}"
                                                             class="navbar-brand nav-link"><img
                            style="display: block; width: 145px; margin: auto;" alt="branding logo"
                            src="{{url('/')}}/uploads/logo/{{getSettings('site_logo')}}"
                            data-expand="{{url('/')}}/uploads/logo/{{getSettings('site_logo')}}"
                            data-collapse="{{url('/')}}/uploads/logo/{{getSettings('site_logo')}}"
                            class="brand-logo"></a></li>
                <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile"
                                                                    class="nav-link open-navbar-container"><i
                            class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content container-fluid">
            <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
                <ul class="nav navbar-nav float-xs-right">


                    <li class="nav-item">
                        <a href="https://1st-leader.com/" target="_blank" class="nav-link nav-menu-main">
                        {{ trans('admin.visit_web') }}
                        <!-- <i class="fa fa-eye"></i> -->
                        </a>
                    </li>

                    @if(Auth::user()->can('contacts.view'))
                        <li class="dropdown dropdown-notification nav-item message-content">
                            @include($pLayout.'boxs.message')
                        </li>
                    @endif



                    @if(Auth::user()->can('contacts.view'))
                        <li class="dropdown dropdown-notification nav-item message-content">
                            @include($pLayout.'boxs.notification')
                        </li>
                    @endif

                    @if(in_array(auth()->id(), [1, 9]))
                        <li class="dropdown dropdown-notification nav-item message-content">
                            @include($pLayout.'boxs.warranties_notifications')
                        </li>
                    @endif


                    <li class="dropdown dropdown-user nav-item">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span
                                class="avatar avatar-online">
                <!-- <img src="{{ $panel_assets }}images/portrait/small/userico.png" alt="avatar"> -->

                    <i></i></span><span class="user-name">{{ $userAuth->name }}</span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('users.update.info.show') }}" class="dropdown-item">
                                <!-- <i class="icon-head"></i> -->

                                {{ trans('admin.edit', ['name' => trans('admin.mydata')]) }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('admin.settings') }}" class="dropdown-item">
                                <!-- <i class="icon-head"></i> -->
                                اعدادات السيستم
                            </a>

                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                <!-- <i class="icon-power3"></i> -->

                                {{ trans('admin.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


<!-- ////////////////////////////////////////////////////////////////////////////-->
