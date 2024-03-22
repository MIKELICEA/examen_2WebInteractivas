@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-xl mb-4 text-white">Gestión de Votaciones</h1>
    <a href="{{ route('polls.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Añadir nueva votación
    </a>

    {{-- Tabla de votaciones --}}
    <table class="table-auto w-full mt-6">
        <thead>
            <tr>
                <th class="border px-4 py-2 text-white bg-navy-600">Título</th>
                <th class="border px-4 py-2 text-white bg-navy-600">Descripción</th>
                <th class="border px-4 py-2 text-white bg-navy-600">Fecha de Inicio</th>
                <th class="border px-4 py-2 text-white bg-navy-600">Fecha de Fin</th>
                <th class="border px-4 py-2 text-white bg-navy-600">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($polls as $poll)
            <tr>
                <td class="border px-4 py-2">{{ $poll->title }}</td>
                <td class="border px-4 py-2">{{ $poll->description }}</td>
                <td class="border px-4 py-2">{{ $poll->start_date }}</td>
                <td class="border px-4 py-2">{{ $poll->end_date }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('polls.show', $poll->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a> |
                    <a href="{{ route('polls.edit', $poll->id) }}" class="text-blue-600 hover:text-blue-900">Editar</a> |
                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $poll->id }}').submit();" class="text-red-600 hover:text-red-900">
                        Eliminar
                    </a>

                    <form id="delete-form-{{ $poll->id }}" action="{{ route('polls.destroy', $poll->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Gráficas en tiempo real --}}
    <div class="mt-8">
        <h2 class="text-xl mb-4 text-white">Gráficas en tiempo real de las votaciones con sus candidatos</h2>
        <div class="row">
            <div class="col-md-6">
                <canvas id="votingChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Script para generar la gráfica -->
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Obtener los datos de las votaciones y sus candidatos desde el backend
    const candidateNames = {!! json_encode($candidates->pluck('name')) !!};
    const votesCount = {!! json_encode($candidates->map(function($candidate) {
        return $candidate->votes->count();
    })) !!};

    // Crear la gráfica
    const ctx = document.getElementById('votingChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: candidateNames,
            datasets: [{
                label: 'Número de Votos',
                data: votesCount,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
@endsection
