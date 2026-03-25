@extends('layouts.app')

@section('title', 'Materi Pembelajaran')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>📖 Materi Pembelajaran</h1>
            @if($isTeacher)
                <a href="{{ route('materials.create') }}" class="btn btn-success">➕ Tambah Materi</a>
            @endif
        </div>

        @if($materials->isEmpty())
            <div class="alert alert-info">
                Belum ada materi. @if($isTeacher) <a href="{{ route('materials.create') }}">Tambah materi sekarang</a> @endif
            </div>
        @else
            <div class="row">
                @foreach($materials as $material)
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $material->title }}</h5>
                                <p class="card-text">{{ $material->description ?? 'Tidak ada deskripsi' }}</p>
                                
                                @if($material->file_path)
                                    <div class="mb-3">
                                        <a href="{{ route('materials.download', $material) }}" 
                                           class="btn btn-primary btn-sm">📥 Download</a>
                                    </div>
                                @endif
                                
                                <small class="text-muted">Dibuat: {{ $material->created_at->format('d-m-Y H:i') }}</small>
                                
                                @if($isTeacher)
                                    <div class="mt-3">
                                        <form action="{{ route('materials.destroy', $material) }}" method="POST" style="display: inline;">
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
@endsection
