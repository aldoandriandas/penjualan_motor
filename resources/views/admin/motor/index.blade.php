@extends('admin.layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-motorcycle"></i>
        Data Motor
    </h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">

            @if (Auth::user()->role == 'admin')
                <a href="{{ route('admin.motor.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i> Tambah Motor
                </a>
            @else
                -
            @endif

            <div>
                @if (in_array(Auth::user()->role, ['admin', 'super_admin']))
                    <a href="{{ route('motor.excel') }}" class="btn btn-success btn-sm mr-2">
                        <i class="fas fa-file-excel mr-1"></i> Excel
                    </a>
                @endif

                <a href="#" class="btn btn-danger btn-sm">
                    <i class="fas fa-file-pdf mr-1"></i> PDF
                </a>
            </div>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark text-center">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Merk</th>
                            <th>Model</th>
                            <th>Dealer</th>
                            <th>Tahun</th>
                            <th>Warna</th>
                            <th>Harga</th>
                            <th>Jarak Tempuh</th>
                            <th>Kondisi</th>
                            <th>Stock</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($motors as $motor)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Gambar --}}
                                <td class="text-center">
                                    @if ($motor->gambar)
                                        <img src="{{ asset('storage/' . $motor->gambar) }}" width="70"
                                            class="img-thumbnail">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td>{{ $motor->merk->nama_merk ?? '-' }}</td>
                                <td>{{ $motor->model->nama_model ?? '-' }}</td>
                                <td>{{ $motor->dealer->nama_dealer ?? '-' }}</td>


                                <td class="text-center">{{ $motor->tahun }}</td>

                                <td>{{ $motor->warna }}</td>

                                <td class="text-right">
                                    Rp {{ number_format($motor->harga, 0, ',', '.') }}
                                </td>

                                <td class="text-right">
                                    {{ number_format($motor->jarak_tempuh, 0, ',', '.') }} KM
                                </td>

                                <td class="text-center">
                                    @if ($motor->kondisi == 'Baru')
                                        <span class="badge badge-success">Baru</span>
                                    @else
                                        <span class="badge badge-warning">Bekas</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $motor->stock }}
                                </td>

                                <td class="{{ Auth::user()->role === 'admin' ? 'text-center d-flex' : 'text-center' }}">
                                    <button type="button" class="btn btn-sm btn-info mr-1" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <i class="fas fa-eye"></i>

                                    </button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Detail Motor</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="row g-4">

                                                        <div class="col-md-5">

                                                            @php
                                                                $images = collect([
                                                                    $motor->gambar,
                                                                    $motor->gambar2,
                                                                    $motor->gambar3,
                                                                ])->filter();
                                                            @endphp

                                                            @if ($images->count() > 0)
                                                                <div class="d-flex flex-column align-items-center gap-3">

                                                                    @foreach ($images as $img)
                                                                        <img src="{{ asset('storage/' . $img) }}"
                                                                            class="img-fluid rounded shadow-sm mb-2"
                                                                            style="max-width: 180px;">
                                                                    @endforeach

                                                                </div>
                                                            @else
                                                                <div
                                                                    class="border rounded p-5 text-muted text-center bg-light">
                                                                    Tidak ada gambar
                                                                </div>
                                                            @endif

                                                        </div>

                                                        {{-- Detail Motor --}}
                                                        <div class="col-md-7">

                                                            <h5 class="fw-bold mb-3">
                                                                {{ $motor->merk->nama_merk ?? '-' }}
                                                                {{ $motor->model->nama_model ?? '-' }}
                                                                ({{ $motor->tahun }})
                                                            </h5>

                                                            <div class="mb-3">
                                                                <span class="badge bg-success text-white fs-6">
                                                                    Rp {{ number_format($motor->harga, 0, ',', '.') }}
                                                                </span>
                                                            </div>

                                                            <hr>

                                                            <div class="row mb-2">
                                                                <div class="col-5 text-muted">Warna</div>
                                                                <div class="col-7 fw-semibold">{{ $motor->warna }}</div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-5 text-muted">Jarak Tempuh</div>
                                                                <div class="col-7 fw-semibold">
                                                                    {{ number_format($motor->jarak_tempuh, 0, ',', '.') }}
                                                                    KM
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-5 text-muted">Kondisi</div>
                                                                <div class="col-7">
                                                                    @if ($motor->kondisi == 'Baru')
                                                                        <span
                                                                            class="badge bg-primary text-white">Baru</span>
                                                                    @else
                                                                        <span
                                                                            class="badge bg-warning text-white">Bekas</span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <hr>

                                                            <div>

                                                                <div class="border rounded p-3 bg-light small text-justify">
                                                                    {{ $motor->deskripsi ?? 'Tidak ada deskripsi.' }}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (Auth::user()->role === 'admin')
                                        <a href="{{ route('admin.motor.edit', $motor->id) }}"
                                            class="btn btn-sm btn-warning mr-1">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.motor.destroy', $motor->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">
                                    Data motor belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($motors, 'links'))
                <div class="mt-3">
                    {{ $motors->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection
