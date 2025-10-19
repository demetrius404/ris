<?php

namespace App\Models\Enums;
use App\Functions;
use ValueError;


class OperationType {

    public const Income = 'income';
    public const Outcome = 'outcome';
    
    public $value = null;

    public function __construct($value) {
        $this->value = $value;
    }

    public static function fromEnglish($value) {

        if (!Functions::isString($value)) throw new ValueError('Value must be a string');
        
        $operationType = null;
        switch (Functions::toLowerCase($value)) {  
            case 'income': $operationType = OperationType::Income; break;  
            case 'outcome': $operationType = OperationType::Outcome; break;
        }

        return new OperationType($operationType);

    }
}
