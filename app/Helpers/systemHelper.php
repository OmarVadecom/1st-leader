<?php

if (! function_exists('checkIfNullValue')) {
    function checkIfNullValue($value = null, $constant){
      return $value == null ? $constant : $value;
    }
}