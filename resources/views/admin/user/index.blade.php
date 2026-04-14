@extends('admin.layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-user"></i>
    Data Pengguna
</h1>

<div class="card">

    <div class="card-header py-3 d-flex justify-content-between align-items-center">

        {{-- Tombol Tambah User hanya untuk Super Admin --}}
        @if(Auth::user()->role == 'super_admin')
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus mr-1"></i> Tambah User
            </a>
        @else
            <div></div>
        @endif

        <div>
            @if (in_array(Auth::user()->role, ['admin','super_admin']))
                <a href="{{route('user.excel')}}" class="btn btn-success btn-sm mr-2">
                <i class="fas fa-file-excel mr-1"></i> Excel
            </a>
            @endif
            
            <a href="#" class="btn btn-danger btn-sm">
                <i class="fas fa-file-pdf mr-1"></i> PDF
            </a>
        </div>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable">

                <thead class="thead-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th>Role</th>

                        {{-- Kolom aksi hanya untuk admin dealer --}}
                        @if(auth()->user()->role == 'super_admin')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>

                <tbody>

                    @foreach ($users as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td class="text-center">{{ $item->role }}</td>

                            {{-- Hanya super admin bisa CRUD, tapi hanya admin dealer --}}
                            @if(auth()->user()->role == 'super_admin')
                                <td class="text-center">
                                    @if($item->role == 'admin')
                                        {{-- Edit --}}
                                        <a href="{{ route('admin.user.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('admin.user.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus admin ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection