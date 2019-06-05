<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SportsmanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now()->toDateTimeString();

        DB::table('sportsmen')->insert(
            [
                [
                    'sportsman' => 'Иванов Иван Иванович',
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
                [
                    'sportsman' => 'Петров Петр Петрович',
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
                [
                    'sportsman' => 'Васильев Василий Васильевич',
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
            ]
        );
    }
}
