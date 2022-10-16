<?php

namespace App\Services;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Auth;
use Hash;
use App\Models\Role;
class AuthService {

    public function login($request) {

        if($request->role_id == 3){
            $guard = Auth::guard('studentsapi');
        }else{
            $guard = Auth::guard('web');
        }

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
        else{
            User::create($params);
        }
        return response()->json(true, 200);

    }

    public function logout($request): void {

        $user = $request->user();
        $user->currentAccessToken()->delete();

    }

}