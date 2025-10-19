<?php


namespace Tests\Unit;

use App\Functions;
use App\Models\Socks;
use Tests\TestCase;

class ModelSocksTest extends TestCase {


    public function testModelSocksCamelCasePositive() {

        $socks = Socks::from([
            'skuName' => 'Носки',
            'color' => 'ЧЕРНЫЙ',
            'cottonPart' => 10,
        ]);

        $this->assertEquals($socks->skuName, 'Носки');
        $this->assertEquals($socks->color, 'Черный');
        $this->assertEquals($socks->cottonPart, 10);

    }

    public function testModelSocksSnakeCasePositive() {

        $socks = Socks::from([
            'sku_name' => 'Носки',
            'color' => 'красный',
            'cotton_part' => 10,
        ]);

        $this->assertEquals($socks->skuName,'Носки');
        $this->assertEquals($socks->color,'Красный');
        $this->assertEquals($socks->cottonPart, 10);

    }

    public function testModelSocksColorNullNegative() {

        $socks = Socks::from([
            'skuName' => 'Носки',
            'color' => null,
            'cottonPart' => 10,
        ]);

        $this->assertEquals(Functions::isNull($socks), true);
        
    }

    public function testModelSocksColorInvalidNegative() {

        $socks = Socks::from([
            'skuName' => 'Носки',
            'color' => 'red',
            'cottonPart' => 10,
        ]);
        
        $this->assertEquals(Functions::isNull($socks), true);
        
    }

}
