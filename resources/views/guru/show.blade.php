@extends('adminlte::page')

@section('title', 'Detail Guru')

@section('content_header')
    <h1>Detail Guru</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                {{-- KOLOM KIRI: FOTO --}}
                <div class="col-md-4 d-flex justify-content-center align-items-start">
                    @if($guru->foto)
                        {{-- Menampilkan foto jika ada --}}
                        <img src="{{ asset('storage/' . $guru->foto) }}"
                             alt="Foto {{ $guru->nama_guru }}"
                             class="img-fluid rounded shadow-sm"
                             style="max-width: 100%; max-height: 400px;">
                    @else
                        {{-- Placeholder jika tidak ada foto --}}
                        <div class="text-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($guru->nama_guru) }}&background=random"
                                 class="img-fluid rounded-circle mb-3"
                                 style="width: 150px;">
                            <p class="text-muted">Tidak ada foto</p>
                        </div>
                    @endif
                </div>

                {{-- KOLOM KANAN: DATA --}}
                <div class="col-md-8">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th style="width: 200px">Nama Guru</th>
                            <td>{{ $guru->nama_guru }}</td>
                        </tr>
                        <tr>
                            <th>NIP</th>
                            <td>{{ $guru->nip }}</td>
                        </tr>
                        <tr>
                            <th>Mata Pelajaran</th>
                            <td>{{ $guru->mata_pelajaran }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>{{ $guru->kelas }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $guru->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Terdaftar Pada</th>
                            <td>{{ $guru->created_at->format('d F Y') }}</td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('guru.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
