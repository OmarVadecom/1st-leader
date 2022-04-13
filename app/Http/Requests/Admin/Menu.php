<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class Menu extends FormRequest
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
    public function rules()
    {
        if($this->get('id') != null){
            $array = [
                'title.*'             => 'required|string|min:3|max:191',
                'target'              => 'required',
                'link_method'         => 'required',
            ];
        }else{
            $array = [
                'title.*'             => 'required|string|min:3|max:191',
                'target'              => 'required',
                'link_method'         => 'required',
            ];
        }
        return $array;
    }
}
