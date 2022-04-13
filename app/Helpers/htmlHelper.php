<?php

/***** Admin *****/

/**
* Check if the given var = given value
*
* @return string active var
*/
if(! function_exists('getActiveByVar')){
  function getActiveByVar($var, $value, $default = 'active')
  {
    return isset($var) ? ($var == $value ? $default : '') : '';
  }
}

/**
* Get action to ajax request but after check policy and array means that in this action remove this id
*
* @return void action
*/
if(! function_exists('getAjaxAction')){
  function getAjaxAction($policy = 'users.', $model, $show = null, $edit = null,  $delete = null, $array = ['edit' => [], 'show' => [],  'delete' => []])
  {
    $all = '';


       if(! in_array($model->id, $array['edit'])){
        if($edit != null){
        $all .= '<a href="' . $edit . '" class="btn btn-circle"><i class="icon-pencil3"></i></a> ';
        }
      }


      if(! in_array($model->id, $array['show'])){
        if ($show != null) {
           $all .= '<input class="urlLink" value="'.$show.'" type="hidden" />';
           $all .= '<a target="_blank" href="'. $show .'"  class="btn btn-circle showInfo" data-value="'.$show.'"><i class="icon-eye6"></i></a> ';
        }
      }



      if(! in_array($model->id, $array['delete'])){
        if ($delete != null) {
          $all .= '<a data-id="' . $delete . '" class="btn btn-circle" onclick="deleteOneItem(this);"  id=""><i class="icon-trash2"></i></a>';
        }
      }


     return $all;

  }
}

if(! function_exists('url_exists')){
    function url_exists($url) {
    if (!$fp = curl_init($url)) return false;
    return true;
}
}
/**
* get status active or inactive with html
*
* @return void status html
*/
if(! function_exists('getStatus')){
  function getStatus($var, $lang = null)
  {
   $out = '';
   $lan = $lang == null ? getCurrentLocale() : $lang;
   $active = trans('admin.active');
   $inactive = trans('admin.inactive', [], $lan);
   $act = trans('admin.active', [], $lan);
   if ($var == $active) {
      $out .= '<span class="tag tag-success">'. $act .'</span>';
   }else{
      $out .= '<span class="tag tag-danger">'. $inactive .'</span>';
   }
   return $out;
  }
}

/**
* get status of message read or unread with html
*
* @return void status html
*/
if(! function_exists('getMsgStatus')){
  function getMsgStatus($var, $id = null, $lang = null)
  {
   $out = '';
   $lan = $lang == null ? getCurrentLocale() : $lang;
   $active = trans('admin.read');
   $inactive = trans('admin.unread', [], $lan);
   $act = trans('admin.read', [], $lan);
   if ($var == $active) {
      $out .= '<span class="tag" id="message-'.$id.'">'. $act .'</span>';
   }else{
      $out .= '<span class="tag" id="message-'.$id.'">'. $inactive .'</span>';
   }
   return $out;
  }
}

/**
* Get select to the ajax request
*
* @return void input [checkbox]
*/
if(! function_exists('getSelectAjax')){
  function getSelectAjax($model)
  {
    $alls = '';
    $alls = '<input type="checkbox" class="checkSingle inline" name="del[]" value="'. $model->id .'">';
    return $alls;
  }
}

/**
* Create delete button but after check policy
*
* @return void delete btn
*/
function getDeleteOneBtn($route ='#', $policy)
{
  $out = '';
  if(Auth::user()->can($policy)){
    $out = '<a href="#" data-id="' . $route . '" class="btn btn-circle" onclick="deleteOneItem(this);"  id=""><i style="color: #FFF" class="icon-trash2"></i></a>';
  }
  return $out;
}

/**
* Create delete button but after check policy (For multi delete)
*
* @return void delete btn
*/
if(! function_exists('getDeleteBtn')){
  function getDeleteBtn($route = '#', $policy)
  {
   $out = '';
   if(Auth::user()->can($policy)){
   $out = '<li><a class="btn" data-url="'. $route .'" id="delete-btn"><i style="color: #FFF" class="fa fa-trash-o"></i></a></li>';
    }
   return $out;
  }
}

/**
* Create create button but after check policy
*
* @return void delete btn
*/

if(! function_exists('getCreateBtn')){
  function getCreateBtn($route = '#', $policy)
  {

   $out = '';
   $out = '<li><a class="btn " href="'. $route .'"><i style="color: #FFF" class="fa fa-plus"></i></a></li>';

   if(Auth::user()->can($policy)){
   $out = '<li><a class="btn " href="'. $route .'"><i style="color: #FFF" class="fa fa-plus"></i></a></li>';
    }
   return $out;
  }
}

/**
* Generate link a tag
*
* @return void html link
*/
if(! function_exists('getLinkTag')){
  function getLinkTag($route = '#', $title = 'link', $attr = null)
  {
   $att = '';
   if($attr != null && is_array($attr)){
      foreach ($attr as $value) {
        $att .= $value;
      }
   }
   $out = ' <a href="'. $route .'" '. $att .'>'. $title .'</a> ';
   return $out;
  }
}

/**
* Generate Span a tag
*
* @return void html span
*/
if(! function_exists('getSpanTag')){
  function getSpanTag($title = 'link', $attr = null)
  {
   $att = '';
   if($attr != null && is_array($attr)){
      foreach ($attr as $value) {
        $att .= $value;
      }
   }
   $out = '<span '. $att .'>'. $title .'</span>';
   return $out;
  }
}

if(! function_exists('flashMessage')){

function flashMessage($message, $type = 'success')
{
    session()->flash('flash_message', $message);
    session()->flash('flash_message_type', $type);
}
}
/**
* Get Main Page Meta tags
*
* @return void html tags
*/
if(! function_exists('getPageMetaTags')){
  function getPageMetaTags($title = null, $description = null ,$keywords = null, $image = null)
  {
   $out         = '';
   $title       = checkIfNullValue($title, trans('site.home'));
   $title       = getSettings() . ' | ' . $title;
   $keywords    = checkIfNullValue($keywords, getSettings('site_keys'));
   $description = checkIfNullValue($description, getSettings('site_desc'));
   $image       = url(checkIfNullValue($image, asset('site/img/logo.png')));
   $url         = url()->current();
   $out  .= '<title>' . $title . '</title>' . PHP_EOL;
   $out  .= '<meta name="description" content="'. $description .'" />' . PHP_EOL;
   $out  .= '<meta name="keywords" content="'. $keywords .'" />' . PHP_EOL;
   $out  .= '<meta name="author" content="'. getSettings() .'" />' . PHP_EOL;
   $out  .= '<meta property="og:title" content="'. $title .'" />' . PHP_EOL;
   $out  .= '<meta property="og:image" content="'. $image .'" />' . PHP_EOL;
   $out  .= '<meta property="og:url" content="'. $url .'" />' . PHP_EOL;
   $out  .= '<meta property="og:site_name" content="'. url('/') .'" />' . PHP_EOL;
   $out  .= '<meta property="og:description" content="'. $description .'" />' . PHP_EOL;
   $out  .= '<meta name="twitter:title" content="'. $title .'" />' . PHP_EOL;
   $out  .= '<meta name="twitter:image" content="'. $image .'" />' . PHP_EOL;
   $out  .= '<meta name="twitter:url" content="'. $url .'" />' . PHP_EOL;
   $out  .= '<meta name="twitter:card" content="'. $description .'" />' . PHP_EOL;
   $out  .= '<link rel="canonical" href="'. $url .'" />' . PHP_EOL;
   return $out;
  }
}
