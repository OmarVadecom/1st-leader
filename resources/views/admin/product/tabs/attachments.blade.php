<div class="tab-pane fade" id="menu5">
  <div class="row">
    <div class="col-md-12">
      <div id="filesinput" class="form-group">
        <label for="title">المرفقات </label><br>
        <div class="row">
          <div class="col-md-2">
            <select name="attachment_names[]" class="form-control" id="">
              <option value="">اختر التصنيف</option>
              @foreach($attachcats as $attachcat)
              <option value="{{$attachcat->name}}">{{$attachcat->name}}</option>
              @endforeach
            </select>
            <input type="hidden" name="counter[]" value="0">
          </div>
          <div class="col-md-4">
            {!! Form::text("attachment_links[]", "", [
            "class" => "form-control",
            "placeholder" => "لينك المستند",
            ]) !!}
          </div>
          <div class="col-md-2">
            <input accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file" name="attachments[]">
          </div>
          <div class="col-md-2">
            <label class="checkbox-inline"><input type="checkbox" name="attachment_status[]" value="1" checked> مفعل
            </label>
          </div>
          <div class="col-md-2">
            <button id="addinputf" class="btn btn-primary"><i class="fa fa-plus"></i></button>
          </div>
        </div>
        <br>
      </div>
      <div class="row">
        @if(isset($product))
        @if($attachments[0] != "" || $attachment_links[0] != "" || $attachment_names[0] != "")
        @foreach($attachments as $key=>$filename)
        @php
        $attach=\App\Models\AttachmentCat::Where('name',$attachment_names[$key])->first();
        if($attach){
        $attachimg=url('/').'/uploads/attachcat/'.$attach->image;
        }else{
        $attachimg=asset('panel/app-assets/images/emptyimg.jpg');
        }
        @endphp
        <div class="col-md-6 centeritems">
          <div class="col-md-3">
            <img src="{{$attachimg}}" alt="{{$attachment_names[$key]}}" style="width: 75px;padding: 6px;">
          </div>
          <div class="col-md-6">
            <select name="attachment_names[]" class="form-control" id="">
              <option value="">اختر التصنيف</option>
              @foreach($attachcats as $attachcat)
              <option value="{{$attachcat->name}}" {{($attachment_names[$key]==$attachcat->name) ? 'selected' : ''}}>
                {{$attachcat->name}}</option>
              @endforeach
            </select>
            @if($filename != "")
            <a href="{{url('/')}}/uploads/products-attachments/{{$filename}}" class="file{{$key}}" download>تحميل الملف</a><br>
            @endif
            @if(isset($attachment_links[$key]) && $attachment_links[$key] != "")
            <a href="{{$attachment_links[$key]}}" target="_blank">{{$attachment_links[$key]}}</a>
            @endif
            <select name="attachment_status[]">
              <option value="1" {{ (isset($attachment_status[$key])) ? $attachment_status[$key]==1 ? 'selected' : ''
                : 'selected' }}>مفعل</option>
              <option value="0" {{ (isset($attachment_status[$key])) ? $attachment_status[$key]==0 ? 'selected' : ''
                : 'selected' }}>غير مفعل</option>
            </select>

            <!-- <label class="checkbox-inline"><input type="checkbox" name="attachment_status[]" {{ (isset($attachment_status[$key])) ? $attachment_status[$key] == 1 ? 'checked' : '' : 'checked' }} value="1"> مفعل </label>-->

          </div>
          <div class="col-md-3">
            <i id="btu-file{{$key}}" style="color:red" class="fa fa-times clickrem"></i>
          </div>
          <input id="file{{$key}}" type="hidden" name="attachments_edit[]" value="{{$filename}}">
          {{-- <input id="file{{$key}}_name" type="hidden" name="attachment_names[]"
            value="{{$attachment_names[$key]}}">
          --}}
          <input id="file{{$key}}_link" type="hidden" name="attachment_links[]"
            value="{{isset($attachment_links[$key]) ? $attachment_links[$key] : ''}}">
        </div>




        @endforeach
        @endif
        @endif
      </div>
    </div>
  </div>
</div>