@extends('admin.layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-store"></i>
    Tambah Dealer
</h1>

<div class="card shadow mb-4">

    <div class="card-body">

        <form action="{{ route('admin.dealer.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row">

                {{-- Nama Dealer --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Dealer</label>

                        <input type="text"
                               name="nama_dealer"
                               class="form-control @error('nama_dealer') is-invalid @enderror"
                               value="{{ old('nama_dealer') }}"
                               required>

                        @error('nama_dealer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kota --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kota Dealer</label>

                        <input type="text"
                               name="kota_dealer"
                               class="form-control"
                               value="{{ old('kota_dealer') }}">
                    </div>
                </div>

                {{-- No HP --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>No HP Dealer</label>

                        <input type="text"
                               name="no_hp_dealer"
                               class="form-control"
                               value="{{ old('no_hp_dealer') }}">
                    </div>
                </div>

                {{-- Email --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email Dealer</label>

                        <input type="email"
                               name="email_dealer"
                               class="form-control"
                               value="{{ old('email_dealer') }}">
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Alamat Dealer</label>

                        <textarea name="alamat_dealer"
                                  rows="3"
                                  class="form-control">{{ old('alamat_dealer') }}</textarea>
                    </div>
                </div>

                {{-- Logo --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Logo Dealer</label>

                        <input type="file"
                               name="logo_dealer"
                               class="form-control">

                        <small class="text-muted">
                            Format: JPG / PNG (Max 2MB)
                        </small>
                    </div>
                </div>

            </div>

            <hr>

            <div class="d-flex">

                <button type="submit" class="btn btn-primary mr-2">
                    <i class="fas fa-save"></i> Simpan
                </button>

                <a href="{{ route('admin.dealer.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection