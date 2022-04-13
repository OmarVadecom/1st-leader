<?php $__env->startSection('content'); ?>

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        عروض الاسعار المعمده
                        <button class="btn btn-danger no-print" id="print">طباعه</button>
                    </h4>
                    <a class="heading-elements-toggle no-print"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements no-print">
                        <ul class="list-inline mb-0">
                            <li class="tag tag-info"><?php echo e(trans('admin.select')); ?> <input type="checkbox"
                                                                                        class="checkedAll" name="dels"></li>
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>

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
                                    <th>رقم العرض</th>
                                    <th>التاريخ</th>
                                    <th>الزبون</th>
                                    <th>النوع</th>
                                    <th>اجمالي عرض السعر</th>
                                    <th> حاله الدفع</th>
                                    <th width="15%">التحكم</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot class="no-print">
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>رقم العرض</th>
                                    <th>التاريخ</th>
                                    <th>الزبون</th>
                                    <th>النوع</th>
                                    <th>اجمالي عرض السعر</th>
                                    <th> حاله الدفع</th>

                                    <th>التحكم</th>
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
    $(document).ready(function () {
        var t = $('#data').DataTable({
            "processing": true,
            "language": {
                "sUrl": lang
            },
            "ordering": 0,
            "pagingType": "full_numbers",
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"]
            ],
            iDisplayLength: 25,
            "fixedHeader": true,
            "responsive": true,
            "ajax": "<?php echo e(route('admin.verified_offers.ajax')); ?>",
            "columns": [{
                    data: null,
                    name: null,
                    class: 'no-print'
                },
                {
                    data: 'select',
                    name: '',
                    class: 'no-print'
                },
                {
                    data: 'number',
                    name: 'number'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'customer',
                    name: 'customer'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'total',
                    name: 'total'
                },
                {
                    data: 'offertype',
                    name: 'offertype'
                },
                {
                    data: 'action',
                    name: '',
                    class: 'no-print'
                }
            ],

            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [
                [1, 'asc']
            ]

        });
        t.on('order.dt search.dt', function () {
            t.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
    });

</script>
<style>
    .verified {
        color: green;
    }

</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($pLayout. 'master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>