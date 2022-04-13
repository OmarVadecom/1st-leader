<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<a class="btn btn-warning" style="float: right; margin:5px;" href="<?php echo e(route('tmpclients.index')); ?>">رجوع</a>
<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <tr>
                    <th colspan="3">
                        <img src="<?php echo e(url('/')); ?>/uploads/brands_images/faseplogo_it.png" style="width: 260px;">
                    </th>
                </tr>
                <tr style="background: #C80500;">
                    <th colspan="3">
                        <p style="color: #fff;font-size: 26px;">Fasep Old Customer Update Forum</p>
                    </th>
                </tr>
                <tr style="background:#BBBFB3; color:#C80500;font-size: 20px;">
                    <th width="20%">S/N</th>
                    <th width="50%"><?php echo e($client->code); ?></th>
                    <th width="30%">photo</th>
                </tr>
                <tr>
                    <td class="tdtitle">Name</td>
                    <td><?php echo e($client->center_name); ?></td>
                    <td rowspan="13" style="vertical-align: middle;">
                        <div style="margin: 0 auto; width: 300px">
                            <img src="<?php echo e(url('/')); ?>/uploads/tmp_clients_images/<?php echo e($client->image); ?>"
                                style="width: 300px; float: right;">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="tdtitle">City</td>
                    <td><?php echo e($client->city); ?></td>
                </tr>
                <tr>
                    <td class="tdtitle">Region</td>
                    <td><?php echo e($client->region); ?></td>
                </tr>
                <tr>
                    <td class="tdtitle">Address</td>
                    <td><?php echo e($client->address); ?></td>
                </tr>
                <tr>
                    <td class="tdtitle">Email</td>
                    <td style="position: relative"><?php echo e($client->email); ?> <span class="created">Created</span>
                    </td>
                </tr>
                <tr>
                    <td class="tdtitle">Email Password</td>
                    <td><?php echo e($client->password); ?> </td>
                </tr>
                <tr>
                    <td class="tdtitle">Person in Charge</td>
                    <td><?php echo e($client->old_responsable); ?></td>
                </tr>
                <tr>
                    <td class="tdtitle">Mobile Number</td>
                    <td><?php echo e($client->mobile); ?></td>
                </tr>
                <tr>
                    <td class="tdtitle">Tele Number</td>
                    <td><?php echo e($client->phone); ?></td>
                </tr>
                <tr>
                    <td class="tdtitle">Fax Number</td>
                    <td><?php echo e($client->fax); ?></td>
                </tr>
                <tr>
                    <td class="tdtitle">Truecaller ID</td>
                    <td><?php echo e($client->truecaller_id); ?></td>
                </tr>
                <tr>
                    <td class="tdtitle">Truecaller Password</td>
                    <td><?php echo e($client->truecaller_pass); ?></td>
                </tr>
                <tr>
                    <td class="tdtitle">AnyDesk ID</td>
                    <td><?php echo e($client->anydesk_id); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<style>
    p,
    h4 {
        font-weight: bold;
        font-family: ui-sans-serif;
        font-size: 16px;
    }

    th {
        text-align: center;
    }

    th,
    td {
        border: 2px solid #000 !important;
        font-weight: bold;

    }

    .tdtitle {
        background: #C80500;
        color: #fff;
        font-weight: bold;
    }

    .created {
        color: #fff;
        font-weight: bold;
        float: right;
        position: absolute;
        right: 0px;
        height: 78px;
        top: 0px;
        background: green;
        margin: auto;
        display: block;
        text-align: center;
        padding: 26px 20px;
    }
</style>