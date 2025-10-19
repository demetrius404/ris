<?php

namespace Tests\Unit;

use App\Rules\CottonPart as RuleCottonPart;
use Tests\TestCase;

use Illuminate\Support\Facades\Validator;

class RuleCottonPartTest extends TestCase {

    public function testRuleRuleCottonPartPositive() {

        $data = ['RuleCottonPart' => 10];

        $validator = Validator::make($data, [
            'RuleCottonPart' => ['required', new RuleCottonPart()]
        ]);
        
        if ($validator->fails()) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

    }

    public function testRuleRuleCottonPartMinimumPositive() {

        $data = ['RuleCottonPart' => 0];

        $validator = Validator::make($data, [
            'RuleCottonPart' => ['required', new RuleCottonPart()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

    }

    public function testRuleRuleCottonPartMaximumPositive() {

        $data = ['RuleCottonPart' => 100];

        $validator = Validator::make($data, [
            'RuleCottonPart' => ['required', new RuleCottonPart()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

    }

    public function testRuleRuleCottonPartStringNegative() {

        $data = ['RuleCottonPart' => '10'];

        $validator = Validator::make($data, [
            'RuleCottonPart' => ['required', new RuleCottonPart()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    public function testRuleRuleCottonPartNullNegative() {

        $data = ["RuleCottonPart" => null];

        $validator = Validator::make($data, [
            'RuleCottonPart' => ['required', new RuleCottonPart()]
        ]);
        
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    public function testRuleRuleCottonPartFloatingPointNegative() {

        $data = ['RuleCottonPart' => 3.14];

        $validator = Validator::make($data, [
            'RuleCottonPart' => ['required', new RuleCottonPart()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    public function testRuleRuleCottonPartMaximumNegative() {

        $data = ['RuleCottonPart' => 105];

        $validator = Validator::make($data, [
            'RuleCottonPart' => ['required', new RuleCottonPart()]
        ]);
            
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    public function testRuleRuleCottonPartMinimumNegative() {

        $data = ["RuleCottonPart" => -1];

        $validator = Validator::make($data, [
            'RuleCottonPart' => ['required', new RuleCottonPart()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
             $this->assertTrue(false);
        }

    }

}
