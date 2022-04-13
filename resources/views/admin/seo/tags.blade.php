@extends($pLayout. 'master')

@section('content')

<!-- File export table -->
<section id="file-export" >
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ trans('admin.get_meta') }}
                    </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in" style="min-height: 450px">
                    <div class="card-block card-dashboard">
                       <div class="input-group">
                        <span class="input-group-btn">
                            <a href="#" class="btn btn-primary" id="seo-action"><i class="fa fa-search"></i></a>
                        </span>
                        {!! Form::text('page',null, 
                        array('class'=>'form-control', 'id' => 'seo-page', 'required' => true)) !!}
                    </div>
                        <div class="col-xs-12" style="margin-top: 20px" id="seo-result"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection


@section('script')
<script type="text/javascript">
    $('#seo-action').on('click', function (e) {
        e.preventDefault();
        var page = $('#seo-page').val();

         $.ajax({
            type: 'get',
            url: "{{ route('admin.seo.tags') }}",
            data: { page:page },
            beforeSend: function(){
                $('#seo-page').html('<i class="fa fa-spinner fa-spin text-center" style="color: #000"></i>');
            },
            success: function (data) {
              $('#seo-result').html(data);
            },
            error: function (data) {
                alert('check your url and you connection.');
                $('#seo-page').html('');
            },
            fail: function (argument) {
                alert('ops, look like something happend !! try again.');
                $('#seo-page').html('');
            }
          });


    })
</script>
@endsection