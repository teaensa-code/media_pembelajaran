<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        $isTeacher = auth()->user()->role === 'guru';
        $userSubmissions = [];
        
        if (!$isTeacher) {
            $userId = auth()->id();
            foreach ($tasks as $task) {
                $submission = TaskSubmission::where('task_id', $task->id)
                    ->where('user_id', $userId)
                    ->first();
                $userSubmissions[$task->id] = $submission;
            }
        }
        
        return view('tasks.index', [
            'tasks' => $tasks,
            'isTeacher' => $isTeacher,
            'userSubmissions' => $userSubmissions,
        ]);
    }

    public function create()
    {
        return view('tasks.create');
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
            $filePath = $file->store('tasks', 'public');
        }

        Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $filePath,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function download(Task $task)
    {
        if (!$task->file_path) {
            return redirect()->back()->with('error', 'File tidak tersedia.');
        }

        if (!Storage::disk('public')->exists($task->file_path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($task->file_path);
    }

    public function destroy(Task $task)
    {
        if ($task->file_path && Storage::disk('public')->exists($task->file_path)) {
            Storage::disk('public')->delete($task->file_path);
        }

        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus.');
    }

    /**
     * Show submissions for a task (for teachers)
     */
    public function submissions(Task $task)
    {
        $submissions = TaskSubmission::where('task_id', $task->id)
            ->with('user')
            ->get();
        
        return view('tasks.submissions', [
            'task' => $task,
            'submissions' => $submissions,
        ]);
    }

    /**
     * Show form to submit task (for students)
     */
    public function submitForm(Task $task)
    {
        // Check if student already submitted
        $existingSubmission = TaskSubmission::where('task_id', $task->id)
            ->where('user_id', auth()->id())
            ->first();

        return view('tasks.submit', [
            'task' => $task,
            'existingSubmission' => $existingSubmission,
        ]);
    }

    /**
     * Store task submission
     */
    public function storeSubmission(Request $request, Task $task)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        // Delete old submission if exists
        $oldSubmission = TaskSubmission::where('task_id', $task->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($oldSubmission && Storage::disk('public')->exists($oldSubmission->file_path)) {
            Storage::disk('public')->delete($oldSubmission->file_path);
            $oldSubmission->delete();
        }

        // Store new submission
        $file = $request->file('file');
        $filePath = $file->store('submissions', 'public');

        TaskSubmission::create([
            'task_id' => $task->id,
            'user_id' => auth()->id(),
            'file_path' => $filePath,
            'submitted_at' => now(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dikumpulkan.');
    }

    /**
     * Download submission
     */
    public function downloadSubmission(TaskSubmission $submission)
    {
        // Check authorization
        $isTeacher = auth()->user()->role === 'guru';
        if (!$isTeacher && $submission->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        if (!Storage::disk('public')->exists($submission->file_path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($submission->file_path);
    }

    /**
     * Show grading form
     */
    public function showGradeForm(Task $task, TaskSubmission $submission)
    {
        // Verify teacher
        if (auth()->user()->role !== 'guru') {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        // Verify submission belongs to task
        if ($submission->task_id !== $task->id) {
            return redirect()->back()->with('error', 'Submission tidak ditemukan.');
        }

        return view('tasks.grade', [
            'task' => $task,
            'submission' => $submission,
        ]);
    }

    /**
     * Store grade and feedback
     */
    public function storeGrade(Request $request, Task $task, TaskSubmission $submission)
    {
        // Verify teacher
        if (auth()->user()->role !== 'guru') {
            return redirect()->back()->with('error', 'Akses ditolak.');
        }

        // Verify submission belongs to task
        if ($submission->task_id !== $task->id) {
            return redirect()->back()->with('error', 'Submission tidak ditemukan.');
        }

        $validated = $request->validate([
            'grade' => 'required|integer|min:0|max:100',
            'feedback' => 'nullable|string|max:1000',
        ]);

        $submission->update([
            'grade' => $validated['grade'],
            'feedback' => $validated['feedback'] ?? null,
            'graded_at' => now(),
        ]);

        return redirect()->route('tasks.submissions', $task->id)
            ->with('success', 'Nilai dan feedback berhasil disimpan.');
    }
}
