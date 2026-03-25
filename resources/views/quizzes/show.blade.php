@extends('layouts.app')

@section('title', 'Lihat Kuis')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>{{ $quiz->title }}</h1>
                <p class="text-muted">{{ $quiz->description ?? 'Tidak ada deskripsi' }}</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">← Kembali</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        📝 Kuis
                    </div>
                    <div class="card-body">
                        @if($quiz->link)
                            <p class="mb-3">Klik link di bawah untuk membuka kuis:</p>
                            <a href="{{ $quiz->link }}" target="_blank" class="btn btn-primary btn-lg">
                                Buka Kuis →
                            </a>
                        @else
                            <p class="text-muted">Kuis belum memiliki link.</p>
                        @endif
                    </div>
                </div>

                @if(auth()->user()->role === 'siswa')
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            ✅ Submit Hasil
                        </div>
                        <div class="card-body">
                            <form action="{{ route('quizzes.storeResult', $quiz->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="score" class="form-label">Skor (0-100)</label>
                                    <input type="number" class="form-control @error('score') is-invalid @enderror" 
                                           id="score" name="score" min="0" max="100" 
                                           value="{{ old('score', $userResult->score ?? '') }}" required>
                                    @error('score')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="result" class="form-label">Catatan (Opsional)</label>
                                    <textarea class="form-control @error('result') is-invalid @enderror" 
                                              id="result" name="result" rows="4">{{ old('result', $userResult->result ?? '') }}</textarea>
                                    @error('result')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-success">💾 Submit Hasil</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-4">
                @if($userResult)
                    <div class="card bg-success text-white">
                        <div class="card-header">
                            ✅ Status Pengerjaan
                        </div>
                        <div class="card-body">
                            <p><strong>Skor:</strong> {{ $userResult->score }}/100</p>
                            <p><strong>Dikerjakan:</strong> {{ $userResult->submitted_at->format('d-m-Y H:i') }}</p>
                            @if($userResult->result)
                                <p><strong>Catatan:</strong></p>
                                <p>{{ $userResult->result }}</p>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="card bg-warning text-dark">
                        <div class="card-header">
                            ⏳ Belum Dikerjakan
                        </div>
                        <div class="card-body">
                            <p>Anda belum mengerjakan kuis ini. Silakan buka kuis dan submit hasil di atas.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
