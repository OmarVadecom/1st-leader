<div class="tab-pane " id="menu3">
    <div class="row">
        <div class="row bordered aligned-row">

            <div class="col-md-1" style="background: orange">
                <div class="center">المندوب</div>
            </div>

            <div class="col-md-11">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title"> تقييم المندوب للزياره: </label><br>
                            <i data-id="1"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->delegatestars >= 1) ? 'fa-star' : 'fa-star-o'); ?> delegate1 stardel"></i>
                            <i data-id="2"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->delegatestars >= 2) ? 'fa-star' : 'fa-star-o'); ?> delegate2 stardel"></i>
                            <i data-id="3"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->delegatestars >= 3) ? 'fa-star' : 'fa-star-o'); ?> delegate3 stardel"></i>
                            <i data-id="4"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->delegatestars >= 4) ? 'fa-star' : 'fa-star-o'); ?> delegate4 stardel"></i>
                            <i data-id="5"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->delegatestars >= 5) ? 'fa-star' : 'fa-star-o'); ?> delegate5 stardel"></i>
                            <input type="hidden" name="delegatestars" value="5" class="delegate">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title"> تقييم المندوب للعميل: </label><br>
                            <i data-id="1"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->delegateclient >= 1) ? 'fa-star' : 'fa-star-o'); ?> delegatecl1 stardelcl"></i>
                            <i data-id="2"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->delegateclient >= 2) ? 'fa-star' : 'fa-star-o'); ?> delegatecl2 stardelcl"></i>
                            <i data-id="3"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->delegateclient >= 3) ? 'fa-star' : 'fa-star-o'); ?> delegatecl3 stardelcl"></i>
                            <i data-id="4"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->delegateclient >= 4) ? 'fa-star' : 'fa-star-o'); ?> delegatecl4 stardelcl"></i>
                            <i data-id="5"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->delegateclient >= 5) ? 'fa-star' : 'fa-star-o'); ?> delegatecl5 stardelcl"></i>
                            <input type="hidden" name="delegateclient" value="5" class="delegatecl">
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title"> طريقه التواصل: </label>
                            <select name="con_way" id="" class="form-control">
                                <option value="">اختر طريقه التواصل</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title">ملاحظات</label>
                            <textarea name="del_notes" id=""
                                class="form-control"><?php echo e((isset($visit)) ? $visit->notes : ''); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title"> الزياره: </label>
                            <input type="text" name="del_visit" class="form-control" placeholder="الزياره" id="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">السبب</label>
                            <textarea name="del_visit_reason" id=""
                                class="form-control"><?php echo e((isset($visit)) ? $visit->notes : ''); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <br>



        <div class="row bordered aligned-row">

            <div class="col-md-1" style="background: #b4ff00">
                <div class="center">اداره المبيعات</div>
            </div>

            <div class="col-md-11">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="title"> تقييم الاداره للزياره: </label><br>
                            <i data-id="1"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->managervisit >= 1) ? 'fa-star' : 'fa-star-o'); ?> managevi1 starmanvi"></i>
                            <i data-id="2"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->managervisit >= 2) ? 'fa-star' : 'fa-star-o'); ?> managevi2 starmanvi"></i>
                            <i data-id="3"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->managervisit >= 3) ? 'fa-star' : 'fa-star-o'); ?> managevi3 starmanvi"></i>
                            <i data-id="4"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->managervisit >= 4) ? 'fa-star' : 'fa-star-o'); ?> managevi4 starmanvi"></i>
                            <i data-id="5"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->managervisit >= 5) ? 'fa-star' : 'fa-star-o'); ?> managevi5 starmanvi"></i>
                            <input type="hidden" name="managervisit" value="5" class="managervis">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="title"> تقييم الاداره للمندوب: </label><br>
                            <i data-id="1"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->managerdelegate >= 1) ? 'fa-star' : 'fa-star-o'); ?> managede1 starmande"></i>
                            <i data-id="2"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->managerdelegate >= 2) ? 'fa-star' : 'fa-star-o'); ?> managede2 starmande"></i>
                            <i data-id="3"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->managerdelegate >= 3) ? 'fa-star' : 'fa-star-o'); ?> managede3 starmande"></i>
                            <i data-id="4"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->managerdelegate >= 4) ? 'fa-star' : 'fa-star-o'); ?> managede4 starmande"></i>
                            <i data-id="5"
                                class="fa <?php echo e((isset($visit) && $visit->delegaterate->managerdelegate >= 5) ? 'fa-star' : 'fa-star-o'); ?> managede5 starmande"></i>
                            <input type="hidden" name="managerdelegate" value="5" class="managerdele">
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title">ملاحظات</label>
                            <textarea name="sales_notes" id=""
                                class="form-control"><?php echo e((isset($visit)) ? $visit->delegaterate->sales_notes : ''); ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title">توصيه</label>
                            <textarea name="sales_recommend" id=""
                                class="form-control"><?php echo e((isset($visit)) ? $visit->delegaterate->sales_recommend : ''); ?></textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>






    </div>
</div>
<style>
    .aligned-row {
        display: flex;
        flex-flow: row wrap;

        &::before {
            display: block;
        }
    }

    .center {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%);
        font-size: 16px;
        font-weight: 600;
    }
</style>