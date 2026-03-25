@extends('layouts.app')

@section('title', 'Tambah Game')

@section('content')
    <div class="container-fluid">
        <h1>Tambah Game Baru</h1>

        <div class="card mt-4" style="max-width: 600px;">
            <div class="card-body">
                <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Game</label>
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
                        <label class="form-label">Tipe Upload</label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="upload_type" id="upload_file" 
                                       value="file" {{ old('upload_type') === 'file' ? 'checked' : '' }}>
                                <label class="form-check-label" for="upload_file">
                                    Upload File Game (ZIP/EXE, max 50MB)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="upload_type" id="upload_link" 
                                       value="link" {{ old('upload_type') === 'link' ? 'checked' : '' }}>
                                <label class="form-check-label" for="upload_link">
                                    Masukkan Link Game
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="file-section" style="display: none;">
                        <div class="mb-3">
                            <label for="file" class="form-label">File Game</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" 
                                   id="file" name="file" accept=".zip,.exe">
                            <small class="text-muted">Format: ZIP atau EXE, Maksimal 50MB</small>
                            @error('file')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div id="link-section" style="display: none;">
                        <div class="mb-3">
                            <label for="link" class="form-label">Link Game</label>
                            <input type="url" class="form-control @error('link') is-invalid @enderror" 
                                   id="link" name="link" value="{{ old('link') }}"
                                   placeholder="https://example.com/game">
                            @error('link')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">✅ Simpan</button>
                    <a href="{{ route('games.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleUploadType() {
            const fileSection = document.getElementById('file-section');
            const linkSection = document.getElementById('link-section');
            const fileInput = document.getElementById('file');
            const linkInput = document.getElementById('link');
            const uploadType = document.querySelector('input[name="upload_type"]:checked').value;

            if (uploadType === 'file') {
                fileSection.style.display = 'block';
                linkSection.style.display = 'none';
                fileInput.required = true;
                linkInput.required = false;
            } else {
                fileSection.style.display = 'none';
                linkSection.style.display = 'block';
                fileInput.required = false;
                linkInput.required = true;
            }
        }

        document.querySelectorAll('input[name="upload_type"]').forEach(radio => {
            radio.addEventListener('change', toggleUploadType);
        });

        // Initialize on page load
        window.addEventListener('load', toggleUploadType);
    </script>
@endsection
