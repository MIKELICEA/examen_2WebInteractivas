{{-- resources/views/polls/show.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-xl mb-4 text-white">Detalles de la Encuesta</h1>

    <div class="bg-navy-600 shadow-md rounded px-8 pt-6 pb-8 mb-4 text-white">
        <div class="mb-4">
            <h2 class="text-lg font-bold mb-2">Información de la Encuesta</h2>
            <p><strong>Título:</strong> {{ $poll->title }}</p>
            <p><strong>Descripción:</strong> {{ $poll->description }}</p>

            {{-- Uso de Carbon para las fechas --}}
            @php
                use Carbon\Carbon;
                $startDate = $poll->start_date ? Carbon::parse($poll->start_date)->format('d/m/Y') : 'No especificada';
                $endDate = $poll->end_date ? Carbon::parse($poll->end_date)->format('d/m/Y') : 'No especificada';
            @endphp
            
            <p><strong>Fecha de Inicio:</strong> {{ $startDate }}</p>
            <p><strong>Fecha de Fin:</strong> {{ $endDate }}</p>
        </div>

        <a href="{{ route('polls.edit', $poll->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Editar Encuesta
        </a>
        <a href="{{ route('polls.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Regresar a la Lista
        </a>
    </div>
</div>
@endsection
