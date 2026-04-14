@extends('admin.layouts.app')

@section('content')
    {{-- Page Heading --}}
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-motorcycle mr-2"></i>
        Data Model Motor
    </h1>

    {{-- Card --}}
    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex justify-content-between align-items-center">

            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.model.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i> Tambah Motor
                </a>
            @else
            -
            @endif

        </div>

        {{-- Card Body --}}
        <div class="card-body">

            {{-- Alert --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Model</th>
                            {{-- Kolom aksi hanya untuk admin --}}
                            @if(Auth::user()->role === 'admin')
                                <th width="150" class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($models as $model)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $model->nama_model }}</td>

                                {{-- Aksi hanya untuk admin --}}
                                @if(Auth::user()->role === 'admin')
                                    <td class="text-center">
                                        <a href="{{ route('admin.model.edit', $model->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.model.destroy', $model->id) }}" method="POST"
                                            style="display:inline-block;"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ Auth::user()->role === 'admin' ? 3 : 2 }}" class="text-center text-muted">
                                    Data model belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection