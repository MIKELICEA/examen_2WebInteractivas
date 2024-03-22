<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function crearVotacion()
    {
        return view('admin.crear_votacion');
    }

    public function crearCandidatos()
    {
        return view('admin.crear_candidatos');
    }

    public function verVotos()
    {
        return view('admin.ver_votos');
    }

    public function graficasVotos()
    {
        return view('admin.graficas_votos');
    }
}
