<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    public function register(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $http = new Client;

        $response = $http->post(url('oauth/token'), [
         'form_params' => [
            'grant_type' => 'password',
            'client_id' => '2',
            'client_secret' => 'oZNuI0nyu7iC0QaOBDqu7IFFYOPMaAip7yOGhpWc',
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
         ],
        ]);
     return response(['auth' => json_decode((string) $response->getBody(), true), 'user'=>$user]);
    }



    public function login(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::Where('email', $request->email)->first();

        if(!$user){

            // return response(['status' => 'error', 'message' => 'User not found on our database.']);
            return response;
        }
        if(Hash::check($request->password, $user->password)){

            $http = new Client;

            $response = $http->post(url('oauth/token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'oZNuI0nyu7iC0QaOBDqu7IFFYOPMaAip7yOGhpWc',
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '',
                 ],
             ]);

             return response(['auth' => json_decode((string) $response->getBody(), true), 'user'=>$user]);
        }
    }

}
