<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CourseLearn extends Model
{
    use HasFactory, HasUlids;

    public function learnable(): MorphTo
    {
        return $this->morphTo();
    }
    public function likes(): HasMany
    {
        return $this->morphTo();
    }
}
