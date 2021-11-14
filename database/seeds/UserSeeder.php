<?php

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
        App\User::create([
            'name' => 'Jules Jacobs',
            'email' => 'jules@gmail.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
