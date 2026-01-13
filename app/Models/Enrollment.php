<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'student_name',
        'subject_id',
        'grade_level',
        'strand',
        'section',
        'section_id',
        'contact_number',
        'email',
        'status'
    ];


    /**
     * Each enrollment belongs to a student.
     */
    public function student()
    {
        return $this->belongsTo(Student::class); // Make sure you have a Student model
    }
}
