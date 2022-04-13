<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class Role extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if($request->get('id') != null){
            $array = [
                'name.*'              => 'required|string|min:3|max:50',
                'comment.*'           => 'nullable|string|min:3|max:250',
                'permissions'         => 'required'
            ];
        }else{
            $array = [
               'name.*'              => 'required|string|min:3|max:50',
               'comment.*'           => 'nullable|string|min:3|max:250',
               'permissions'         => 'required'
            ];
        }
        return $array;
    }
}
