<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\Poll;


class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        return view('candidates.index', compact('candidates'));
    }

    public function create()
    {
        $polls = \App\Models\Poll::all();
        return view('candidates.create', compact('polls'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'poll_id' => 'required|exists:polls,id',
        ]);

        Candidate::create($validatedData);

        return redirect()->route('candidates.index')->with('success', 'Candidato creado exitosamente.');
    }

    public function show($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('candidates.show', compact('candidate'));
    }

    public function edit($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('candidates.edit', compact('candidate'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'poll_id' => 'required|exists:polls,id',
        ]);

        Candidate::findOrFail($id)->update($validatedData);

        return redirect()->route('candidates.index')->with('success', 'Candidato actualizado exitosamente.');
    }

    public function destroy($id)
    {
        Candidate::findOrFail($id)->delete();

        return back()->with('success', 'Candidato eliminado exitosamente.');
    }

    public function getCandidates($pollId)
    {
        // Obtener los candidatos correspondientes a la votación seleccionada
        $candidates = Candidate::where('poll_id', $pollId)->get();

        return response()->json($candidates);
    }

}
