@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-xl mb-4 text-white">Gestión de Candidatos</h1>
    <a href="{{ route('candidates.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Añadir nuevo candidato
    </a>

    {{-- Tabla de candidatos --}}
    <table class="table-auto w-full mt-6">
        <thead>
            <tr>
                <th class="border px-4 py-2 text-white bg-navy-600">ID</th>
                <th class="border px-4 py-2 text-white bg-navy-600">Nombre</th>
                <th class="border px-4 py-2 text-white bg-navy-600">ID de Votación</th>
                <th class="border px-4 py-2 text-white bg-navy-600">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($candidates as $candidate)
            <tr>
                <td class="border px-4 py-2">{{ $candidate->id }}</td>
                <td class="border px-4 py-2">{{ $candidate->name }}</td>
                <td class="border px-4 py-2">{{ $candidate->poll_id }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('candidates.show', $candidate->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a> |
                    <a href="{{ route('candidates.edit', $candidate->id) }}" class="text-blue-600 hover:text-blue-900">Editar</a> |
                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $candidate->id }}').submit();" class="text-red-600 hover:text-red-900">
                        Eliminar
                    </a>

                    <form id="delete-form-{{ $candidate->id }}" action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" style="display: none;">
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
