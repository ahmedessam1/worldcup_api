<?php

namespace App\Http\Controllers;

use App\Player;
use App\User;
use Illuminate\Http\Request;
use Auth;

class PlayersController extends Controller
{
    public function index()
    {
        try {
            $collection = User::where('role', 'player')->get();
            $data = ['data' => $collection, 'status' => true, 'message' => "success"];
            return $data;
        } catch (\Exception $e) {
            return ['status' => false, 'message' => "something went wrong"];
        }
    }

    public function show($id)
    {
        try {
            $collection = User::where('role', 'player')->find($id);
            $data = ['data' => $collection, 'status' => true, 'message' => "success"];
            return $data;
        } catch (\Exception $e) {
            return ['status' => false, 'message' => "something went wrong"];
        }
    }
}
