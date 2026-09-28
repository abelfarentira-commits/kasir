@extends('adminlte::page')

@section('title', 'Edit Guru')

@section('content_header')
    <h1>Edit Guru</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('guru.update', $guru->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- Nama Guru --}}
                <div class="form-group">
                    <label for="nama_guru">Nama Guru</label>

                    <input type="text"
                           name="nama_guru"
                           class="form-control @error('nama_guru') is-invalid @enderror"
                           id="nama_guru"
                           required
                           value="{{ old('nama_guru', $guru->nama_guru) }}">

                    @error('nama_guru')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- NIP --}}
                <div class="form-group">
                    <label for="nip">NIP</label>

                    <input type="text"
                           name="nip"
                           class="form-control @error('nip') is-invalid @enderror"
                           id="nip"
                           required
                           value="{{ old('nip', $guru->nip) }}">

                    @error('nip')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Mata Pelajaran --}}
                <div class="form-group">
                    <label for="mata_pelajaran">Mata Pelajaran</label>

                    <input type="text"
                           name="mata_pelajaran"
                           class="form-control @error('mata_pelajaran') is-invalid @enderror"
                           id="mata_pelajaran"
                           required
                           placeholder="Contoh: Pemrograman Web"
                           value="{{ old('mata_pelajaran', $guru->mata_pelajaran) }}">

                    @error('mata_pelajaran')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Kelas --}}
                <div class="form-group">
                    <label for="kelas">Kelas</label>

                    <input type="text"
                           name="kelas"
                           class="form-control @error('kelas') is-invalid @enderror"
                           id="kelas"
                           required
                           placeholder="Contoh: XII RPL A"
                           value="{{ old('kelas') }}">

                    @error('kelas')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Jenis Kelamin --}}
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>

                    <select name="jenis_kelamin"
                            id="jenis_kelamin"
                            class="form-control @error('jenis_kelamin') is-invalid @enderror"
                            required>

                        <option value="">-- Pilih Jenis Kelamin --</option>

                        <option value="Laki-laki"
                            {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>

                        <option value="Perempuan"
                            {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>

                    </select>

                    @error('jenis_kelamin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email">Email</label>

                    <input type="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           required
                           value="{{ old('email') }}">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Foto --}}
                <div class="form-group">
                    <label for="foto">Foto Guru</label>

                    <input type="file"
                           name="foto"
                           class="form-control @error('foto') is-invalid @enderror"
                           id="foto"
                           accept=".jpg,.jpeg,.png">

                    @error('foto')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Tombol --}}
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>

                <a href="{{ route('guru.index') }}"
                   class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Batal
                </a>

            </form>

        </div>
    </div>
@stop

