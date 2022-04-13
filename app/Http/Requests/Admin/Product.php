<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class Product extends FormRequest
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
                'slug'                => 'required|string|min:3|max:191',
                'content.*'           => 'nullable|string|min:5',
                'description.*'       => 'nullable|string|max:155',
            ];
        }else{
            $array = [
                'title.*'             => 'required|string|min:3|max:191',
                'slug'                => 'required|string|min:3|max:191',
                'content.*'           => 'nullable|string|min:5',
                'description.*'       => 'nullable|string|max:155',
            ];
        }
        return $array;
    }
}
