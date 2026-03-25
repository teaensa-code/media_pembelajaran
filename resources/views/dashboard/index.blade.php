@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
        <p class="text-muted">Anda login sebagai: <strong>{{ ucfirst(auth()->user()->role) }}</strong></p>

        @if(auth()->user()->role === 'guru')
            <div class="alert alert-info">
                ✅ Anda memiliki akses penuh. Anda dapat menambah dan menghapus item di setiap fitur.
            </div>
        @else
            <div class="alert alert-info">
                👁️ Anda memiliki akses read-only. Anda hanya dapat melihat item.
            </div>
        @endif

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">📖 Materi</h5>
                        <p class="card-text">Lihat semua materi pembelajaran</p>
                        <a href="{{ route('materials.index') }}" class="btn btn-primary">Buka Materi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">🎬 Video Pembelajaran</h5>
                        <p class="card-text">Lihat semua video pembelajaran</p>
                        <a href="{{ route('videos.index') }}" class="btn btn-primary">Buka Video</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">✏️ Tugas</h5>
                        <p class="card-text">Lihat semua tugas yang tersedia</p>
                        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Buka Tugas</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">❓ Kuis</h5>
                        <p class="card-text">Lihat semua kuis yang tersedia</p>
                        <a href="{{ route('quizzes.index') }}" class="btn btn-primary">Buka Kuis</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">🎮 Game</h5>
                        <p class="card-text">Lihat semua game pembelajaran</p>
                        <a href="{{ route('games.index') }}" class="btn btn-primary">Buka Game</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
