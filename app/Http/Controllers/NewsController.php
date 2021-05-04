<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function index()
    {
        try {
            $news = News::with('media')->with('tags')->paginate(10);
            $data = ['data' => $news, 'status' => true, 'message' => "success"];
            return $data;
        } catch (\Exception $e) {
            return ['status' => false, 'message' => "something went wrong"];
        }
    }

    public function show($id)
    {
        try {
            $news = News::with('media')->with('tags')->find($id);
            $data = ['data' => $news, 'status' => true, 'message' => "success"];
            return $data;
        } catch (\Exception $e) {
            return ['status' => false, 'message' => "something went wrong"];
        }
    }

    public function search(Request $q)
    {
        try {
            $query = $q->q;
            $news = News::with('media')->with('tags')->where('title', 'LIKE', '%'.$query.'%')->orWhereHas('tags', function($q) use ($query) {
                $q->where('name', 'LIKE', '%'.$query.'%');
            })->limit(15)->get();
            $data = ['data' => $news, 'status' => true, 'message' => "success"];

            return $data;
        } catch (\Exception $e) {
            return ['status' => false, 'message' => "something went wrong"];
        }
    }
}
