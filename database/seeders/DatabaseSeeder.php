<?php

namespace Database\Seeders;

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
         $this->call(TypeMovementTableSeeder::class);
         $this->call(TypeAccountTableSeeder::class);
         $this->call(BanksTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(AccountTableSeeder::class);
         $this->call(UserHasAccountTableSeeder::class);
    }
}
