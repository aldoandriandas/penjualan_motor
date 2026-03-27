@extends('admin.layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Tambah Merk</h1>

<div class="card shadow">
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.merk.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Merk</label>
                <input type="text"
                       name="nama_merk"
                       value="{{ old('nama_merk') }}"
                       class="form-control @error('nama_merk') is-invalid @enderror"
                       required>

                @error('nama_merk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

            <a href="{{ route('admin.merk.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

@endsection