@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-xl mb-4 text-white">Detalles del Candidato</h1>

    <div class="bg-navy-600 shadow-md rounded px-8 pt-6 pb-8 mb-4 text-white">
        <div class="mb-4">
            <h2 class="text-lg font-bold mb-2">Información del Candidato</h2>
            <p><strong>ID:</strong> {{ $candidate->id }}</p>
            <p><strong>Nombre:</strong> {{ $candidate->name }}</p>
            <p><strong>ID de Encuesta:</strong> {{ $candidate->poll_id }}</p>
        </div>

        <a href="{{ route('candidates.edit', $candidate->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Editar Candidato
        </a>
        <a href="{{ route('candidates.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Regresar a la Lista
        </a>
    </div>
</div>
@endsection
