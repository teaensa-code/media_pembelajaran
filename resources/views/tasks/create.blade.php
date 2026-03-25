@extends('layouts.app')

@section('title', 'Tambah Tugas')

@section('content')
    <div class="container-fluid">
        <h1>Tambah Tugas Baru</h1>

        <div class="card mt-4" style="max-width: 600px;">
            <div class="card-body">
                <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Tugas</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="5">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File (PDF/Word) - Max 10MB</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" 
                               id="file" name="file" accept=".pdf,.doc,.docx">
                        @error('file')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="text-muted">Format: PDF, DOC, atau DOCX. Ukuran maksimal: 10MB</small>
                    </div>

                    <button type="submit" class="btn btn-success">✅ Simpan</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
