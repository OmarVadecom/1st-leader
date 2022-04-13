@extends($pLayout. 'master')
@section('content')
<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        تفاصيل الزياره
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>

                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <div class="tab-content px-1 pt-1">
                            @foreach($dbLangs as $key => $lang)
                                <div role="tabpanel"
                                    class="tab-pane fade {{ $key == 0 ? 'active in' : '' }}"
                                    id="{{ $lang->code }}" aria-labelledby="{{ $lang->code }}-tab"
                                    aria-expanded="{{ $key == 0 ? 'true' : 'false' }}">

                                    <table class="table table-striped table-bordered">

                                        <tr>
                                            <th>اسم المندوب</th>
                                            <td>{{ $visit->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>تفاصيل العميل</th>
                                            <td>
                                                <table class="table table-striped table-dark">

                                                    <tr style="background:#FFF">
                                                        <td>إسم العميل:
                                                        </td>
                                                        <td>{{ $visit->customer->name
                                                                                                                }}</td>
                                                    </tr>
                                                    <tr style="background:#FFF">
                                                        <td>المسؤول
                                                            العام:
                                                        </td>
                                                        <td>{{ $visit->customer->general_resp
                                                                                                                }}</td>
                                                    </tr>
                                                    <tr style="background:#FFF">
                                                        <td>المسؤول
                                                            الشخصي:
                                                        </td>
                                                        <td>{{ $visit->customer->personal_resp
                                                                                                                }}</td>
                                                    </tr>
                                                    <tr style="background:#FFF">
                                                        <td>العمل: </td>
                                                        <td>{{ $visit->customer->work
                                                                                                                }}</td>
                                                    </tr>
                                                    <tr style="background:#FFF">
                                                        <td>رقم التليفون:
                                                        </td>
                                                        <td>{{ $visit->customer->phonenumber
                                                                                                                }}</td>
                                                    </tr>
                                                    <tr style="background:#FFF">
                                                        <td>الدوله:
                                                        </td>
                                                        <td>{{ $visit->customer->country
                                                                                                                }}</td>
                                                    </tr>
                                                    <tr style="background:#FFF">
                                                        <td>المدينه:
                                                        </td>
                                                        <td>{{ $visit->customer->city
                                                                                                                }}</td>
                                                    </tr>
                                                    <tr style="background:#FFF">
                                                        <td>المنطقه:
                                                        </td>
                                                        <td>{{ $visit->customer->region
                                                                                                                }}</td>
                                                    </tr>
                                                    <tr style="background:#FFF">
                                                        <td>الشارع:
                                                        </td>
                                                        <td>{{ $visit->customer->street
                                                                                                                }}</td>
                                                    </tr>
                                                </table>
                                            </td>

                                        </tr>
                                        <tr>
                                            <th>المنتجات المطلوب تحضيرها</th>

                                            <td>
                                                <table class="table table-striped table-dark">

                                                    @foreach($allproducts as
                                                        $key=>$product)
                                                        <tr style="background:#FFF">
                                                            <td>إسم المنتج:
                                                                {{ $product->name }}
                                                            </td>
                                                            <td>القسم:
                                                                {{ $product->category->name }}
                                                            </td>
                                                            <td>الكميه:
                                                                {{ $quantities[$key] }}
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </table>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>حاله التحضير</th>

                                            @if($visit->prepare_order == 1)
                                                <td><i style="color:green" class="fa fa-check"></i>
                                                    تم تحضيرها</td>
                                            @else
                                                <td><i style="color:red" class="fa fa-times"></i>
                                                    لم يتم تحضيرها</td>
                                            @endif
                                        </tr>

                                        <tr>
                                            <th>حاله الاستلام</th>

                                            @if($visit->delivery_order == 1)
                                                <td><i style="color:green" class="fa fa-check"></i>
                                                    تم تسليمها</td>
                                            @else
                                                <td><i style="color:red" class="fa fa-times"></i>
                                                    لم يتم تسليمها</td>
                                            @endif
                                        </tr>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('admin.preparing_orders.index') }}"
                            class="btn btn-danger">{{ trans('admin.back') }}</a>
                        <button id="print" class="btn btn-primary">طباعه</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection


@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js"></script>

<script>
    $(function () {
        $("#print").click(function () {
            $('#file-export').print();
        })
    })

</script>
@endsection
