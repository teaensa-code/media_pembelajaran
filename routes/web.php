<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\GameController;

// Public Routes
Route::get('/', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Protected Routes (Memerlukan Login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Materi Routes
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/{material}/download', [MaterialController::class, 'download'])->name('materials.download');
    Route::middleware('isTeacher')->group(function () {
        Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
        Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
        Route::delete('/materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');
    });
    
    // Video Routes
    Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
    Route::get('/videos/{video}/download', [VideoController::class, 'download'])->name('videos.download');
    Route::middleware('isTeacher')->group(function () {
        Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
        Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
        Route::delete('/videos/{video}', [VideoController::class, 'destroy'])->name('videos.destroy');
    });
    
    // Task Routes
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/{task}/download', [TaskController::class, 'download'])->name('tasks.download');
    Route::get('/tasks/{task}/submit', [TaskController::class, 'submitForm'])->name('tasks.submit.form');
    Route::post('/tasks/{task}/submission', [TaskController::class, 'storeSubmission'])->name('tasks.submission.store');
    Route::get('/submissions/{submission}/download', [TaskController::class, 'downloadSubmission'])->name('tasks.submission.download');
    Route::middleware('isTeacher')->group(function () {
        Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
        Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
        Route::get('/tasks/{task}/submissions', [TaskController::class, 'submissions'])->name('tasks.submissions');
        Route::get('/tasks/{task}/submission/{submission}/grade', [TaskController::class, 'showGradeForm'])->name('tasks.grade.form');
        Route::post('/tasks/{task}/submission/{submission}/grade', [TaskController::class, 'storeGrade'])->name('tasks.grade.store');
    });
    
    // Quiz Routes
    Route::middleware('isTeacher')->group(function () {
        Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
        Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
        Route::delete('/quizzes/{quiz}', [QuizController::class, 'destroy'])->name('quizzes.destroy');
        Route::get('/quizzes/{quiz}/results', [QuizController::class, 'results'])->name('quizzes.results');
    });
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz}/result', [QuizController::class, 'storeResult'])->name('quizzes.storeResult');
    
    // Game Routes
    Route::middleware('isTeacher')->group(function () {
        Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
        Route::post('/games', [GameController::class, 'store'])->name('games.store');
        Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');
        Route::get('/games/{game}/results', [GameController::class, 'results'])->name('games.results');
    });
    Route::get('/games', [GameController::class, 'index'])->name('games.index');
    Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');
    Route::get('/games/{game}/download', [GameController::class, 'download'])->name('games.download');
    Route::post('/games/{game}/result', [GameController::class, 'storeResult'])->name('games.storeResult');
});
