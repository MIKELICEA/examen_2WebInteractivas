<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            // Se elimina la validación de 'role' ya que se asignará automáticamente
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        
        // Asignar automáticamente el rol "votante" a todos los nuevos usuarios
        $validatedData['role'] = 'votante';

        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'Usuario creado con éxito.');
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,votante', // Validación del campo role
        ]);

        if($request->filled('password')) {
            $validatedData['password'] = bcrypt($request->password);
        }

        User::findOrFail($id)->update($validatedData);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return back()->with('success', 'Usuario eliminado con éxito.');
    }

    /**
     * Determine if the user has the given role.
     *
     * @param int $userId
     * @param string $role
     * @return bool
     */
    public function hasRole($userId, $role)
    {
        $user = User::findOrFail($userId);
        return $user->role === $role;
    }
}
