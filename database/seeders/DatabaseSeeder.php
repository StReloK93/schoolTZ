<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use App\Models\Director;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::factory(3)->state(new Sequence(
            ['name' => 'director'],
            ['name' => 'teacher'],
            ['name' => 'student']
        ))->create();

        Director::factory(3)->create();

        Group::factory(10)->create();

        Student::factory(30)->create();

        Subject::factory(10)->create();

        Grade::factory(60)->create();

    }
}
