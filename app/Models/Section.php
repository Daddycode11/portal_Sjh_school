<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'school_year',
        'semester',
        // add other fields as needed
    ];

    /**
     * Students in this section
     */
    public function students()
    {
        // Assuming you have a pivot table 'section_student' with section_id and student_id
        return $this->belongsToMany(User::class, 'section_student', 'section_id', 'student_id')
                    ->withPivot('school_year', 'semester')
                    ->withTimestamps();
    }

    /**
     * Subjects in this section
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'section_subject', 'section_id', 'subject_id')
                    ->withPivot('school_year', 'semester')
                    ->withTimestamps();
    }
}
