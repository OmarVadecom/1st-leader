<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
	public function getView($view, $policy, $array = null, $action = 'datatable')
	{
		$array['act'] = $action;
//		$target_view = view(important_pages('403'));

// 		if(auth()->user()->can($policy)){
// 			$target_view = view($view, $array);
// 		}

        return view($view, $array);
	}

}
