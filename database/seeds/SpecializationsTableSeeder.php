<?php

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('specializations')->delete();

        $specializations = [
            ['en'=> 'Arabic', 'ar'=> 'عربي'],
            ['en'=> 'Science', 'ar'=> 'علوم'],
            ['en'=> 'Computer', 'ar'=> 'حاسب آلي'],
            ['en'=> 'English', 'ar'=> 'إنجليزي'],
        ];
        foreach ($specializations as $special) {
            Specialization::create(['name' => $special]);
        }
    }
}
