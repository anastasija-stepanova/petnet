<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gender extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'genders';
    protected $guarded = false;

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class, 'gender', 'id');
    }
}
