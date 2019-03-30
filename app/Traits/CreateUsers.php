<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;

trait CreateUsers
{
	public function validator(array $data)
	{
		return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
	}

	public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}