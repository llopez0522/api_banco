<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bank = [
            ['name' => 'Bancolombia', 'state' => 1],
            ['name' => 'Nequi', 'state' => 1],
        ];
        foreach ($bank as $item) {
            DB::table('banks')->insert([
                'name' => $item['name'],
                'state' => $item['state'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
