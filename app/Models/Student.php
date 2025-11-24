<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Student extends User
{
    protected $table = 'users'; // Use users table

    protected $fillable = [
        'name',
        'student_id',
        'major',
        'gender',
        'grade_level',
        'address',
        'contact_number',
        'parent_name',
        'relationship',
        'parent_contact',
        'parent_email',
    ];

    protected static function booted()
    {
        static::addGlobalScope('student', function (Builder $query) {
            $query->where('user_role', 'client');
        });
    }
}
