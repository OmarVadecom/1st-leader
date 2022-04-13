<div class="tab-pane  fade" id="menu9">
    <div class="col-md-12">
        <table class="table table-striped" style="text-align:center">
            <thead>
                <tr>
                    <th style="width:40%">الماده</th>
                    <th style="width:40%">الكميه</th>
                    <th style="width:20%">اجباريه</th>
                    <th>x</th>
                </tr>
            </thead>
            <tbody class="productsadd">
                <div class="form-group ">
                    @if(isset($productssss))
                        @foreach($productsgro as $key=>$productg)
                            @php
                                $singleproduct=\App\Models\Products::find($productg);
                            @endphp
                            <tr>
                                <td>
                                    <select style="width:350px;" name="product[]" class="form-control selectproduct">
                                        <option value="">اختر المنتج</option>
                                        @foreach($products as $prod)
                                            @if(isset($singleproduct))
                                                <option value="{{ $prod->id }}"
                                                    {{ ($prod->id == $singleproduct->id) ? 'selected' : '' }}>
                                                    {{ $prod->code }} | {{ $prod->name }}</option>
                                            @else
                                                <option value="{{ $prod->id }}">
                                                    {{ $prod->code }} | {{ $prod->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" value="{{ $quantities[$key] }}" placeholder="الكميه"
                                        min="1" class="form-control productquantity" name="quantity[]">

                                </td>
                                <td>
                                    <div class="checkbox">
                                        <input type="hidden" name="group_status[{{ $key }}]" value="" />
                                        <label><input type="checkbox" name="group_status[{{ $key }}]"
                                                {{ ($group_statuss[$key]==1) ? 'checked' : '' }}>
                                            اجباريه </label>
                                    </div>
                                </td>

                                <td>
                                    <i class="fa fa-times clickremrow"></i>
                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td>
                                <select style="width:350px;" name="" class="form-control selectproduct">
                                    <option value="">اختر المنتج</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->code }} |
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" value="1" placeholder="الكميه" min="1"
                                    class="form-control productquantity" name="">
                            </td>
                            <td>
                                <div class="checkbox">
                                    {{-- <input type="hidden" name="group_status[0]" value="" />
                <label><input type="checkbox" name="group_status[0]"> اجباريه </label> --}}
                                </div>
                            </td>
                            <td>
                                <i class="fa fa-times clickremrow"></i>
                            </td>
                        </tr>
                    @endif
                </div>
            </tbody>
        </table>
        <button id="add-product" style="float:left; margin-top:10px; margin-bottom:10px;" class="btn btn-success">اضف
            منتج أخر</button>

    </div>

    <div class="card-body collapse in">
        <div class="card-block card-dashboard">
            <table class="table table-striped table-bordered " id="data" style="width:100%;">
                <thead>
                    <tr>
                        <th>رقم السند</th>
                        <th>التاريخ</th>
                        <th>رقم الاستلام</th>
                        <th>اسم الفني</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> سند تركيب 12</td>
                        <td>20/02/2020</td>
                        <td>9</td>
                        <td> محمد</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>رقم السند</th>
                        <th>التاريخ</th>
                        <th>رقم الاستلام</th>
                        <th>اسم الفني</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>



</div>
@section('script')
<script type="text/javascript">
    // 	$(document).ready(function() {
    //     $('#data').DataTable( {
    //         "processing": true,
    //             "language": {
    //             "sUrl": lang
    //         },
    //         "ordering": true,
    //         "pagingType": "full_numbers",
    //             aLengthMenu: [
    //                 [25, 50, 100, 200, -1],
    //                 [25, 50, 100, 200, "All"]
    //             ],
    //             iDisplayLength: 25,
    //         "fixedHeader": true,
    //         "responsive": true,
    //         "ajax": "{{ route('admin.product.ajax') }}",
    //         "columns": [
    //            {data: 'select', name: ''},
    //            {data: 'title', name: 'title'},
    //            {data: 'status', name: 'status'},
    //            {data: 'action', name: ''}
    //         ],

    //     });
    // });

</script>
@endsection
