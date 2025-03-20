<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(20)->create();

        \App\Models\User::factory()->create(['name' => 'Givanildo Teixeira','email' => 'givanildo@guarachevrolet.com.br','password' => 'teste123','level' => 'admin',]);

        // Cria 50 clientes fictícios
        \App\Models\Cliente::factory(50)->create();

        // Cria 150 veiculos fictícios
        \App\Models\Veiculo::factory(100)->create();
    }
}
