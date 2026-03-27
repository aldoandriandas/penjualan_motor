
@extends('admin.layouts.app')

@section('content')

    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-plus mr-2"></i>
        {{ $title }}
    </h1>

    <div class="card shadow">

        <div class="card-header bg-primary d-flex justify-content-between align-items-center">

            <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-light">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>

        </div>


        <div class="card-body">

            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf


                {{-- ================= NAMA & EMAIL ================= --}}
                <div class="form-row">

                    <div class="form-group col-md-6">

                        <label>Nama</label>

                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror">

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class="form-group col-md-6">

                        <label>Email</label>

                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror">

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                </div>



                {{-- ================= NO HP ================= --}}
                <div class="form-group">

                    <label>No HP</label>

                    <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                        class="form-control @error('no_hp') is-invalid @enderror">

                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>



                {{-- ================= ALAMAT ================= --}}
                <div class="form-group">

                    <label>Alamat</label>

                    <textarea name="alamat" rows="3"
                        class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>

                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>



                {{-- ================= ROLE ================= --}}
                <div class="form-group">

                    <label>Role</label>

                    <select name="role" id="roleSelect" class="form-control @error('role') is-invalid @enderror" required>

                        <option value="">-- Pilih Role --</option>

                        @if(auth()->user()->role == 'super_admin')

                            <option value="admin">Admin Dealer</option>

                        @endif


                        @if(auth()->user()->role == 'admin')

                        <option value="user">User</option>
                            <option value="sales">Sales</option>

                        @endif

                    </select>

                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>



                {{-- ================= DEALER ================= --}}
                @if(auth()->user()->role === 'super_admin')

                    <div class="form-group">

                        <label>Dealer</label>

                        <select name="dealer_id" id="dealerSelect" class="form-control" required>

                            <option value="">-- Pilih Dealer --</option>

                            @foreach($dealers as $dealer)

                                <option value="{{ $dealer->id }}">
                                    {{ $dealer->nama_dealer }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                @endif



                {{-- ================= PASSWORD ================= --}}
                <div class="form-row">

                    <div class="form-group col-md-6">

                        <label>Password</label>

                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class="form-group col-md-6">

                        <label>Konfirmasi Password</label>

                        <input type="password" name="password_confirmation" class="form-control">

                    </div>

                </div>



                {{-- ================= SUBMIT ================= --}}
                <div class="text-right">

                    <button type="submit" class="btn btn-primary">

                        <i class="fas fa-save mr-1"></i>
                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
