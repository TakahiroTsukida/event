<?php

use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            'id'             => '1',
            'name'           => 'オンライン',
            'tel'            => null,
            'postcode'       => null,
            'pref_code'      => null,
            'city_code'      => null,
            'block'          => null,
            'open'           => null,
            'close'          => null,
            'web'            => null,
            'google_map_url' => null,
            'image_path'     => null,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }
}
