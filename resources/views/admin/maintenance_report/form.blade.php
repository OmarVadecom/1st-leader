<input type="hidden" id="maintenance_sr" value="1">
<input type="hidden" name="main_type" value="{{ request('main_type') }}"/>
<input
    type="hidden"
    name="code"
    @if(isset($maint))
    value="{{ $maint->code . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT) }}"
    @elseif(isset($maintenance))
    value="{{ $maintenance->maintenance->code . '-' . str_pad(request('invoice_num'), 4, '0', STR_PAD_LEFT) }}"
    @else
    value=""
    @endif
/>
<div class="row">
    <ul class=" nav nav-tabs">
        <li class="nav-item navbitem">
            <a class="nav-link navvlink active" data-toggle="tab" href="#menu1">عام</a>
        </li>
        <li class="nav-item navbitem">
            <a class="nav-link navvlink" data-toggle="tab" href="#menu2">ملاحظات مصوره</a>
        </li>
    </ul>
    <br>
    <div class="tab-content">
        <div class="tab-pane active" id="menu1">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>حاله التقرير</label>
                        <div class="radio" style="margin-right: 3%;">
                            <label>
                                <input
                                    {{ (isset($maintenance)) ? ($maintenance->status_report == 1) ? 'checked' : '' : 'checked' }}
                                    name="status_report"
                                    type="radio"
                                    value="1"
                                />
                                تحت التنفيذ
                            </label>
                        </div>
                        <div class="radio" style="margin-right: 3%;">
                            <label>
                                <input
                                    {{ (isset($maintenance) && $maintenance->status_report == 2) ? 'checked' : '' }}
                                    name="status_report"
                                    type="radio"
                                    value="2"
                                />
                                مكتمل
                            </label>
                        </div>
                        <div class="radio" style="margin-right: 3%;">
                            <label>
                                <input
                                    {{ (isset($maintenance) && $maintenance->status_report == 3) ? 'checked' : '' }}
                                    name="status_report"
                                    type="radio"
                                    value="3"
                                />
                                مرفوض
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>حاله الضمان</label>
                        <div class="radio" style="margin-right: 3%;">
                            <label>
                                <input
                                    {{ (isset($maintenance)) ? ($maintenance->status_warranty == 1) ? 'checked' : '' : 'checked' }}
                                    name="status_warranty"
                                    type="radio"
                                    value="1"
                                />
                                خارج الضمان
                            </label>
                        </div>
                        <div class="radio" style="margin-right: 3%;">
                            <label>
                                <input
                                    {{ (isset($maintenance) && $maintenance->status_warranty == 2) ? 'checked' : '' }}
                                    name="status_warranty"
                                    type="radio"
                                    value="2"
                                />
                                داخل الضمان
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label> هل تم الفحص</label>
                        <div class="radio" style="margin-right: 30%;">
                            <label><input type="radio" value="1" name="status" {{(isset($maintenance)) ? ($maintenance->status == 1) ?
                'checked' : '' : 'checked' }}> نعم </label>
                        </div>
                        <div class="radio" style="margin-right: 30%;">
                            <label><input value="0" type="radio" name="status" {{(isset($maintenance) && $maintenance->status == 0) ?
                'checked' : '' }}> لا </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                        <label>نوع المشكله</label>

                        {!! Form::text("type", isset($maintenance) ? $maintenance->type : "", [
                        "class" => "form-control",
                        "placeholder" => 'نوع المشكله',
                        "required"
                        ]) !!}
                    </div><!-- /.form-group -->
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">بدايه الفحص</label>
                        <input type="date" value="{{$maintenance->start or date('Y-m-d')}}" required name="start"
                               class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">نهايه الفحص الفحص</label>
                        <input type="date" value="{{$maintenance->end or date('Y-m-d')}}" required name="end"
                               class="form-control">
                    </div>
                </div>
                @if(isset($maint))
                    <input type="hidden" name="maintenance_id" value="{{$maint->id}}">
                    <input type="hidden" name="customer_id" value="{{$maint->client_id}}">
                @endif
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>تقرير الفني</label>
                        <i data-id="1"
                           class="fa {{(isset($maintenance) && $maintenance->tech_rate >= 1) ? 'fa-star' : 'fa-star-o' }} delegate1 stardel"></i>
                        <i data-id="2"
                           class="fa {{(isset($maintenance) && $maintenance->tech_rate >= 2) ? 'fa-star' : 'fa-star-o' }} delegate2 stardel"></i>
                        <i data-id="3"
                           class="fa {{(isset($maintenance) && $maintenance->tech_rate >= 3) ? 'fa-star' : 'fa-star-o' }} delegate3 stardel"></i>
                        <i data-id="4"
                           class="fa {{(isset($maintenance) && $maintenance->tech_rate >= 4) ? 'fa-star' : 'fa-star-o' }} delegate4 stardel"></i>
                        <i data-id="5"
                           class="fa {{(isset($maintenance) && $maintenance->tech_rate >= 5) ? 'fa-star' : 'fa-star-o' }} delegate5 stardel"></i>
                        <input type="hidden" name="tech_rate" value="5" class="delegate">
                        <textarea style="height: inherit !important;" class="form-control" name="tech_report"
                                  placeholder="تقرير الفني"
                                  rows="4">{{isset($maintenance) ? $maintenance->tech_report : ""}}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>التوصيه</label>
                        <i data-id="1"
                           class="fa {{(isset($maintenance) && $maintenance->recommends_rate >= 1) ? 'fa-star' : 'fa-star-o' }} delegatecl1 stardelcl"></i>
                        <i data-id="2"
                           class="fa {{(isset($maintenance) && $maintenance->recommends_rate >= 2) ? 'fa-star' : 'fa-star-o' }} delegatecl2 stardelcl"></i>
                        <i data-id="3"
                           class="fa {{(isset($maintenance) && $maintenance->recommends_rate >= 3) ? 'fa-star' : 'fa-star-o' }} delegatecl3 stardelcl"></i>
                        <i data-id="4"
                           class="fa {{(isset($maintenance) && $maintenance->recommends_rate >= 4) ? 'fa-star' : 'fa-star-o' }} delegatecl4 stardelcl"></i>
                        <i data-id="5"
                           class="fa {{(isset($maintenance) && $maintenance->recommends_rate >= 5) ? 'fa-star' : 'fa-star-o' }} delegatecl5 stardelcl"></i>
                        <input type="hidden" name="recommends_rate" value="5" class="delegatecl">
                        <textarea style="height: inherit !important;" class="form-control" name="recommends"
                                  placeholder="التوصيه"
                                  rows="4">{{isset($maintenance) ? $maintenance->recommends : ""}}</textarea>
                    </div>
                </div>
            </div>

            @php
                if(isset($edit)){
                $items=$offer_products ;
                $quantities=$offer_products_quantities;
                $prices=$offer_products_prices;
                $discounts=$offer_products_discounts;
                $taxes=$offer_products_taxes;
                $addon_disc=$maintenance->addon_disc;
                }
            @endphp
            @include('admin.layouts.product_table')

        </div>
        <div class="tab-pane fade" id="menu2">
            @if(isset($maintenance))
                <div class="row main_specs">
                    @if(count($notes) > 0 )
                        @foreach($notes as $i => $note)
                            @if(isset($note))
                                <div class="col-md-7">
                                    <input type="text" name="main_spec[]" value="{{$note}}" class="form-control main_spec" placeholder="الملاحظه" />
                                    <input
                                        value="{{ isset($attachments[$i]) ? $attachments[$i] : ''}}"
                                        class="file_num_{{$i}}"
                                        name="old_main_images[]"
                                        type="hidden"
                                    />
                                </div>
                                <div class="col-md-3">
                                    <input type="file" name="main_images[]">
                                    @if(isset($attachments[$i]))
                                        @if($note != "" || $attachments[$i] != "")
                                            <div class="downimg">
                                                <img src="{{url('/')}}/uploads/main-attachments/{{$attachments[$i]}}" style="width: 150px; height: 150px; padding: 10px;">
                                                <a href="{{url('/')}}/uploads/main-attachments/{{$attachments[$i]}}" download=""> تحميل </a>
                                                <span class="removethis" data-num="{{$i}}" style="color:red;cursor:pointer;"> حذف </span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    @if(($i == 0))
                                        <button id="add_main_spec" class="btn btn-success">اضافه ملاحظه اخري</button>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="col-md-7">
                            <input type="text" name="main_spec[]" class="form-control main_spec" placeholder="الملاحظه">
                        </div>
                        <div class="col-md-3">
                            <input type="file" name="main_images[]">
                        </div>
                        <div class="col-md-2">
                            <button id="add_main_spec" class="btn btn-success">اضافه ملاحظه اخري</button>
                        </div>

                    @endif
                </div>
            @else
                <div class="row main_specs">
                    <div class="col-md-7">
                        <input type="text" name="main_spec[]" class="form-control main_spec" placeholder="الملاحظه">
                    </div>
                    <div class="col-md-3">
                        <input type="file" name="main_images[]">
                    </div>
                    <div class="col-md-2">
                        <button id="add_main_spec" class="btn btn-success">اضافه ملاحظه اخري</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-12">
        <hr>
        <div class="clear">
            <button type="submit" class="btn btn-success">
                <i class="icon-check2"></i> {{ trans('admin.save') }}
            </button>
        </div>
    </div>


@section('script')
    @include('admin.layouts.script')
@append

<!-- /*/*/*/*/*/ Style Section  /*/*/*/*/*/*/*/-->
@include('admin.layouts.style.form_style')
<!-- /*/*/*/*/*/ Style Section  /*/*/*/*/*/*/*/-->
