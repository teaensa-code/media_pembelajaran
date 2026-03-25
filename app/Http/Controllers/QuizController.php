<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        $isTeacher = auth()->user()->role === 'guru';
        $userResults = auth()->user()->quizResults ?? collect();
        return view('quizzes.index', ['quizzes' => $quizzes, 'isTeacher' => $isTeacher, 'userResults' => $userResults]);
    }

    public function create()
    {
        return view('quizzes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
        ]);

        Quiz::create($validated);
        return redirect()->route('quizzes.index')->with('success', 'Kuis berhasil ditambahkan.');
    }

    public function show(Quiz $quiz)
    {
        $userResult = QuizResult::where('quiz_id', $quiz->id)
            ->where('user_id', auth()->id())
            ->first();

        return view('quizzes.show', ['quiz' => $quiz, 'userResult' => $userResult]);
    }

    public function submitForm(Quiz $quiz)
    {
        return view('quizzes.submit', ['quiz' => $quiz]);
    }

    public function storeResult(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'score' => 'required|integer|min:0|max:100',
            'result' => 'nullable|string',
        ]);

        $result = QuizResult::updateOrCreate(
            ['quiz_id' => $quiz->id, 'user_id' => auth()->id()],
            [
                'score' => $validated['score'],
                'result' => $validated['result'],
                'submitted_at' => now(),
            ]
        );

        return redirect()->route('quizzes.show', $quiz->id)
            ->with('success', 'Hasil kuis berhasil disimpan.');
    }

    public function results(Quiz $quiz)
    {
        $results = QuizResult::where('quiz_id', $quiz->id)
            ->with('user')
            ->get();

        return view('quizzes.results', ['quiz' => $quiz, 'results' => $results]);
    }

    public function destroy(Quiz $quiz)
    {
        if ($quiz->file_path && Storage::disk('public')->exists($quiz->file_path)) {
            Storage::disk('public')->delete($quiz->file_path);
        }

        $quiz->results()->delete();
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'Kuis berhasil dihapus.');
    }
}
