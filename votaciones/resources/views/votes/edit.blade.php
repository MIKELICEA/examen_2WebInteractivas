@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-xl mb-4 text-white">Editar Voto</h1>

    <form action="{{ route('votes.update', $vote->id) }}" method="POST" class="bg-navy-600 shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="user_id" class="block text-sm font-bold mb-2" style="color: white;">ID de Usuario:</label>
            <input type="text" name="user_id" id="user_id" value="{{ $vote->user_id }}" required readonly class="shadow appearance-none border rounded w-full py-2 px-3 bg-white leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="poll_id" class="block text-sm font-bold mb-2" style="color: white;">Seleccionar Votación:</label>
            <select name="poll_id" id="poll_id" required class="shadow appearance-none border rounded w-full py-2 px-3 bg-white leading-tight focus:outline-none focus:shadow-outline" onchange="getCandidates()">
                {{-- Iterar sobre las votaciones disponibles --}}
                @foreach ($polls as $poll)
                    <option value="{{ $poll->id }}" {{ $poll->id == $vote->poll_id ? 'selected' : '' }}>{{ $poll->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="candidate_id" class="block text-sm font-bold mb-2" style="color: white;">Seleccionar Candidato:</label>
            <select name="candidate_id" id="candidate_id" required class="shadow appearance-none border rounded w-full py-2 px-3 bg-white leading-tight focus:outline-none focus:shadow-outline">
                {{-- Iterar sobre los candidatos disponibles para la votación seleccionada --}}
                @foreach ($candidates as $candidate)
                    <option value="{{ $candidate->id }}" {{ $candidate->id == $vote->candidate_id ? 'selected' : '' }}>{{ $candidate->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-between">
            <input type="submit" value="Actualizar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            <a href="{{ route('votes.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Regresar
            </a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function getCandidates() {
        var pollId = document.getElementById('poll_id').value;
        var candidatesSelect = document.getElementById('candidate_id');

        // Limpiar opciones existentes
        while (candidatesSelect.options.length > 0) {
            candidatesSelect.remove(0);
        }

        // Obtener los candidatos correspondientes a la votación seleccionada
        fetch(`/get-candidates/${pollId}`)
            .then(response => response.json())
            .then(data => {
                // Agregar las opciones al select de candidatos
                data.forEach(candidate => {
                    var option = document.createElement('option');
                    option.value = candidate.id;
                    option.text = candidate.name;
                    candidatesSelect.add(option);
                });
            });
    }
</script>
@endsection



