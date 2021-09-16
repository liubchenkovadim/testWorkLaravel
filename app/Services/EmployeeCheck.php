<?php

namespace App\Services;

use App\Models\employeeAndSkill;

class EmployeeCheck
{
    private $skill = [
        'writeCode' => 'code writing',
        'testingCode' => 'code testing',
        'communicationManager' => 'communication with manager',
        'draw' => 'draw',
        'setTasks' => 'set tasks',
    ];

    private $employeeAndSkill = [
        'programmer' => [
            'writeCode',
            'testingCode',
            'communicationManager',
        ],
        'designer' => [
            'communicationManager',
            'draw',
        ],
        'tester' => [
            'communicationManager',
            'testingCode',
            'setTasks',
        ],
        'manager' => [
            'setTasks',
        ],
    ];

    private function isExistsSkill($skill)
    {
        if (!empty($skill) && isset($this->skill[$skill])) {
            return true;
        }
        return false;
    }

    private function isExistsUser($user)
    {
        if (!empty($user) && isset($this->employeeAndSkill[$user])) {
            return true;
        }
        return false;
    }

    private function getSkillName($key)
    {
        if (isset($this->skill[$key])) {
            return $this->skill[$key];
        }
        return false;
    }

    private function getAllSkillForEmployee($employee)
    {
        $result = [];
        if (isset($this->employeeAndSkill[$employee])) {
            foreach ($this->employeeAndSkill[$employee] as $item) {
                $name = $this->getSkillName($item);
                if ($name) {
                    $result[] = $name;
                }
            }
        }

        return $result;
    }

    private function isExistsSkillForEmployee($employee, $skill)
    {
        if (isset($this->employeeAndSkill[$employee]) && in_array($skill,$this->employeeAndSkill[$employee])) {
            return true;
        }

        return false;
    }

    private function getAllEmployee()
    {
        $result = [];
        foreach ($this->employeeAndSkill as $key => $element) {
            $result[] = $key;
        }
        return $result;
    }

    public function getCheckSkillExists($user, $skill)
    {
        $data = [];
        if (empty($user) || empty($skill)) {
            $data['error'][] = "Parameters not corect!";
            return $data;
        }
        if ($this->isExistsUser($user)) {
            if ($this->isExistsSkill($skill)) {
                $checked = $this->isExistsSkillForEmployee($user, $skill);
                if (!empty($checked)) {
                    $data['info'][] = "true";
                } else {
                    $data['error'][] = "false";
                }
            } else {
                $data['error'][] = "Skill {$skill} not exists!";
                $skills = $this->skill;
                $data['info'][] = "Skill exists:";
                foreach ($skills as $key => $item) {
                    $data['info'][] = "-  key = {$key}";
                }
            }
        } else {
            $data['error'][] = "Employee {$user} not exists!";
            $employees = $this->getAllEmployee();
            $data['info'][] = "Employee exists:";
            foreach ($employees as $employee) {
                $data['info'][] = "- {$employee}";
            }
        }
        return $data;
    }

    public function getSkillForEmployee($user)
    {
        $data = [];
        if ($this->isExistsUser($user)) {
            $skils = $this->getAllSkillForEmployee($user);
            $data['info'][] = "Employee {$user} skills:";
            foreach ($skils as  $skill) {
                $data['info'][] = "- {$skill}";
            }
        } else {
            $data['error'][] = "Employee {$user} not exists!";
            $employees = $this->getAllEmployee();
            $data['info'][] = "Employee exists:";

            foreach ($employees as $employee) {
                $data['info'][] = "- {$employee}";
            }
        }
        return $data;
    }
}
