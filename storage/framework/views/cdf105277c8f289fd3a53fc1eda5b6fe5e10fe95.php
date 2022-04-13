<a href="#" data-toggle="dropdown" class="nav-link nav-link-label">
                  <i class="ficon icon-mail6"></i>
                  <?php $count = getCount('contacts', 'status', 0); ?>
                  <?php if($count > 0): ?>
                  <span class="tag tag-pill tag-default tag-info tag-default tag-up"><?php echo e($count); ?></span>
                  <?php endif; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <li class="dropdown-menu-header">
                    <h6 class="dropdown-header m-0"><span class="grey darken-2"><?php echo e(trans('admin.messages')); ?></span>
                      <?php if($count > 0): ?>
                      <span class="notification-tag tag tag-default tag-info float-xs-right m-0"><?php echo e($count); ?> <?php echo e(trans('admin.newMsg')); ?></span>
                      <?php endif; ?>
                    </h6>
                  </li>
                  <li class="list-group scrollable-container">
                    <?php $__empty_1 = true; $__currentLoopData = getUnreadContacts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(route('contact.show', $contact->id)); ?>" class="list-group-item">
                      <div class="media">
                        <div class="media-left"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="<?php echo e($panel_assets); ?>images/portrait/small/avatar-s-1.png" alt="avatar"><i></i></span></div>
                        <div class="media-body">
                          <h6 class="media-heading"><?php echo e($contact->name); ?></h6>
                          <p class="notification-text font-small-3 text-muted"><?php echo e(str_limit($contact->message, 140)); ?></p><small>
                            <time  class="media-meta text-muted"><?php echo e($contact->created_at->diffForHumans()); ?></time></small>
                        </div>
                      </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <a href="javascript:void(0)" class="list-group-item">
                      <div class="media">
                        <div class="media-body">
                            <h6 class="media-heading"></h6>
                            <p class="notification-text font-small-3 text-muted text-center">
                              <?php echo e(trans('admin.noMsg')); ?>

                            </p>        
                        </div>
                      </div>
                    </a>
                    <?php endif; ?>
                    </li>
                  <li class="dropdown-menu-footer"><a href="<?php echo e(route('contact.index')); ?>" class="dropdown-item text-muted text-xs-center"><?php echo e(trans('admin.allMsg')); ?></a></li>
                </ul>