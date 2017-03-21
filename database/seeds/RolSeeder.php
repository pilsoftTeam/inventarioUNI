<?php

use App\Roles;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['revisor', 'supervisor', 'administrador'];
        foreach ($roles as $rol) {
            $r = new Roles();
            $r->rol = $rol;
            $r->save();
        }
    }
}
