@extends('layouts.app')

@section('title', 'Video Pembelajaran')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>🎬 Video Pembelajaran</h1>
            @if($isTeacher)
                <a href="{{ route('videos.create') }}" class="btn btn-success">➕ Tambah Video</a>
            @endif
        </div>

        @if($videos->isEmpty())
            <div class="alert alert-info">
                Belum ada video. @if($isTeacher) <a href="{{ route('videos.create') }}">Tambah video sekarang</a> @endif
            </div>
        @else
            <div class="row">
                @foreach($videos as $video)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $video->title }}</h5>
                                <p class="card-text">{{ $video->description ?? 'Tidak ada deskripsi' }}</p>

                                @if($video->isFileVideo())
                                    <div class="mb-3">
                                        <p class="small text-muted mb-2">📹 File Video:</p>
                                        <video width="100%" height="300" controls class="rounded" style="background-color: #000;">
                                            <source src="{{ Storage::url($video->file_path) }}" type="video/mp4">
                                            Browser Anda tidak mendukung HTML5 video.
                                        </video>
                                        <a href="{{ route('videos.download', $video) }}" 
                                           class="btn btn-primary btn-sm mt-2">📥 Download</a>
                                    </div>
                                @elseif($video->isLinkVideo())
                                    <div class="mb-3">
                                        <p class="small text-muted mb-2">🔗 Video dari Link:</p>
                                        @if($video->embedLink)
                                            <div class="ratio ratio-16x9 rounded overflow-hidden mb-2">
                                                <iframe src="{{ $video->embedLink }}" 
                                                        allowfullscreen="" 
                                                        loading="lazy"></iframe>
                                            </div>
                                        @else
                                            <a href="{{ $video->video_link }}" target="_blank" 
                                               class="btn btn-primary btn-sm">🎥 Buka Video</a>
                                        @endif
                                    </div>
                                @endif

                                <small class="text-muted d-block">Dibuat: {{ $video->created_at->format('d-m-Y H:i') }}</small>

                                @if($isTeacher)
                                    <div class="mt-3">
                                        <form action="{{ route('videos.destroy', $video) }}" method="POST" style="display: inline;">
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
        @endif
    </div>

    <style>
        .ratio-16x9 {
            --bs-aspect-ratio: calc(16 / 9 * 100%);
        }
        
        .ratio {
            position: relative;
            width: 100%;
        }
        
        .ratio::before {
            display: block;
            padding-bottom: var(--bs-aspect-ratio);
            content: "";
        }
        
        .ratio > * {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
@endsection
