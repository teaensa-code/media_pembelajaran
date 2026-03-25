<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        $isTeacher = auth()->user()->role === 'guru';
        return view('materials.index', ['materials' => $materials, 'isTeacher' => $isTeacher]);
    }

    public function create()
    {
        return view('materials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('materials', 'public');
        }

        Material::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $filePath,
        ]);

        return redirect()->route('materials.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function download(Material $material)
    {
        if (!$material->file_path) {
            return redirect()->back()->with('error', 'File tidak tersedia.');
        }

        if (!Storage::disk('public')->exists($material->file_path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($material->file_path);
    }

    public function destroy(Material $material)
    {
        if ($material->file_path && Storage::disk('public')->exists($material->file_path)) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();
        return redirect()->route('materials.index')->with('success', 'Materi berhasil dihapus.');
    }
}
