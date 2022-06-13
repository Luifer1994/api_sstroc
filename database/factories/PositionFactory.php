<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->randomElement([
                'LIDER COMERCIAL',
                'LIDER DE CONSULTA EXTERNA',
                'LÍDER DE GESTIÓN DE COMPRAS',
                'LIDER DE GESTIÓN DE LA CALIDAD',
                'LIDER DE GESTIÓN DE LA TECNOLOGÍA Y AMBIENTE FÍSICO',
                'LÍDER DE GESTIÓN DE TALENTO HUMANO',
                'LIDER DE GESTIÓN FINANCIERA',
                'LIDER DE QUIMIOTERAPIA',
                'LIDER DE RADIOTERAPIA',
                'LIDER DE SISTEMAS DE INFORMACIÓN',
                'MEDICO GENERAL',
                'MENSAJERO',
                'OFICIAL DE PROTECCIÓN RADIOLOGICA',
                'ORIENTADORA',
                'QUIMICO FARMACEUTICO',
                'REVISOR(A) DE CUENTAS MEDICAS',
                'TECNOLOGO DE RADIOTERAPIA',
                'TRABAJADORA SOCIAL'

            ]),
        ];
    }
}
