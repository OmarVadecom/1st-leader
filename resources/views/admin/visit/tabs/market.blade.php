<div class="tab-pane " id="menu4">
    <div class="row">
        <div class="row bordered aligned-row">

            <div class="col-md-2" style="background: orange">
                <div class="center">الرئيسيه</div>
            </div>
            <div class="col-md-10">
                <table class="table table-striped" style="text-align:center">
                    <thead>
                        <tr>
                            <th width="30%">الماركه</th>
                            <th width="30%">النوع</th>
                            <th width="30%">الموديل</th>

                        </tr>
                    </thead>
                    <tbody class="marketadd">

                        @if(isset($visit))

                        @foreach($marketbrand as $key=>$markebrand)
                        <tr>
                            <td>
                                <input type="text" value="{{$markebrand}}" placeholder="الماركه" class="form-control"
                                    name="market_brand[]">
                            </td>

                            <td>
                                <input type="text" value="{{$markettype[$key]}}" placeholder="النوع"
                                    class="form-control" name="market_type[]">
                            </td>
                            <td>
                                <input type="text" value="{{$market_model[$key]}}" placeholder="الموديل"
                                    class="form-control" name="market_model[]">
                            </td>
                            <td>
                                <i class="fa fa-times clickremrow"></i>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>
                                <input type="text" placeholder="الماركه" class="form-control" name="market_brand[]">
                            </td>

                            <td>
                                <input type="text" placeholder="النوع" class="form-control" name="market_type[]">
                            </td>
                            <td>
                                <input type="text" placeholder="الموديل" class="form-control" name="market_model[]">
                            </td>
                            <td>
                                <i class="fa fa-times clickremrow"></i>
                            </td>
                        </tr>
                        @endif


                    </tbody>
                </table>
                <button id="add-market" style="float:left; margin-top:10px;" class="btn btn-success">اضف ماركه
                    اخري</button>



            </div>

        </div>








    </div>
</div>