@extends('layouts.app')

@section('title', 'Kumpulkan Tugas: ' . $task->title)

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>📤 Kumpulkan Tugas</h1>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Detail Tugas</h5>
                    </div>
                    <div class="card-body">
                        <h6>{{ $task->title }}</h6>
                        <p class="text-muted">{{ $task->description ?? 'Tidak ada deskripsi' }}</p>
                        
                        @if($task->file_path)
                            <div class="mt-3">
                                <p><strong>File Soal:</strong></p>
                                <a href="{{ route('tasks.download', $task) }}" class="btn btn-primary btn-sm">📥 Download Soal</a>
                            </div>
                        @endif

                        @if($existingSubmission)
                            <div class="alert alert-success mt-3">
                                <strong>✅ Sudah Dikumpulkan</strong><br>
                                Tanggal: {{ $existingSubmission->submitted_at->format('d-m-Y H:i') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Form Pengumpulan</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tasks.submission.store', $task) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file" class="form-label">Upload File Tugas (PDF/Word) - Max 10MB</label>
                                <input type="file" class="form-control @error('file') is-invalid @enderror" 
                                       id="file" name="file" accept=".pdf,.doc,.docx" required>
                                @error('file')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                <small class="text-muted d-block mt-1">Format: PDF, DOC, atau DOCX. Ukuran maksimal: 10MB</small>
                            </div>

                            <button type="submit" class="btn btn-success">✅ Kumpulkan</button>
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Batal</a>
                        </form>

                        @if($existingSubmission)
                            <div class="mt-3">
                                <p class="text-muted small">💡 Mengupload ulang akan mengganti file yang sudah dikumpulkan.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
