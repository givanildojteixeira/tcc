<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Veiculo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Veiculo>
 */
class VeiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define se o veículo é novo ou usado
        $novo_usado = $this->faker->randomElement(['Novo', 'Usado']);

        // Define a marca com base no tipo de veículo
        $marca = $novo_usado === 'Novo'
            ? 'GM'
            : $this->faker->randomElement(['GM', 'FORD', 'VW', 'FIAT', 'RENAULT', 'CITROEN']);

        // Define o ano de fabricação
        $ano_fab = $this->faker->numberBetween(2000, date('Y'));

        // Define o ano do modelo como o mesmo ano de fabricação ou o próximo ano
        $ano_modelo = $this->faker->randomElement([$ano_fab, $ano_fab + 1]);

        // Insere os dados
        return [
            'chassi'        => $this->faker->unique()->regexify('[A-HJ-NPR-Z0-9]{17}'),
            'novo_usado'    => $novo_usado,
            'marca'         => $marca,
            'familia'       => $this->faker->word(),
            'desc_veiculo'  => $this->faker->sentence(6),
            'modelo_fab'    => $this->faker->word(),
            'cor'           => $this->faker->safeColorName(),
            'cod_opcional'  => $this->faker->randomNumber(6, true),
            'combustivel'   => $this->faker->randomElement(['Gasolina', 'Álcool', 'Flex', 'Diesel', 'Elétrico', 'Híbrido']),
            'ano_fab'       => $ano_fab,
            'ano_modelo'    => $ano_modelo,
            'motor'         => $this->faker->randomElement(['1.0', '1.4', '1.6', '2.0', '3.0', 'Elétrico']),
            'portas'        => $this->faker->randomElement([2, 4, 5]),
            'vlr_tabela'    => $this->faker->randomFloat(2, 30000, 200000),
            'vlr_bonus'     => $this->faker->randomFloat(2, 500, 5000),
            'vlr_nota'      => $this->faker->randomFloat(2, 25000, 180000),
            'user_reserva'  => $this->faker->name(),
            'desc_nota'     => $this->faker->sentence(10),
        ];
    }
}
