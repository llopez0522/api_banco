<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $account = [
            [
                'type_account_id' => 1,
                'name' => 'Bancolombia',
                'number_' => '4800055847158803',
                'value' => 1000000,
                'type_' => 'Cuentas Propias',
                'state' => 1,
            ],
            [
                'type_account_id' => 1,
                'name' => 'Nequi',
                'number_' => '4371563020327524',
                'value' => 10000,
                'type_' => 'Cuentas Propias',
                'state' => 0,
            ],
        ];
        foreach ($account as $item) {
            DB::table('account')->insert([
                'type_account_id' => $item['type_account_id'],
                'name' => $item['name'],
                'number_' => $item['number_'],
                'value' => $item['value'],
                'type_' => $item['type_'],
                'state' => $item['state'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
