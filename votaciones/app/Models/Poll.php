<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
    ];

    /**
     * Obtener los datos necesarios para las gráficas en tiempo real.
     *
     * @return array
     */
    public function getVotingData()
    {
        // Obtener los votos relacionados con esta votación
        $votes = $this->votes;

        // Inicializar un array para almacenar el recuento de votos por candidato
        $voteCount = [];

        // Iterar sobre los votos y contar los votos por candidato
        foreach ($votes as $vote) {
            // Incrementar el recuento de votos para el candidato de este voto
            $candidateId = $vote->candidate_id;
            if (array_key_exists($candidateId, $voteCount)) {
                $voteCount[$candidateId]++;
            } else {
                $voteCount[$candidateId] = 1;
            }
        }

        // Obtener los nombres de los candidatos
        $candidates = Candidate::all()->pluck('name', 'id');

        // Inicializar arrays para almacenar los nombres de los candidatos y el recuento de votos
        $candidateNames = [];
        $voteCounts = [];

        // Iterar sobre los datos de candidatos y votos para prepararlos para la representación en gráficos
        foreach ($candidates as $candidateId => $candidateName) {
            $candidateNames[] = $candidateName;
            $voteCounts[] = $voteCount[$candidateId] ?? 0;
        }

        return [
            'candidates' => $candidateNames,
            'votes' => $voteCounts,
        ];
    }

    /**
     * Obtener los votos asociados a esta votación.
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
