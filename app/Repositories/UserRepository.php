<?php


namespace App\Repositories;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function create(Request $request)
    {
        return User::create([
            'name' => $request->get('name'),
            'password' => Hash::make($request->get('password')),
        ]);
    }

    public function getUser($credentials)
    {
        $user = User::all()->where('name', $credentials['name'])->first();
        return Hash::check($credentials['password'], $user['password']);
    }

}