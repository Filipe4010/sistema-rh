<?php

namespace Database\Factories;

use App\Models\Vaga;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VagaFactory extends Factory
{
    protected $model = Vaga::class;

    public function definition()
    {
        return [
            'tipo' => $this->faker->randomElement([1, 2, 3]),
            'descricao' => $this->faker->sentence(),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
