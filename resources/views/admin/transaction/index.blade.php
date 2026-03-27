@extends('admin.layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-receipt"></i>
        Data Transaksi
    </h1>

    <div class="card shadow mb-4">

        {{-- Header --}}
        <div class="card-header py-3 d-flex justify-content-between align-items-center">

            {{-- Tombol Tambah hanya untuk admin --}}
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.transaction.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i> Tambah Transaksi
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

        <div class="card-body">

            {{-- Alert --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <thead class="thead-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Invoice</th>
                            <th>Motor</th>
                            <th>User</th>
                            <th>Total</th>
                            <th>Dealer</th>
                            @if(Auth::user()->role === 'admin')
                                <th>Status</th>
                                <th width="120">Aksi</th>
                            @else
                                <th width="120">Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transactions as $trx)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>

                                <td class="text-center">
                                    <span class="badge badge-secondary">{{ $trx->invoice }}</span>
                                </td>

                                <td>{{ $trx->motor->model->nama_model ?? '-' }}</td>
                                <td>{{ $trx->user->name ?? '-' }}</td>
                                <td class="text-right">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                                <td>{{ $trx->dealer->nama_dealer ?? '-' }}</td>

                                {{-- Status hanya untuk admin --}}
                                @if(Auth::user()->role === 'admin')
                                    <td class="text-center">
                                        <form action="{{ route('admin.transaction.status', $trx->id) }}" method="POST">
                                            @csrf
                                            <select name="status" class="form-control form-control-sm
                                                @if($trx->status == 'pending') bg-warning text-dark
                                                @elseif($trx->status == 'dibayar') bg-info text-white
                                                @elseif($trx->status == 'diproses') bg-primary text-white
                                                @elseif($trx->status == 'selesai') bg-success text-white
                                                @elseif($trx->status == 'dibatalkan') bg-danger text-white
                                                @endif
                                            ">
                                                <option value="pending" {{ $trx->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="dibayar" {{ $trx->status == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                                                <option value="diproses" {{ $trx->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="selesai" {{ $trx->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="dibatalkan" {{ $trx->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                            </select>
                                            <button class="btn btn-success btn-sm mt-1">Update</button>
                                        </form>
                                    </td>
                                @endif

                                {{-- Aksi --}}
                                <td class="text-center">
                                    <a href="{{ route('admin.transaction.show', $trx->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    @if(Auth::user()->role === 'admin')
                                        <form action="{{ route('admin.transaction.destroy', $trx->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ Auth::user()->role === 'admin' ? 8 : 7 }}" class="text-center text-muted">
                                    Data transaksi belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if(method_exists($transactions, 'links'))
                <div class="mt-3">{{ $transactions->links() }}</div>
            @endif

        </div>

    </div>
@endsection