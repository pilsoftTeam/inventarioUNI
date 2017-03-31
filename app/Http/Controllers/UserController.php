<?php

namespace App\Http\Controllers;

use App\Perfiles;
use App\Roles;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = Perfiles::with('getUsers', 'getRoles')->get();

        return response()->json($users);
    }

    public function getRoles()
    {
        return response()->json(Roles::all(), 200);
    }

    public function save(Request $request)
    {
        $pass = bcrypt(str_random(12));
        $user = new User();
        $perfilamiento = new Perfiles();

        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->password = $pass;
        $user->save();

        $perfilamiento->idRol = $request->idRol;
        $perfilamiento->idUsuario = $user->id;
        $perfilamiento->save();


        return response()->json($pass, 200);
    }
}
