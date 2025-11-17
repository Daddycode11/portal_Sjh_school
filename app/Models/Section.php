<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name', 'grade_level'];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'section_id');
    }
}
