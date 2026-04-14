@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-comments"></i> Data Testimoni
    </h1>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- BUTTON TAMBAH --}}
    <a href="{{ route('admin.testimoni.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Testimoni
    </a>

    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Testimoni</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Pesan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($testimonis as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->email ?? '-' }}</td>
                                <td>{{ Str::limit($item->pesan, 50) }}</td>
                                <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                <td>
                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.testimoni.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Belum ada data testimoni
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection