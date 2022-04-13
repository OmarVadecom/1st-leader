<div class="tab-pane fade" id="menu3">

    <div class="col-md-12">
      <table class="table table-striped" style="text-align:center">
        <thead>
          <tr>
            <th style="width:40%">الماده</th>
            <th style="width:40%">الكميه</th>
            <th style="width:20%">اجباريه</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="productsadd">
          <div class="form-group ">
            @if(isset($productssssssssssssss))
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
                  <option value="{{ $prod->id }}" {{($prod->id == $singleproduct->id) ? 'selected' : ''}}>
                    {{ $prod->code }} | {{ $prod->name }}</option>
                  @else
                  <option value="{{ $prod->id }}">
                    {{ $prod->code }} | {{ $prod->name }}</option>
                  @endif
                  @endforeach
                </select>
              </td>
              <td>
                <input type="number" value="{{$quantities[$key]}}" placeholder="الكميه" min="1"
                  class="form-control productquantity" name="quantity[]">

              </td>
              <td>
                <div class="checkbox">
                  <input type="hidden" name="group_status[{{$key}}]" value="" />
                  <label><input type="checkbox" name="group_status[{{$key}}]"
                      {{($group_statuss[$key]==1) ? 'checked' : ''}}> اجباريه </label>
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
                  <option value="{{ $product->id }}">{{ $product->code }} | {{ $product->name }}
                  </option>
                  @endforeach
                </select>
              </td>
              <td>
                <input type="number" value="1" placeholder="الكميه" min="1" class="form-control productquantity"
                  name="quantity[]">
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
      <button id="add-product-1" style="float:left; margin-top:10px; margin-bottom:10px;" class="btn btn-success">اضف منتج أخر</button>
    </div>
    <br>
    <div class="col-md-4">
        <label for=""> نظام الاحتساب </label>
        <select name="" class="form-control" id="">
            <option value=""> نظام الاحتساب </option>
            <option value="1">في حاله البيع</option>
            <option value="0">في حاله الشراء</option>
                    </select>
    </div>
    <div class="col-md-4">
        <label for="">حاله اجره التجميع</label>
        <select name="" class="form-control" id="">
<option value="">حاله اجره التجميع</option>
<option value="1">نعم</option>
<option value="0">لا</option>
        </select>
    </div>

    <div class="col-md-4">
        <label for="">اجره التجميع </label>

        <input type="text" class="form-control" placeholder="اجره التجميع" name="" id="">
    </div>
  </div>