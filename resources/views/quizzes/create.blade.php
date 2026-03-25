@extends('layouts.app')

@section('title', 'Tambah Kuis')

@section('content')
    <div class="container-fluid">
        <h1>Tambah Kuis Baru</h1>

        <div class="card mt-4" style="max-width: 600px;">
            <div class="card-body">
                <form action="{{ route('quizzes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Kuis</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="link" class="form-label">Link Kuis <small class="text-muted">(Google Forms, Quizizz, dll)</small></label>
                        <input type="url" class="form-control @error('link') is-invalid @enderror" 
                               id="link" name="link" value="{{ old('link') }}" 
                               placeholder="https://forms.gle/...">
                        @error('link')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">✅ Simpan</button>
                    <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
