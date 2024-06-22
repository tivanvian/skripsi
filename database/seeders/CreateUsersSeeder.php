<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRole;

class CreateUsersSeeder extends Seeder
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
                'name'          => 'Superadmin',
                'email'         => 'superadmin@email.com',
                'password'      => bcrypt('123456'),
                'is_confirmed'  => '1',
                'is_active'     => '1',
                'default_role'  => 'superadmin',
            ],
            [
                'name'          => 'Admin',
                'email'         => 'admin@email.com',
                'password'      => bcrypt('123456'),
                'is_confirmed'  => '1',
                'is_active'     => '1',
                'default_role'  => 'admin',
            ],
            [
                'name'          => 'User',
                'email'         => 'user@email.com',
                'password'      => bcrypt('123456'),
                'is_confirmed'  => '1',
                'is_active'     => '1',
                'default_role'  => 'user',
            ],
        ];

        foreach ($users as $key => $user) {
            $UserData = User::create(
                [
                    'name'          => $user['name'],
                    'email'         => $user['email'],
                    'password'      => $user['password'],
                    'is_confirmed'  => $user['is_confirmed'],
                    'is_active'     => $user['is_active'],
                ]
            );

            if($user['default_role'] == 'user'){
                $typeUser = 'user';
            }else{
                $typeUser = 'admin';
            }

            //Create To User Role
            UserRole::create([
                'user_id'       => $UserData->id,
                'roles'         => [$user['default_role']],
                'default_role'  => $user['default_role'],
                'type'          => $typeUser,
            ]);
        }
    }
}
