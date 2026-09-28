@extends('adminlte::page')

@section('title', 'Tambah Guru')

@section('content_header') <h1>Tambah Guru</h1>
@stop

@section('content') <div class="card"> <div class="card-body">
        <form action="{{ route('guru.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            {{-- Nama Guru --}}
            <div class="form-group">
                <label for="nama_guru">Nama Guru</label>

                <input type="text"
                       name="nama_guru"
                       class="form-control"
                       id="nama_guru"
                       value="{{ old('nama_guru') }}"
                       required>
            </div>

            {{-- NIP --}}
            <div class="form-group">
                <label for="nip">NIP</label>

                <input type="text"
                       name="nip"
                       class="form-control"
                       id="nip"
                       value="{{ old('nip') }}"
                       required>
            </div>

            {{-- Mata Pelajaran --}}
            <div class="form-group">
                <label for="mata_pelajaran">Mata Pelajaran</label>

                <input type="text"
                       name="mata_pelajaran"
                       class="form-control"
                       id="mata_pelajaran"
                       value="{{ old('mata_pelajaran') }}"
                       required>
            </div>

            {{-- Kelas --}}
            <div class="form-group">
                <label for="kelas">Kelas</label>

                <input type="text"
                       name="kelas"
                       class="form-control"
                       id="kelas"
                       value="{{ old('kelas') }}"
                       required>
            </div>

            {{-- Jenis Kelamin --}}
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>

                <select name="jenis_kelamin"
                        id="jenis_kelamin"
                        class="form-control"
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
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Email</label>

                <input type="email"
                       name="email"
                       class="form-control"
                       id="email"
                       value="{{ old('email') }}"
                       required>
            </div>

            {{-- Foto --}}
            <div class="form-group">
                <label for="foto">Foto Guru</label>

                <input type="file"
                       name="foto"
                       class="form-control"
                       id="foto"
                       accept=".jpg,.jpeg,.png">
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
