<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Course extends Model
{
    use HasFactory, HasUlids;

    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Difficulty::class);
    }

    public function learns(): MorphMany
    {
        return $this->morphMany(CourseLearn::class, 'learnable');
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(CourseRequirement::class);
    }
    public function sections(): HasMany
    {
        return $this->hasMany(CourseSection::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(CourseReview::class);
    }
}
