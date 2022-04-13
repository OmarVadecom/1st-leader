<a href="#" data-toggle="dropdown" class="nav-link nav-link-label">
    <i style="margin-left: 11px;font-weight: bold">W</i>
    <span class="tag tag-pill tag-default tag-info tag-default tag-up"> <?php echo e(count(getWarrantyNotifications())); ?> </span>
</a>
<ul class="dropdown-menu dropdown-menu-media dropdown-menu-right" style="overflow-y: scroll;min-height: 10px;max-height: 300px;margin-top: 4px;padding: 5px 0 0">
    <li class="dropdown-menu-header">
        <h6 class="dropdown-header m-0">
            <span class="grey darken-2">
                تنبيهات الضمانات
            </span>
            <span class="notification-tag tag tag-default tag-info float-xs-right m-0">
                <?php echo e(count(getWarrantyNotifications())); ?> تنبيه جديد
            </span>
        </h6>
    </li>
    <?php $__currentLoopData = getAllWarrantyNotifications(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warrantyNotification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="list-group">
            <?php if($warrantyNotification->product_id !== null): ?>
                <a href="<?php echo e(url('/') . '/warranties/create?notify=' . $warrantyNotification->id . '&product=' . $warrantyNotification->product_id); ?>" class="list-group-item"
                    <?php if($warrantyNotification->reading_status == 0): ?>
                        style="background: #f3f3f3"
                    <?php endif; ?>
                >
            <?php else: ?>
                <a href="<?php echo e(url('/') . '/warranties/create?notify=' . $warrantyNotification->id . '&part=' . $warrantyNotification->part_id); ?>" class="list-group-item"
                    <?php if($warrantyNotification->reading_status == 0): ?>
                        style="background: #f3f3f3"
                    <?php endif; ?>
                >
            <?php endif; ?>
                <div class="media">
                    <div class="media-left">
                        <span class="avatar avatar-online rounded-circle" style="width: 35px">
                            <img src="<?php echo e($panel_assets . 'images/portrait/small/avatar-s-1.png'); ?>" alt="avatar" style="max-width: 95%" />
                            <i></i>
                        </span>
                    </div>
                    <div class="media-body">
                        <?php if($warrantyNotification->product_id !== null): ?>
                            <h6 class="media-heading">منتج <strong><?php echo e($warrantyNotification->product->name); ?></strong> في <strong><?php echo e($warrantyNotification->model_type); ?></strong> داخل الضمان</h6>
                        <?php else: ?>
                            <h6 class="media-heading">جزء <strong><?php echo e($warrantyNotification->part->name); ?></strong> في <strong><?php echo e($warrantyNotification->model_type); ?></strong> داخل الضمان</h6>
                        <?php endif; ?>
                        <p class="notification-text font-small-3 text-muted" style="margin-top: 10px;margin-bottom: 5px"> برقم <?php echo e($warrantyNotification->code); ?> </p>
                        <small>
                            <time class="media-meta text-muted">
                                <?php echo e(date('d-m-Y', strtotime( $warrantyNotification->created_at ))); ?>

                            </time>
                        </small>
                    </div>
                </div>
            </a>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





</ul>
