<?php $__env->startSection('content'); ?>

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <?php echo e(trans('admin.users')); ?>

                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            
                            <?php echo getCreateBtn(route('users.create'), 'users.create'); ?>


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
									<th><?php echo e(trans('admin.name', ['name' => trans('admin.user') ])); ?></th>
									<th><?php echo trans('admin.email'); ?></th>
									<th><?php echo trans('admin.role'); ?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><?php echo e($data->full_name); ?></td>
									<td><?php echo e($data->email); ?></td>
									<td><?php echo e($data->user_type); ?> <?php echo e($data->isAdmin ? '( ' .$data->role_name . ' )' : ''); ?></td>
								</tr>
							</tbody>
						</table>
						 <a href="<?php echo e(route('users.edit', $data->id)); ?>" class="btn btn-primary">
		                    <i class="fa fa-pencil"></i>
		                 </a>
		                 <a href="<?php echo e(route('users.index')); ?>" class="btn btn-danger">
		                    <!--<i class="fa fa-times"></i>--> <?php echo e(trans('admin.cancel')); ?>

		                 </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>



<?php $__env->stopSection(); ?>



<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>