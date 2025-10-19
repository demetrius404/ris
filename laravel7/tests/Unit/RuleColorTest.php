<?php


namespace Tests\Unit;

use App\Rules\ColorRussian as RuleColorRussian;
use App\Rules\ColorEnglish as RuleColorEnglish;
use Tests\TestCase;

use Illuminate\Support\Facades\Validator;


class RuleColorTest extends TestCase {

    public function testRuleColorRussianPositive() {

        $data = ['color' => 'красный'];

        $validator = Validator::make($data, [
            'color' => ['required', new RuleColorRussian()]
        ]);
            
        if ($validator->fails()) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }
    }

    public function testRuleRuleColorEnglishPositive() {

        $data = ['color' => 'red'];

        $validator = Validator::make($data, [
            'color' => ['required', new RuleColorEnglish()]
        ]);
            
        if ($validator->fails()) {
            $this->assertTrue(false);
        } else {
            $this->assertTrue(true);
        }

    }

    public function testRuleColorRussianNullNegative() {

        $data = ['color' => null];

        $validator = Validator::make($data, [
            'color' => ['required', new RuleColorRussian()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
             $this->assertTrue(false);
        }

    }

    public function testRuleColorRussianInvalidNegative() {

        $data = ['color' => '_'];

        $validator = Validator::make($data, [
            'color' => ['required', new RuleColorRussian()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    public function testRuleRuleColorEnglishNull() {

        $data = ['color' => null];

        $validator = Validator::make($data, [
            'color' => ['required', new RuleColorEnglish()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

    public function testRuleRuleColorEnglishInvalidNegative() {

        $data= ['color' => '_'];

        $validator = Validator::make($data, [
            'color' => ['required', new RuleColorEnglish()]
        ]);
    
        if ($validator->fails()) {
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false);
        }

    }

}
