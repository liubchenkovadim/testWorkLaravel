<?php
namespace App\Services;

use App\Models\Employee as EmployeeModel;
use App\Models\EmployeeSkill;
use App\Models\Skill;

class EmployeeCheck
{
    public function getSkillForEmployee($user)
    {
        $data = [];
        $employee = EmployeeModel::where('name', $user)->first();
        if (!is_null($employee)) {
            $skils = EmployeeSkill::where('employee_id', $employee->id)->get();
            $data['info'][] = "Employee {$user} skills:";
            foreach ($skils as $skill) {
                $name = Skill::find($skill->skill_id);
                $data['info'][] = "- {$name->name}";
            }
        } else {
            $data['error'][] = "Employee {$user} not exists!";
            $employees = EmployeeModel::all();
            $data['info'][] = "Employee exists:";

            foreach ($employees as $employee) {
                $data['info'][] = "- {$employee->name}";
            }
        }
        return $data;
    }
}
