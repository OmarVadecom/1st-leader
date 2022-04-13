<?php $__env->startSection('content'); ?>

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <?php if( request('type') === '1' ): ?>
                            سندات قبض
                            <button class="btn btn-danger no-print" id="print">طباعه</button>
                        <?php else: ?>
                            سندات صرف
                            <button class="btn btn-danger no-print" id="print">طباعه</button>
                        <?php endif; ?>
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li class="tag tag-info"><?php echo e(trans('admin.select')); ?> <input type="checkbox"
                                    class="checkedAll" name="dels"></li>
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

                            <?php echo getCreateBtn(route('sanadat.create').'?type='.\Request::get('type'), 'product.create'); ?>

                            

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
                                    <th>النوع</th>
                                    <th><?php echo e(\Request::get('type') == 1 ? 'السند من' : 'نوع السند'); ?></th>
                                    <th>التكلفه</th>
                                    <th><?php echo e(trans('admin.action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot class="no-print">
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>النوع</th>
                                    <th><?php echo e(\Request::get('type') == 1 ? 'السند من' : 'نوع السند'); ?></th>
                                    <th>التكلفه</th>
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
    var t=$('#data').DataTable( {
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
        "ajax": "<?php echo e(route('admin.sanadat.ajax')); ?>?type=<?php echo e(\Request::get('type')); ?>",
        "columns": [
            {data: null, name: null, class: 'no-print'},
           {data: 'select', name: '', class: 'no-print'},
           {data: 'type', name: 'type'},
           {data: 'sanad', name: 'sanad'},
           {data: 'cost', name: 'cost'},
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