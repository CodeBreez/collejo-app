<?php

namespace Collejo\App\Modules\Employees\Seeder;

use Collejo\App\Modules\ACL\Models\User;
use Collejo\App\Modules\Employees\Models\Employee;
use Collejo\App\Modules\Employees\Models\EmployeeCategory;
use Collejo\App\Modules\Employees\Models\EmployeeDepartment;
use Collejo\App\Modules\Employees\Models\EmployeeGrade;
use Collejo\App\Modules\Employees\Models\EmployeePosition;
use Collejo\Foundation\Database\Seeder;

class EmployeeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create employee categories
        foreach ([
                     'Principal',
                     'Assistant Teacher',
                     'Teacher',
                     'Instructor',
                     'Lab assistant',
                     'Accountant',
                 ] as $category) {

            $categoryModel = factory(EmployeeCategory::class)->create([
                'name' => $category,
                'code' => substr(strtoupper($category), 0, 3),
            ]);

            // Create employee positions
            foreach ([
                         'Principal',
                         'Assistant Teacher',
                         'Teacher',
                         'Instructor',
                         'Lab assistant',
                         'Accountant',
                     ] as $position) {

                factory(EmployeePosition::class)->create([
                    'name' => $position,
                    'employee_category_id' => $categoryModel->id
                ]);
            }
        }

        // Create employee departments
        foreach ([
                     'Accounting',
                     'Human Resources',
                     'Academic',
                     'Management',
                 ] as $department) {

            factory(EmployeeDepartment::class)->create([
                'name' => $department,
                'code' => substr(strtoupper($department), 0, 3),
            ]);
        }

        // Create employee grades
        foreach ([
                     'A',
                     'B',
                     'X',
                     'C',
                 ] as $grade) {

            factory(EmployeeGrade::class)->create([
                'name' => $grade,
                'code' => substr(strtoupper($grade), 0, 3),
            ]);
        }

        factory(User::class, 20)->create()->each(function ($user) {

            $employee = factory(Employee::class)->make();

            $employee->employeeDepartment()->associate($this->faker->randomElement(EmployeeDepartment::all()));
            $employee->employeePosition()->associate($this->faker->randomElement(EmployeePosition::all()));
            $employee->employeeGrade()->associate($this->faker->randomElement(EmployeeGrade::all()));

            $employee->user()->associate($user)->save();
        });
    }
}
