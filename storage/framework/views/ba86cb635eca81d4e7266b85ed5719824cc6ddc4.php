<?php $__env->startSection('content'); ?>
    <section id="file-export">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            تقارير الضمان
                        </h4>
                        <a class="heading-elements-toggle no-print"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements no-print">
                            <ul class="list-inline mb-0">
                                <?php echo getCreateBtn(route('warranties.create'), 'product.create'); ?>

                            </ul>
                        </div>
                    </div>
                    <div class="card-body collapse in">
                        <div class="card-block card-dashboard">
                            <table class="table table-striped table-bordered " id="data">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>كود الطلب</th>
                                    <th>تاريخ</th>
                                    <th>النوع</th>
                                    <th>المنتج او الجزء</th>
                                    <th width="15%"><?php echo e(trans('admin.action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot class="no-print">
                                <tr>
                                    <th>#</th>
                                    <th>كود الطلب</th>
                                    <th>تاريخ</th>
                                    <th>النوع</th>
                                    <th>المنتج او الجزء</th>
                                    <th width="15%"><?php echo e(trans('admin.action')); ?></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <style>
        th,
        .table td {
            padding: 0.5rem 0.2rem;
        }

    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#data').DataTable({
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
                "ajax": "<?php echo e(route('warranties.ajax')); ?>",
                "columns": [{
                    data: 'select',
                    name: '',
                    class: 'no-print'
                },
                    {
                        data: 'code',
                        name: 'code',
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'product',
                        name: 'product'
                    },
                    {
                        data: 'action',
                        name: '',
                        class: 'no-print'
                    }
                ],

            });
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>