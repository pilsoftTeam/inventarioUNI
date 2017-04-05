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
        $randomString = str_random(12);
        $pass = bcrypt($randomString);
        $user = new User();
        $perfilamiento = new Perfiles();

        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->rut = $request->rut;
        $user->fono = $request->fono;
        $user->password = $pass;
        $user->save();

        $perfilamiento->idRol = $request->idRol;
        $perfilamiento->idUsuario = $user->id;
        $perfilamiento->save();


        return response()->json($randomString, 200);
    }

    public function update(Request $request)
    {
        Perfiles::where('id', $request->id)->update([
            'idRol' => $request->idRol,
        ]);

        User::where('id', $request->idUsuario)->update([
            'name' => $request->get_users[0]['name'],
            'rut' => $request->get_users[0]['rut'],
            'fono' => $request->get_users[0]['fono'],
            'email' => $request->get_users[0]['email'],
        ]);


        return response()->json([], 200);
    }

    public function deleteUser($id)
    {
        User::where('id', $id)->update(['estado' => false]);
        return response()->json([], 200);
    }
}
