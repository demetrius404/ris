<?php

namespace App\Rules;

use App\Functions;
use App\Models\Enums\Color as EnumColor;

use Illuminate\Contracts\Validation\Rule;

class ColorRussian implements Rule {

    public function passes($attribute, $value) {
        
        if (!Functions::isString($value)) return false;
        $color = EnumColor::fromRussian($value)->toRussian();
        if (Functions::isNull($color)) return false;
        return true;

    }

    public function message() {

        return ':attribute is invalid';

    }

}
