<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['student_id' ,'subject_id' , 'grade'];

    protected $with = ['subject'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }


    protected $casts = [
        'created_at' => 'datetime:Y-M-d',
    ];
}
