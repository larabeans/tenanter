<?php

namespace App\Containers\Vendor\Tenanter\UI\CLI\Commands;

use App\Containers\Vendor\Tenanter\Tasks\CreateDomainTask;
use App\Containers\Vendor\Tenanter\Tasks\CreateHostTask;
use App\Containers\Vendor\Tenanter\Tasks\CreateUserTask;
use Illuminate\Console\Command;

class SetupHost extends Command
{
    protected $description = 'This command creates host, adds host domains, and host configuration.';

    protected $signature = 'tenanter:setup:host';

    private $data = [];
    private $questions = [
        'name' => 'Enter host name',
        'domain' => 'Enter primary domain for host e.g. <fg=blue> www.example.com',
        'email' => 'Enter email for host admin user. <fg=blue> usear@example.com',
        'password' => 'Enter password for host user'
    ];

    public function handle()
    {
        $this->data['name'] = $this->ask($this->questions['name']);
        $this->data['domain'] = $this->ask($this->questions['domain']);
        $this->validateDomain();
        $this->data['email'] = $this->ask($this->questions['email']);
        $this->validateEmail();
        $this->data['password'] = $this->ask($this->questions['password']);

        $this->checkInput();

        $host = app(CreateHostTask::class)->run($this->data['name']);

        $user = app(CreateUserTask::class)->run(
            true,
            $host->id,
            $this->data['email'],
            $this->data['password']
        )->assignRole('admin');

        $domain = app(CreateDomainTask::class)->run(
            $this->data['domain'],
            true,
            'host',
            $host->id
        );
        $this->line('<fg=green>' . "Host setup successfully\n");
    }

    public function checkInput()
    {
        foreach ($this->data as $key => $value) {
            if ($value == null) {
                $this->line('<fg=red>' . "Empty " . $key . " ,Please Enter value\n");
                $this->data[$key] = $this->ask($this->questions[$key]);
                if($key == 'email') {
                    $this->validateEmail();
                } elseif ($key == 'domain') {
                    $this->validateDomain();
                }
            }
        }
    }

    public function validateEmail()
    {
        if (preg_match("/^[^@]+@[^@]+\.[a-z]{2,6}$/i", $this->data['email']) == 0) {
            $this->line('<fg=red>' . "Invalid Email \n");
            $this->data['email'] = $this->ask($this->questions['email']);
        }
    }

    public function validateDomain()
    {
        if (preg_match("/(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]/", $this->data['domain']) == 0) {
            $this->line('<fg=red>' . "Invalid Domain \n");
            $this->data['domain'] = $this->ask($this->questions['domain']);
        }
    }

}
