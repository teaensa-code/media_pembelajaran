@extends('layouts.app')

@section('title', 'Pengumpulan ' . $task->title)

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>👥 Pengumpulan: {{ $task->title }}</h1>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5>Detail Tugas</h5>
            </div>
            <div class="card-body">
                <p><strong>Deskripsi:</strong> {{ $task->description ?? 'Tidak ada deskripsi' }}</p>
                @if($task->file_path)
                    <p>
                        <strong>File Soal:</strong> 
                        <a href="{{ route('tasks.download', $task) }}" class="btn btn-primary btn-sm">📥 Download</a>
                    </p>
                @endif
            </div>
        </div>

        @if($submissions->isEmpty())
            <div class="alert alert-info">
                Belum ada pengumpulan tugas dari siswa.
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Pengumpulan ({{ $submissions->count() }} siswa)</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Tanggal Pengumpulan</th>
                                <th>Nilai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($submissions as $index => $submission)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $submission->user->name }}</td>
                                    <td>{{ $submission->submitted_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        @if($submission->grade !== null)
                                            <span class="badge 
                                                @if($submission->grade >= 85) bg-success
                                                @elseif($submission->grade >= 70) bg-info
                                                @elseif($submission->grade >= 60) bg-warning
                                                @else bg-danger
                                                @endif
                                            ">
                                                {{ $submission->grade }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($submission->graded_at)
                                            <span class="badge bg-success">✓ Dinilai</span>
                                            <br>
                                            <small class="text-muted">{{ $submission->graded_at->format('d/m/Y') }}</small>
                                        @else
                                            <span class="badge bg-warning">⏳ Belum</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('tasks.submission.download', $submission) }}" 
                                               class="btn btn-primary btn-sm">📥 File</a>
                                            <a href="{{ route('tasks.grade.form', [$task, $submission]) }}" 
                                               class="btn btn-warning btn-sm">⭐ Nilai</a>
                                        </div>
                                        @if($submission->feedback)
                                            <button type="button" class="btn btn-info btn-sm ms-1" 
                                                data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $submission->id }}">
                                                💬 Lihat
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Feedback Modals -->
            @foreach($submissions as $submission)
                @if($submission->feedback)
                <div class="modal fade" id="feedbackModal{{ $submission->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">💬 Feedback untuk {{ $submission->user->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <small class="form-text text-muted">Nilai:</small>
                                    <p class="h5">
                                        <span class="badge 
                                            @if($submission->grade >= 85) bg-success
                                            @elseif($submission->grade >= 70) bg-info
                                            @elseif($submission->grade >= 60) bg-warning
                                            @else bg-danger
                                            @endif
                                        ">
                                            {{ $submission->grade }}
                                        </span>
                                    </p>
                                </div>
                                <div>
                                    <small class="form-text text-muted">Feedback:</small>
                                    <p class="mt-2">{{ nl2br(e($submission->feedback)) }}</p>
                                </div>
                                <hr>
                                <small class="text-muted">Dinilai pada: {{ $submission->graded_at->format('d/m/Y H:i') }}</small>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        @endif
    </div>
@endsection
