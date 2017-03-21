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
                'email' => 'revisor@sistema.cl',
                'password' => bcrypt('revisor')
            ],
            [
                'name' => 'supervisor',
                'email' => 'supervisor@sistema.cl',
                'password' => bcrypt('supervisor')
            ],
            [
                'name' => 'admin',
                'email' => 'admin@sistema.cl',
                'password' => bcrypt('admin')
            ]
        ];

        foreach ($users as $user) {
            $u = new User();
            $u->name = $user['name'];
            $u->email = $user['email'];
            $u->password = $user['password'];
            $u->save();
        }


    }
}
