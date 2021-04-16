<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;

class AppConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loc = [
            'name' => 'RS Harapan Kita',
            'address' => 'Let Jend. S. Parman Kav.8'
        ];
        $location = Config::create(['config_name' => 'location', 'config_value' => json_encode($loc)]);

//        $pricing = [
//            'first_hour' => 3000,
//            'next_hour' => 3000
//        ];
//        $price = Config::create(['config_name' => 'pricing', 'config_value' => json_encode($pricing)]);
    }
}
