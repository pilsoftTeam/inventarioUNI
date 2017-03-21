<?php

use App\Campus;
use Illuminate\Database\Seeder;

class CampusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campus = [
            [
                'idSede' => 1,
                'campus' => 'Playa Brava',
                'pabellones' => 26
            ],
            [
                'idSede' => 1,
                'campus' => 'Genaro Gallo',
                'pabellones' => 5
            ],
            [
                'idSede' => 1,
                'campus' => 'Huayquique',
                'pabellones' => 41
            ],
            [
                'idSede' => 1,
                'campus' => 'Canchones',
                'pabellones' => 5
            ],
            [
                'idSede' => 1,
                'campus' => 'Santa Rosa',
                'pabellones' => 1
            ],
            [
                'idSede' => 1,
                'campus' => 'Hogar Universidad',
                'pabellones' => 4
            ],
            [
                'idSede' => 1,
                'campus' => 'Kaufmann',
                'pabellones' => 3
            ],
            [
                'idSede' => 1,
                'campus' => 'Zegers',
                'pabellones' => 1
            ],
            [
                'idSede' => 1,
                'campus' => 'Casa Sur Iquique',
                'pabellones' => 1
            ],
            [
                'idSede' => 1,
                'campus' => 'Salvador Allende',
                'pabellones' => 1
            ],
            [
                'idSede' => 1,
                'campus' => 'Santiago Polanco',
                'pabellones' => 1
            ],
            [
                'idSede' => 1,
                'campus' => 'Centro de Salud',
                'pabellones' => 1
            ],
            [
                'idSede' => 1,
                'campus' => 'Palacio Astoreca',
                'pabellones' => 1
            ],
            [
                'idSede' => 1,
                'campus' => 'Patricio Lynch',
                'pabellones' => 1
            ],
            [
                'idSede' => 1,
                'campus' => 'Emac',
                'pabellones' => 1
            ],
            [
                'idSede' => 1,
                'campus' => 'Edificio Centro Iquique',
                'pabellones' => 1
            ],
            [
                'idSede' => 1,
                'campus' => 'Edificio Don Alfredo',
                'pabellones' => 1
            ],
            [
                'idSede' => 1,
                'campus' => 'Edificio Contadores',
                'pabellones' => 1
            ],
            [
                'idSede' => 1,
                'campus' => 'Edificio Dharma',
                'pabellones' => 1
            ],
            [
                'idSede' => 1,
                'campus' => 'Edificio Dharma',
                'pabellones' => 1
            ],
            [
                'idSede' => 1,
                'campus' => 'Pedro Lagos',
                'pabellones' => 1
            ],
            [
                'idSede' => 1,
                'campus' => 'Pedro Lagos',
                'pabellones' => 1
            ],
            [
                'idSede' => 2,
                'campus' => 'Santa María',
                'pabellones' => 1
            ],
            [
                'idSede' => 2,
                'campus' => 'Proyecto Investigación',
                'pabellones' => 1
            ],
            [
                'idSede' => 3,
                'campus' => 'Latorre',
                'pabellones' => 1
            ],
            [
                'idSede' => 4,
                'campus' => 'Villa Chica',
                'pabellones' => 1
            ],
            [
                'idSede' => 5,
                'campus' => 'San Pablo',
                'pabellones' => 1
            ],
            [
                'idSede' => 5,
                'campus' => 'República',
                'pabellones' => 1
            ],
            [
                'idSede' => 6,
                'campus' => 'Ohiggins',
                'pabellones' => 18
            ],
            [
                'idSede' => 6,
                'campus' => 'Lagos',
                'pabellones' => 1
            ],
            [
                'idSede' => 6,
                'campus' => 'Ramírez',
                'pabellones' => 1
            ],
            [
                'idSede' => 7,
                'campus' => 'Colon',
                'pabellones' => 1
            ],
            [
                'idSede' => 8,
                'campus' => 'Ejercito',
                'pabellones' => 1
            ],
        ];


        foreach ($campus as $item) {
            $c = new Campus();
            $c->idSede = $item['idSede'];
            $c->campus = $item['campus'];
            $c->pabellones = $item['pabellones'];
            $c->save();
        }
    }
}
