<?php $__env->startSection('content'); ?>

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <?php if(request('main_type') === '2'): ?>
                            طلبات الصيانه الخارجيه
                            <button class="btn btn-danger no-print" id="print">طباعه</button>
                        <?php elseif(request('main_type') === '4'): ?>
                            طلبات الزيارة الميدانيه
                            <button class="btn btn-danger no-print" id="print">طباعه</button>
                        <?php elseif(request('main_type') === '5'): ?>
                            طلبات مركز الاتصالات
                            <button class="btn btn-danger no-print" id="print">طباعه</button>
                        <?php else: ?>
                            طلبات الورشه
                            <button class="btn btn-danger no-print" id="print">طباعه</button>

                        <?php endif; ?>
                    </h4>
                    <a class="heading-elements-toggle no-print"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements no-print">
                        <ul class="list-inline mb-0">
                            <li class="tag tag-info"><?php echo e(trans('admin.select')); ?> <input
                                    type="checkbox" class="checkedAll" name="dels"></li>
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>


                                <?php echo getCreateBtn(route('maintenance.create').'?main_type='.\Request::get('main_type'),
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
                                    <th>كود الطلب</th>
                                    <th>تاريخ</th>
                                    <th>المنتج</th>
                                    <th>سيريال نمبر</th>
                                    <th>القطع المستلمه</th>
                                    <th>العميل</th>
                                    <th width="20%">حاله الطلب</th>
                                    <th width="20%">حاله التقرير</th>
                                    <th width="20%">حاله الضمان</th>
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
                                    <th>المنتج</th>
                                    <th>سيريال نمبر</th>
                                    <th>القطع المستلمه</th>
                                    <th>العميل</th>
                                    <th width="20%">حاله الطلب</th>
                                    <th width="20%">حاله التقرير</th>
                                    <th width="20%">حاله الضمان</th>
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
            "ajax": "<?php echo e(route('admin.maintenance.ajax')); ?>?main_type=<?php echo e(\Request::get('main_type')); ?>",
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
                    data: 'product',
                    name: 'product'
                },
                {
                    data: 'serial_num',
                    name: 'serial_num'
                },
                {
                    data: 'quantity',
                    name: 'quantity'
                },
                {
                    data: 'client',
                    name: 'client'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'status_report',
                    name: 'status_report'
                },
                {
                    data: 'status_warranty',
                    name: 'status_warranty'
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