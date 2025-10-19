<?php

namespace Tests\Feature;

use Tests\TestCase;


class RouteSocksReportTest extends TestCase {
    
    public function testApiSocksPositive() {
        $response = $this->get('/api/socks');
        $response->assertStatus(200);
    }

    public function testApiSocksWithColorPositive() {
        $response = $this->get('/api/socks?color=red');
        $response->assertStatus(200);
    }

        public function testApiSocksWithCottonPartPositive() {
        $response = $this->get('/api/socks?operation=moreThan&cottonPart=0');
        $response->assertStatus(200);
    }

}