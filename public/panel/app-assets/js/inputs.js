function stripHTML(dirtyString) {
    var rex = /(<([^>]+)>)/ig;
  var content = dirtyString.replace(rex , "")
  return content; // innerHTML will be a xss safe string
}

/* keywords */
function tranferKeywords(input, code) {
	var content = CKEDITOR.instances[input].getData();
	if (content != '') {
		content = $(content).text().trim();
		content = content.replace(/\s/g,',').replace(/,,/g,'');
		$('#keywords'+code).val(content);
	}else{
		alert(pickSome);
	}
}
/* description */
function tranferDescription(input, code, limit) {
	var content = CKEDITOR.instances[input].getData();
	if (content != '') {
		content = $(content).text().trim().substring(0,limit);
		$('#description'+code).val(content);
	}else{
		alert(pickSome);
	}
}

/* Get value of role */
function getRoles(value) {
    value == 1 ? $('.role-group').fadeIn() : $('.role-group').fadeOut();
  }

/* Make textarea edior with ajax */
function loadEditor() {
    $('.editor-ajax').each(function()
    {
         var __main = $(this);
         var __editorName = __main.attr('id');
         var editor = CKEDITOR.instances[__editorName];
         if (!editor) { 
          CKEDITOR.replace(__editorName); // ADD THIS
          }
          //$(__editorName).CKEDITOR();
    });
          
 }

/* Copy from Text */
function copyToClipboard(element) {
    /* Get the text field */
  var copyText = element;
  if(copyText.val() != ''){
  	  /* Select the text field */
	  copyText.select();

	  /* Copy the text inside the text field */
	  document.execCommand("copy");
  }
  else{
  	alert('not allowed');
  }
}

$('.slugable').on('change', function(){
  var txt = $(this).attr('data-slug');
  var checked = $('#check-slug').is(":checked");
  if(! checked){
    $('#slug-'+ txt).val(convertToSlug($(this).val()));
  }
});

$('#check-slug').on('change', function() {
  var checked = $(this).is(":checked");
  if(checked){
    $('input[name=slug]').prop("readonly", true);
  }else{
    $('input[name=slug]').prop("readonly", false);
  }
});

$('#thumbnail').on('change', function () {
 var count_image = $('.image-type').size();
 var image       = $(this).val();
 if(count_image == 1){
  if(image != ''){
   $('.image-type').val(image);
  }
 }
});