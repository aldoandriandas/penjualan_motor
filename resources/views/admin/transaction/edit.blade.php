@extends('admin.layouts.app')

@section('content')

    <div class="container">

        <h3>Edit Status Transaksi</h3>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('admin.transaction.updateStatus', $transaction->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Motor</label>
                        <input type="text" class="form-control"
                            value="{{ $transaction->motor->merk->nama_merk }} {{ $transaction->motor->model->nama_model }}"
                            readonly>
                    </div>

                    <div class="mb-3">
                        <label>Total Harga</label>
                        <input type="text" class="form-control"
                            value="Rp {{ number_format($transaction->total_price, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>

                        <select name="status" class="form-control">

                            <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="dibayar" {{ $transaction->status == 'dibayar' ? 'selected' : '' }}>
                                Dibayar
                            </option>

                            <option value="diproses" {{ $transaction->status == 'diproses' ? 'selected' : '' }}>
                                Diproses
                            </option>

                            <option value="selesai" {{ $transaction->status == 'selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>

                            <option value="dibatalkan" {{ $transaction->status == 'dibatalkan' ? 'selected' : '' }}>
                                Dibatalkan
                            </option>

                        </select>

                    </div>

                    <button class="btn btn-warning">
                        Update Status
                    </button>

                    <a href="{{ route('admin.transaction.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                </form>

            </div>
        </div>

    </div>

@endsection