<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentApplication extends Model
{
    protected $fillable = [
        'student_id',
        'grade_level_id',
        'section_id',
        'school_year',
        'status',
    ];

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function gradeLevel() {
        return $this->belongsTo(GradeLevel::class);
    }

    public function section() {
        return $this->belongsTo(Section::class);
    }
}
