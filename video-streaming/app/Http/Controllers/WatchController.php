<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class WatchController extends Controller
{
    public function show(Video $video)
    {
        return view('customer.watch', compact('video'));
    }
}