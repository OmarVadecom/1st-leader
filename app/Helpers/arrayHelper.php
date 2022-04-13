<?php

/**
* get avaliable role control
*
* @return array | string (if key not null)
*/
if(! function_exists('admin_roles')){
	function admin_roles($key = null)
	{
		$array = [
			trans('admin.user'),
			trans('admin.admin')
		];
		return $key == null ? $array : (array_key_exists($key, $array) ? $array[$key] : $key);
	}
}

/**
* show all avalibale permissions
*
* @return array | string (if key not null)
*/
if(! function_exists('admin_permissions')){
	function admin_permissions($key = null)
	{
		$array = [
		    'settings',
		    'sliders',
		    'menus',
		    'pages',
		    'product-categories',
			'products',
			'page-categories',
			'contacts',
			'roles',
			'users',
			'socials',
		];
		return $key == null ? $array : (array_key_exists($key, $array) ? $array[$key] : $key);
	}
}

/**
* check if user has permission to go
*
* @return boolean permission
*/
if(! function_exists('check_permissions')){
	function check_permissions($user, $permission)
	{
		if(isset($user->role) && isset($user->role->permissions)){
			foreach ($user->role->permissions as $key => $perm) {
				if($perm->id == $permission){
					return true;
				}
			}
		}
		return false;
	}
}

/**
* get all important page
*
* @return array | string (if key not null)
*/
if(! function_exists('important_pages')){
	function important_pages($key = null)
	{
		$array = [
			'404' => 'admin.errors.404',
			'403' => 'admin.errors.403',
		];
		return $key == null ? $array : (array_key_exists($key, $array) ? $array[$key] : $key);
	}
}

/**
* get all Modules
*
* @return array | string (if key not null)
*/


/**
* get all Target Link
*
* @return array | string (if key not null)
*/
if (! function_exists('targets')) {
	function targets($key = null)
	{
		$array = [
			'_self'  => trans('admin.self_target'),
			'_blank' => trans('admin.blank_target')
		];

		return $key == null ? $array : (array_key_exists($key, $array) ? $array[$key] : '----');
	}
}


if(! function_exists('linkMethods')){
	function linkMethods()
	{
		return [
			'home'	=> trans('admin.homeWeb'),
			'page'  => trans('admin.page'),
			'product'  => trans('admin.product'),
			'products'  => trans('admin.products'),
			'link'  => trans('admin.transferLink'),
		];
	}
}

if(! function_exists('linkRef')){
	function linkRef($key = null)
	{
		$array = [
			'home' => url('/'),
			'page' => url(''),
			'product' => url('/products/'),
			'products' => url('products'),
			'link' => 'http://',
		];
		return $key == null ? $array : (array_key_exists($key, $array) ? $array[$key] : '----');
	}
}