<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeMovementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeMovement = [
            ['name' => 'Consignación'],
            ['name' => 'Retiro'],
            ['name' => 'Transferencia'],
        ];
        foreach ($typeMovement as $item) {
            DB::table('type_movement')->insert([
                'name' => $item['name'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
