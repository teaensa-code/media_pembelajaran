@extends('layouts.app')

@section('title', 'Game')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>🎮 Game</h1>
            @if($isTeacher)
                <a href="{{ route('games.create') }}" class="btn btn-success">➕ Tambah Game</a>
            @endif
        </div>

        @if($games->isEmpty())
            <div class="alert alert-info">
                Belum ada game. @if($isTeacher) <a href="{{ route('games.create') }}">Tambah game sekarang</a> @endif
            </div>
        @else
            <div class="row">
                @foreach($games as $game)
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $game->title }}</h5>
                                <p class="card-text">{{ $game->description ?? 'Tidak ada deskripsi' }}</p>
                                
                                @if(!$isTeacher)
                                    @php
                                        $userResult = $userResults->firstWhere('game_id', $game->id);
                                    @endphp
                                    <div class="mb-2">
                                        @if($userResult)
                                            <span class="badge bg-success">✅ Dimainkan</span>
                                            <small class="text-success">Score: {{ $userResult->score }}/100</small>
                                        @else
                                            <span class="badge bg-warning text-dark">⏳ Belum dimainkan</span>
                                        @endif
                                    </div>
                                @else
                                    <div class="mb-2">
                                        <span class="badge bg-info">{{ $game->results()->count() }} siswa</span>
                                    </div>
                                @endif

                                <small class="text-muted d-block">Dibuat: {{ $game->created_at->format('d-m-Y H:i') }}</small>
                                
                                <div class="mt-3">
                                    <a href="{{ route('games.show', $game->id) }}" class="btn btn-primary btn-sm">🎮 Mainkan</a>
                                    @if($isTeacher)
                                        <a href="{{ route('games.results', $game->id) }}" class="btn btn-info btn-sm">📊 Hasil</a>
                                        <form action="{{ route('games.destroy', $game) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
