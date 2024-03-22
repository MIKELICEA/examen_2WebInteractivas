@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-xl mb-4 text-white">Gestión de Votos</h1>
    <a href="{{ route('votes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Añadir nuevo voto
    </a>

    {{-- Tabla de votos --}}
    <table class="table-auto w-full mt-6">
        <thead>
            <tr>
                <th class="border px-4 py-2 text-white bg-navy-600">ID</th>
                <th class="border px-4 py-2 text-white bg-navy-600">Usuario</th>
                <th class="border px-4 py-2 text-white bg-navy-600">Candidato</th>
                <th class="border px-4 py-2 text-white bg-navy-600">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($votes as $vote)
            <tr>
                <td class="border px-4 py-2">{{ $vote->id }}</td>
                <td class="border px-4 py-2">{{ $vote->user->name }}</td>
                <td class="border px-4 py-2">{{ $vote->candidate->name }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('votes.show', $vote->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a> |
                    <a href="{{ route('votes.edit', $vote->id) }}" class="text-blue-600 hover:text-blue-900">Editar</a> |
                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $vote->id }}').submit();" class="text-red-600 hover:text-red-900">
                        Eliminar
                    </a>

                    <form id="delete-form-{{ $vote->id }}" action="{{ route('votes.destroy', $vote->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
    <script>
        Swal.fire({
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@endsection
