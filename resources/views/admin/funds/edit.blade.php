@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        تفاصيل الدفعه
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>

                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <div class="tab-content px-1 pt-1">
                            @foreach ($dbLangs as $key => $lang)
                            <div role="tabpanel" class="tab-pane fade {{ $key == 0 ? 'active in' : '' }}"
                                id="{{ $lang->code  }}" aria-labelledby="{{ $lang->code }}-tab"
                                aria-expanded="{{ $key == 0 ? 'true' : 'false' }}">

                                <table class="table table-striped table-bordered">

                                    <tr>
                                        <th>رقم الدفعه</th>
                                        <td>

                                            @php
                                            $id = str_pad($fund->id, 4, '0', STR_PAD_LEFT);
                                            $id = 'INV-' . $id;
                                            @endphp
                                            {{ $id }}

                                        </td>
                                    </tr>

                                    <tr>
                                        <th>اسم الزبون</th>
                                        <td>{{ $fund->customer->name }}</td>
                                    </tr>

                                    <tr>
                                        <th> عرض السعر</th>
                                        <td>{{ $fund->price->code }}</td>
                                    </tr>

                                    <tr>
                                        <th> المبلغ المستحق</th>
                                        <td>{{ $fund->money }}</td>
                                    </tr>
                                    <tr>
                                        <th> تاريخ الاستحقاق من</th>
                                        <td>{{ $fund->date_from }}</td>
                                    </tr>
                                    <tr>
                                        <th> تاريخ الاستحقاق الي</th>
                                        <td>{{ $fund->date_to }}</td>
                                    </tr>
                                    <tr>
                                        <th> نوع الدفعه</th>
                                        <td>
                                            @if($fund->type == 1)
                                            شيك
                                            @else
                                            كمبياله
                                            @endif
                                        </td>
                                    </tr>
                                    @if($fund->type == 1)
                                    <tr>
                                        <th> البنك </th>
                                        <td>{{ $fund->bank }}</td>
                                    </tr>
                                    <tr>
                                        <th>رقم البنك</th>
                                        <td>{{ $fund->bank_num }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th>ملاحظه</th>
                                        <td>{{ $fund->note }}</td>
                                    </tr>

                                    <tr>
                                        <th>حاله الدفع</th>
                                        <td>
                                            @if ($fund->status == 1)
                                            <i style="color:green" class="fa fa-check"></i> تم الدفع
                                            <br>
                                            @else
                                            <i style="color:red" class="fa fa-times"></i> لم يتم الدفع
                                            <br>
                                            @endif
                                            <form style="padding-top:10px;" method="post"
                                                action="{{route('funds.store')}}">
                                                @csrf
                                                <input type="hidden" name="fund_id" value="{{$fund->id}}">
                                                <input id="radio_id" type="checkbox" class="checkbtnC" name="status"
                                                    @if($fund->status == 1)
                                                checked="checked" @endif /><br>
                                                <button type="submit" class="btn btn-success">حفظ </button>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            @endforeach
                        </div>
                        <a href="{{ route('funds.index') }}" class="btn btn-danger">{{ trans('admin.back') }}</a>
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
 $("#print").click(function(){
$('#file-export').print();
})
})
</script>
@endsection