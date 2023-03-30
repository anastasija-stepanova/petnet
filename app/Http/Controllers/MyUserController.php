<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\MyUser;
use Illuminate\Support\Facades\Hash;

class MyUserController extends Controller
{
    public function create(UserCreateRequest $request): string
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($request->password);
            MyUser::create($data);
            return 'User created successfully';
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                return 'User with this email address already exists';
            }
        }
        return 'User created failed';
    }

    public function get(string $id): MyUser
    {
        return MyUser::findOrFail($id);
    }

    public function delete(string $id): string
    {
        $user = MyUser::findOrFail($id);
        $user->delete();
        return 'User deleted successfully';
    }

    public function update(UserUpdateRequest $request, string $id): string
    {
        $user = MyUser::findOrFail($id);
        $data = $request->validated();
        $user->updateOrFail($data + [
                'password' => Hash::make($request->password),
            ]);
        return 'User updated successfully';
    }
}
