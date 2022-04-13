<?php
/**
* Get value of the admin input
*
* @return string value of input
*/
if(! function_exists('checkVar')){
	function checkVar($method, $var, $lang, $name, $old)
	{
		if($method == 'create'){
			$return = null;
		}elseif ($method == 'edit') {
			$return = isset($var->langWith($lang)->$name) ? $var->langWith($lang)->$name : '';
			$return = old($old, $return);
		}else{
			$return = null;
		}
		return $return;
	}
}

/**
* Get alt or image value
*
* @return string image value (alt or image)
*/
/**
* Get Date Content (modules)
*
* @return string content value
*/
if(! function_exists('getDataContent')){
	function getDataContent($data, $for, $lang)
	{
		return isset($data[$for][$lang][0]) ? $data[$for][$lang][0] : '';
	}
}