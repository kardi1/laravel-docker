<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class UseraccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 3810; $i++) {
            $date = Carbon::create(2019, 3, 26, 0, 0, 0);
            DB::table('usersaccesses')->insert([
                'last_login' => $date->addWeeks(rand(1, 52))->format('Y-m-d H:i:s'),
                'user_id' => rand(1,500),
            ]);
        }
    }
}
