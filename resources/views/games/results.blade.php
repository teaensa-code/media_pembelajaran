@extends('layouts.app')

@section('title', 'Hasil Game')

@section('content')
    <div class="container-fluid">
        <div class="mb-4">
            <h1>Hasil Game: {{ $game->title }}</h1>
            <a href="{{ route('games.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>

        @if ($results->isEmpty())
            <div class="alert alert-info">Belum ada siswa yang memainkan game ini.</div>
        @else
            <div class="card">
                <div class="card-header bg-info text-white">
                    📊 Daftar Hasil Siswa
                </div>
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Skor</th>
                                <th>Dimainkan</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                                <tr>
                                    <td>{{ $result->user->name }}</td>
                                    <td>
                                        <span class="badge 
                                            @if ($result->score >= 80) bg-success
                                            @elseif ($result->score >= 60) bg-warning text-dark
                                            @else bg-danger
                                            @endif">
                                            {{ $result->score }}/100
                                        </span>
                                    </td>
                                    <td>{{ $result->submitted_at->format('d-m-Y H:i') }}</td>
                                    <td>{{ Str::limit($result->result ?? 'Tidak ada catatan', 50) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header bg-info text-white">
                    📈 Statistik
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <h3>{{ $results->count() }}</h3>
                            <p class="text-muted">Total Siswa</p>
                        </div>
                        <div class="col-md-3">
                            <h3>{{ round($results->avg('score')) }}</h3>
                            <p class="text-muted">Rata-rata Skor</p>
                        </div>
                        <div class="col-md-3">
                            <h3>{{ $results->max('score') }}</h3>
                            <p class="text-muted">Skor Tertinggi</p>
                        </div>
                        <div class="col-md-3">
                            <h3>{{ $results->min('score') }}</h3>
                            <p class="text-muted">Skor Terendah</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
