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
        ];


        foreach ($users as $user) {
            $p = new Perfiles();
            $p->idUsuario = $user['idUsuario'];
            $p->idRol = $user['idRol'];
            $p->save();
        }


    }
}
