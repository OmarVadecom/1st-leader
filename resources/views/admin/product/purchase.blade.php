@extends($pLayout. 'master')
@section('content')
<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">شراء منتج
                    </h4>
                </div>
                {!! Form::open([
                'url' => route('purchases.product'),
                'method', 'POST',
                ]) !!}
                <div class="card-body">
                    <div class="card-block">
                        <div class="col-md-6">
                            <div class="form-group productsadd">
                                <label for="title">المنتج</label>
                                <select id="chooseprod" name="product" class="form-control" required>
                                    <option value="">اختر المنتج</option>
                                    @foreach($products as $product)
                                    <option data-quantity="{{$product->quantity}}"
                                        data-purchase="{{$product->purchase}}" value="{{ $product->id }}">{{
                                        $product->name }}</option>
                                    @endforeach
                                </select>
                                <a href="{{url('/')}}/product/create">منتج جديد</a>
                            </div>
                        </div>
                        <div class="col-md-6 chooseoption">
                            <div class="form-group">
                                <label for="title" style="color:red">هذا المنتج ليس له كميه من قبل هل تريد اضافه كميه
                                    افتراضيه؟</label><br>
                                <label><input type="radio" value="default" name="qunatityrad" checked> كميه افتراضيه
                                </label><br>
                                <label><input type="radio" value="purchase" name="qunatityrad"> شراء منتج </label><br>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group productsadd">
                                <label for="title">الكميه</label>

                                <input type="number" value="1" placeholder="الكميه" min="1"
                                    class="form-control productquantity" name="quantity">
                            </div>
                        </div>
                        <button type="submit" style="float:left; margin-top:10px;" class="btn btn-success">شراء
                            منتج</button>

                    </div>

                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    </div>
</section>

<style>
    .chooseoption {
        display: none;
    }
</style>
@endsection
@section('script')
<script>
    $("#chooseprod").change(function(){
    if($(this).find(':selected').data('quantity') || $(this).find(':selected').data('purchases')){
        $(".chooseoption").hide('slow');
    }else{
        $(".chooseoption").show('slow');
    }
})
</script>
@endsection
