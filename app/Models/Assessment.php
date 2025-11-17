<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;
use App\Models\Subject;
use App\Models\User;
use App\Models\StudentScore;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'subject_id',
        'faculty_id',
        'title',
        'type',
        'max_score',
        'term',
        'schedule_date',
        'schedule_time',
        'school_year',
        'semester'
    ];

    protected $casts = [
        'schedule_date' => 'date',
        'schedule_time' => 'datetime',
    ];

    // ✅ Add this:
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function faculty()
    {
        return $this->belongsTo(User::class, 'faculty_id');
    }

    public function scores()
    {
        return $this->hasMany(StudentScore::class);
    }
}
