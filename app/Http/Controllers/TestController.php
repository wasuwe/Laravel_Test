<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() {
       
        $data = '';

        return view('admin.test.index', compact('data'));
    }
}
