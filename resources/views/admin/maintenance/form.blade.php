
<div class="row">
    <ul class=" nav nav-tabs">
        <li class="nav-item navbitem">
            <a class="nav-link navvlink active" data-toggle="tab" href="#menu1">عام</a>
        </li>
        <li class="nav-item navbitem">
            <a class="nav-link navvlink" data-toggle="tab" href="#menu2">استلام قطع غيار</a>
        </li>
        <li class="nav-item navbitem">
            <a class="nav-link navvlink" data-toggle="tab" href="#menu4">ملاحظات مصوره للمستلم</a>
        </li>
    </ul>
    <br>
    <div class="tab-content">
        <div class="tab-pane active" id="menu1">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>اختر الزبون</label>
                        <select
                            @if( !isset($maintenance) || ((isset($maintenance) && $maintenance->client_id) == null || (isset($maintenance) && $maintenance->client_id == 0) || (isset($maintenance) && $maintenance->client_id == '0')) )
                                required
                            @endif
                            class="form-control select2"
                            name="client"
                        >
                            <option value="">اختر الزبون</option>
                            @foreach($customers as $customer)
                                <option
                                    {{(isset($maintenance) && $maintenance->client_id == $customer->id) ? 'selected' : ''}}
                                    value="{{$customer->id}}"
                                >
                                    {{$customer->name}}
                                </option>
                            @endforeach
                        </select>
                        <br>
                        <a href="{{url('/')}}/customers/create">اضافه زبون جديد </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">التاريخ</label>
                        <input type="date" value="{{$maintenance->date or date('Y-m-d')}}" required name="date"
                               class="form-control">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="title">الوقت</label>
                        <input type="text" value="{{$maintenance->time or date('h:i:s A')}}" required name="time"
                               class="form-control">
                    </div>
                </div>
                <input type="hidden" name="main_type" value="{{$maintenance->main_type or \Request::get('main_type')}}">
                <div class="col-md-3">
                    <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                        <label>اسم صاحب الطلب</label>

                        {!! Form::text("name", null, [
                        "class" => "form-control",
                        "placeholder" => 'اسم صاحب الطلب',

                        ]) !!}
                    </div><!-- /.form-group -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">


                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="RadioOption" id="inlineRadio1" value="product"
                                {{(isset($maintenance) && $maintenance->product_id != null) ? 'checked' : ''}}>
                            <label style="padding-right:0px;margin-bottom:8px;" class="form-check-label"
                                   for="inlineRadio1">منتج</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="RadioOption" id="inlineRadio2" value="part"
                                {{(isset($maintenance) && $maintenance->part_id != null) ? 'checked' : ''}}>
                            <label style="padding-right:0px;margin-bottom:8px;" class="form-check-label" for="inlineRadio2">قطعه
                                غيار</label>
                        </div>
                        <select class="form-control" id="select_product" name="main_product_id" required>
                            <option value="">اختر المنتج</option>
                            @foreach($products as $product)
                                <option value="{{$product->id}}" {{(isset($maintenance) && $maintenance->product_id==$product->id) ?
                'selected' : ''}}>{{$product->name}}
                                </option>
                            @endforeach
                        </select>
                        <select class="form-control" id="select_part" name="main_part_id" required>
                            <option value="">اختر القطعه</option>
                            @foreach($parts as $part)
                                <option value="{{$part->id}}" {{(isset($maintenance) && $maintenance->part_id==$part->id) ? 'selected' :
                ''}}>{{$part->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                        <label>سيريال نمبر</label>

                        {!! Form::text("serial_num", null, [
                        "class" => "form-control",
                        "placeholder" => 'سيريال نمبر',
                        ]) !!}
                    </div><!-- /.form-group -->
                </div>

                <div class="col-md-3">
                    <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                        <label>الطراز</label>

                        {!! Form::text("type", null, [
                        "class" => "form-control",
                        "placeholder" => 'الطراز',
                        ]) !!}
                    </div><!-- /.form-group -->
                </div>


                <div class="col-md-3">
                    <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                        <label>عدد القطع المستلمه</label>

                        {!! Form::number("quantity", null, [
                        "class" => "form-control",
                        "placeholder" => 'الكميه',

                        ]) !!}
                    </div><!-- /.form-group -->
                </div>
            </div>
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                        <label>حاله القطعه</label>

                        {!! Form::text("status", null, [
                        "class" => "form-control",
                        "placeholder" => 'حاله القطعه',

                        ]) !!}
                    </div><!-- /.form-group -->
                </div>
                <div class="col-md-3">
                    <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                        <label>حاله التشغيل</label>
                        <select class="form-control" name="op_status">
                            <option value="">اختر الحاله</option>
                            <option value="تعمل" {{ (isset($maintenance) && $maintenance->op_status == 'تعمل') ? 'selected' : ''}}>
                                تعمل </option>
                            <option value="لا تعمل" {{ (isset($maintenance) && $maintenance->op_status == 'لا تعمل') ? 'selected' :
                ''}}> لا تعمل </option>
                        </select>
                    </div><!-- /.form-group -->
                </div>
                <div class="col-md-3">
                    <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                        <label> مستوي النظافه</label>
                        <select class="form-control" name="cleaning">
                            <option value="">اختر المستوي</option>
                            <option value="سيء" {{(isset($maintenance) && $maintenance->cleaning == "سيء") ? 'selected' : ''}}> سيء
                            </option>
                            <option value="جيد" {{(isset($maintenance) && $maintenance->cleaning == "جيد") ? 'selected' : ''}}> جيد
                            </option>
                            <option value="ممتاز" {{(isset($maintenance) && $maintenance->cleaning == "ممتاز") ? 'selected' : ''}}>
                                ممتاز </option>
                        </select>
                    </div> <!-- /.form-group -->
                </div>
                <div class="col-md-3">
                    <div class="form-group{{ $errors->has(" name") ? " has-error" : "" }}">
                        <label> قيمه الفحص</label>

                        {!! Form::number("cost", null, [
                        "class" => "form-control",
                        "placeholder" => ' قيمه الفحص',

                        ]) !!}
                    </div><!-- /.form-group -->
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>وصف المشكله لدي العميل</label>
                        <i data-id="1"
                           class="fa {{(isset($maintenance) && $maintenance->problem_rate >= 1) ? 'fa-star' : 'fa-star-o' }} delegate1 stardel"></i>
                        <i data-id="2"
                           class="fa {{(isset($maintenance) && $maintenance->problem_rate >= 2) ? 'fa-star' : 'fa-star-o' }} delegate2 stardel"></i>
                        <i data-id="3"
                           class="fa {{(isset($maintenance) && $maintenance->problem_rate >= 3) ? 'fa-star' : 'fa-star-o' }} delegate3 stardel"></i>
                        <i data-id="4"
                           class="fa {{(isset($maintenance) && $maintenance->problem_rate >= 4) ? 'fa-star' : 'fa-star-o' }} delegate4 stardel"></i>
                        <i data-id="5"
                           class="fa {{(isset($maintenance) && $maintenance->problem_rate >= 5) ? 'fa-star' : 'fa-star-o' }} delegate5 stardel"></i>
                        <input type="hidden" name="problem_rate" value="5" class="delegate">
                        <textarea style="height: inherit !important;" class="form-control" name="problem_description"
                                  placeholder="وصف الطلب"
                                  rows="4">{{isset($maintenance) ? $maintenance->problem_description : ""}}</textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>وصف المستلم</label>

                        <i data-id="1"
                           class="fa {{(isset($maintenance) && $maintenance->delivery_rate >= 1) ? 'fa-star' : 'fa-star-o' }} delegatecl1 stardelcl"></i>
                        <i data-id="2"
                           class="fa {{(isset($maintenance) && $maintenance->delivery_rate >= 2) ? 'fa-star' : 'fa-star-o' }} delegatecl2 stardelcl"></i>
                        <i data-id="3"
                           class="fa {{(isset($maintenance) && $maintenance->delivery_rate >= 3) ? 'fa-star' : 'fa-star-o' }} delegatecl3 stardelcl"></i>
                        <i data-id="4"
                           class="fa {{(isset($maintenance) && $maintenance->delivery_rate >= 4) ? 'fa-star' : 'fa-star-o' }} delegatecl4 stardelcl"></i>
                        <i data-id="5"
                           class="fa {{(isset($maintenance) && $maintenance->delivery_rate >= 5) ? 'fa-star' : 'fa-star-o' }} delegatecl5 stardelcl"></i>
                        <input type="hidden" name="delivery_rate" value="5" class="delegatecl">
                        <textarea style="height: inherit !important;" class="form-control" name="delivery_description"
                                  placeholder="وصف المستلم"
                                  rows="4">{{isset($maintenance) ? $maintenance->delivery_description : ""}}</textarea>
                    </div>
                </div>
            </div>


        </div>

        <div class="tab-pane fade" id="menu2">
            <div class="col-md-12">
                <table id="added_products_table" class="table table-striped" style="text-align:center">
                    <thead>
                    <tr>
                        <th width="5%">م</th>
                        <th>رقم الصنف</th>
                        <th>اسم القطعه</th>
                        <th>رقم القطعه</th>
                        <th>حاله القطعه</th>
                        <th>حاله التشغيل</th>
                        <th>مستوي النظافه</th>
                    </tr>
                    </thead>
                    <tbody id="table_body" class="productsadd">
                    @if(isset($maintenance))
                        @foreach($maintenance_parts as $k => $product )
                            @if(isset($product))
                                <tr><input type="hidden" name="product[]" value="{{$product->id}}">
                                    <input type="hidden" name="product_code_type[]" value="{{$product->code_type or ''}}">
                                    <td>{{$k}}</td>
                                    <td>{{$product->code}}</td>
                                    <td> {{$product->name}}</td>
                                    <td>
                                        <input type="text" data-number="{{$k}}" value="{{$parts_num[$k]}}" placeholder="رقم القطعه"
                                               class="form-control" name="part_num[]">
                                    </td>
                                    <td>
                <textarea data-number="{{$k}}" placeholder="حاله القطعه" class=" form-control"
                          name="part_status[]">{{$parts_status[$k]}}</textarea>
                                    </td>
                                    <td>
                                        <select class="form-control" name="parts_op_status[]">
                                            <option value="">اختر الحاله</option>
                                            <option value="تعمل" {{ (($parts_op_status[$k]=='تعمل' ) ? 'selected' : '' )}}>
                                                تعمل </option>
                                            <option value="لا تعمل" {{ (($parts_op_status[$k]=='لا تعمل' ) ? 'selected' : '' )}}> لا تعمل
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="parts_cleaning[]">
                                            <option value="">اختر المستوي</option>
                                            <option value="سيء" {{($parts_cleaning[$k]=="سيء" ) ? 'selected' : '' }}> سيء
                                            </option>
                                            <option value="جيد" {{($parts_cleaning[$k]=="جيد" ) ? 'selected' : '' }}> جيد
                                            </option>
                                            <option value="ممتاز" {{($parts_cleaning[$k]=="ممتاز" ) ? 'selected' : '' }}>
                                                ممتاز </option>
                                        </select>
                                    </td>
                                    <td><i data-rownumber="{{$k}}" class="fa fa-times clickremrow"></i> </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
                @if(!isset($delivery))
                    @include('admin.product_search.product_search')
                @endif
            </div>
        </div>


        <div class="tab-pane fade" id="menu4">
            @if(isset($delnotes) && count($delnotes) > 0 && $delnotes[0] != "")
                <div class="row del_main_specs">
                    @foreach($delnotes as $i=>$note)
                        @if($note != '' || $delattachments[$i] != '')
                            <div class="col-md-7">
                                <input type="text" name="del_main_spec[]" value="{{$note}}" class="form-control main_spec"
                                       placeholder="الملاحظه">
                            </div>
                            <div class="col-md-3">
                                <input type="file" name="del_main_imgs[]">
                                <input type="hidden" value="{{$delattachments[$i]}}" class="attachcl_{{$i}}" name="old_del_main_imgs[]">

                                @if(isset($delattachments[$i]) && $delattachments[$i] != "")
                                    <div class="downimg">
                                        <img src="{{url('/')}}/uploads/main-attachments/{{$delattachments[$i]}}"
                                             style="width: 150px; height: 150px; padding: 10px;">
                                        <a href="{{url('/')}}/uploads/main-attachments/{{$delattachments[$i]}}" download=""> تحميل </a> |
                                        <span data-num="{{$i}}" class="removethis" style="color:red;cursor:pointer;"> حذف </span>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-2">
                                @if(($i == 0))
                                    <button id="add_del_main_spec" class="btn btn-success">اضافه ملاحظه اخري</button>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>

            @else
                <div class="row del_main_specs">
                    <div class="col-md-7">
                        <input type="text" name="del_main_spec[]" class="form-control main_spec" placeholder="الملاحظه">
                    </div>
                    <div class="col-md-3">
                        <input type="file" name="del_main_imgs[]">
                    </div>
                    <div class="col-md-2">
                        <button id="add_del_main_spec" class="btn btn-success">اضافه ملاحظه اخري</button>
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
    @if(isset($maintenance) && $maintenance->product_id !=null)
        <style>
            #select_part {
                display: none;
            }
        </style>
    @endif
    @if(isset($maintenance) && $maintenance->part_id !=null)
        <style>
            #select_product {
                display: none;
            }
        </style>
    @else
        <style>
            #select_part {
                display: none;
            }
        </style>
    @endif
    <style>
        .comp {
            display: none;
        }

        .select2-selection {
            text-align: right !important;
            height: 35px !important;
        }

        .fa-star {
            color: #ffc12b;
            font-size: 15px;
        }

        th {
            text-align: center !important;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background: #dff0d8 !important;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background: #f2dede !important;
        }


        .clickremrow {
            background: antiquewhite;
            padding: 12px;
            cursor: pointer;
            color: red;
        }

        .main_spec {
            margin-bottom: 10px;
        }

        .table th,
        .table td {
            padding: 0.5rem 0.5rem;
        }
    </style>


    @section('script')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
        <script>
            var k = '@if(isset($edit)||isset($verify)){{count($offer_products)}}@else{{1}}@endif';
            $(".add_products_btn").click(function() {
                var products = [];
                var parts = [];
                $.each($("input[name='product_id']:checked"), function() {
                    if($(this).data('type')=='ES'||$(this).data('type')=='EA')
                    {
                        parts.push($(this).val());
                    }
                    else products.push($(this).val());
                });

                $.ajax({
                    dataType: "json",
                    url: "{{route('admin.ajax_add')}}",
                    data: {
                        'product_ids': products,
                        'part_ids': parts,
                    },
                    success: function(data) {
                        // $('#added_products_table').find("tr:gt(0)").remove();
                        for (var i = 0; i < data.length; i++) {
                            var name='';
                            if(data[i].name!=null)
                                name = data[i].name;
                            $('#added_products_table tr:last').after('<tr><input type="hidden" name="product[]" value="' + data[i].id + '">  <input type="hidden" name="product_code_type[]" value="' + data[i].code_type + '"><td>' + k + '</td> <td>' + data[i].code + '</td><td> ' +name + '</td><td><input type="text"  data-number="' + k + '" placeholder="رقم القطعه" class="form-control" name="part_num[]"></td><td><textarea  data-number="' + k + '" placeholder="حاله القطعه" class=" form-control" name="part_status[]"></textarea> </td><td> <select class="form-control" name="parts_op_status[]"> <option value="">اختر الحاله</option> <option value="تعمل"> تعمل </option> <option value="لا تعمل"> لا تعمل </option> </select> </td><td> <select class="form-control" name="parts_cleaning[]"> <option value="">اختر المستوي</option> <option value="سيء" > سيء </option> <option value="جيد" > جيد </option> <option value="ممتاز"> ممتاز </option> </select> </td> <td><i class="fa fa-times clickremrow"></i> </td></tr>');
                            $("#products_table").hide('slow');
                            $(".add_products_btn").hide('slow');
                            k++;
                        }
                    }
                });




            });

            @if(isset($maintenance) && $maintenance->product_id != null)
            $("#select_product").attr('required',true);
            $("#select_part").attr('required',false);

            @else
            $("#select_part").attr('required',true);
            $("#select_product").attr('required',false);
            @endif
            $('input[type=radio][name=RadioOption]').change(function() {

                if (this.value == 'product') {
                    $("#select_product").attr('required',true);
                    $("#select_part").attr('required',false);
                    $("#select_part").hide('slow');
                    $("#select_product").show('slow');

                    $("#select_part").val('');
                }else if (this.value == 'part'){
                    $("#select_product").hide('slow');
                    $("#select_part").show('slow');
                    $("#select_part").attr('required',true);
                    $("#select_product").attr('required',false);

                    $("#select_product").val('');

                }

            });


            $(".select2").select2();
            $("#selecttype").change(function(){
                if($(this).val()==0){
                    $(".comp").show('slow');
                }else{
                    $(".comp").hide('slow');
                }

            })
            $('.removethis').click(function(){
                num=$(this).data('num');
                $(".attachcl_"+num).val('');
                $(this).parent().remove();
                return false;
            })


            $('.stardel').click(function(){
                stars=$(this).data('id');
                $(".delegate").val(stars);
                for(i=1; i<=stars; i++){
                    $(".delegate"+i).css('color','#ffc12b');
                }
                for(i=(stars+1); i<6; i++){
                    $(".delegate"+i).css('color','#ccc');
                }
            })

            $('.stardelcl').click(function(){
                stars=$(this).data('id');
                $(".delegatecl").val(stars);
                for(i=1; i<=stars; i++){
                    $(".delegatecl"+i).css('color','#ffc12b');
                }
                for(i=(stars+1); i<6; i++){
                    $(".delegatecl"+i).css('color','#ccc');
                }
            })

            $('#add_main_spec').click(function(){
                $(".main_specs").append('<div class="col-md-7"> <input type="text" name="main_spec[]" class="form-control main_spec" placeholder="الملاحظه"> </div> <div class="col-md-3"> <input type="file" name="main_imgs[]"> </div> <div class="col-md-2"></div><br><br>');
                return false;
            })

            $('#add_del_main_spec').click(function(){
                $(".del_main_specs").append('<div class="col-md-7"> <input type="text" name="del_main_spec[]" class="form-control main_spec" placeholder="الملاحظه"> </div> <div class="col-md-3"> <input type="file" name="del_main_imgs[]"> </div> <div class="col-md-2"></div><br><br>');
                return false;
            })

            $(document).on("click", ".clickremrow", function() {
                $(this).parents("tr:first").remove();
            })
        </script>
@append
