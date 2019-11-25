<?php

// src/Util/Helpers.php 

namespace App\Util;

class Helpers
{
    public function average($values)
    {
        if(count($values) > 0)
        {
            $result = array_sum($values) / count($values);
            return $result;
        }
        return false;
    }
}