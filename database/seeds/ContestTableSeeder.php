<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ContestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now()->toDateTimeString();

        DB::table('contests')->insert(
            [
                [
                    'name' => 'Кубок 1',
                    'status' => 1,
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
                [
                    'name' => 'Кубок 2',
                    'status' => 1,
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
                [
                    'name' => 'Кубок 3',
                    'status' => 1,
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
            ]
        );
    }
}
