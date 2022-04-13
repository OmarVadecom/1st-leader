<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = ['name', 'slug', 'value', 'type', 'lang', 'sort_number', 'isOption', 'options'];

    /**
    * return value based to type
    *
    * @return mixed value
    */
    public function getFulterValueAttribute()
    {
    	$value = '';
    	$v = $this->attributes['value'];
    	if($this->attributes['type'] == 'select'){
    		$value = array_key_exists($v, $this->select_options) ? $this->select_options[$v] : '';
    	}else{
    		$value = $this->attributes['value'];
    	}
    	return $value;
    }

    /**
    * in case type is select and isOption = 1 transform pattarn into array
    *
    * @return array option
    */
    public function getSelectOptionsAttribute()
    {
    	$array = [];
    	$options = $this->attributes['options'];
    	if($this->attributes['isOption'] && $options != null){
    		$array = explode(',', $options);
    	}
    	return $array;
    }

}
