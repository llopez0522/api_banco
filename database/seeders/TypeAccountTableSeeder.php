<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeAccount = [
            ['name' => 'Ahorros'],
            ['name' => 'Corriente'],
        ];
        foreach ($typeAccount as $item) {
            DB::table('type_account')->insert([
                'name' => $item['name'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
