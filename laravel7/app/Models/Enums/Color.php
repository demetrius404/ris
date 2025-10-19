<?php

namespace App\Models\Enums;

use App\Functions;

use ValueError;


class Color {

    public const Red = 'red';
    public const Green = 'green';
    public const Black = 'black';
    public const Multicolor = 'multicolor';

    public $value = null;

    function __construct($value) {
        $this->value = $value;
    }
    
    public function toRussian() {

        $color = null;
        switch ($this->value) { 
            case Color::Red: $color = 'Красный'; break;
            case Color::Green: $color = 'Зеленый'; break;
            case Color::Black: $color = 'Черный'; break;
            case Color::Multicolor: $color = 'Многоцветный'; break;
        }
        return $color;

    }

    public static function fromEnglish($value) {

        if (!Functions::isString($value)) throw new ValueError('Value must be a string');
        
        $color = null;
        switch (Functions::toLowerCase($value)) { 
            case 'red': $color = Color::Red; break;
            case 'green': $color = Color::Green; break;
            case 'black': $color = Color::Black; break;
            case 'multicolor': $color = Color::Multicolor; break;
        }
        return new Color($color);

    }

    public static function fromRussian($value) {
        
        if (!Functions::isString($value)) throw new ValueError('Value must be a string');
        
        $color = null;
        switch (Functions::toLowerCase($value)) { 
            case 'красный': $color = Color::Red; break;
            case 'зеленый': $color = Color::Green; break;
            case 'черный': $color = Color::Black; break;
            case 'многоцветный': $color = Color::Multicolor; break;
        }
        return new Color($color);
    }

}
