<?php

use Illuminate\Database\Seeder;

class apartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Apartment',100)->create();
    }
}
