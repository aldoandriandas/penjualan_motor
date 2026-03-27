@extends('admin.layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit Merk</h1>

    <div class="card shadow">

        <div class="card-header bg-warning d-flex justify-content-between">
            <a href="{{ route('admin.merk.index') }}" class="btn btn-light btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.merk.update', $merk->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Merk</label>
                    <input type="text" name="nama_merk" value="{{ old('nama_merk', $merk->nama_merk) }}"
                        class="form-control @error('nama_merk') is-invalid @enderror" required>

                    @error('nama_merk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save mr-1"></i> Update
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
