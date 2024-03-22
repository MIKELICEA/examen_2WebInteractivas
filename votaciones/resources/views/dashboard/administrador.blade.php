<head>
    <!-- Agrega este enlace CDN a Font Awesome en tu archivo de diseño -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard Administrador') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("¡Has iniciado sesión!") }}
                    </div>
    @section('content')
                    <div class="row">
                        <!-- Crear Votación -->
                        <div class="col-md-3 mb-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fas fa-edit fa-4x text-white"></i> 
                                    <div class="card-title mt-3">
                                        <a href="{{ route('polls.index') }}" class="stretched-link text-white text-decoration-none">Crear Votación</a> <!-- Cambia el color del texto a blanco -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Crear Candidatos -->
                        <div class="col-md-3 mb-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fas fa-users fa-4x text-white"></i>
                                    <div class="card-title mt-3">
                                        <a href="{{ route('candidates.index') }}" class="stretched-link text-white text-decoration-none">Crear Candidatos</a> <!-- Cambia el color del texto a blanco -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ver Votos -->
                        <div class="col-md-3 mb-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fas fa-eye fa-4x text-white"></i> 
                                    <div class="card-title mt-3">
                                        <a href="{{ route('votes.index') }}" class="stretched-link text-white text-decoration-none">Ver Votos</a> <!-- Cambia el color del texto a blanco -->
                                    </div>
                                </div>
                            </div>
                        </div>                    

                        <!-- Gráficas de Votos -->
                        <div class="col-md-3 mb-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <i class="fas fa-chart-bar fa-4x text-white"></i> 
                                    <div class="card-title mt-3">
                                        <a href="{{ route('polls.index') }}" class="stretched-link text-white text-decoration-none">Gráficas de Votos</a> <!-- Cambia el color del texto a blanco -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    </x-app-layout>
</body>
