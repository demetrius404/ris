<?php

namespace Tests\Feature;

use App\Functions;
use Tests\TestCase;


class RouteOperationOutcomeTest extends TestCase {

    public function testRouteApiSocksOutcomePositive() {
    
        $data = [
            'color' => 'многоцветный',
            'cottonPart' => 0,
            'quantity' => 50,
        ];

        $this->postJson('/api/socks/income', $data);
        $response = $this->postJson('/api/socks/outcome', $data);
        $response->assertStatus(200);
    }

    public function testRouteApiSocksOutcomeNegative() {
    
        $data = [
            'color' => 'многоцветный',
            'cottonPart' => 0,
            'quantity' => 50,
        ];

        $this->postJson('/api/socks/income', $data);
        
        $response = $this->get('/api/socks?color=multicolor&operation=equal&cottonPart=0');
        $response->assertStatus(200);

        $data['quantity'] = $response->json()[0]['quantity'] * 100;

        $response = $this->postJson('/api/socks/outcome', $data);
        $response->assertStatus(400);
    }

}