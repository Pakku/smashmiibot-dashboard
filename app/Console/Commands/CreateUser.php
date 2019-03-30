<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\CreateUsers;
use Illuminate\Validation\ValidationException;

class CreateUser extends Command
{

    use CreateUsers;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an user';

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
     * @return mixed
     */
    public function handle()
    {
        $this->askData();

        try {
            $this->validateData();

            $this->createUser();
        } catch (ValidationException $e) {
            $this->error($e->getMessage());
            foreach ($e->errors() as $errorField) {
                foreach ($errorField as $error) {
                    $this->error($error);
                }
            }

            return 2;
        }

        
    }

    private function askData()
    {
        $this->name = $this->ask('Enter user name');
        $this->email = $this->ask('Enter email');
        $this->password = $this->secret('Enter password');
        $this->passwordConfirmation = $this->secret('Confirm password');
    }

    private function validateData()
    {
        
            $validator = $this->validator([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->passwordConfirmation,
            ])->validate();
        
        
    }

    private function createUser() {
        $this->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);

        $this->info('User created successfully');
    }
}
