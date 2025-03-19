<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = FakerFactory::create('pt_BR'); // Gera dados em português do Brasil

        $tipoPessoa = $faker->randomElement(['Física', 'Jurídica']);
        $cpfCnpj = ($tipoPessoa === 'Física')
            ? $faker->unique()->numerify('###########') // CPF com 11 dígitos
            : $faker->unique()->numerify('###############'); // CNPJ com 14 dígitos

        return [
            'user_id'       => User::factory(),
            'nome'          => $faker->name(),
            'tipo_Pessoa'   => $tipoPessoa,
            'cpf_cnpj'      => $cpfCnpj,
            'email'         => $faker->unique()->safeEmail(),
            'celular'       => $faker->cellphoneNumber(),
            'telefone'      => $faker->phoneNumber(),
            'telefonecom'   => $faker->phoneNumber(),
            'cep'           => $faker->postcode(),
            'endereco'      => $faker->streetAddress(),
            'bairro'        => $faker->word(),
            'cidade'        => $faker->city(),
            'uf'            => $faker->stateAbbr(),
            'sexo'          => $faker->randomElement(['Masculino', 'Feminino']),
            'estado_Civil'  => $faker->randomElement(['Solteiro', 'Casado', 'Divorciado', 'Viúvo']),
            'data_fundacao' => $faker->date(),
            'data_Nascimento' => $faker->date(),
        ];
    }
}
