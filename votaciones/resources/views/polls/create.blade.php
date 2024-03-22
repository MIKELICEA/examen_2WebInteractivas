@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-xl mb-4 text-white">Crear Encuesta</h1>
    <form action="{{ route('polls.store') }}" method="POST" class="bg-navy-600 shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-sm font-bold mb-2" style="color: white;">Título:</label>
            <input type="text" name="title" id="title" required class="shadow appearance-none border rounded w-full py-2 px-3 bg-white leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-bold mb-2" style="color: white;">Descripción:</label>
            <textarea name="description" id="description" required class="shadow appearance-none border rounded w-full py-2 px-3 bg-white leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>

        <div class="mb-4">
            <label for="start_date" class="block text-sm font-bold mb-2" style="color: white;">Fecha de inicio:</label>
            <input type="date" name="start_date" id="start_date" class="shadow appearance-none border rounded w-full py-2 px-3 bg-white leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="mb-4">
            <label for="end_date" class="block text-sm font-bold mb-2" style="color: white;">Fecha de fin:</label>
            <input type="date" name="end_date" id="end_date" class="shadow appearance-none border rounded w-full py-2 px-3 bg-white leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <div class="flex items-center justify-between">
            <input type="submit" value="Crear Encuesta" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            <a href="{{ route('polls.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Regresar
            </a>
        </div>
    </form>
</div>
@endsection