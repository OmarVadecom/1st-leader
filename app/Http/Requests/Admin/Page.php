<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class Page extends FormRequest
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
                'title.*'             => 'required|string|min:3|max:191',
                'slug'                => 'required|string|min:1|max:191',
                'content.*'           => 'nullable|string|min:5',
                'description.*'       => 'nullable|string|max:500',
            ];
        }else{
            $array = [
                'title.*'             => 'required|string|min:3|max:191',
                'slug'                => 'required|string|min:3|max:191',
                'content.*'           => 'nullable|string|min:5',
                'description.*'       => 'nullable|string|max:500',
            ];
        }
        return $array;
    }
}
