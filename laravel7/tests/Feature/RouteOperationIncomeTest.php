<?php

namespace Tests\Feature;

use Tests\TestCase;


class RouteOperationIncomeTest extends TestCase {


    public function testRouteApiSocksIncomePositive() {
        
        $data = [
            'color' => 'ЧЕРНЫЙ',
            'cottonPart' => 55,
            'quantity' => 10,
        ];

        $response = $this->postJson('/api/socks/income', $data);
        $response->assertStatus(200);
        

    }


    public function testRouteApiSocksIncomeQuantityInvalidNegative() {
        
        $data = [
            'color' => 'красный',
            'cottonPart' => 1,
            'quantity' => -1,
        ];

        $response = $this->postJson('/api/socks/income', $data);
        $response->assertStatus(400);

    }

    public function testRouteApiSocksIncomeCottonPartInvalidNegative() {
        
        $data = [
            'color' => 'красный',
            'cottonPart' => 200,
            'quantity' => 1,
        ];

        $response = $this->postJson('/api/socks/income', $data);
        $response->assertStatus(400);

    }

    public function testRouteApiSocksIncomeColorNullNegative() {

        $data = [
            'cottonPart' => 1,
            'quantity' => 1,
        ];

        $response = $this->postJson('/api/socks/income', $data);
        $response->assertStatus(400);

    }

    public function testRouteApiSocksIncomeColorInvalidNegative () {

        $data = [
            'color' => '_',
            'cottonPart' => 1,
            'quantity' => 1,
        ];

        $response = $this->postJson('/api/socks/income', $data);
        $response->assertStatus(400);

    }

}
