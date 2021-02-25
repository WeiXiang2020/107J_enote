<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'course_id',
    ];

    public function ta()
    {
        return $this->hasMany(Course::class);
    }

}
