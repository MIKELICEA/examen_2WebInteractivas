<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;
use App\Models\Candidate;

class PollController extends Controller
{
    public function index()
    {
        // Obtener todas las votaciones
        $polls = Poll::all();

        // Obtener todos los candidatos
        $candidates = Candidate::all();

        // Iterar sobre las votaciones y obtener los datos de votación para cada una
        foreach ($polls as $poll) {
            // Obtener los datos de votación para esta votación
            $votingData = $this->getVotingData($poll->id);

            // Hacer algo con los datos de votación, como pasarlo a la vista
            // Por ejemplo, podrías almacenar los datos en un array para pasarlo a la vista
            $poll->votingData = $votingData;
        }

        // Pasar los datos de las votaciones y los candidatos a la vista
        return view('polls.index', compact('polls', 'candidates'));
    }

    public function create()
    {
        return view('polls.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        Poll::create($validatedData);

        return redirect()->route('polls.index')->with('success', 'Encuesta creada exitosamente.');
    }

    public function show($id)
    {
        $poll = Poll::findOrFail($id);
        return view('polls.show', compact('poll'));
    }

    public function edit($id)
    {
        $poll = Poll::findOrFail($id);
        return view('polls.edit', compact('poll'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        Poll::findOrFail($id)->update($validatedData);

        return redirect()->route('polls.index')->with('success', 'Encuesta actualizada exitosamente.');
    }

    public function destroy($id)
    {
        Poll::findOrFail($id)->delete();

        return back()->with('success', 'Encuesta eliminada exitosamente.');
    }

     /**
     * Obtener los datos necesarios para las gráficas en tiempo real.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVotingData($id)
    {
        // Obtener la cantidad de votos por votación
        $votesCount = Vote::where('poll_id', $id)->count();

        return $votesCount;
    }

}
