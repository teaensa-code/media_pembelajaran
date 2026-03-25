<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        $isTeacher = auth()->user()->role === 'guru';
        return view('videos.index', ['videos' => $videos, 'isTeacher' => $isTeacher]);
    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'upload_type' => 'required|in:file,link',
            'file' => 'nullable|required_if:upload_type,file|file|mimes:mp4,avi|max:51200',
            'video_link' => 'nullable|required_if:upload_type,link|url',
        ], [
            'file.required_if' => 'File video harus di-upload ketika tipe upload adalah file.',
            'file.mimes' => 'Format video harus MP4 atau AVI.',
            'file.max' => 'Ukuran file maksimal 50MB.',
            'video_link.required_if' => 'Link video harus diisi ketika tipe upload adalah link.',
            'video_link.url' => 'Link harus URL yang valid.',
        ]);

        $filePath = null;
        $videoLink = null;

        if ($validated['upload_type'] === 'file' && $request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('videos', 'public');
        } elseif ($validated['upload_type'] === 'link') {
            $videoLink = $validated['video_link'];
        }

        Video::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $filePath,
            'video_link' => $videoLink,
        ]);

        return redirect()->route('videos.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function download(Video $video)
    {
        if (!$video->file_path) {
            return redirect()->back()->with('error', 'File video tidak tersedia.');
        }

        if (!Storage::disk('public')->exists($video->file_path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($video->file_path);
    }

    public function destroy(Video $video)
    {
        if ($video->file_path && Storage::disk('public')->exists($video->file_path)) {
            Storage::disk('public')->delete($video->file_path);
        }

        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video berhasil dihapus.');
    }
}
