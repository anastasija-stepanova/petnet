<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PetType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pet_types';
    protected $guarded = false;

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class, 'type', 'id');
    }
}
