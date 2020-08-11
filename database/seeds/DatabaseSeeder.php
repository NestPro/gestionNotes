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
        $this->call(UserSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(StudentInfoSeeder::class);
        //$this->call(DepartmentTableSeeder::class);
        //$this->call(ClassesTableSeeder::class);
        //$this->call(ExamsTableSeeder::class);
        //$this->call(GradesystemsTableSeeder::class);
        //$this->call(CoursesTableSeeder::class);
        //$this->call(GradesTableSeeder::class);
        //$this->call(ExamForClassesTableSeeder::class);
        //$this->call(FormsTableSeeder::class);
        //$this->call(AccountsTableSeeder::class);
        //$this->call(AccountSectorsTableSeeder::class);
    }
}
