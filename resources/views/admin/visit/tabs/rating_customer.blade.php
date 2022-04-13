<div class="tab-pane " id="menu2">
    <div class="row">
        <div class="row bordered aligned-row">

            <div class="col-md-1" style="background: orange">
                <div class="center">الرئيسيه</div>
            </div>

            <div class="col-md-11">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> التقييم: </label><br>
                            <i data-id="1"
                                class="fa {{(isset($visit) && $visit->clientrate->mainrate >= 1) ? 'fa-star' : 'fa-star-o' }} mainrate1 starmainrate"></i>
                            <i data-id="2"
                                class="fa {{(isset($visit) && $visit->clientrate->mainrate >= 2) ? 'fa-star' : 'fa-star-o' }} mainrate2 starmainrate"></i>
                            <i data-id="3"
                                class="fa {{(isset($visit) && $visit->clientrate->mainrate >= 3) ? 'fa-star' : 'fa-star-o' }} mainrate3 starmainrate"></i>
                            <i data-id="4"
                                class="fa {{(isset($visit) && $visit->clientrate->mainrate >= 4) ? 'fa-star' : 'fa-star-o' }} mainrate4 starmainrate"></i>
                            <i data-id="5"
                                class="fa {{(isset($visit) && $visit->clientrate->mainrate >= 5) ? 'fa-star' : 'fa-star-o' }} mainrate5 starmainrate"></i>
                            <input type="hidden" name="mainrate" value="5" class="mainrate">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> نوع السجل: </label>
                            <select name="segl_type" id="" class="form-control">
                                <option value="">اختر نوع السجل</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> فئه العميل: </label>
                            <select name="client_type" id="" class="form-control">
                                <option value="">اختر فئه العميل</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> اسم المسؤول: </label>
                            <input type="text" name="resp_name"
                                value="{{(isset($visit) ? $visit->clientrate->resp_name : '')}}" class="form-control"
                                placeholder="اسم المسؤول" id="">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> رقم التليفون: </label>
                            <input type="number" name="client_phone"
                                value="{{(isset($visit) ? $visit->clientrate->client_phone : '')}}" class="form-control"
                                placeholder="رقم التليفون" id="">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> هل الشخص صاحب القرار: </label>
                            <select name="client_decision" id="" class="form-control">
                                <option value="">اختر حاله الشخص</option>
                                <option {{(isset($visit) && $visit->clientrate->client_decision == "لا") ? 'selected' :
                                    ''}} value="لا">لا</option>
                                <option {{(isset($visit) && $visit->clientrate->client_decision == "مؤثر") ? 'selected'
                                    : ''}} value="مؤثر">مؤثر</option>
                                <option {{(isset($visit) && $visit->clientrate->client_decision == "صاحب قرار") ?
                                    'selected' : ''}} value="صاحب قرار">صاحب قرار</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> الجديه: </label>
                            <select name="client_serious" id="" class="form-control">
                                <option value="">اختر حاله الجديه</option>
                                <option {{(isset($visit) && $visit->clientrate->client_serious == "لا يوجد") ?
                                    'selected' : ''}} value="لا يوجد">لا يوجد</option>
                                <option {{(isset($visit) && $visit->clientrate->client_serious == "وسط") ? 'selected' :
                                    ''}} value="وسط">وسط</option>
                                <option {{(isset($visit) && $visit->clientrate->client_serious == "عاليه") ? 'selected'
                                    : ''}} value="عاليه">عاليه</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> الجاهزيه: </label>
                            <select name="client_ready" id="" class="form-control">
                                <option value="">اختر حاله الجاهزيه</option>
                                <option {{(isset($visit) && $visit->clientrate->client_ready == "لا يوجد") ? 'selected'
                                    : ''}} value="لا يوجد">لا يوجد</option>
                                <option {{(isset($visit) && $visit->clientrate->client_ready == "مبتديء") ? 'selected' :
                                    ''}} value="مبتديء">مبتديء</option>
                                <option {{(isset($visit) && $visit->clientrate->client_ready == "جاهز") ? 'selected' :
                                    ''}} value="جاهز">جاهز</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> مرتبط بحساب لدينا: </label>
                            <select name="client_con" id="" class="form-control">
                                <option {{(isset($visit) && $visit->clientrate->client_con == "نعم") ? 'selected' : ''}}
                                    value="نعم">نعم</option>
                                <option {{(isset($visit) && $visit->clientrate->client_con == "لا") ? 'selected' : ''}}
                                    value="لا">لا</option>
                            </select>
                            <a href="#">ربط</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> عملاؤه المعروفين: </label>
                            <input type="text" name="client_clients[]"
                                value="{{(isset($visit)) ? $client_clients[0] : ''}}" class="form-control" id="">
                            <input type="text" name="client_clients[]"
                                value="{{(isset($visit)) ? $client_clients[1] : ''}}" class="form-control" id="">
                            <input type="text" name="client_clients[]"
                                value="{{(isset($visit)) ? $client_clients[2] : ''}}" class="form-control" id="">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> مزكي وضامن: </label>
                            <select name="client_ins" id="" class="form-control">
                                <option {{(isset($visit) && $visit->clientrate->client_ins == "نعم") ? 'selected' : ''}}
                                    value="نعم">نعم</option>
                                <option {{(isset($visit) && $visit->clientrate->client_ins == "لا") ? 'selected' : ''}}
                                    value="لا">لا</option>
                            </select>
                        </div>
                    </div>


                </div>

            </div>
        </div>



        <br>



        <div class="row bordered aligned-row">

            <div class="col-md-1" style="background: #b4ff00">
                <div class="center">المقر</div>
            </div>

            <div class="col-md-11">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> التقييم: </label><br>
                            <i data-id="1"
                                class="fa {{(isset($visit) && $visit->clientrate->locationrate >= 1) ? 'fa-star' : 'fa-star-o' }} locationrate1 starlocationrate"></i>
                            <i data-id="2"
                                class="fa {{(isset($visit) && $visit->clientrate->locationrate >= 2) ? 'fa-star' : 'fa-star-o' }} locationrate2 starlocationrate"></i>
                            <i data-id="3"
                                class="fa {{(isset($visit) && $visit->clientrate->locationrate >= 3) ? 'fa-star' : 'fa-star-o' }} locationrate3 starlocationrate"></i>
                            <i data-id="4"
                                class="fa {{(isset($visit) && $visit->clientrate->locationrate >= 4) ? 'fa-star' : 'fa-star-o' }} locationrate4 starlocationrate"></i>
                            <i data-id="5"
                                class="fa {{(isset($visit) && $visit->clientrate->locationrate >= 5) ? 'fa-star' : 'fa-star-o' }} locationrate5 starlocationrate"></i>
                            <input type="hidden" name="locationrate" value="5" class="locationrate">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> نوع المقر: </label>
                            <select name="location_type" id="" class="form-control">
                                <option value="">اختر نوع المقر</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> الخدمات المقدمه: </label>
                            <select name="services" id="" class="form-control">
                                <option value="">اختر الخدمات المقدمه</option>
                            </select>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> حالة المقر </label>
                            <select name="location_status" id="" class="form-control">
                                <option value="">اختر حاله المقر</option>.
                                <option {{(isset($visit) && $visit->clientrate->location_status == "لا يوجد") ?
                                    'selected' : ''}} value="لا يوجد">لا يوجد</option>
                                <option {{(isset($visit) && $visit->clientrate->location_status == "وسط") ? 'selected' :
                                    ''}} value="وسط">وسط</option>
                                <option {{(isset($visit) && $visit->clientrate->location_status == "ممتازه") ?
                                    'selected' : ''}} value="ممتازه">ممتازه</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> موقع العميل </label>
                            <select name="client_location_status" id="" class="form-control">
                                <option value="">اختر حاله موقع العميل</option>
                                <option {{(isset($visit) && $visit->clientrate->client_location_status == "غير مناسب") ?
                                    'selected' : ''}} value="غير مناسب">غير مناسب </option>
                                <option {{(isset($visit) && $visit->clientrate->client_location_status == "مناسب") ?
                                    'selected' : ''}} value="مناسب">مناسب</option>
                                <option {{(isset($visit) && $visit->clientrate->client_location_status == "ممتاز") ?
                                    'selected' : ''}} value="ممتاز">ممتاز</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title">توفير البضائع</label>
                            <select name="goods_available" id="" class="form-control">
                                <option value="">اختر حاله توفير البضائع</option>
                                <option {{(isset($visit) && $visit->clientrate->goods_available == "قليل") ? 'selected'
                                    : ''}} value="قليل">قليل </option>
                                <option {{(isset($visit) && $visit->clientrate->goods_available == "عادي") ? 'selected'
                                    : ''}} value="عادي">عادي</option>
                                <option {{(isset($visit) && $visit->clientrate->goods_available == "قوي") ? 'selected' :
                                    ''}} value="قوي">قوي</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title">مستوي النظافه و الترتيب </label>
                            <select name="cleaning" id="" class="form-control">
                                <option value="">اختر مستوي النظافه</option>
                                <option {{(isset($visit) && $visit->clientrate->cleaning == "سيء") ? 'selected' : ''}}
                                    value="سيء">سيء </option>
                                <option {{(isset($visit) && $visit->clientrate->cleaning == "وسط") ? 'selected' : ''}}
                                    value="وسط">وسط</option>
                                <option {{(isset($visit) && $visit->clientrate->cleaning == "عالي") ? 'selected' : ''}}
                                    value="عالي">عالي</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> مستوى الإهتمام بالمعدات</label>
                            <select name="equip_interest" id="" class="form-control">
                                <option value="">اختر مستوي الاهتمام</option>
                                <option {{(isset($visit) && $visit->clientrate->equip_interest == "سيء") ? 'selected' :
                                    ''}} value="سيء">سيء </option>
                                <option {{(isset($visit) && $visit->clientrate->equip_interest == "وسط") ? 'selected' :
                                    ''}} value="وسط">وسط</option>
                                <option {{(isset($visit) && $visit->clientrate->equip_interest == "عالي") ? 'selected' :
                                    ''}} value="عالي">عالي</option>
                            </select>
                        </div>
                    </div>



                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title"> المساحه : </label>
                            <input type="text" name="distance"
                                value="{{(isset($visit) ? $visit->clientrate->distance : '')}}" class="form-control"
                                placeholder="المساحه" id="">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row bordered aligned-row">

            <div class="col-md-1" style="background: #00d0ff">
                <div class="center">العماله</div>
            </div>

            <div class="col-md-11">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="title"> التقييم: </label><br>
                            <i data-id="1"
                                class="fa {{(isset($visit) && $visit->clientrate->workrate >= 1) ? 'fa-star' : 'fa-star-o' }} workrate1 starworkrate"></i>
                            <i data-id="2"
                                class="fa {{(isset($visit) && $visit->clientrate->workrate >= 2) ? 'fa-star' : 'fa-star-o' }} workrate2 starworkrate"></i>
                            <i data-id="3"
                                class="fa {{(isset($visit) && $visit->clientrate->workrate >= 3) ? 'fa-star' : 'fa-star-o' }} workrate3 starworkrate"></i>
                            <i data-id="4"
                                class="fa {{(isset($visit) && $visit->clientrate->workrate >= 4) ? 'fa-star' : 'fa-star-o' }} workrate4 starworkrate"></i>
                            <i data-id="5"
                                class="fa {{(isset($visit) && $visit->clientrate->workrate >= 5) ? 'fa-star' : 'fa-star-o' }} workrate5 starworkrate"></i>
                            <input type="hidden" name="workrate" value="5" class="workrate">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="title"> عدد العمال : </label>
                            <input type="text" name="work_num" class="form-control"
                                value="{{(isset($visit) ? $visit->clientrate->work_num : '')}}" placeholder="عدد العمال"
                                id="">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="title"> الجنسيه : </label>
                            <input type="text" name="nationality"
                                value="{{(isset($visit) ? $visit->clientrate->nationality : '')}}" class="form-control"
                                placeholder=" الجنسيه" id="">
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title"> تقييم العمال: </label>
                            <select name="worker_rate" id="" class="form-control">
                                <option value="">اختر تقييم العمال</option>
                                <option {{(isset($visit) && $visit->clientrate->worker_rate == "عادي") ? 'selected' :
                                    ''}} value="عادي">عادي</option>
                                <option {{(isset($visit) && $visit->clientrate->worker_rate == "جيد") ? 'selected' :
                                    ''}} value="جيد">جيد</option>
                                <option {{(isset($visit) && $visit->clientrate->worker_rate == "محترفين") ? 'selected' :
                                    ''}} value="محترفين">محترفين</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title"> مؤهلات العمال: </label>
                            <select name="worker_qualify" id="" class="form-control">
                                <option value="">اختر مؤهلات العمال</option>
                                <option {{(isset($visit) && $visit->clientrate->worker_qualify == "غير متعلمين") ?
                                    'selected' : ''}} value="غير متعلمين">غير متعلمين </option>
                                <option {{(isset($visit) && $visit->clientrate->worker_qualify == "متعلمين") ?
                                    'selected' : ''}} value="متعلمين">متعلمين</option>
                                <option {{(isset($visit) && $visit->clientrate->worker_qualify == "محترفين") ?
                                    'selected' : ''}} value="محترفين">محترفين</option>
                            </select>
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