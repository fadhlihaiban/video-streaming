<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Request as VideoRequest;

class CheckVideoAccess
{

    public function handle(Request $request, Closure $next): Response
    {
        
        $video = $request->route('video');

        if (!$video) {
            return response('Video tidak ditemukan.', 404);
        }

        
        $approvedRequest = VideoRequest::where('user_id', auth()->id())
                                       ->where('video_id', $video->id)
                                       ->where('status', 'approved')
                                       ->where('approved_until', '>', now()) 
                                       ->first();

        // 3. Cek Otorisasi
        if (!$approvedRequest) {
            return redirect()->route('customer.videos.index')
                             ->with('error', 'Akses ditolak. Anda belum memiliki izin tonton atau akses sudah kadaluarsa.');
        }

        return $next($request);
    }
}