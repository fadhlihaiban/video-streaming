<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Request as VideoRequest;
use Carbon\Carbon;

class RequestController extends Controller
{
    
    public function index()
    {
        
        $requests = VideoRequest::with(['user', 'video'])->orderBy('created_at', 'desc')->get();
        
        return view('admin.requests.index', compact('requests'));
    }
    
    
    public function approve(VideoRequest $request)
    {
        
        $request->update([
            'status' => 'approved',
            'approved_until' => Carbon::now()->addDays(7), 
        ]);

        return redirect()->back()->with('success', 'Akses video berhasil disetujui selama 7 hari.');
    }

    
    public function reject(VideoRequest $request)
    {
        $request->update([
            'status' => 'rejected',
            'approved_until' => null,
        ]);

        return redirect()->back()->with('success', 'Permintaan akses video berhasil ditolak.');
    }

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
