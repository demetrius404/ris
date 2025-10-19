<?php

namespace Tests\Unit;

use App\Models\Enums\OperationType as EnumOperationType;
use PHPUnit\Framework\TestCase;

class EnumOperationTypeTest extends TestCase {

    public function testEnumOperationTypePositive() {

        $this->assertEquals(EnumOperationType::Income, 'income');

    }

    public function testEnumOperationTypeFromEnglishLowerCasePositive() {

        $operationType = EnumOperationType::fromEnglish('income');
        $this->assertEquals($operationType->value, 'income');

    }

    public function testEnumOperationTypeFromEnglishUpperCasePositive() {

        $operationType = EnumOperationType::fromEnglish('OUTCOME');
        $this->assertEquals($operationType->value, 'outcome');

    }

    public function testEnumOperationTypeFromEnglishNegative() {

        $operationType = EnumOperationType::fromEnglish('_');
        $this->assertEquals($operationType->value, null);

    }
}
