@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2>📝 Penilaian Pengumpulan Tugas</h2>
            <p class="text-muted">Tugas: <strong>{{ $task->title }}</strong></p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Submission Details -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">📋 Detail Pengumpulan</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Nama Siswa:</strong></p>
                            <p>{{ $submission->user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email:</strong></p>
                            <p>{{ $submission->user->email }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Tanggal Pengumpulan:</strong></p>
                            <p>{{ $submission->submitted_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>File:</strong></p>
                            <a href="{{ route('tasks.submission.download', $submission) }}" class="btn btn-sm btn-primary">
                                📥 Download File
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grading Form -->
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">⭐ Berikan Nilai dan Feedback</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('tasks.grade.store', [$task, $submission]) }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="grade" class="form-label">Nilai (0-100)</label>
                            <input type="number" class="form-control @error('grade') is-invalid @enderror" 
                                id="grade" name="grade" min="0" max="100" step="1"
                                value="{{ old('grade', $submission->grade) }}" required>
                            @error('grade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Masukkan nilai dari 0 hingga 100</small>
                        </div>

                        <div class="mb-4">
                            <label for="feedback" class="form-label">Feedback / Catatan</label>
                            <textarea class="form-control @error('feedback') is-invalid @enderror" 
                                id="feedback" name="feedback" rows="5" placeholder="Berikan feedback kepada siswa...">{{ old('feedback', $submission->feedback) }}</textarea>
                            @error('feedback')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Opsional - Berikan komentar konstruktif untuk siswa</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                ✅ Simpan Nilai dan Feedback
                            </button>
                            <a href="{{ route('tasks.submissions', $task) }}" class="btn btn-secondary">
                                ← Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Grade Status -->
            @if($submission->graded_at)
            <div class="alert alert-info mt-4">
                <strong>ℹ️ Sudah Dinilai</strong>
                <p class="mb-0">Nilai diberikan pada: {{ $submission->graded_at->format('d/m/Y H:i') }}</p>
            </div>
            @endif
        </div>

        <!-- Preview Panel -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-light">
                    <h6 class="mb-0">📊 Preview</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="form-text text-muted">Nilai yang akan disimpan:</small>
                        <div id="gradePreview" class="h4 mt-2">
                            <span class="badge bg-secondary">-</span>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <small class="form-text text-muted">Status:</small>
                        <div id="statusPreview" class="mt-2">
                            @if($submission->graded_at)
                                <span class="badge bg-success">✓ Sudah Dinilai</span>
                            @else
                                <span class="badge bg-warning">⏳ Belum Dinilai</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('grade').addEventListener('input', function() {
    const grade = this.value;
    let color = 'secondary';
    let label = 'Belum ada';
    
    if (grade) {
        if (grade >= 85) color = 'success';
        else if (grade >= 70) color = 'info';
        else if (grade >= 60) color = 'warning';
        else color = 'danger';
        label = grade;
    }
    
    document.getElementById('gradePreview').innerHTML = 
        `<span class="badge bg-${color} fs-6">${label}</span>`;
});
</script>
@endsection
