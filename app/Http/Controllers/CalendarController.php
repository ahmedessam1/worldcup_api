<?php

namespace App\Http\Controllers;

use App\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->date;
        try {
            if($request->filter) {
                $collection = Calendar::where('date', $date)->where('gender', $request->filter)->get();
            } else {
                $collection = Calendar::where('date', $date)->get();
            }
            $data = ['data' => $collection, 'status' => true, 'message' => "success"];
            return $data;
        } catch (\Exception $e) {
            return ['status' => false, 'message' => "something went wrong"];
        }
    }
}
