@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-xl mb-4 text-white">Crear Candidato</h1>
    <form action="{{ route('candidates.store') }}" method="POST" class="bg-navy-600 shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-bold mb-2" style="color: white;">Nombre:</label>
            <input type="text" name="name" id="name" required class="shadow appearance-none border rounded w-full py-2 px-3 bg-white leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="poll_id" class="block text-sm font-bold mb-2" style="color: white;">Votación:</label>
            <select name="poll_id" id="poll_id" class="shadow appearance-none border rounded w-full py-2 px-3 bg-white leading-tight focus:outline-none focus:shadow-outline">
                @foreach($polls as $poll)
                    <option value="{{ $poll->id }}">{{ $poll->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-between">
            <input type="submit" value="Crear Candidato" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            <a href="{{ route('candidates.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Regresar
            </a>
        </div>
    </form>
</div>
@endsection
