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
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'app@nedkab.nl',
                'company' => 'Nedkab',
                'phone' => '0412213030',
                'type' => 'admin',
                'password' => bcrypt('N3dk@b2022!')
            ]
        ];

        foreach($users as $user) {
            App\User::create($user);
        }
    }
}
