@extends('layouts.app')

@section('title', 'Tambah Video')

@section('content')
    <div class="container-fluid">
        <h1>Tambah Video Baru</h1>

        <div class="card mt-4" style="max-width: 700px;">
            <div class="card-body">
                <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Video</label>
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
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="upload_type" id="upload_file" 
                                   value="file" {{ old('upload_type') === 'file' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="upload_file">
                                Upload File Video (MP4/AVI - Max 50MB)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="upload_type" id="upload_link" 
                                   value="link" {{ old('upload_type') === 'link' ? 'checked' : '' }} required>
                            <label class="form-check-label" for="upload_link">
                                Masukkan Link Video (YouTube, dll)
                            </label>
                        </div>
                        @error('upload_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3" id="file-section" style="display: none;">
                        <label for="file" class="form-label">File Video (MP4/AVI) - Max 50MB</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" 
                               id="file" name="file" accept=".mp4,.avi">
                        @error('file')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="text-muted">Format: MP4 atau AVI. Ukuran maksimal: 50MB</small>
                    </div>

                    <div class="mb-3" id="link-section" style="display: none;">
                        <label for="video_link" class="form-label">Link Video</label>
                        <input type="url" class="form-control @error('video_link') is-invalid @enderror" 
                               id="video_link" name="video_link" placeholder="https://www.youtube.com/watch?v=..."
                               value="{{ old('video_link') }}">
                        @error('video_link')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="text-muted">Contoh: YouTube, Vimeo, atau link video lainnya</small>
                    </div>

                    <button type="submit" class="btn btn-success">✅ Simpan</button>
                    <a href="{{ route('videos.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        const uploadTypeRadios = document.querySelectorAll('input[name="upload_type"]');
        const fileSection = document.getElementById('file-section');
        const linkSection = document.getElementById('link-section');

        uploadTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'file') {
                    fileSection.style.display = 'block';
                    linkSection.style.display = 'none';
                    document.getElementById('file').required = true;
                    document.getElementById('video_link').required = false;
                } else {
                    fileSection.style.display = 'none';
                    linkSection.style.display = 'block';
                    document.getElementById('file').required = false;
                    document.getElementById('video_link').required = true;
                }
            });
        });

        // Trigger change on page load
        const checkedRadio = document.querySelector('input[name="upload_type"]:checked');
        if (checkedRadio) {
            checkedRadio.dispatchEvent(new Event('change'));
        }
    </script>
@endsection
