<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as HttpRequest;
use App\Models\Request as VideoRequest;

use App\Models\Video;

class RequestController extends Controller
{
    
    public function store(Video $video)
    {
        $existingRequest = VideoRequest::where('user_id', auth()->id())
                                    ->where('video_id', $video->id)
                                    ->first();
        
        if ($existingRequest) {
            return redirect()->back()->with('warning', 'Anda sudah pernah mengajukan permintaan untuk video ini.');
        }
        
        VideoRequest::create([
            'user_id' => auth()->id(),
            'video_id' => $video->id,
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Permintaan akses berhasil diajukan!');
    }
}