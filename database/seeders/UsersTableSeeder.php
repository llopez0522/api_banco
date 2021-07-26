<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'document' => '0148',
                'username' => 'Luis Miguel Lopez Lopez',
                'phone' => '3005492794',
                'email' => 'luism.lopezl22@gmail.com',
                'state' => 1,
            ],
        ];
        foreach ($user as $item) {
            DB::table('users')->insert([
                'document' => $item['document'],
                'username' => $item['username'],
                'phone' => $item['phone'],
                'email' => $item['email'],
                'password' => Hash::make($item['document']),
                'state' => $item['state'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
