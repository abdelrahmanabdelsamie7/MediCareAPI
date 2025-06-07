<?php
namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    public function run()
    {
        $admins = [
            [
                'name' => 'Abdelrahman Abdelsamie',
                'email' => 'abdelrahman1@medicare.com',
                'password' => Hash::make('01129508321'),
                'phone' => '01129508321',
                'is_super_admin' => true,
            ],
            [
                'name' => 'Mohamed Ahmed Ali',
                'email' => 'mohamed1@medicare.com',
                'password' => Hash::make('01551921438'),
                'phone' => '01551921438',
                'is_super_admin' => true,
            ],
            [
                'name' => 'Ali Maher',
                'email' => 'ali1@medicare.com',
                'password' => Hash::make('01278408531'),
                'phone' => '01278408531',
                'is_super_admin' => true,
            ],
            [
                'name' => 'Ahmed Mansour',
                'email' => 'ahmed1@medicare.com',
                'password' => Hash::make('01122035529'),
                'phone' => '01122035529',
                'is_super_admin' => true,
            ],
            [
                'name' => 'Mayada Mohamed',
                'email' => 'mayada1@medicare.com',
                'password' => Hash::make('01124052354'),
                'phone' => '01124052354',
                'is_super_admin' => true,
            ],
        ];

        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }

}