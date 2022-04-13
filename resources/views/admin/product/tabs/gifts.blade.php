<div class="tab-pane  fade" id="menu8">
    <div class="col-md-12 addgift">
        @if(isset($gifts_ids))
        @foreach($gifts_ids as $key=>$gifts_id)
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label> الهديه</label>
                    <select name="gifts_ids[]" class="form-control" id="">
                        <option value=""> اختر الهديه</option>
                        @foreach($gifts as $gift)
                        <option value="{{$gift->id}}" {{($gift->id==$gifts_id) ? 'selected' : ''}}>{{$gift->name}}
                        </option>
                        @endforeach
                    </select>
                </div><!-- /.form-group -->
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label> الكميه</label>
                    {!! Form::number("gifts_quantities[]",$gifts_quantities[$key] , [
                    "class" => "form-control",
                    "placeholder" => "الكميه ",
                    ]) !!}
                </div><!-- /.form-group -->
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>لكل </label>
                    {!! Form::text("gifts_for[]", $gifts_for[$key] , [
                    "class" => "form-control",
                    "placeholder" => "الهديه لكل",
                    ]) !!}
                </div><!-- /.form-group -->

            </div>
            <div class="col-md-3">
                @if($key == 0)
                <button id="add-gift" style="float: left;margin-top: 24px;" class="btn btn-success">اضافه هديه
                    اخري</button>
                @endif
            </div>
        </div>
        @endforeach
        @else
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label> الهديه</label>
                    <select name="gifts_ids[]" class="form-control" id="">
                        <option value=""> اختر الهديه</option>
                        @foreach($gifts as $gift)
                        <option value="{{$gift->id}}">{{$gift->name}}</option>
                        @endforeach
                    </select>
                </div><!-- /.form-group -->
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label> الكميه</label>
                    {!! Form::number("gifts_quantities[]","" , [
                    "class" => "form-control",
                    "placeholder" => "الكميه ",
                    ]) !!}
                </div><!-- /.form-group -->
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>لكل </label>
                    {!! Form::text("gifts_for[]", "" , [
                    "class" => "form-control",
                    "placeholder" => "الهديه لكل",
                    ]) !!}
                </div><!-- /.form-group -->

            </div>
            <div class="col-md-3">
                <button id="add-gift" style="float: left;margin-top: 24px;" class="btn btn-success">اضافه هديه
                    اخري</button>
            </div>
        </div>
        @endif


    </div>


    <div class="card-body collapse in">
        <div class="card-block card-dashboard">
            <table class="table table-striped table-bordered " id="data" style="width:100%;">
                <thead>
                    <tr>
                        <th>رقم السند</th>
                        <th>التاريخ</th>
                        <th>نوع الهديه</th>
                        <th>الكميه</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <th>رقم السند</th>
                        <th>التاريخ</th>
                        <th>نوع الهديه</th>
                        <th>الكميه</th>
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