<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

use App\Models\Director;
use App\Models\Student;
use App\Models\Teacher;

use App\Models\Group;
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

        Director::factory()->create(['email' => 'director@mail.com']);
        
        Teacher::factory()->create(['email' => 'teacher@mail.com']);

        Director::factory(3)->create();

        Teacher::factory(3)->create();



        Group::factory(10)->create();

        Student::factory(10)->create();

        Student::factory()->create(['email' => 'student@mail.com']);

        

        Subject::factory(10)->create();

        Grade::factory(200)->create();

    }
}
