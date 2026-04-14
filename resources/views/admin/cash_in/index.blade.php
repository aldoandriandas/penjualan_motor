@extends('admin.layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-arrow-down mr-2 text-success"></i> Pemasukan
</h1>

<div class="card shadow mb-4">
    <div class="card-body">

        {{-- SUMMARY --}}
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="card border-left-success shadow">
                    <div class="card-body">
                        Total Masuk <br>
                        <strong>Rp {{ number_format($totalMasuk ?? 0) }}</strong>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-left-danger shadow">
                    <div class="card-body">
                        Total Keluar <br>
                        <strong>Rp {{ number_format($totalKeluar ?? 0) }}</strong>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-left-primary shadow">
                    <div class="card-body">
                        Saldo <br>
                        <strong>Rp {{ number_format($saldo ?? 0) }}</strong>
                    </div>
                </div>
            </div>
        </div>

        {{-- FORM INPUT --}}
        <div class="card mb-4 border-left-success">
            <div class="card-body">

                <form action="{{ route('admin.cash_in.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-md-5 mb-2">
                            <input type="number" name="amount" class="form-control" placeholder="Jumlah Pemasukan" required>
                        </div>

                        <div class="col-md-5 mb-2">
                            <input type="text" name="description" class="form-control" placeholder="Deskripsi (contoh: Service, Sparepart, dll)" required>
                        </div>

                        <div class="col-md-2 mb-2">
                            <button class="btn btn-success btn-block">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>

        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table table-bordered">

                <thead class="thead-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Deskripsi</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->description }}</td>
                            <td class="text-right text-success">
                                Rp {{ number_format($item->amount,0,',','.') }}
                            </td>
                            <td class="text-center">
                                {{ $item->created_at->format('d-m-Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada pemasukan
                            </td>
                        </tr>
                    @endforelse
                    
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection