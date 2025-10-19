<?php

namespace Tests\Unit;

use App\Rules\Quantity as RuleQuantity;
use Tests\TestCase;

use Illuminate\Support\Facades\Validator;


class RuleQuantityTest extends TestCase {

    public function testRuleRuleQuantityPositive() {

        $data = ['RuleQuantity' => 1];

        $validator = Validator::make($data, [
            'RuleQuantity' => ['required', new RuleQuantity()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

    }

    public function testRuleRuleQuantityZeroNegative() {

        $data = ['RuleQuantity' => 0];

        $validator = Validator::make($data, [
            'RuleQuantity' => ['required', new RuleQuantity()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    public function testRuleRuleQuantityMinimumNegative() {

        $data = ['RuleQuantity' => -1];

        $validator = Validator::make($data, [
            'RuleQuantity' => ['required', new RuleQuantity()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    public function testRuleRuleQuantityNullNegative() {

        $data = ['RuleQuantity' => null];

        $validator = Validator::make($data, [
            'RuleQuantity' => ['required', new RuleQuantity()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

}
