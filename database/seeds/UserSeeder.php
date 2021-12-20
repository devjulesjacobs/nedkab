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
                'name' => 'Jules Jacobs',
                'email' => 'example@email.com',
                'company' => 'Nedkab',
                'phone' => '+31 6 12345678',
                'type' => 'app',
                'password' => bcrypt('password')
            ],
            [
                'name' => 'Administrator',
                'email' => 'admin@email.com',
                'company' => 'Nedkab',
                'phone' => '+31 6 12345678',
                'type' => 'admin',
                'password' => bcrypt('password')
            ]
        ];

        foreach($users as $user) {
            App\User::create($user);
        }
    }
}
