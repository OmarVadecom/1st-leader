<a href="#" data-toggle="dropdown" class="nav-link nav-link-label">
                  <i class="ficon icon-mail6"></i>
                  @php $count = getCount('contacts', 'status', 0); @endphp
                  @if($count > 0)
                  <span class="tag tag-pill tag-default tag-info tag-default tag-up">{{ $count }}</span>
                  @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <li class="dropdown-menu-header">
                    <h6 class="dropdown-header m-0"><span class="grey darken-2">{{ trans('admin.messages') }}</span>
                      @if($count > 0)
                      <span class="notification-tag tag tag-default tag-info float-xs-right m-0">{{ $count }} {{ trans('admin.newMsg') }}</span>
                      @endif
                    </h6>
                  </li>
                  <li class="list-group scrollable-container">
                    @forelse(getUnreadContacts() as $contact)
                    <a href="{{ route('contact.show', $contact->id) }}" class="list-group-item">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="{{ $panel_assets }}images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading">{{ $contact->name }}</h6>
                          <p class="notification-text font-small-3 text-muted">{{ str_limit($contact->message, 140) }}</p><small>
                            <time  class="media-meta text-muted">{{ $contact->created_at->diffForHumans() }}</time></small>
                        </div>
                      </div>
                    </a>
                    @empty
                    <a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-body">
                            <h6 class="media-heading"></h6>
                            <p class="notification-text font-small-3 text-muted text-center">
                              {{ trans('admin.noMsg') }}
                            </p>        
                        </div>
                      </div>
                    </a>
                    @endforelse
                    </li>
                  <li class="dropdown-menu-footer"><a href="{{ route('contact.index') }}" class="dropdown-item text-muted text-xs-center">{{ trans('admin.allMsg') }}</a></li>
                </ul>