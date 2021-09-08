<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\EmployeeSkill;
use App\Models\Skill;

class SkillCheck
{
    public function getCheckSkillExists($user, $skill)
    {
        $data = [];
        if(empty($user) || empty($skill)){
            $data['error'][] = "Parameters not corect!";
            return $data;
        }
        $employee = Employee::where('name', $user)->first();
        if (!is_null($employee)) {
            $skill_name = Skill::where('key', $skill)->first();
            if (!is_null($skill_name)) {
                $checked = EmployeeSkill::where('employee_id', $employee->id)
                    ->where('skill_id', $skill_name->id)
                    ->first();
                if (!is_null($checked)) {
                    $data['info'][] = "true";
                } else {
                    $data['error'][] = "false";
                }
            } else {
                $data['error'][] = "Skill {$skill} not exists!";
                $skills = Skill::all();
                $data['info'][] = "Skill exists:";
                foreach ($skills as $item) {
                    $data['info'][] = "-  key = {$item->key}";
                }
            }
        } else {
            $data['error'][] = "Employee {$user} not exists!";
            $employees = Employee::all();
            $data['info'][] = "Employee exists:";
            foreach ($employees as $employee) {
                $data['info'][] = "- {$employee->name}";
            }
        }
     return $data;
    }
}
