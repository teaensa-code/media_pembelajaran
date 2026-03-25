@extends('layouts.app')

@section('title', 'Tugas')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>✏️ Tugas</h1>
            @if($isTeacher)
                <a href="{{ route('tasks.create') }}" class="btn btn-success">➕ Tambah Tugas</a>
            @endif
        </div>

        @if($tasks->isEmpty())
            <div class="alert alert-info">
                Belum ada tugas. @if($isTeacher) <a href="{{ route('tasks.create') }}">Tambah tugas sekarang</a> @endif
            </div>
        @else
            <div class="row">
                @foreach($tasks as $task)
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $task->title }}</h5>
                                <p class="card-text">{{ $task->description ?? 'Tidak ada deskripsi' }}</p>
                                
                                @if($task->file_path)
                                    <div class="mb-2">
                                        <a href="{{ route('tasks.download', $task) }}" 
                                           class="btn btn-primary btn-sm">📥 Download Soal</a>
                                    </div>
                                @endif
                                
                                @if($isTeacher)
                                    <div class="mb-3">
                                        <a href="{{ route('tasks.submissions', $task) }}" 
                                           class="btn btn-info btn-sm">👥 Lihat Pengumpulan</a>
                                    </div>
                                @else
                                    @if(isset($userSubmissions[$task->id]) && $userSubmissions[$task->id])
                                        @php $submission = $userSubmissions[$task->id]; @endphp
                                        <div class="alert alert-success alert-sm mb-2" role="alert">
                                            ✅ Sudah dikumpulkan: {{ $submission->submitted_at->format('d-m-Y H:i') }}
                                            <a href="{{ route('tasks.submission.download', $submission) }}" 
                                               class="btn btn-link btn-sm">📥 Download Kiriman</a>
                                        </div>
                                        
                                        @if($submission->grade !== null)
                                            <div class="alert alert-info alert-sm mb-2" role="alert">
                                                <strong>⭐ Nilai: 
                                                    <span class="badge 
                                                        @if($submission->grade >= 85) bg-success
                                                        @elseif($submission->grade >= 70) bg-info
                                                        @elseif($submission->grade >= 60) bg-warning
                                                        @else bg-danger
                                                        @endif
                                                    ">
                                                        {{ $submission->grade }}
                                                    </span>
                                                </strong>
                                                @if($submission->feedback)
                                                    <button type="button" class="btn btn-link btn-sm ms-2" 
                                                        data-bs-toggle="modal" data-bs-target="#feedbackModal{{ $submission->id }}">
                                                        💬 Lihat Feedback
                                                    </button>
                                                @endif
                                                <small class="d-block text-muted">Dinilai: {{ $submission->graded_at->format('d/m/Y H:i') }}</small>
                                            </div>
                                        @else
                                            <div class="alert alert-warning alert-sm mb-2" role="alert">
                                                ⏳ Menunggu penilaian guru
                                            </div>
                                        @endif
                                    @else
                                        <div class="alert alert-warning alert-sm mb-2" role="alert">
                                            ⏳ Belum dikumpulkan
                                        </div>
                                    @endif
                                    <a href="{{ route('tasks.submit.form', $task) }}" 
                                       class="btn btn-success btn-sm">📤 Kumpulkan Tugas</a>
                                @endif
                                
                                <small class="text-muted d-block mt-2">Dibuat: {{ $task->created_at->format('d-m-Y H:i') }}</small>
                                
                                @if($isTeacher)
                                    <div class="mt-3">
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Feedback Modals -->
            @foreach($tasks as $task)
                @if(isset($userSubmissions[$task->id]) && $userSubmissions[$task->id] && $userSubmissions[$task->id]->feedback)
                    @php $submission = $userSubmissions[$task->id]; @endphp
                    <div class="modal fade" id="feedbackModal{{ $submission->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">💬 Feedback: {{ $task->title }}</h5>
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
                                        <small class="form-text text-muted">Feedback dari guru:</small>
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

    <style>
        .alert-sm {
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
    </style>
@endsection
