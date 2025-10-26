<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_id',
        'section_id',
        'subject_id',
        'school_year',
        'semester'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function syllabi()
    {
        return $this->hasMany(Syllabus::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
