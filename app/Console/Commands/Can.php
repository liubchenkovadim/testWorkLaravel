<?php

namespace App\Console\Commands;

use App\Models\EmployeeSkill;
use App\Models\Skill;
use App\Models\Employee;
use Illuminate\Console\Command;

class Can extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employee:can {user} {skill}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checking the skills of employees';

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
        $skill = $this->argument('skill');
        $employee = Employee::where('name', $user)->first();
        if (!is_null($employee)) {
            $skill_name = Skill::where('key', $skill)->first();
            if (!is_null($skill_name)) {
                $checked = EmployeeSkill::where('employee_id', $employee->id)
                    ->where('skill_id', $skill_name->id)
                    ->first();
                if (!is_null($checked)) {
                    $this->info("true");
                } else {
                    $this->error("false");
                }
            } else {
                $this->error("Skill {$skill} not exists!");
                $skills = Skill::all();
                $this->info("Skill exists:");
                foreach ($skills as $item) {
                    $this->info("-  key = {$item->key}");
                }
            }
        } else {
            $this->error("Employee {$user} not exists!");
            $employees = Employee::all();
            $this->info("Employee exists:");
            foreach ($employees as $employee) {
                $this->info("- {$employee->name}");
            }
        }

        return 0;
    }
}
