@extends($pLayout. 'master')
@section('content')
  <section id="justified-top-border">
  	<div class="row match-height">
  		<div class="col-xs-12">
  			<div class="card">
  				<div class="card-header">
  					<h4 class="card-title">ارساله رساله</h4>
  				</div>
          {!! Form::open([
              'url' => route('admin.msg.send'),
              'method', 'POST'
              ]) !!}
             <div class="card-body">
              <div class="card-block">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">أختر العميل</label>
                                <select name="user_id" class="form-control" required>
                                    <option value="">أختر العميل</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    <div class="col-md-6">
             <div class="form-group">
              <label for="title">الرساله</label>
                                    <br>
                <textarea name="message" class="form-control"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                    <i class="icon-check2"></i> ارسال
                </button>
    {!! Form::close() !!}
        </div>
    </div>
</div>
</section>
@endsection