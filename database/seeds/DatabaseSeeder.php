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
        $this->call(PropertiesSeeder::class);
        $this->call(AnalyticTypesSeeder::class);
        $this->call(PropertyAnalyticsSeeder::class);
    }
}
