@extends('admin.layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-tags mr-2"></i>
    Data Merk
</h1>

<div class="card shadow mb-4">
    {{-- Card Header --}}
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('admin.merk.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus mr-1"></i> Tambah Merk
            </a>
        @else
        -
        @endif

        <div>
            <a href="#" class="btn btn-success btn-sm mr-2">
                <i class="fas fa-file-excel mr-1"></i> Excel
            </a>
            <a href="#" class="btn btn-danger btn-sm">
                <i class="fas fa-file-pdf mr-1"></i> PDF
            </a>
        </div>
    </div>

    {{-- Card Body --}}
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Merk</th>
                        @if(Auth::user()->role === 'admin')
                            <th width="120" class="text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($merks as $merk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="font-weight-bold">{{ $merk->nama_merk }}</td>

                            @if(Auth::user()->role === 'admin')
                                <td class="text-center">
                                    <a href="{{ route('admin.merk.edit', $merk->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.merk.destroy', $merk->id) }}" method="POST" 
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus merk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->role === 'admin' ? 3 : 2 }}" class="text-center text-muted">
                                Data merk belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection