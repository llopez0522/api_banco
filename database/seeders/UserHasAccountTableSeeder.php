<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserHasAccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uc = [
            [
                'user_id' => 1,
                'account_id' => 1,
            ],
            [
                'user_id' => 1,
                'account_id' => 2,
            ],
        ];
        foreach ($uc as $item) {
            DB::table('user_has_account')->insert([
                'user_id' => $item['user_id'],
                'account_id' => $item['account_id'],
            ]);
        }
    }
}
