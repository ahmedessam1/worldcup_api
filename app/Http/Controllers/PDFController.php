<?php

namespace App\Http\Controllers;

use App\PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function index()
    {
        try {
            $collection = PDF::all();
            $data = ['data' => $collection, 'status' => true, 'message' => "success"];
            return $data;
        } catch (\Exception $e) {
            return ['status' => false, 'message' => "something went wrong"];
        }
    }
}
