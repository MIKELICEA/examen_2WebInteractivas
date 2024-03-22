<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'candidate_id',
        'poll_id', // Agregar esto para permitir la asignación masiva
    ];

    /**
     * Obtener el usuario que posee el voto.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener el candidato al que pertenece el voto.
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    /**
     * Obtener la encuesta a la que pertenece el voto.
     */
    public function poll()
    {
        return $this->belongsTo(Poll::class); // Definir la relación con Poll
    }
}

