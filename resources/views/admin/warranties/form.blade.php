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
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="productOrPart">أختر منتج ام جزء</label><br>
                        <select
                            class="form-control selectproduct"
                            name="product_or_part"
                            id="productOrPart"
                            required
                        >
                            <option value="">اختر منتج ام جزء</option>
                            <option
                                value="1"
                                @if(isset(request()['product'])) selected @endif
                                @if(isset($warranty, $warranty->product_id)) selected @endif
                            > منتج </option>
                            <option
                                value="2"
                                @if(isset(request()['part'])) selected @endif
                                @if(isset($warranty, $warranty->part_id)) selected @endif
                            > جزء </option>
                        </select>
                    </div>
                </div>
                <div
                    style="@if(isset(request()['product']) || isset($warranty, $warranty->product_id)) display: block; @else display: none; @endif"
                    id="productSelect"
                    class="col-md-4"
                >
                    <div class="form-group">
                        <label for="product">أختر المنتج</label><br>
                        <select
                            class="form-control selectproduct"
                            name="product_id"
                            id="product"
                        >
                            <option value="">اختر المنتج</option>
                            @foreach($products as $product)
                                <option
                                    {{ (isset($warranty) && $warranty->product_id === $product->id) ? 'selected' : '' }}
                                    {{ (isset(request()['product']) && request()['product'] == $product->id) ? 'selected' : '' }}
                                    value="{{ $product->id }}"
                                >
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div
                    style="@if(isset(request()['part']) || isset($warranty, $warranty->part_id)) display: block; @else display: none; @endif"
                    class="col-md-4"
                    id="partSelect"
                >
                    <div class="form-group">
                        <label for="part">أختر جزء</label><br>
                        <select
                            class="form-control selectproduct"
                            name="part_id"
                            id="part"
                        >
                            <option value="">اختر الجزء</option>
                            @foreach($parts as $part)
                                <option
                                    {{ (isset($warranty) && $warranty->part_id === $part->id) ? 'selected' : '' }}
                                    {{ (isset(request()['part']) && request()['part'] == $part->id) ? 'selected' : '' }}
                                    value="{{ $part->id }}"
                                >
                                    {{ $part->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group {{ $errors->has("problem_type") ? " has-error" : "" }}">
                        <label for="problem_type">المشكله</label>
                        {!!
                            Form::text("problem", isset($warranty) ? $warranty->problem_type : "", [
                            "placeholder"   => 'نوع المشكله',
                            "required",
                            "class"         => "form-control",
                            "id"            => "problem_type",
                            ])
                        !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group {{ $errors->has("date_create_warranty") ? " has-error" : "" }}">
                        <label for="date_create_warranty">تاريخ انشاء الضمان</label>
                        <input
                            value="{{$warranty->date_create_warranty or date('Y-m-d')}}"
                            name="date_create_warranty"
                            id="date_create_warranty"
                            class="form-control"
                            type="date"
                            required
                        />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has("tech_report") ? " has-error" : "" }}">
                        <label for="tech_report">التقرير الفني</label>
                        <textarea
                            style="height: inherit !important;resize: none"
                            placeholder="تقرير الفني"
                            class="form-control"
                            name="tech_report"
                            id="tech_report"
                            rows="5"
                        >{{isset($warranty) ? $warranty->tech_report : ""}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has("recommend") ? " has-error" : "" }}">
                        <label for="recommend">التوصيه</label>
                        <textarea
                            style="height: inherit !important;resize: none"
                            placeholder="التوصيه"
                            class="form-control"
                            name="recommend"
                            id="recommend"
                            rows="5"
                        >{{isset($warranty) ? $warranty->recommend : ""}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="menu2">
            @if(isset($warranty))
                <div class="row main_specs">
                    @if(count($notes) > 0 )
                        @foreach($notes as $i => $note)
                            @if(isset($note))
                                <div class="col-md-7">
                                    <input
                                        class="form-control main_spec"
                                        placeholder="الملاحظه"
                                        name="main_spec[]"
                                        value="{{$note}}"
                                        type="text"
                                    />
                                    <input
                                        value="{{ $attachments[$i] }}"
                                        class="file_num_{{$i}}"
                                        name="old_main_images[]"
                                        type="hidden"
                                    />
                                </div>
                                <div class="col-md-3">
                                    <input type="file" name="main_images[]">
                                    @if($note != "" || $attachments[$i] != "")
                                        <div class="downimg">
                                            <img
                                                src="{{url('/')}}/uploads/warranty-attachments/{{$attachments[$i]}}"
                                                style="width: 150px; height: 150px; padding: 10px 0;"
                                            >
                                            <a
                                                href="{{url('/')}}/uploads/warranty-attachments/{{$attachments[$i]}}"
                                                download=""
                                            > تحميل </a>
                                            <span
                                                class="removethis"
                                                data-num="{{$i}}"
                                                style="color:red;cursor:pointer;"
                                            > حذف </span>
                                        </div>
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
                    <div class="col-md-3" style="margin-top: 5px">
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
                <i class="icon-check2"></i>
                {{ trans('admin.save') }}
            </button>
            <a href="{{ route('warranties.index') }}" class="btn btn-danger">
                <i class="fa fa-times"></i>
                {{ trans('admin.cancel') }}
            </a>
        </div>
    </div>
</div>

@section('script')
    @include('admin.layouts.script')
    <script>
        $('#productOrPart').on('change', function () {
            if($(this).val() === '1') {
                $('#productSelect').fadeIn(300);
                $('#partSelect').hide();
            } else {
                $('#partSelect').fadeIn(300);
                $('#productSelect').hide();
            }
        })
    </script>
@endsection
