<?php

use App\Sedes;
use Illuminate\Database\Seeder;

class SedesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sedes = ["Casa Central - Iquique", "Arica", "Antofagasta", "Calama", "Santiago", "Sede Victoria", 'Talcahuano', 'Puerto Montt'];

        foreach ($sedes as $sede) {
            $s = new Sedes();
            $s->sede = $sede;
            $s->save();
        }
    }
}
