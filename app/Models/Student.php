<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory;


    protected $with = ['role'];

    protected $fillable = ['name','group_id', 'password' , 'role_id' , 'email'];

    protected $hidden = ['password'];


    protected $casts = [
        'created_at' => 'datetime:Y-M-d',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

}
