<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Video;

class VideoController extends Controller
{

    public function index()
    {
        $videos = Video::all(); 

        return view('admin.videos.index', compact('videos'));
    }


    public function create()
    {
        return view('admin.videos.create');
    }
    
    
    
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'youtube_id' => 'required|string|max:50|unique:videos,youtube_id', 
        ]);

        Video::create($validated);

        return redirect()->route('admin.videos.index')
                         ->with('success', 'Video baru berhasil ditambahkan.');
    }
    
    
    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video')); 
    }
    
    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'youtube_id' => 'required|string|max:50|unique:videos,youtube_id,' . $video->id, 
        ]);

        $video->update($validated);

        return redirect()->route('admin.videos.index')
                         ->with('success', 'Video berhasil diperbarui.');
    }
    
    
    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('admin.videos.index')
                         ->with('success', 'Video "' . $video->title . '" berhasil dihapus.');
    }

    

}
