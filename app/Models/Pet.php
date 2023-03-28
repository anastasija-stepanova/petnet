<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pets';
    protected $guarded = false;

    public function petType(): BelongsTo
    {
        return $this->belongsTo(PetType::class, 'type', 'id');
    }

    public function petBreed(): BelongsTo
    {
        return $this->belongsTo(PetBreed::class, 'breed', 'id');
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class, 'gender', 'id');
    }
}
