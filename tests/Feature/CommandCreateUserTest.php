<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommandCreateUserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test for create user feature via command
     *
     * @return void
     */
    public function testCommandSuccessful()
    {
        $password = $this->faker->password();
        $this->artisan('user:create')
            ->expectsQuestion('Enter user name', $this->faker->firstName())
            ->expectsQuestion('Enter email', $this->faker->safeEmail())
            ->expectsQuestion('Enter password', $password)
            ->expectsQuestion('Confirm password', $password)
            ->expectsOutput('User created successfully')
            ->assertExitCode(0);
    }

    /**
     * Tests that an email cannot be duplicated
     *
     * @return void
     */
    public function testDuplicatedMail()
    {
        $email = $this->faker->safeEmail();
        $password = $this->faker->password();
        $this->artisan('user:create')
            ->expectsQuestion('Enter user name', $this->faker->firstName())
            ->expectsQuestion('Enter email', $email)
            ->expectsQuestion('Enter password', $password)
            ->expectsQuestion('Confirm password', $password)
            ->expectsOutput('User created successfully')
            ->assertExitCode(0);

        $this->artisan('user:create')
            ->expectsQuestion('Enter user name', $this->faker->firstName())
            ->expectsQuestion('Enter email', $email)
            ->expectsQuestion('Enter password', $password)
            ->expectsQuestion('Confirm password', $password)
            ->assertExitCode(2);
    }

    /**
     * Tests that an email must have the correct format
     *
     * @return void
     */
    public function testWrongMail()
    {
        $password = $this->faker->password();
        $this->artisan('user:create')
            ->expectsQuestion('Enter user name', $this->faker->firstName())
            ->expectsQuestion('Enter email', 'wrongmail')
            ->expectsQuestion('Enter password', $password)
            ->expectsQuestion('Confirm password', $password)
            ->assertExitCode(2);

    }

    /**
     * Tests length for password
     *
     * @return void
     */
    public function testShortPass()
    {
        $password = $this->faker->password();
        $this->artisan('user:create')
            ->expectsQuestion('Enter user name', $this->faker->firstName())
            ->expectsQuestion('Enter email', $this->faker->safeEmail())
            ->expectsQuestion('Enter password', 'short')
            ->expectsQuestion('Confirm password', 'short')
            ->assertExitCode(2);

    }

    /**
     * Tests password that hasn't been confirmed well
     *
     * @return void
     */
    public function testPassBadConfirmed()
    {
        $password = $this->faker->password();
        $passwordBadConfirmed = $this->faker->password();
        $this->artisan('user:create')
            ->expectsQuestion('Enter user name', $this->faker->firstName())
            ->expectsQuestion('Enter email', $this->faker->safeEmail())
            ->expectsQuestion('Enter password', $password)
            ->expectsQuestion('Confirm password', $passwordBadConfirmed)
            ->assertExitCode(2);

    }


}
