<?php

use App\Perfiles;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'idUsuario' => 1,
                'idRol' => 1
            ],
            [
                'idUsuario' => 2,
                'idRol' => 2
            ],
            [
                'idUsuario' => 3,
                'idRol' => 3
            ],
            [
                'idUsuario' => 4,
                'idRol' => 1
            ],
            [
                'idUsuario' => 5,
                'idRol' => 1
            ],
            [
                'idUsuario' => 6,
                'idRol' => 1
            ], [
                'idUsuario' => 7,
                'idRol' => 1
            ], [
                'idUsuario' => 8,
                'idRol' => 1
            ], [
                'idUsuario' => 9,
                'idRol' => 1
            ], [
                'idUsuario' => 10,
                'idRol' => 1
            ], [
                'idUsuario' => 11,
                'idRol' => 1
            ], [
                'idUsuario' => 12,
                'idRol' => 1
            ], [
                'idUsuario' => 13,
                'idRol' => 1
            ], [
                'idUsuario' => 14,
                'idRol' => 1
            ], [
                'idUsuario' => 15,
                'idRol' => 1
            ],
        ];


        foreach ($users as $user) {
            $p = new Perfiles();
            $p->idUsuario = $user['idUsuario'];
            $p->idRol = $user['idRol'];
            $p->save();
        }


    }
}
