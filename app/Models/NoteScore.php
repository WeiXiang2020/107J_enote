<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteScore extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'note_id',
        'score',
        'time',
    ];
}
