<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetCreateRequest;
use App\Http\Requests\PetUpdateRequest;
use App\Models\Pet;

class PetController extends Controller
{
    public function create(PetCreateRequest $request): string
    {
        try {
            $data = $request->validated();
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

    public function update(PetUpdateRequest $request, string $id): string
    {
        $pet = Pet::findOrFail($id);
        $data = $request->validated();
        $pet->updateOrFail($data);
        return 'Pet updated successfully';
    }
}
