<?php

namespace App\Http\Controllers;

use App\Models\MyUser;
use Doctrine\Common\Lexer\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyUserController extends Controller
{
    public function create(Request $request): string
    {
        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:my_users'],
                'phone' => ['required', 'string', 'min:11'],
                'telegram' => 'string',
                'instagram' => 'string',
                'photo' => 'string',
                'password' => ['required', 'string', 'min:8']
            ]);
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

    public function update(Request $request, string $id): string
    {
        $user = MyUser::findOrFail($id);
        $data = $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:my_users'],
            'phone' => ['string', 'min:11'],
            'telegram' => 'string',
            'instagram' => 'string',
            'photo' => 'string',
            'password' => ['string', 'min:8']
        ]);
        $user->updateOrFail($data + [
                'password' => Hash::make($request->password),
            ]);
        return 'User updated successfully';
    }
}
