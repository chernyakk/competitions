<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TourTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now()->toDateTimeString();

        DB::table('tours')->insert(
            [
                [
                    'name' => 'тур № 1',
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
                [
                    'name' => 'тур № 2',
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
                [
                    'name' => 'тур № 3',
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
                [
                    'name' => 'тур № 4',
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
                [
                    'name' => 'тур № 5',
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
                [
                    'name' => 'тур № 6',
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
                [
                    'name' => 'тур № 7',
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
                [
                    'name' => 'тур № 8',
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
                [
                    'name' => 'тур № 9',
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
                [
                    'name' => 'тур № 10',
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
                [
                    'name' => 'тур № 11',
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
                [
                    'name' => 'тур № 12',
                    'created_at' => $dt,
                    'updated_at' => $dt
                ],
            ]
        );
    }
}
