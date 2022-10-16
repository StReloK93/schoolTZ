<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $casts = [
        'created_at' => 'datetime:Y-M-d',
    ];


    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
