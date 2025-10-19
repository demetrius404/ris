<?php

namespace Tests\Unit;

use App\Models\Enums\Color as EnumColor;
use PHPUnit\Framework\TestCase;

class EnumColorTest extends TestCase {

    public function testEnumColorFromEnglishLowerCasePositive() {

        $color = EnumColor::fromEnglish('red');
        $this->assertEquals($color->value, 'red');

    }

    public function testEnumColorFromEnglishUpperCasePositive() {

        $color = EnumColor::fromEnglish('GREEN');
        $this->assertEquals($color->toRussian(), 'Зеленый');

    }

    public function testEnumColorFromEnglishNegative() {

        $color = EnumColor::FromEnglish('_');
        $this->assertEquals($color->toRussian(), null);

    }

    public function testEnumColorFromRussianLowerCasePositive() {

        $color = EnumColor::FromRussian('черный');
        $this->assertEquals($color->toRussian(), 'Черный');

    }

    public function testEnumColorFromRussianUpperCasePositive() {

        $color = EnumColor::FromRussian('КРАСНЫЙ');
        $this->assertEquals($color->toRussian(), 'Красный');

    }

    public function testEnumColorFromRussianInvalidNegative() {

        $color = EnumColor::FromRussian('_');
        $this->assertEquals($color->toRussian(), null);

    }

    public function testEnumColorFromRussianInvalidEnglishNegative() {

        $color = EnumColor::FromRussian('red');
        $this->assertEquals($color->toRussian(), null);

    }
    
}
