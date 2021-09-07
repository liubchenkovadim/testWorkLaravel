<?php

namespace App\Console\Commands;

use App\Models\EmployeeSkill;
use App\Models\Skill;
use Illuminate\Console\Command;
use App\Models\Employee as EmployeeModel;

class Employee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'company:employee {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displaying the list of skills employee.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = $this->argument('user');
        $employee = EmployeeModel::where('name', $user)->first();
        if (!is_null($employee)) {
            $skils = EmployeeSkill::where('employee_id', $employee->id)->get();
            $this->info("Employee {$user} skills:");
            foreach ($skils as $skill) {
                $name = Skill::find($skill->skill_id);
                $this->info("- {$name->name}");
            }
        } else {
            $this->error("Employee {$user} not exists!");
            $employees = EmployeeModel::all();
            $this->info("Employee exists:");
            foreach ($employees as $employee) {
                $this->info("- {$employee->name}");
            }
        }

        return 0;
    }
}
