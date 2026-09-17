<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // relasi one to many dengan model Question
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    // relasi many-to-many dengan tabel exams
    public function exams(): BelongsToMany
    {
        return $this->belongsToMany(Exam::class)
            ->withPivot('qty');
    }
}
