@extends($pLayout. 'master')
@section('content')
@php
$last_id = $entry->id;
$last_id=str_pad($last_id, 4, '0', STR_PAD_LEFT);
$last_id = 'ENT-'.$last_id;
@endphp
<section id="justified-top-border">
  <div class="row match-height">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">
            تعديل ادخال {{$last_id}}
            <span class="pull-left">
            </span>
          </h4>
        </div>
        {!! Form::model($entry ,[
        'method' => 'PATCH',
        'route' => ['supplies.update', $entry->id],
        'files' => true
        ])
        !!}
        <input type="hidden" value="{{ $entry->id }}" name="id">
        <div class="card-body">
          <div class="card-block">

            @include('admin.supplies.form')

          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section>
@endsection

@section('script')
<script>
  $(document).on('change','.select-stock',function(){
		var selected_id = $(this).children("option:selected").val();
      $.ajax({
            dataType: "json",
            url: "{{route('admin.supplies.get_warehouses')}}",
            data: {
                'stock_id': selected_id,
            },
            success: function(data) {
              $(".warehouse").empty();
              $(".warehouse").append('<option value="">اختر المستودع</option>');
                for (var i = 0; i < data.length; i++) {
                   $(".warehouse").append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
                }
            }
        });
    });
</script>
@endsection