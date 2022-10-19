<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Models\Director;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Role;
use Auth;
use Hash;
class AuthService {

    public function login($request) {

        $guard = $this->guard($request->role_id);

        if ($guard->attempt($request->only('email', 'password', 'role_id'))) {

            $user = $guard->user();
            $token = $this->createToken($user);
            return response()->json(['token' => $token,'type' => 'Bearer'], 200);

        }

        return response()->json(['message' => 'the input data is incorrect!'], 422);
    }

    private function createToken($user) {
        return $user->createToken('name', [Role::find($user->role_id)->name])->plainTextToken;
    }


    public function register($request) {

        $params = $request->only('name','email','role_id','password');
        $params['password'] = Hash::make($params['password']);

        if($params['role_id'] == 3){
            Student::create($params);
        }
        elseif($params['role_id'] == 2){
            Teacher::create($params);
        }
        else{
            Director::create($params);
        }


        return response()->json(true, 200);

    }

    public function logout($request): void {

        $user = $request->user();
        $user->currentAccessToken()->delete();

    }


    public function guard($role_id){
        if($role_id == 3){
            return $guard = Auth::guard('students');
        }
        elseif ($role_id == 2) {
            return $guard = Auth::guard('teachers');
        }
        else{
            return $guard = Auth::guard('directors');
        }
    }
}