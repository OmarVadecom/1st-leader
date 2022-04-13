    <div class="app-content content container-fluid">
    	<div class="content-wrapper">
    		{{-- <div class="content-header row">
    			@if(isset($act) && in_array($act, ['edit', 'create']))
    			<div class="col-xs-6" style="margin-bottom: 20px">
    				<div class="input-group">
    					<span class="input-group-btn">
    						<a id="lfm" data-input="thumbnail" style="color: #FFF" data-preview="holder" class="btn btn-primary">
    							<i class="fa fa-picture-o"></i> {{ trans('filemanger.filemanger') }}
    						</a>
    					</span>
    					{!! Form::text('image-test',null, 
    					array('class'=>'form-control copyTarget', 'id' => 'thumbnail', 'readonly' => 'true', 'style' => 'display:none')) !!}
    				</div>
    			</div>
    			<div class="col-xs-6 target-button-area" style="margin-bottom: 20px; display: none;">
    				<button id="copyButton" class="btn btn-success" title="copy"><i class="fa fa-copy"></i></button>
    			</div>
    			@endif
    		</div> --}}
    		<div class="content-body"><!-- stats -->
    			@yield('content')

                <ul style="position: absolute;top: 25%;" id="alert-ajax-url">
                </ul>
              
    		</div>
    	</div>
    </div>

