<?php

namespace App\Rules;

use App\Functions;
use App\Models\Enums\OperationType as EnumOperationType;

use Illuminate\Contracts\Validation\Rule;


class OperationType implements Rule {

    public function passes($attribute, $value) {

        if (!Functions::isString($value)) return false;
        $operationType = EnumOperationType::fromEnglish($value)->value;
        if (Functions::isNull($operationType)) return false;
        return true;

    }

    public function message() {

        return ':attribute is invalid';

    }
    
}