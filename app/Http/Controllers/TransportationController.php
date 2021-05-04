<?php

namespace App\Http\Controllers;

use App\Transportation;
use Illuminate\Http\Request;
use Auth;

class TransportationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $date = $request->date;
            if($date)
                $collection = Transportation::where('player_id', Auth::user()->id)->where('date', $date)->get();
            else
                $collection = Transportation::where('player_id', Auth::user()->id)->get();

            $data = ['data' => $collection, 'status' => true, 'message' => "success"];
            return $data;
        } catch (\Exception $e) {
            return ['status' => false, 'message' => "something went wrong"];
        }
    }
}
