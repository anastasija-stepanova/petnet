<?php

namespace App\Http\Controllers;

use App\Models\MyUser;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetController extends Controller
{
    public function create(Request $request): string
    {
        try {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'type' => ['required', 'integer'],
                'breed' => ['required', 'integer'],
                'age' => 'integer',
                'gender' => 'integer',
                'avatar' => 'string',
            ]);
            Pet::create($data);
            return 'Pet created successfully';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function get(string $id): Pet
    {
        return Pet::findOrFail($id);
    }

    public function delete(string $id): string
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();
        return 'Pet deleted successfully';
    }

    public function update(Request $request, string $id): string
    {
        $pet = Pet::findOrFail($id);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'integer'],
            'breed' => ['required', 'integer'],
            'age' => 'integer',
            'gender' => 'integer',
            'avatar' => 'string',
        ]);
        $pet->updateOrFail($data);
        return 'Pet updated successfully';
    }
}
