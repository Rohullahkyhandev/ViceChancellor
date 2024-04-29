<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\permission;
use App\Models\User;
use App\Models\userpermission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|min:8',
        ]);

        // User::create([
        //     'name' => 'Rohullah',
        //     'email' => $request->email,
        //     'position' => 'department manager',
        //     'photo_path' => 'http://localhost/image.jpg',
        //     'photo' => 'test.jpg',
        //     'password' => $request->password,
        //     'user_type' => 'admin',
        //     'user_departments_id' => 1,p
        // ]);

        if (!Auth::attempt($credential)) {
            return response([
                'message' => 'ایمل آدرس یا  پسورد شما درست نمی باشد'
            ], 403);
        }
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function getCurrentUser(Request $request)
    {
        return $request->user();
    }

    public function getCurrentPermission()
    {
        return permission::query()
            ->join('userpermissions', 'userpermissions.permission_id', 'permissions.id')
            ->where('user_id', Auth::id())
            ->select('permissions.*', 'userpermissions.permission_id as id')
            ->get();
    }


    public function logout()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->currentAccessToken()->delete;
        return response(['', 204]);
    }
}
