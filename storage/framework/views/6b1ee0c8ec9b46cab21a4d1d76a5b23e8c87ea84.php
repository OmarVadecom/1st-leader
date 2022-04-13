<?php $__env->startSection('content'); ?>

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        الزيارات
                        <a class="btn" href="<?php echo e(url('/')); ?>/mapvisits?type=all">خريطه الزيارات</a>
                        <a class="btn" href="<?php echo e(url('/')); ?>/mapvisits?type=target">خريطه الزيارات
                            المستهدفه</a>
                        <a class="btn" href="<?php echo e(url('/')); ?>/mapvisits?type=done">خريطه الزيارات المنفذه</a>

                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li class="tag tag-info"><?php echo e(trans('admin.select')); ?> <input type="checkbox"
                                    class="checkedAll" name="dels"></li>
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            <?php echo getCreateBtn(route('visits.create'), 'products.create'); ?>

                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <table class="table table-hover table-bordered" bordered='2' id="data">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"></th>
                                    <th scope="col">رقم الزياره</th>
                                    <th scope="col">اسم المندوب</th>
                                    <th scope="col">اسم العميل</th>
                                    <th scope="col">عرض السعر</th>
                                    <th scope="col">الحاله</th>
                                    <th scope="col"><?php echo e(trans('admin.action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>رقم الزياره</th>
                                    <th>اسم المندوب</th>
                                    <th>اسم العميل</th>
                                    <th>عرض السعر</th>
                                    <th>الحاله</th>
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
        "ajax": "<?php echo e(route('admin.visits.ajax')); ?>",
        "columns": [
           {data: null, name: null},
           {data: 'select', name: ''},
           {data: 'id', name: 'id'},
           {data: 'user', name: 'user'},
           {data: 'customer', name: 'customer'},
           {data: 'priceoffer', name: 'priceoffer'},
           {data: 'status', name: 'status'},
           {data: 'action', name: ''}
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