<div class="tab-pane fade" id="menu5">
    <div class="row">
        <div class="col-md-12">

            @if(isset($product) && $attachments[0] != "")
                @foreach($attachments as $key=>$filename)
                    <input id="file{{ $key }}" type="hidden" name="attachments_edit[]" value="{{ $filename }}">
                    <input id="file{{ $key }}_name" type="hidden" name="attachment_names[]"
                        value="{{ $attachment_names[$key] }}">
                @endforeach
            @endif


            <div id="filesinput" class="form-group">
                <label for="title">المرفقات </label><br>
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::text("attachment_names[]", "", [
                        "class" => "form-control",
                        "placeholder" => "اسم المستند",
                        ]) !!}
                    </div>
                    <div class="col-md-4">
                        <input accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf" type="file"
                            name="attachments[]">
                    </div>
                    <div class="col-md-2">
                        <button id="addinputf" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <br>
            </div>

            @if(isset($product) && $attachments[0] != "")
                @foreach($attachments as $key=>$filename)
                    <a href="{{ url('/') }}/uploads/products-attachments/{{ $filename }}"
                        class="file{{ $key }}" download><span
                            style="color:#000; margin-left: 10px;">{{ $attachment_names[$key] }}: </span>
                        {{ $filename }} </a>
                    <i id="btu-file{{ $key }}" style="color:red" class="fa fa-times clickrem"></i>
                    <br>
                @endforeach
            @endif

        </div>
    </div>
</div>
