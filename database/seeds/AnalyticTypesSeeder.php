<?php

use App\AnalyticType;
use Illuminate\Database\Seeder;

class AnalyticTypesSeeder extends Seeder
{
    /**
     * Run the database seeds
     *
     * @return void
     */
    public function run()
    {
        AnalyticType::unguard();
        AnalyticType::create([
            'id'                 => 1,
            'name'               => 'max_Bld_Height_m',
            'units'              => 'm',
            'is_numeric'         => TRUE,
            'num_decimal_places' => 1,
        ]);
        AnalyticType::create([
            'id'                 => 2,
            'name'               => 'min_lot_size_m2',
            'units'              => 'm2',
            'is_numeric'         => TRUE,
            'num_decimal_places' => 0,
        ]);
        AnalyticType::create([
            'id'                 => 3,
            'name'               => 'fsr',
            'units'              => ':1',
            'is_numeric'         => TRUE,
            'num_decimal_places' => 2,
        ]);
        AnalyticType::reguard();
    }
}
