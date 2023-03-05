<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'resumo',
        'email',
        'vaga_id'
    ];   

    
    public function vaga()
    {
        return $this->belongsTo(Vaga::class);
    }

    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'resumo' => 'string',
        'email' => 'string',
        'vaga_id' => 'integer'
    ];

    protected static function newFactory()
    {
        return \Database\Factories\CandidatoFactory::new();
    }
}
