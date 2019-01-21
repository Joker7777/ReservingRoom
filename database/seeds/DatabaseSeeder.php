<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $item = new \App\BookList();

        $item->name = $faker->name;
        $item->one_time_date = date('Y-m-d', time());
        // $item->every_week_start_date = null;
        // $item->every_week_end_date = null;
        // $item->every_week_day = null;
        $item->frame = 5;
        // $item->every_week = false;
        $item->representative = $faker->name;
        $item->save();

        // $this->call(UsersTableSeeder::class);
    }
}
