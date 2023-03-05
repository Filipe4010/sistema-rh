<?php

namespace Database\Factories;

use App\Models\Candidato;
use App\Models\Vaga;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidatoFactory extends Factory
{
    protected $model = Candidato::class;

    public function definition()
    {
        $vagaIds = Vaga::pluck('id')->toArray();

        return [
            'nome' => $this->faker->name,
            'resumo' => $this->faker->sentence(10),
            'email' => $this->faker->unique()->safeEmail,
            'vaga_id' => $this->faker->randomElement($vagaIds)
        ];
    }
}
