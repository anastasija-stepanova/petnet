<?php

namespace App\Services;

use App\Models\MyUser;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create(mixed $data): void
    {
        $data['password'] = Hash::make($data['password']);
        MyUser::create($data);
    }

    public function update(mixed $data, MyUser $user)
    {
        $user->updateOrFail($data + [
                'password' => Hash::make($data['password']),
            ]);
    }
}
