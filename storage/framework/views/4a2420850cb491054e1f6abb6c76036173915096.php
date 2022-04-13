<a href="#" data-toggle="dropdown" class="nav-link nav-link-label">
    <i class="fa fa-bell"></i>
    <span class="tag tag-pill tag-default tag-info tag-default tag-up"> <?php echo e(count(getfunds())); ?> </span>
</a>
<ul class="dropdown-menu dropdown-menu-media dropdown-menu-right" style="overflow-y: scroll;height: 300px;margin-top: 4px;">
    <li class="dropdown-menu-header">
        <h6 class="dropdown-header m-0">
            <span class="grey darken-2">
                التنبيهات
            </span>
            <span class="notification-tag tag tag-default tag-info float-xs-right m-0">
                <?php echo e(count(getfunds())); ?> تنبيه جديد
            </span>
        </h6>
    </li>
    <?php $__currentLoopData = getAllFunds(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <li class="list-group">
            <a href="<?php echo e(url('/') . '/funds/' . $fund->id . '/edit?notify=' . $fund->id); ?>" class="list-group-item"
                <?php if($fund->reading_status == 0): ?>
                    style="background: #f3f3f3"
               <?php endif; ?>
            >
                <div class="media">
                    <div class="media-left">
                        <span class="avatar avatar-online rounded-circle" style="width: 35px">
                            <img src="<?php echo e($panel_assets . 'images/portrait/small/avatar-s-1.png'); ?>" alt="avatar" style="max-width: 95%" />
                            <i></i>
                        </span>
                    </div>
                    <div class="media-body">
                        <h6 class="media-heading">توجد دفعه مستحقه من العميل <?php echo e($fund->customer->name); ?> </h6>
                        <p class="notification-text font-small-3 text-muted"> برقم <?php echo e($fund->code); ?> </p>
                        <small>
                            <time class="media-meta text-muted">
                                <?php echo e(date('d-m-Y', strtotime($fund->created_at))); ?>

                            </time>
                        </small>
                    </div>
                </div>
            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <li class="dropdown-menu-footer">
        <a href="<?php echo e(route('funds.index')); ?>" class="dropdown-item text-muted text-xs-center">
            كل المستحقات
        </a>
    </li>
</ul>
