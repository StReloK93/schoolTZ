<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory;


    protected $with = ['role'];
    
    protected $guard = 'student';

    protected $fillable = ['name','group_id', 'password' , 'role_id' , 'email'];

    protected $hidden = ['password'];


    public function role()
    {
        return $this->hasOne(Role::class , 'id' , 'role_id');
    }


    protected $casts = [
        'created_at' => 'datetime:Y-M-d',
    ];
}
