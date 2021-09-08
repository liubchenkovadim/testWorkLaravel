<?php

namespace App\Console\Commands;

use App\Services\EmployeeCheck;
use Illuminate\Console\Command;

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

    private $check;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(EmployeeCheck $check)
    {
        $this->check = $check;
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
        $result = $this->check->getSkillForEmployee($user);
        if(!empty($result)){
            if(isset($result['error'])){
                foreach ($result['error'] as $error){
                    $this->error($error);
                }
            }
            if(isset($result['info'])){
                foreach ($result['info'] as $info){
                    $this->info($info);
                }
            }
        }

        return 0;
    }
}
