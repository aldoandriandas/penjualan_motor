@extends('admin.layouts.app')

@section('content')

    <div class="container">

        {{-- Tombol --}}
        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('admin.transaction.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <button onclick="printInvoice()" class="btn btn-primary">
                <i class="fas fa-print"></i> Cetak Invoice
            </button>
        </div>

        {{-- Area yang dicetak --}}
        <div id="invoiceArea">

            <div class="text-center mb-4">
                <h4 class="font-weight-bold">INVOICE PEMBELIAN MOTOR</h4>

                <p>
                    No Invoice: <strong>{{ $transaction->invoice }}</strong>
                </p>

                <p>
                    Dealer:
                    <strong>
                        {{ $transaction->dealer->nama_dealer ?? '-' }}
                    </strong>
                </p>
            </div>  


            <div class="card shadow">
                <div class="card-body">

                    <div class="row">

                        {{-- Informasi Motor --}}
                        <div class="col-md-6">

                            <h5 class="mb-3">Informasi Motor</h5>

                            <table class="table table-bordered">

                                <tr>
                                    <th width="40%">Merk</th>
                                    <td>{{ $transaction->motor->merk->nama_merk ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Model</th>
                                    <td>{{ $transaction->motor->model->nama_model ?? '-' }}</td>
                                </tr>

                                <tr>
                                    <th>Tahun</th>
                                    <td>{{ $transaction->motor->tahun }}</td>
                                </tr>

                                <tr>
                                    <th>Warna</th>
                                    <td>{{ $transaction->motor->warna }}</td>
                                </tr>

                                <tr>
                                    <th>Harga</th>
                                    <td>
                                        Rp {{ number_format($transaction->motor->harga, 0, ',', '.') }}
                                    </td>
                                </tr>

                            </table>

                        </div>


                        {{-- Informasi Transaksi --}}
                        <div class="col-md-6">

                            <h5 class="mb-3">Informasi Transaksi</h5>

                            <table class="table table-bordered">

                                <tr>
                                    <th width="40%">Invoice</th>
                                    <td>{{ $transaction->invoice }}</td>
                                </tr>

                                <tr>
                                    <th>Pembeli</th>
                                    <td>{{ $transaction->user->name }}</td>
                                </tr>

                                <tr>
                                    <th>Metode Pembayaran</th>
                                    <td>{{ ucfirst($transaction->payment_method) }}</td>
                                </tr>

                                <tr>
                                    <th>Total Harga</th>
                                    <td>
                                        <strong class="text-success">
                                            Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                        </strong>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>

                                        @if($transaction->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($transaction->status == 'dibayar')
                                            <span class="badge badge-primary">Dibayar</span>
                                        @elseif($transaction->status == 'diproses')
                                            <span class="badge badge-info">Diproses</span>
                                        @elseif($transaction->status == 'selesai')
                                            <span class="badge badge-success">Selesai</span>
                                        @else
                                            <span class="badge badge-danger">Dibatalkan</span>
                                        @endif

                                    </td>
                                </tr>

                            </table>

                        </div>

                    </div>

                </div>
            </div>

            {{-- Footer Invoice --}}
            <div class="text-center mt-4">
                <p class="text-muted">
                    Terima kasih telah melakukan pembelian.
                </p>
            </div>

        </div>

    </div>


    {{-- Script Print --}}
    <script>

        function printInvoice() {

            var printContents = document.getElementById('invoiceArea').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

            location.reload();
        }

    </script>

@endsection