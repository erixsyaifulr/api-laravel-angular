<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTExceptions;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $user = User::where('email', $request['email'])->first();

        if($user){
            $response['status'] = 0;
            $response['message'] = 'Email sudah digunakan';
            $response['code'] = 409;
        }
        else{
            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password)
            ]);
            $response['status'] = 1;
            $response['message'] = 'User register success';
            $response['code'] = 200;
        }

        return response()->json($response);
    }

    public function login(Request $request){

        $credentials = $request->only('email', 'password');
        try{
            if(!JWTAuth::attempt($credentials)){
                $response['status'] = 0;
                $response['code'] = 401;
                $response['data'] = null;
                $response['message'] = 'Email atau password salah';
                return response()->json($response);
            }
        }catch(JWTExceptions $e){
            $response['data'] = null;
            $response['code'] = 500;
            $response['message'] = 'Tidak dapat create token';
            return response()->json($response);
        }

        $user = auth()->user();
        $data['token'] = auth()->claims([
            'user_id' => $user->id,
            'semail' => $user->email
        ])->attempt($credentials);

                $response['data'] = $data;
                $response['status'] = 1;
                $response['code'] = 200;
                $response['message'] = 'Login sukses...';
                return response()->json($response);
    }
}
