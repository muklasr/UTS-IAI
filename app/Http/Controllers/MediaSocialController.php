<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\MediaSocial;

class MediaSocialController extends Controller
{

    public function index()
    {
        $result = MediaSocial::all();

        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }
     
    public function store(Request $request)
    {
        $user = UserController::getCurrentUser($request);
        $result = MediaSocial::create([
            'user_id' => $user->id,
            'social_media' => $request->social_media,
            'username' => $request->username
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
     
    public function show(Request $request)
    {

        $user = UserController::getCurrentUser($request);
        $result = MediaSocial::where('user_id', $user->id)->get();

        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data = 'Maaf, data media sosial milik '.$user->name.' tidak ditemukan';
        }
        return response()->json($data);
    }
    
    public function destroy($id)
    {
        $result = MediaSocial::destroy('id', $id);

        if($result){
            $data = "Data berhasil dihapus";
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }
}
