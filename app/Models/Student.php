<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Student extends User
{
    // Force the table to 'users'
    protected $table = 'users';

    /**
     * The "booted" method of the model.
     * Adds a global scope to automatically filter users with role 'client'
     */
    protected static function booted()
    {
        static::addGlobalScope('student', function (Builder $query) {
            $query->where('user_role', 'client');
        });
    }
}
