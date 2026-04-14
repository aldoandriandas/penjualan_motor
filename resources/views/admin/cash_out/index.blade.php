@extends('admin.layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-arrow-up mr-2 text-danger"></i> Pengeluaran
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

        {{-- FORM INPUT (DIUBAH JADI ROW SEPERTI CASH IN) --}}
        <div class="card mb-4 border-left-danger">
            <div class="card-body">

                <form method="POST" action="{{ route('admin.cash_out.store') }}">
                    @csrf

                    <div class="row">

                        <div class="col-md-5 mb-2">
                            <input type="number" name="amount" class="form-control" placeholder="Jumlah" required>
                        </div>

                        <div class="col-md-5 mb-2">
                            <input type="text" name="description" class="form-control" placeholder="Deskripsi" required>
                        </div>

                        <div class="col-md-2 mb-2">
                            <button class="btn btn-danger btn-block">
                                <i class="fas fa-save mr-1"></i> Simpan
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
                            <td class="text-right text-danger">
                                Rp {{ number_format($item->amount,0,',','.') }}
                            </td>
                            <td class="text-center">
                                {{ $item->created_at->format('d-m-Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada pengeluaran
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>
@endsection