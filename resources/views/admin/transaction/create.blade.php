@extends('admin.layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-shopping-cart"></i>
    Beli Motor
</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.transaction.index') }}" class="btn btn-sm btn-light">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>

        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#searchModal">
            <i class="fas fa-search mr-1"></i> Cari Motor (ID)
        </button>
    </div>

    <div class="card-body">

        {{-- ALERT --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('admin.transaction.store') }}" method="POST">
            @csrf

            <div class="row">

                {{-- PILIH MOTOR --}}
                <div class="col-md-6 mb-3">
                    <label>Motor</label>
                    <select name="motor_id" id="motorSelect" class="form-control" required>
                        <option value="">-- Pilih Motor --</option>

                        @forelse ($motors as $motor)
                            <option value="{{ $motor->id }}" data-harga="{{ $motor->harga }}">
                                {{ $motor->second_id ?? '-' }} - 
                                {{ $motor->merk->nama_merk ?? '-' }} - 
                                {{ $motor->model->nama_model ?? '-' }}
                                ({{ $motor->tahun ?? '-' }}) 
                                | Stok: {{ $motor->stock }}
                            </option>
                        @empty
                            <option disabled>Tidak ada motor tersedia</option>
                        @endforelse

                    </select>
                </div>

                {{-- HARGA --}}
                <div class="col-md-6 mb-3">
                    <label>Harga</label>
                    <input type="text" id="hargaInput" class="form-control" readonly>
                </div>

                {{-- DEALER --}}
                <div class="col-md-6 mb-3">
                    <label>Dealer</label>
                    <select name="dealer_id" class="form-control" required>
                        <option value="">-- Pilih Dealer --</option>
                        @foreach ($dealers as $dealer)
                            <option value="{{ $dealer->id }}">{{ $dealer->nama_dealer }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- PAYMENT --}}
                <div class="col-md-6 mb-3">
                    <label>Metode Pembayaran</label>
                    <select name="payment_method" class="form-control" required>
                        <option value="transfer">Transfer</option>
                        <option value="cash">Cash</option>
                    </select>
                </div>

            </div>

            <div class="text-right">
                <button class="btn btn-primary">
                    <i class="fas fa-credit-card mr-1"></i> Beli Sekarang
                </button>
            </div>

        </form>
    </div>
</div>

{{-- MODAL SEARCH --}}
<div class="modal fade" id="searchModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Cari Motor</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <input type="text" id="searchInput" class="form-control" placeholder="Masukkan second_id...">
                <ul class="list-group mt-2" id="searchResults"></ul>
            </div>

        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    const motors = @json($motors);

    // AUTO ISI HARGA
    document.getElementById('motorSelect').addEventListener('change', function () {
        let harga = this.options[this.selectedIndex].getAttribute('data-harga') || '';
        document.getElementById('hargaInput').value = harga;
    });

    // SEARCH MOTOR
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('input', function () {
        const query = this.value.toLowerCase();
        searchResults.innerHTML = '';

        if (query.length > 0) {
            const filtered = motors.filter(m => m.second_id?.toLowerCase().includes(query));

            filtered.forEach(m => {
                const li = document.createElement('li');
                li.classList.add('list-group-item', 'list-group-item-action');

                li.textContent = `${m.second_id} - ${m.merk.nama_merk} ${m.model.nama_model} (${m.tahun}) | Stock: ${m.stock}`;

                li.onclick = () => {
                    document.getElementById('motorSelect').value = m.id;
                    document.getElementById('hargaInput').value = m.harga;
                    $('#searchModal').modal('hide');
                };

                searchResults.appendChild(li);
            });
        }
    });
</script>

@endsection