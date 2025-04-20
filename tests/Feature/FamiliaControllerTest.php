<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FamiliaControllerTest extends TestCase
{
    public function test_familia_index_route_is_accessible()
    {
        $response = $this->get('/veiculos/familia');
        $response->assertStatus(200); // Espera que a rota funcione
    }

    public function test_familia_search_returns_expected_data()
    {
        // Aqui você pode usar um seed ou factory se tiver dados de exemplo
        $response = $this->get('/veiculos/familia?busca=equinox');
        $response->assertSee('equinox'); // Espera ver o texto no HTML
    }
}
