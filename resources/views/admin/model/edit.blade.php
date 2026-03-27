@extends('admin.layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-edit mr-2"></i> Edit Model Motor
</h1>

<div class="card shadow mb-4">
    <div class="card-header bg-primary d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.model.index') }}" class="btn btn-sm btn-light">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.model.update', $model->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Pilih Merk --}}
            <div class="form-group mb-3">
                <label>Merk Motor</label>
                <select name="merk_id" class="form-control @error('merk_id') is-invalid @enderror">
                    <option value="">-- Pilih Merk --</option>
                    @foreach ($merks as $merk)
                        <option value="{{ $merk->id }}" {{ $model->merk_id == $merk->id ? 'selected' : '' }}>
                            {{ $merk->nama_merk }}
                        </option>
                    @endforeach
                </select>
                @error('merk_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Nama Model --}}
            <div class="form-group mb-3">
                <label>Nama Model</label>
                <input type="text" name="nama_model" value="{{ old('nama_model', $model->nama_model) }}"
                    class="form-control @error('nama_model') is-invalid @enderror">
                @error('nama_model')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection