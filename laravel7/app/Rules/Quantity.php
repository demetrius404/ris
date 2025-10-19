<?php

namespace App\Rules;

use App\Functions;

use Illuminate\Contracts\Validation\Rule;

class Quantity implements Rule {

    public function passes($attribute, $value) {

        if (!Functions::isInteger($value)) return false;
        if ($value > 0 ) return true;
        return false;

    }

    public function message() {

        return ':attribute is invalid';

    }
    
}