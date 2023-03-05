<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoVaga;

class tipoVagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        TipoVaga::create([
            'tipo' => 'CLT',
        ]);
        TipoVaga::create([
            'tipo' => 'CNPJ',
        ]);
        TipoVaga::create([
            'tipo' => 'FREELANCER',
        ]);
    }
}
