<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Video;
use App\Models\Request as VideoRequest;

use Illuminate\Routing\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        
        $user_requests = auth()->user()->requests()->get()->keyBy('video_id'); 
        
        return view('customer.videos.index', compact('videos', 'user_requests'));
    }
    
}
