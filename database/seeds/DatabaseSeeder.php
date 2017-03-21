<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RolSeeder::class);
        $this->call(PerfilSeeder::class);
        $this->call(SedesTableSeeder::class);
        $this->call(CampusTableSeeder::class);
    }
}
