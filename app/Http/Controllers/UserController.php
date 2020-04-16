<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use App\Http\Middleware\JwtMiddleware;
use App\User;

class UserController extends Controller
{
     
    public static function getCurrentUser(Request $request){
        $credentials = JWT::decode($request->token, env('JWT_SECRET'), ['HS256']);
        $user = User::find($credentials->sub);
        return $user;
    }
     
    public function register(Request $request)
    {
        $result = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->input('password'))
        ]);

        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }
     
    public function show($id)
    {
        $result = User::where('id', $id)->first();

        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }
    
    public function update(Request $request, $id)
    {
        $result = User::where('id',$id)->first();
        $result->name = $request->input('name');
        $result->email = $request->input('email');
        $result->password = Hash::make($request->input('password'));
        $result->save();

        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function destroy($id)
    {
        $result = User::destroy('id', $id);

        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }
}
