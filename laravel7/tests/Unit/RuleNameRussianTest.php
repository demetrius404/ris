<?php

namespace Tests\Unit;

use App\Rules\NameRussian as RuleNameRussian;
use Tests\TestCase;

use Illuminate\Support\Facades\Validator;


class RuleNameRussianTest extends TestCase {

    public function testRuleRuleNameRussianPositive() {

        $data = ['name' => 'Наименование'];

        $validator = Validator::make($data, [
            'name' => ['required', new RuleNameRussian(50)]
        ]);
        
        if ($validator->fails()) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

    }

    public function testRuleRuleNameRussianIntegerNegative() {

        $data = ['name' => 0];

        $validator = Validator::make($data, [
            'name' => ['required', new RuleNameRussian(50)]
        ]);
        
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    public function testRuleRuleNameRussianNullNegative() {

        $data = ['name' => null];

        $validator = Validator::make($data, [
            'name' => ['required', new RuleNameRussian(50)]
        ]);
        
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    public function testRuleRuleNameRussianLengthNegative() {

        $data = ['name' => 'Наименование'];

        $validator = Validator::make($data, [
            'name' => ['required', new RuleNameRussian(5)]
        ]);
        
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    public function testRuleRuleNameRussianEmptyNegative() {

        $data = ['name' => ''];

        $validator = Validator::make($data, [
            'name' => ['required', new RuleNameRussian(5)]
        ]);
        
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }
}
