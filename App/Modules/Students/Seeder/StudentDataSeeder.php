<?php

namespace Collejo\App\Modules\Students\Seeder;

use Collejo\App\Modules\ACL\Models\User;
use Collejo\App\Modules\Students\Models\Guardian;
use Collejo\App\Modules\Students\Models\Student;
use Collejo\App\Modules\Students\Models\StudentCategory;
use Collejo\Foundation\Database\Seeder;

class StudentDataSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		// Create student categories
		foreach ([
					  'Transferred',
					  'Economy',
					  'Foreign',
					  'Special Education',
				  ] as $category) {
			factory(StudentCategory::class)->create([
				 'name' => $category,
				 'code' => substr(strtoupper($category), 0, 3),
			]);
		}

		factory(User::class, 20)->create()->each(function ($user) {
			$student = factory(Student::class)->make();

			$student->user()->associate($user);
            $student->studentCategory()->associate($this->faker->randomElement(StudentCategory::all()));

            $student->save();

			$guardian = factory(Guardian::class)->make();

			$guardianUser = factory(User::class)->create();

			$guardian->user()->associate($guardianUser)->save();

			$student->guardians()->sync($this->createPivotIds([$guardian->id]));
		});
	}
}
