<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index()
    {
        try {
            $collection = Video::paginate(10);
            $data = ['data' => $collection, 'status' => true, 'message' => "success"];
            return $data;
        } catch (\Exception $e) {
            return ['status' => false, 'message' => "something went wrong"];
        }
    }

    public function show($id)
    {
        try {
            $collection = Video::find($id);
            $data = ['data' => $collection, 'status' => true, 'message' => "success"];
            return $data;
        } catch (\Exception $e) {
            return ['status' => false, 'message' => "something went wrong"];
        }
    }

    public function search(Request $q)
    {
        try {
            $query = $q->q;
            $collection = Video::where('title', 'LIKE', '%'.$query.'%')->limit(15)->get();
            $data = ['data' => $collection, 'status' => true, 'message' => "success"];
            return $data;
        } catch (\Exception $e) {
            return ['status' => false, 'message' => "something went wrong"];
        }
    }
}
