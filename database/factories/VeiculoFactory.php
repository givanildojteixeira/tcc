<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Veiculo;

class VeiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $marca = $this->faker->randomElement([
            'Chevrolet',
            'Ford',
            'Volkswagen',
            'Fiat',
            'Honda',
            'Toyota',
            'Nissan',
            'Hyundai',
            'Renault',
            'Peugeot',
            'Citroën',
            'Jeep',
            'Mitsubishi',
            'BMW',
            'Mercedes-Benz',
            'Audi',
            'Kia',
            'Suzuki',
            'Chery',
            'Volvo'
        ]);

        $modelo = $this->faker->randomElement([
            'Onix',
            'Prisma',
            'Civic',
            'Corolla',
            'Gol',
            'Polo',
            'HB20',
            'Argo',
            'Fiesta',
            'Ka',
            'Cruze',
            'Fusion',
            'Ranger',
            'Toro',
            'Compass',
            'HR-V',
            'EcoSport',
            'SW4',
            'X1',
            'A3',
            'S10',
            'Duster',
            'Kicks',
            'Versa',
            'March',
            'Sentra',
            'Strada',
            'Hilux',
            'Yaris',
            'T-Cross',
            'Spin',
            'Renegade',
            'Mobi',
            'Cronos',
            'Saveiro',
            'Jetta',
            'Tiguan',
            'Amarok',
            'Doblo',
            'Celta',
            'Bravo',
            'C4 Cactus',
            '208',
            'Sandero',
            'Logan',
            'Captur',
            'Outlander',
            'ASX',
            'Lancer',
            'Golf'
        ]);

        $cores = $this->faker->randomElement([
            'Azul',
            'Vermelho',
            'Preto',
            'Branco',
            'Cinza',
            'Prata',
            'Dourado',
            'Verde',
            'Amarelo',
            'Laranja',
            'Roxo',
            'Azul Claro',
            'Bege',
            'Marrom',
            'Rosa',
            'Verde Claro',
            'Azul Escuro',
            'Lilas',
            'Turquesa',
            'Pêssego'
        ]);

        // Gera os anos no formato "2000/2001"
        $anosModelo = [];
        for ($ano = 2000; $ano <= 2022; $ano++) {
            $anosModelo[] = "$ano/$ano";
            if ($ano < 2022) {
                $anosModelo[] = "$ano/" . ($ano + 1);
            }
        }

        return [
            'chassi'          => $this->faker->regexify('[A-HJ-NPR-Z0-9]{11}') . $this->faker->randomNumber(6, true),
            'novo_usado'      => 'Usado',
            'marca'           => $marca,
            'familia'         => $marca, // Família agora igual à marca
            'desc_veiculo'    => $modelo,
            'modelo_fab'      => $modelo, // Ajustado para evitar null
            'cor'             => $cores,
            'cod_opcional'    => $this->faker->regexify('[A-Z]{3}'),
            'combustivel'     => $this->faker->randomElement(['Gasolina', 'Álcool', 'Flex', 'Diesel', 'Elétrico', 'Híbrido']),
            'Ano_Mod'         => $this->faker->randomElement($anosModelo), // Agora retorna apenas um valor
            'motor'           => $this->faker->randomElement(['1.0', '1.4', '1.6', '2.0', '3.0', 'Elétrico']),
            'portas'          => $this->faker->randomElement([2, 4, 5]),
            'vlr_tabela'      => $this->faker->randomFloat(2, 30000, 200000),
            'vlr_bonus'       => $this->faker->randomFloat(2, 500, 5000),
            'vlr_nota'        => $this->faker->randomFloat(2, 25000, 180000),
            'local'           => $this->faker->randomElement(['Consignado', 'Matriz', 'Filial']),
            'dta_faturamento' => $this->faker->dateTimeBetween('2024-09-01', 'now')->format('Y-m-d'), // Ajustado para formato padrão de banco de dados
            'user_reserva'    => '22',
            'desc_nota'       => "Veículo usado modelo: " . $modelo, // Incluindo o modelo no texto
        ];
    }
}
