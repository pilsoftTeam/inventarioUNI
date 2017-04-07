<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
                'name' => 'revisor',
                'rut' => null,
                'fono' => null,
                'email' => 'revisor@sistema.cl',
                'password' => bcrypt('revisor'),
                'estado' => true
            ],
            [
                'name' => 'supervisor',
                'rut' => null,
                'fono' => null,
                'email' => 'supervisor@sistema.cl',
                'password' => bcrypt('supervisor'),
                'estado' => true
            ],
            [
                'name' => 'admin',
                'rut' => null,
                'fono' => null,
                'email' => 'admin@sistema.cl',
                'password' => bcrypt('admin'),
                'estado' => true
            ],
            [
                'name' => 'Maria Lorena Villalobos Cortes',
                'rut' => ' 10.699.929-5',
                'fono' => 978399407,
                'email' => 'marialvi39@gmail.com',
                'password' => bcrypt('10699929'),
                'estado' => true
            ],
            [
                'name' => 'Jimena Soledad Caamaño Diaz',
                'rut' => '13.263.689-3',
                'fono' => 956834198,
                'email' => 'soledad7531@msn.com',
                'password' => bcrypt('13263689'),
                'estado' => true
            ],
            [
                'name' => 'Ariel Patricio González Arredondo',
                'rut' => '18.372.815-6',
                'fono' => 977053869,
                'email' => 'arieel19@gmail.com',
                'password' => bcrypt('18372815'),
                'estado' => true
            ],
            [
                'name' => 'Katherine Roxana Zalles Olivares',
                'rut' => '20.086.494-8',
                'fono' => 965848454,
                'email' => ' 	kathyzalles@yahoo.com',
                'password' => bcrypt('20086494'),
                'estado' => true
            ],
            [
                'name' => 'Romina Eileen Grimaldi Aguilera ',
                'rut' => '17.096.260-5',
                'fono' => 957667928,
                'email' => 'grimaldiromi@gmail.com',
                'password' => bcrypt('17096260'),
                'estado' => true
            ],
            [
                'name' => 'Yasna Riveros Souza',
                'rut' => '16.671.580-6',
                'fono' => 962494456,
                'email' => 'abita_1987@hotmail.com',
                'password' => bcrypt('16671580'),
                'estado' => true
            ],
            [
                'name' => 'Macarena Abarca Godoy',
                'rut' => '16.733.544-6',
                'fono' => 950695125,
                'email' => 'macarena.abarca.godoy@gmail.com',
                'password' => bcrypt('16733544'),
                'estado' => true
            ],
            [
                'name' => 'Carolina Andrea Rivera Jiménez',
                'rut' => '16.873.622-3',
                'fono' => 985090487,
                'email' => 'karito-2015@hotmail.com',
                'password' => bcrypt('16873622'),
                'estado' => true
            ],
            [
                'name' => 'Constanza Andrea Opazo Herrera',
                'rut' => '19.500.203-4',
                'fono' => 987018553,
                'email' => 'constanza-andreaa@hotmail.com',
                'password' => bcrypt('19500203'),
                'estado' => true
            ],
            [
                'name' => 'Peggy Patricia Pérez Marambio',
                'rut' => '9.395.238-3',
                'fono' => 954239101,
                'email' => 'peggy.ppm@gmail.com',
                'password' => bcrypt('9395238'),
                'estado' => true
            ],
            [
                'name' => 'Nicole Betsabé Gaete Estay',
                'rut' => '18.299.453-7',
                'fono' => 954229111,
                'email' => 'n.gaetestay@gmail.com',
                'password' => bcrypt('18299453'),
                'estado' => true
            ],
            [
                'name' => 'Catalina de la Mackarena Lastra Rebollo',
                'rut' => '18.372.848-2',
                'fono' => 988346207,
                'email' => 'catamackarenaaa@gmail.com',
                'password' => bcrypt('18372848'),
                'estado' => true
            ],


        ];

        foreach ($users as $user) {
            $u = new User();
            $u->name = $user['name'];
            $u->rut = $user['rut'];
            $u->fono = $user['fono'];
            $u->email = $user['email'];
            $u->estado = $user['estado'];
            $u->password = $user['password'];
            $u->save();
        }


    }
}
