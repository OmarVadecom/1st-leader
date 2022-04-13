 $('#add-module').on('click', function(){
    var mod = $('#select-module').val();
    var title = $('#select-module').find("option:selected").text();
    if(mod != ''){
        $.ajax({
        type: 'get',
        url: links_array['get_module'],
        data: {
          'mod': mod
        },
        beforeSend: function (argument) {
         // obj.innerHTML = "<i class='fa fa-spinner fa-spin'>";
        },
        success: function (data) {

          $('#put-model-data').append(getModultLayout(data, title));
          loadEditor();
        }
      });
    }
   });

   $('#add-package_cat').on('click', function(){
    var package = $('#packagecat').val();
    var title = $('#packagecat').find("option:selected").text();
    $('#put-model-data').append(getpackagecarLayout(package, title));
  });

  $('#add-package').on('click', function(){
    var package = $('#packagesres').val();
    var title = $('#packagesres').find("option:selected").text();
    $('#put-model-data').append(getpackageLayout(package, title));
  });
function getModultLayout(data, title) {
          var out = '';
          var num = getRandomInt(9999999999);
          out = '<div class="sort-scroll-element" id="mod-'+num+'"> <div id="heading'+ num +'"  class="card-header">';
          out += '<span onclick="deleteThis('+num+');"><span><i class="fa fa-times"></i></span></span><a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion'+num+'" aria-expanded="true" aria-controls="accordion'+num+'" class="card-title lead">'+ title +'</a>';
          out += '   <span class="sort-scroll-button-up"><i class="fa fa-arrow-up"></i></span>    <span class="sort-scroll-button-down"><i class="fa fa-arrow-down"></i></span>';
          out += '</div>';
          out += '<div id="accordion'+num+'" role="tabpanel" aria-labelledby="heading'+num+'" class="card-collapse collapse in" aria-expanded="true">';
          out += '<div class="card-body">';
          out += '<div class="card-block">';
          out += data;
          out += '</div></div></div></div>';
          return out;
}


function getpackagecarLayout(package, title) {
  var out = '';
  var num = getRandomInt(9999999999);
  out = '<div class="sort-scroll-element" id="mod-'+num+'"> <div id="heading'+ num +'"  class="card-header">';
  out += '<span onclick="deleteThis('+num+');"><span><i class="fa fa-times"></i></span></span><a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion'+num+'" aria-expanded="true" aria-controls="accordion'+num+'" class="card-title lead">Package_Category-'+ title +' </a>';
  out += '   <span class="sort-scroll-button-up"><i class="fa fa-arrow-up"></i></span>    <span class="sort-scroll-button-down"><i class="fa fa-arrow-down"></i></span>';
  out += '</div>';
  out += '<div id="accordion'+num+'" role="tabpanel" aria-labelledby="heading'+num+'" class="card-collapse collapse in" aria-expanded="true">';
  out += '<div class="card-body">';
  out += '<div class="card-block">';
  out += '<input type="hidden" value='+package+' name="mod['+num+'][packagecatid][id][]"> ';
  out += '<input type="hidden" value="'+title+'" name="mod['+num+'][packagecattitle][id][]"> ';
  out += '</div></div></div></div>';
  return out;
}


function getpackageLayout(package, title) {
  var out = '';
  var num = getRandomInt(9999999999);
  out = '<div class="sort-scroll-element" id="mod-'+num+'"> <div id="heading'+ num +'"  class="card-header">';
  out += '<span onclick="deleteThis('+num+');"><span><i class="fa fa-times"></i></span></span><a data-toggle="collapse" data-parent="#accordionWrapa1" href="#accordion'+num+'" aria-expanded="true" aria-controls="accordion'+num+'" class="card-title lead">Package_'+ title +' </a>';
  out += '   <span class="sort-scroll-button-up"><i class="fa fa-arrow-up"></i></span>    <span class="sort-scroll-button-down"><i class="fa fa-arrow-down"></i></span>';
  out += '</div>';
  out += '<div id="accordion'+num+'" role="tabpanel" aria-labelledby="heading'+num+'" class="card-collapse collapse in" aria-expanded="true">';
  out += '<div class="card-body">';
  out += '<div class="card-block">';
  out += '<a style="text-align: center; display: block; padding-top: 25px; color: blue;" class="packagelink" href="/vc-admin/packages/'+package+'/edit" target="blank"> Edit - "'+title+'" </a>';
  out += '<div class="card-block"><input type="hidden" value='+package+' name="mod['+num+'][packageid][id][]"> ';
  out += '<input type="hidden" value="'+title+'" name="mod['+num+'][packagetitle][id][]"> <div class="col-md-8"><select name="mod['+num+'][packagetype][id][]" class="form-control"><option value="">Choose Style</option><option value="p_1" selected="">Style 1</option><option value="p_2">Style 2</option><option value="p_3">Style 3</option><option value="p_4">Style 4</option><option value="p_5">Style 5</option></select></div><div class="col-md-4"><a href="/vc-admin/package-samples" class="packagelink" target="blank">See Samples</a></div> ';
  out += '</div></div></div></div></div>';
  return out;
}
  $('.head-mod').on('click', function(){
    var id = $(this).attr('data-id');
    $('.head1').remove();
    $('#accordion'+id).remove();
   });

  $('.delete-mod').on('click', function(){
    var id = $(this).attr('data-id');
    $('#mod-'+id).remove();
   });

function deleteThis(id){
  $('#mod-'+id).remove();
}

