<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Address::create([
            'user_id' => 2,
            'province_id' => 32,
            'regency_id' => 3209,
            'district_id' => 3209141,
            'village_id' => 3209141010,
            'title' => 'Alamsyah',
            'description' => 'Rumah',
        ]);
    }
}
