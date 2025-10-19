<?php

namespace Tests\Unit;

use App\Rules\OperationType as RuleOperationType;
use Tests\TestCase;

use Illuminate\Support\Facades\Validator;

class RuleOperationTypeTest extends TestCase {

    public function testRuleRuleOperationTypeIncomePositive() {

        $data = ['RuleOperationType' => 'income'];

        $validator = Validator::make($data, [
            'RuleOperationType' => ['required', new RuleOperationType()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

    }

    public function testRuleRuleOperationTypeOutcomePositive() {

        $data = ['RuleOperationType' => 'outcome'];

        $validator = Validator::make($data, [
            'RuleOperationType' => ['required', new RuleOperationType()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

    }

    public function testRuleRuleOperationTypeInvalidNegative() {

        $data = ['RuleOperationType' => '_'];

        $validator = Validator::make($data, [
            'RuleOperationType' => ['required', new RuleOperationType()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    public function testRuleRuleOperationTypeNullNegative() {

        $data = ['RuleOperationType' => null];

        $validator = Validator::make($data, [
            'RuleOperationType' => ['required', new RuleOperationType()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

}
