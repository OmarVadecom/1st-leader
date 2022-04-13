<div class="tab-pane fade" id="menu17">
    <h5 style="text-align:center; margin-bottom:15px;"> المكافئات</h5>
    <div class="col-md-1">
    </div>
    <div class="col-md-8">
      <div id="addproductsin" class="form-group">
        @if(isset($descriptions))
        @foreach($descriptions as $description)
        {!! Form::text("description[]", $description, [
          "class" => "form-control",
          "placeholder" => 'معلومات المنتج',
          ]) !!}<br>
        @endforeach
        @else
    <select name="products_in[]" class="form-control tagsadd" id="">
        <option value="">اختر المنتج</option>
    @foreach($products as $product)
    <option value="{{$product->id}}">{{$product->name}} | {{$product->code}} </option>
    @endforeach
    
    </select>
        @endif
        <br>
      </div><!-- /.form-group -->
    </div>
    <div class="col-md-3">
      <button id="add-pro-in" style="float: left;" class="btn btn-success">اضافه منتج اخر</button>
    </div>




    <div class="card-body collapse in">
        <div class="card-block card-dashboard">
            <table class="table table-striped table-bordered " id="data" style="width:100%;">
             <thead>
                <tr>
                    <th>رقم القطعه</th>
                    <th>اسم القطعه</th>
                    <th>السعر </th>
                    <th>الشركه </th>
                    <th>بلد المنشأ  </th>
                    <th>بلد التصنيع  </th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th>رقم القطعه</th>
                    <th>اسم القطعه</th>
                    <th>السعر </th>
                    <th>الشركه </th>
                    <th>بلد المنشأ  </th>
                    <th>بلد التصنيع  </th>
                </tr>
            </tfoot>
            </table>
        </div>
    </div>





</div>