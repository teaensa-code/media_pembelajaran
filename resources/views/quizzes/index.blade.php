@extends('layouts.app')

@section('title', 'Kuis')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>❓ Kuis</h1>
            @if($isTeacher)
                <a href="{{ route('quizzes.create') }}" class="btn btn-success">➕ Tambah Kuis</a>
            @endif
        </div>

        @if($quizzes->isEmpty())
            <div class="alert alert-info">
                Belum ada kuis. @if($isTeacher) <a href="{{ route('quizzes.create') }}">Tambah kuis sekarang</a> @endif
            </div>
        @else
            <div class="row">
                @foreach($quizzes as $quiz)
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $quiz->title }}</h5>
                                <p class="card-text">{{ $quiz->description ?? 'Tidak ada deskripsi' }}</p>
                                
                                @if(!$isTeacher)
                                    @php
                                        $userResult = $userResults->firstWhere('quiz_id', $quiz->id);
                                    @endphp
                                    <div class="mb-2">
                                        @if($userResult)
                                            <span class="badge bg-success">✅ Dikerjakan</span>
                                            <small class="text-success">Score: {{ $userResult->score }}/100</small>
                                        @else
                                            <span class="badge bg-warning text-dark">⏳ Belum dikerjakan</span>
                                        @endif
                                    </div>
                                @else
                                    <div class="mb-2">
                                        <span class="badge bg-info">{{ $quiz->results()->count() }} siswa</span>
                                    </div>
                                @endif

                                <small class="text-muted d-block">Dibuat: {{ $quiz->created_at->format('d-m-Y H:i') }}</small>
                                
                                <div class="mt-3">
                                    <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-primary btn-sm">📖 Lihat</a>
                                    @if($isTeacher)
                                        <a href="{{ route('quizzes.results', $quiz->id) }}" class="btn btn-info btn-sm">📊 Hasil</a>
                                        <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
