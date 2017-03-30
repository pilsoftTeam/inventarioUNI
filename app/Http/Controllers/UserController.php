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
        $users = Perfiles::with('getUsers')->get();

        return response()->json($users);
    }

    public function getRoles()
    {
        return response()->json(Roles::all(), 200);
    }
}
