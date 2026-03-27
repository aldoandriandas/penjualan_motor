@extends('admin.layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-store"></i>
    Data Dealer
</h1>

<div class="card shadow mb-4">

    <div class="card-header py-3 d-flex justify-content-between align-items-center">

        <a href="{{ route('admin.dealer.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Dealer
        </a>

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

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead class="thead-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Logo</th>
                        <th>Nama Dealer</th>
                        <th>Kota</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Email</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($dealers as $dealer)

                    <tr>

                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>

                        <td class="text-center">

                            @if ($dealer->logo_dealer)
                                <img src="{{ asset('storage/'.$dealer->logo_dealer) }}"
                                     width="70"
                                     class="img-thumbnail">
                            @else
                                <span class="text-muted">-</span>
                            @endif

                        </td>

                        <td>
                            {{ $dealer->nama_dealer }}
                        </td>

                        <td>
                            {{ $dealer->kota_dealer ?? '-' }}
                        </td>

                        <td>
                            {{ $dealer->alamat_dealer }}
                        </td>

                        <td>
                            {{ $dealer->no_hp_dealer }}
                        </td>

                        <td>
                            {{ $dealer->email_dealer ?? '-' }}
                        </td>

                        

                        <td class="text-center">

                            <a href="{{ route('admin.dealer.edit',$dealer->id) }}"
                               class="btn btn-sm btn-warning mr-1">
                               <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.dealer.destroy',$dealer->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus dealer ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            Data dealer belum tersedia.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection