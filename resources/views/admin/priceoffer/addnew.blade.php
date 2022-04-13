@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">إنشاء عرض سعر
                    </h4>
                </div>
                {!! Form::open([
                'url' => route('admin.saveoffer'),
                'method', 'POST',
                ]) !!}
                <div class="card-body">
                    <div class="card-block">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="title">أختر الزبون</label>
                                    <select name="customer" class="form-control selectproduct" required>
                                        <option value="">اختر الزبون</option>
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{(isset($visit) && $customer->
                                            id==$visit->customer_id) ? 'selected' : ''}}>
                                            {{ $customer->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <a href="{{url('/')}}/customers/create">اضافه زبون جديد </a>
                                    @if ($errors->has('customer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('customer') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>

                        <div class="col-md-12">
                            <table class="table table-striped" style="text-align:center">
                                <thead>
                                    <tr>
                                        <th>الماده</th>
                                        <th>الوحده</th>

                                        <th>سعر البيع</th>
                                        <th>الخصم</th>

                                        <th>الكميه</th>
                                        <th style="width:9%">الاجمالي</th>
                                    </tr>
                                </thead>
                                <tbody class="productsadd">

                                    @foreach($allproducts as $key=>$product)
                                    <tr>
                                        <td>
                                            <select style="width:250px;" data-number="{{$key}}" name="product[]"
                                                class="form-control selectproduct selectproducted" required>
                                                @foreach($products as $singleproduct)
                                                <option value="{{ $singleproduct->id }}" {{($product->id ==
                                                    $singleproduct->id)? 'selected' : ''}}>
                                                    {{ $singleproduct->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="unit0">
                                            {{$product->unit_1}}
                                        </td>


                                        <td>
                                            <input type="number" value="{{$product->price}}" placeholder="السعر" min="1"
                                                class="prices form-control productquantity price0" name="price[]">
                                        </td>

                                        <td>
                                            <input type="number" value="" placeholder="الخصم %" min="1"
                                                class="form-control productquantity discounts discount0"
                                                name="discount[]">
                                        </td>

                                        <td>
                                            <input type="number" value="{{$quantities[$key]}}" placeholder="الكميه"
                                                min="1" class="quantities form-control productquantity quantity0"
                                                name="quantity[]">

                                        </td>

                                        <td class="totals total0"></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button id="add-product" style="float:left; margin-top:10px;" class="btn btn-success">اضف
                                منتج أخر</button>

                        </div>


                        <div class="col-md-12">
                            <hr>
                            <div class="clear">
                                <button type="submit" class="btn btn-success">
                                    <i class="icon-check2"></i> {{ trans('admin.save') }}
                                </button>
                            </div>
                        </div>



                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

@endsection

<style>
    td,
    th {
        padding: 5px 5px !important;
    }

    .select2-container {
        font-size: 14px !important;
        text-align: right !important;
        ;
    }

    th {
        text-align: center;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background: #dff0d8 !important;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background: #f2dede !important;
    }
</style>
@section('script')
<script>
    $(document).ready(function(){
    i=0;

    $("#add-product").click(function(){
        i++;
    $(".productsadd").append('<tr> <td> <select style="width:250px;" name="product[]" class="form-control selectproduct selectproducted" data-number="'+i+'" required> <option value="">اختر المنتج</option> @foreach($products as $product) <option data-price="{{$product->price}}" data-unit="{{$product->unit_1}}"  data-quantity="{{$product->quantity}}" value="{{ $product->id }}">{{ $product->name }}</option> @endforeach </select> </td> <td class="unit'+i+'"> </td> <td> <input type="number"  value="1" placeholder="السعر" min="1" class="form-control productquantity price'+i+'" name="price[]"> </td> <td> <input type="number"  value="" placeholder="الخصم" min="1" class="form-control productquantity" name="discount[]"> </td> <td> <input type="number"  value="1" placeholder="الكميه" min="1" class="form-control productquantity" name="quantity[]"> </td> </tr>');

    $('.selectproduct').select2();
    return false;
    })

    $(".productquantity").keyup(function(){


    })

    $('.selectproduct').select2();


    $(document).on('change','.selectproducted',function(){
    num=$(this).data('number');
    price=$(this).find(':selected').data('price');
    unit=$(this).find(':selected').data('unit');

    $('.unit'+num).html("<span style='display:block;margin-top: 4px;' class='unitpro'>"+unit+"</span>");
    $('.price'+num).val(price);
    })

    })
</script>

@endsection