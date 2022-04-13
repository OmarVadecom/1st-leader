<?php $__env->startSection('content'); ?>

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <?php if(request('main_type') === '2'): ?>
                            فواتير بيع الصيانه الخارجيه
                            <button class="btn btn-danger no-print" id="print">طباعه</button>
                        <?php elseif(request('main_type') === '1'): ?>
                            فواتير بيع الورشه
                            <button class="btn btn-danger no-print" id="print">طباعه</button>
                        <?php elseif(request('main_type') === '4'): ?>
                             فواتير بيع الزيارات الميدانيه
                            <button class="btn btn-danger no-print" id="print">طباعه</button>
                            <a class="btn no-print" href="<?php echo e(route('maintenance.create')); ?>?main_type=4">استلام زيارة ميدانيه</a>
                            <a class="btn no-print" href="<?php echo e(route('maintenance.index')); ?>?main_type=4">طلبات الزيارة الميدانيه</a>
                        <?php else: ?>
                            فواتير بيع مركز الاتصالات
                            <button class="btn btn-danger no-print" id="print">طباعه</button>
                            <a class="btn no-print" href="<?php echo e(route('maintenance.create')); ?>?main_type=5">استلام مركز الاتصالات</a>
                            <a class="btn no-print" href="<?php echo e(route('maintenance.index')); ?>?main_type=5">طلبات مركز الاتصالات</a>
                        <?php endif; ?>
                    </h4>
                    <a class="heading-elements-toggle no-print"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements no-print">
                        <ul class="list-inline mb-0">
                            <li class="tag tag-info"><?php echo e(trans('admin.select')); ?> <input type="checkbox"
                                    class="checkedAll" name="dels"></li>
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

                            <?php echo getCreateBtn(route('sells.create').'?main_type=' . request('main_type'),
                            'product.create'); ?>

                            

                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <table class="table table-striped table-bordered " id="data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th width="25%">رقم الفاتوره</th>
                                    <th width="25%">التاريخ</th>
                                    <th width="20%">الزبون</th>
                                    <th>اجمالي الفاتوره</th>
                                    <th width="25%"><?php echo e(trans('admin.action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot class="no-print">
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>رقم الفاتوره</th>
                                    <th>تاريخ</th>
                                    <th>الزبون</th>
                                    <th>اجمالي الفاتوره</th>
                                    <th><?php echo e(trans('admin.action')); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $(document).ready(function() {
    var t =$('#data').DataTable( {
        "processing": true,
            "language": {
            "sUrl": lang
        },
        "ordering": true,
        "pagingType": "full_numbers",
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: 25,
        "fixedHeader": true,
        "responsive": true,
        "ajax": "<?php echo e(route('admin.sellsmnt.ajax')); ?>?main_type=<?php echo e(request('main_type')); ?>",
        "columns": [
           {data: null, name: null, class: 'no-print'},
           {data: 'select', name: '', class: 'no-print'},
           {data: 'code', name: 'code'},
           {data: 'date', name: 'date'},
           {data: 'client', name: 'client'},
           {data: 'total', name: 'total'},
           {data: 'action', name: '', class: 'no-print'}
        ],

       "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            "order": [[ 1, 'asc' ]]

    });
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>