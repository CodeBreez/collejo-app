<?php

namespace Collejo\App\Modules\Classes\Seeder;

use Collejo\App\Modules\Classes\Models\Batch;
use Collejo\App\Modules\Classes\Models\Clasis;
use Collejo\App\Modules\Classes\Models\Grade;
use Collejo\App\Modules\Classes\Models\Term;
use Collejo\Foundation\Database\Seeder;

class BatchesAndGradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $years = array_fill(0, 15, null);
        foreach ($years as $k => $v) {
            $years[$k] = $this->faker->dateTimeBetween('-10 years', 'now');
        }
        // create 12 grades
        foreach (range(1, 12) as $num) {
            $grade = factory(Grade::class)->create(['name' => 'Grade '.$num]);
            foreach (range(1, 5) as $class) {
                factory(Clasis::class)->create(['name' => $num.'-'.$class, 'grade_id' => $grade->id]);
            }
        }
        // create batches
        foreach ($years as $y) {
            factory(Batch::class)->create(['name' => $this->course().' - '.$y->format('Y').' Batch'])
                ->each(function ($batch) use ($y) {
                    $batch->grades()->sync($this->createPivotIds($this->faker->randomElements(Grade::all()->pluck('id')->all(), 5)));
                    $batch->terms()->save(factory(Term::class)->make([
                    'name' => $this->faker->randomElement(['Winter', 'Summer', 'Fall']),
                ]));
                });
        }
    }

    private function course()
    {
        return $this->faker->randomElement([
            'International Business',
            'Marketing',
            'Accounting for a Small Business',
            'Geotechnologies',
            'International Law',
            'The Environment and Resource Management',
            'History and Politics',
            'International Languages',
            'Computer Programming',
            'Literature',
        ]);
    }
}
