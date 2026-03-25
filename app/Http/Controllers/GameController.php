<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        $isTeacher = auth()->user()->role === 'guru';
        $userResults = auth()->user()->gameResults ?? collect();
        return view('games.index', ['games' => $games, 'isTeacher' => $isTeacher, 'userResults' => $userResults]);
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'upload_type' => 'required|in:file,link',
            'file' => 'nullable|required_if:upload_type,file|file|mimes:zip,exe|max:51200',
            'link' => 'nullable|required_if:upload_type,link|url',
        ], [
            'file.required_if' => 'File game harus diupload.',
            'file.mimes' => 'File harus berformat ZIP atau EXE.',
            'file.max' => 'Ukuran file maksimal 50MB.',
            'link.required_if' => 'Link game harus diisi.',
            'link.url' => 'Format link tidak valid.',
        ]);

        $filePath = null;
        $link = null;

        if ($validated['upload_type'] === 'file' && $request->hasFile('file')) {
            $filePath = $request->file('file')->store('games', 'public');
        } elseif ($validated['upload_type'] === 'link') {
            $link = $validated['link'];
        }

        Game::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $filePath,
            'link' => $link,
        ]);

        return redirect()->route('games.index')->with('success', 'Game berhasil ditambahkan.');
    }

    public function show(Game $game)
    {
        $userResult = GameResult::where('game_id', $game->id)
            ->where('user_id', auth()->id())
            ->first();

        return view('games.show', ['game' => $game, 'userResult' => $userResult]);
    }

    public function submitForm(Game $game)
    {
        return view('games.submit', ['game' => $game]);
    }

    public function storeResult(Request $request, Game $game)
    {
        $validated = $request->validate([
            'score' => 'required|integer|min:0|max:100',
            'result' => 'nullable|string',
        ]);

        $result = GameResult::updateOrCreate(
            ['game_id' => $game->id, 'user_id' => auth()->id()],
            [
                'score' => $validated['score'],
                'result' => $validated['result'],
                'submitted_at' => now(),
            ]
        );

        return redirect()->route('games.show', $game->id)
            ->with('success', 'Hasil game berhasil disimpan.');
    }

    public function results(Game $game)
    {
        $results = GameResult::where('game_id', $game->id)
            ->with('user')
            ->get();

        return view('games.results', ['game' => $game, 'results' => $results]);
    }

    public function download(Game $game)
    {
        if (!$game->file_path || !Storage::disk('public')->exists($game->file_path)) {
            return redirect()->route('games.index')->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($game->file_path);
    }

    public function destroy(Game $game)
    {
        if ($game->file_path && Storage::disk('public')->exists($game->file_path)) {
            Storage::disk('public')->delete($game->file_path);
        }

        $game->results()->delete();
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Game berhasil dihapus.');
    }
}
