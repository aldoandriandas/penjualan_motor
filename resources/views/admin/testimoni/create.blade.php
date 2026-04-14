@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <h3>Tambah Testimoni</h3>

    <form action="{{ route('admin.testimoni.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Pesan</label>
            <textarea name="pesan" class="form-control" required></textarea>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.testimoni.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection