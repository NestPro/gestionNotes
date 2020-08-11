<?php

use App\Models\StudentInfo;
use Illuminate\Database\Seeder;

class StudentInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(StudentInfo::class, 30)->states('sixieme')->create();
        factory(StudentInfo::class, 25)->states('cinquieme')->create();
        factory(StudentInfo::class, 20)->states('quatrieme')->create();
    }
}
