<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentRequest extends Model
{
    protected $fillable = [
        'user_id',
        'grade_level',
        'section_id',
        'school_year',
        'status',
        'remarks'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}

