<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path1 = 'database/sql/cities_2020_11_05_1.sql';
        DB::unprepared(file_get_contents($path1));

        $path2 = 'database/sql/cities_2020_11_05_2.sql';
        DB::unprepared(file_get_contents($path2));

        $path3 = 'database/sql/cities_2020_11_05_3.sql';
        DB::unprepared(file_get_contents($path3));

        $path4 = 'database/sql/cities_2020_11_05_4.sql';
        DB::unprepared(file_get_contents($path4));
    }
}
