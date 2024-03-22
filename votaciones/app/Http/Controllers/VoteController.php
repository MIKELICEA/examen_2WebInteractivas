<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\User;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Poll;

class VoteController extends Controller
{
    public function index()
    {
        $votes = Vote::all();
        return view('votes.index', compact('votes'));
    }

    public function create()
    {
        $polls = \App\Models\Poll::all();
        $candidates = \App\Models\Candidate::all(); // Obtener todos los candidatos disponibles
        return view('votes.create', compact('polls', 'candidates'));
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'user_id' => 'required',
            'poll_id' => 'required',
            'candidate_id' => 'required',
        ]);

        // Crear el voto
        Vote::create($validatedData);

        // Verificar el rol del usuario y redirigir al dashboard correspondiente
        if (auth()->user()->role === 'admin') {
            return redirect()->route('dashboard.admin')->with('success', 'Voto creado exitosamente.');
        } elseif (auth()->user()->role === 'votante') {
            return redirect()->route('dashboard.votante')->with('success', 'Voto creado exitosamente.');
        } else {
            // Redirigir a una página predeterminada si el rol no está definido
            return redirect()->route('dashboard')->with('success', 'Voto creado exitosamente.');
        }
    }


    public function show($id)
    {
        $vote = Vote::findOrFail($id);
        return view('votes.show', compact('vote'));
    }

    public function edit($id)
    {
        $vote = Vote::findOrFail($id);
        $polls = Poll::all();
        $candidates = Candidate::where('poll_id', $vote->poll_id)->get(); // Obtener los candidatos para la votación seleccionada en el voto a editar
        return view('votes.edit', compact('vote', 'candidates', 'polls'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'candidate_id' => 'required|exists:candidates,id',
            'poll_id' => 'required|exists:polls,id',
        ]);

        Vote::findOrFail($id)->update($validatedData);

        return redirect()->route('votes.index')->with('success', 'Voto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        Vote::findOrFail($id)->delete();

        return back()->with('success', 'Voto eliminado exitosamente.');
    }
}
