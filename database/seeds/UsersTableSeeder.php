<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now()->toDateTimeString();

        DB::table('users')->insert(
            [
                'name' => 'Виктор',
                'email' => 'viktor@mail.local',
                'password' => bcrypt('12345678'),
                'created_at' => $dt,
                'updated_at' => $dt
            ]
        );
    }
}
