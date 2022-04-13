/* Check All  */
$(".checkedAll").change(function(){
  if(this.checked){
    $(".checkSingle").each(function(){
      this.checked=true;
    })
  }else{
    $(".checkSingle").each(function(){
      this.checked=false;
    })
  }
});
/* End Check All */

/* Delete one Ajax */
function deleteOneItem(obj) {
 var d = confirm(delMsg);
 var url = obj.getAttribute("data-id");
 if (d == true) {
   $.ajax({
    type: 'post',
    url: url,
    data: {
      '_token': token,
      '_method': 'DELETE'
    },
    beforeSend: function (argument) {
      obj.innerHTML = "<i class='fa fa-spinner fa-spin'>";
    },
    success: function () {
      location.reload();
    }
  });
 }
}
/* End Delete One */

/* Show Item */
function showInfoFun(valu) {
 var link = $('.urlLink').val();
 loadShowData(valu, link);
 $('.infoMod').modal();

}

function loadShowData(v,link){
  var loading = "<i class='fa fa-spinner fa-spin'></i>";
  $.ajax({
    type: 'get',
    url: link,
    data: { id:v },
    beforeSend: function(){

      $('.userInfo-body').html("<dev class='text-center'><h3 class='text-center' style='text-align:center'>"+ loading +"</h3></div>");
    },
    success: function (data) {

      $('.userInfo-body').html(data);


    }
  });
}
/* End show Item */

/* Check New */
$('.checkbtnC').vSwitch({theme: 'blue'});
/* End Check New */

/* Change Password */
function changePass () {
  $('.changePass').modal();
}
function updatePassRequest (element, msg) {
  var url = element.getAttribute('data-url');
  $.ajax({
    type: 'post',
    url: url,
    data: {
      '_token': token,
      'password': $('#password').val(),
      'id': $('#id').val()
    },
    beforeSend: function(){
      $('.load').show();
      $('.load').html("<h3 style='margin-top:50px' class='text-center'>"+ load +"</h3>");
    },
    success: function (data) {
      if(data == 'done'){
        $('.load').hide();
        $('.errors').removeClass('alert alert-danger');
        $('.errors').addClass('alert alert-success');
        $('.errors').fadeIn();
        $('.errors').text(msg);
      }else{
        $('.load').hide();
        $('.errors').removeClass('alert alert-success');
        $('.errors').addClass('alert alert-danger');
        $('.errors').fadeIn();
        $('.errors').text(data.errors['password'][0]);
      }



    }
  });
}
  /* End change password */

  /* Multi deletes */
  $('#delete-btn').on('click', function(e){
    e.preventDefault();
    var url =$(this).attr('data-url');
    if(confirm(delMsg)){
        var multiId = [];
        $('.checkSingle:checked').each(function(i){
                multiId[i] = $(this).val();
          });
        if(multiId.length === 0){
            alert(pickSome);
        }else{
            multiDelete(multiId, url);
        }
    }
});

  function multiDelete (vals, url) {
   // var btnHtml = $('delete-btn').html();
    $.ajax({
        type: 'post',
         url: url,
          data: {
            '_token': token,
            'id': vals
          },beforeSend: function (){
            $('#delete-btn').html(load);
          },
          success: function (data) {

            location.reload();

        },
    });
  }
  /* End multi deletes */

  /* Pin pages in dashboard */
   function pinPage (id) {
    $.ajax({
        type: 'post',
         url: links_array['pin_page'],
          data: {
            '_token': token,
            'id': id
          },
          beforeSend: function (){

          },
          success: function (data) {
            if(data == '1'){
              $('#pin-'+id).html('<i class="fa fa-ellipsis-h" aria-hidden="true"></i>');
            }else{
              $('#pin-'+id).html('<i class="fa fa-ellipsis-v" aria-hidden="true"></i>');
            }
           createSuccessAlert(messagePin);
        },
    });
  }
  /* End Pin pages in dashboard */

  /* Start Check Slug */
  function slugChecker(field,check, code) {
    var inputVal = $('#'+code).val();
    $.ajax({
        type: 'post',
         url: slugUrl,
          data: {
            '_token': token,
            'check': check,
            'word': field.value,
          },beforeSend: function (){
            $('#'+code).val(inputVal+'...');
          },
          success: function (data) {
           $('#'+code).val(data);
        },
    });
  }
/* End check slug */

  /* Start Write A link */
  function writeAlink() {
      var link_method_input = $('.link_method').val();
      $('.link-prev').text(method[link_method_input]);
      $('#link-place').text($('.link-input').val());
  }

  function getLinkFromType(select){
    var type = select.value;
    type == 'link' ?
      $('select[name=target]').val('_blank')
    : $('select[name=target]').val('_self');
    if(type == 'product'){
      $('#menu-modal').modal('toggle');
      getMenuContent('product');
    }
    if(type == 'page'){
      $('#menu-modal').modal('toggle');
      getMenuContent('page');
    }
    writeAlink();
  }

/* End write a link */

/* Start update message */
function updateStatus(v,link,text){
  $.ajax({
    type: 'get',
    url: link,
    data: { id:v },
    beforeSend: function(){
    },
    success: function (data) {
      $('.message-content').html(data);
      $('#message-'+v).removeClass('tag-danger').addClass('tag-success').text(text);
    }
  });
}
/* End update message */

/* Start update message */
function getMenuContent(v){
  $.ajax({
    type: 'get',
    url: links_array['get_menu_content'],
    data: { type:v },
    beforeSend: function(){
      $('#menu-content').html('<div class="col-md-12 text-center">...</div>');
    },
    success: function (data) {
      $('#menu-content').html(data);
    }
  });
}
/* End update message */

/* Generate random integer number with limit from 0 to given max */
function getRandomInt(max) {
  return Math.floor(Math.random() * Math.floor(max));
}

$('#meta-image').on('click', function(){
  $('.meta-image-content').fadeToggle();
});

function convertToSlug(Text)
{
  var array = ['!', '@', '#', '$', '%', '^', '*', '(', ')', '~', ':', '?', '؟', '/', '\\', '{', '}'];
  var str = Text.toLowerCase().replace(/ +/g,'-');
   for(i=0; i < array.length; i++){
                    str = str.replace(array[i],'');
                }
  return str;
}

$('.menu-setter').on('click', function (e) {
  e.preventDefault();
  var urlL = $(this).attr('data-url');
  $('.link-input').val(urlL);
  $('#menu-modal').modal('hide');
});

$('.pin-page').on('click', function (e) {
  var id = $(this).attr('data-id');
  pinPage(id);
});

function createSuccessAlert(m) {
  var rand = getRandomInt(55555);
  var id   = 'alert-'+rand;
  var out = '<li class="alerts-ajax" id="'+id+'" style="width: 250px;border: 1px solid #c4e2cd;background: #99e2afd1;color: #ffffff;padding: 10px;z-index: 999999;box-shadow: black;margin-top: 10px">';
      out += '<i class="fa fa-check-circle text-green"></i>';
      out += m;
      out += '</li>';
      $('#alert-ajax-url').append(out);
      setInterval(function(){
      $('#'+id).remove();
    },5000);
}
