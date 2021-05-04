<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $http = new \GuzzleHttp\Client;

        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->email,
                    'password' => $request->password,
                ],
            ]);
            $collection = json_decode($response->getBody(), true);
            $data = ['data' => $collection, 'status' => true, 'message' => "success"];

            return $data;
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            $data = ['status' => false, 'message' => 'Your credentials are incorrect. Please try again'];
            if ($e->getCode() === 400)
                return response()->json($data, $e->getCode());
            else if ($e->getCode() === 401) {
                return response()->json($data, $e->getCode());
            }
            return response()->json($data, $e->getCode());
        }
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'max:255',
                'unique:users'
            ],
            'password' => 'required|string|min:4',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $user;
    }
}
