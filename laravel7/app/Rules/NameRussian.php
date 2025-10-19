<?php

namespace App\Rules;

use App\Functions;

use Illuminate\Contracts\Validation\Rule;

class NameRussian implements Rule {

    protected $length = 0;

    public function __construct($length) {

        $this->length = $length;

    }

    public function passes($attribute, $value) {

        if (!Functions::isString($value)) return false;
        if ((Functions::lengthString($value) > 0) && (Functions::lengthString($value) <= $this->length)) {
            return true;
        } else {
            return false;
        }   

    }

    public function message() {

        return ':attribute is invalid';

    }

}