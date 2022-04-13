<section id="file-export">
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        {{ trans('admin.filter') }}
                    </h4>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block card-dashboard">
                        <form action="{{ route('page.index') }}" method="get">
                            <div class="col-xs-3">
                                <label for="slug">{{ trans('admin.slug') }}</label>
                                <input type="text" class="form-control" name="slug" placeholder="{{ trans('admin.slug') }}" value="{{ request()->slug }}">
                            </div>

                            <div class="col-xs-3">
                                <label for="title">{{ trans('admin.title') }}</label>
                                <input type="text" class="form-control" name="title" placeholder="{{ trans('admin.title') }}" value="{{ request()->title }}">
                            </div>

                            <div class="col-xs-3">
                                <label for="status">{{ trans('admin.status') }}</label>
                                <select name="status" class="form-control">
                                    <option value="">{{ trans('admin.status') }}</option>

                                    <option value="1" @if(request()->status == 1) selected @endif>{{ trans('admin.active') }}</option>

                                    <option value="0" @if(request()->status == '0' && request()->status != '') selected @endif>{{ trans('admin.inactive') }}</option>
                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label for="status">{{ trans('admin.category') }}</label>
                                {!! Form::select('category_id', $cats,request()->category_id ,array('class'=>'form-control')) !!}
                            </div>

                            <div class="col-xs-12 text-center" style="margin-top: 10px">
                                 <button type="submit" class="btn btn-primary text-center">
                                 <i class="fa fa-search"></i> {{ trans('admin.search') }}
                               </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>