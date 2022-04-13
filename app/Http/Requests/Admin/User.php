<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class User extends FormRequest
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
                'name'               => 'required|string|min:3|max:191',
                'email'              => 'required|string|email|max:191|unique:users,email,'.$request->get('id'),
                'username'           => 'required|string|min:5|max:191|regex:/([A-Za-z0-9 ])+/|regex:/^\S*$/u|unique:users,username,'.$request->get('id'),
                'branch'           => 'required | in:dam,Wsh,exh',
            ];
        }else{
            $array = [
                'name'               => 'required|string|min:3|max:191',
                'email'              => 'required|string|email|max:191|unique:users',
                'password'           => 'required|string|min:6',
                'branch'           => 'required | in:dam,Wsh,exh',
            ];
        }
        return $array;
    }
}
