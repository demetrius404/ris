<?php

namespace Tests\Unit;

use App\Functions;
use App\Models\Operation;
use Tests\TestCase;

class ModelOperationTest extends TestCase {

    public function testModelOperationUpperCaseIncomePositive() {
        $operation = Operation::from([
            'operationType' => 'INCOME',
            'skuId' => '00000000-0000-0000-0000-000000000000',
            'quantity' => 1,
        ]);

        $this->assertEquals($operation->operationType, 'income');
        $this->assertEquals($operation->skuId, '00000000-0000-0000-0000-000000000000');
        $this->assertEquals($operation->quantity, 1);
    }

    public function testModelOperationSnakeCaseAttributesPositive() {

        $operation = Operation::from([
            'operation_type' => 'income',
            'sku_id' => '00000000-0000-0000-0000-000000000000',
            'quantity' => 1,
        ]);
    
        $this->assertEquals($operation->operationType, 'income');
        $this->assertEquals($operation->skuId, '00000000-0000-0000-0000-000000000000');
        $this->assertEquals($operation->quantity, 1);

    }

    public function testModelOperationNegative() {
    
        $operation = Operation::from([
            'operation_type' => null,
            'sku_id' => '00000000-0000-0000-0000-000000000000',
            'quantity' => null,
        ]);

        $this->assertEquals(Functions::isNull($operation), true);

    }

}
