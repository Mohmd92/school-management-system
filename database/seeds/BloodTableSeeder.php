<?php

use App\Models\Blood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('blood_types')->delete();

        $types = [
            'O-', 'O+',
            'A-', 'A+',
            'B-', 'B+',
            'AB-', 'AB+',
        ];

        foreach ($types as $type)
        {
            Blood::create(['type' => $type]);
        }
    }
}
