@extends('admin.layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-edit mr-2"></i>
    {{ $title }}
</h1>

<div class="card shadow mb-4">

    <div class="card-header py-3 bg-warning d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.user.index') }}" class="btn btn-success btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.user.update',$user->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- ============================= --}}
            {{-- NAMA & EMAIL --}}
            {{-- ============================= --}}
            <div class="form-row">

                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Nama</label>

                    <input type="text"
                        name="name"
                        value="{{ old('name',$user->name) }}"
                        class="form-control @error('name') is-invalid @enderror">

                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold">Email</label>

                    <input type="email"
                        name="email"
                        value="{{ old('email',$user->email) }}"
                        class="form-control @error('email') is-invalid @enderror">

                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>


            {{-- ============================= --}}
            {{-- NO HP --}}
            {{-- ============================= --}}
            <div class="form-group">

                <label class="font-weight-bold">No HP</label>

                <input type="text"
                    name="no_hp"
                    value="{{ old('no_hp',$user->no_hp) }}"
                    class="form-control @error('no_hp') is-invalid @enderror">

                @error('no_hp')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>


            {{-- ============================= --}}
            {{-- ALAMAT --}}
            {{-- ============================= --}}
            <div class="form-group">

                <label class="font-weight-bold">Alamat</label>

                <textarea name="alamat"
                    rows="3"
                    class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat',$user->alamat) }}</textarea>

                @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>


            {{-- ============================= --}}
            {{-- ROLE --}}
            {{-- ============================= --}}
            <div class="form-group">

                <label class="font-weight-bold">Role</label>

                <select name="role"
                    id="roleSelect"
                    class="form-control @error('role') is-invalid @enderror"
                    required>

                    @if(auth()->user()->role == 'super_admin')

                    <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>
                        Super Admin
                    </option>

                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                        Admin Dealer
                    </option>

                    @endif

                    <option value="sales" {{ $user->role == 'sales' ? 'selected' : '' }}>
                        Sales
                    </option>

                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                        User
                    </option>

                </select>

                @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>


            {{-- ============================= --}}
            {{-- DEALER --}}
            {{-- ============================= --}}
            @if(auth()->user()->role == 'super_admin')

            <div class="form-group" id="dealerField">

                <label class="font-weight-bold">Dealer</label>

                <select name="dealer_id" class="form-control">

                    <option value="">-- Pilih Dealer --</option>

                    @foreach($dealers as $dealer)

                    <option value="{{ $dealer->id }}"
                        {{ $dealer->id == old('dealer_id',$user->dealer_id) ? 'selected' : '' }}>

                        {{ $dealer->nama_dealer }}

                    </option>

                    @endforeach

                </select>

            </div>

            @else

            <input type="hidden"
                name="dealer_id"
                value="{{ auth()->user()->dealer_id }}">

            @endif


            {{-- ============================= --}}
            {{-- PASSWORD --}}
            {{-- ============================= --}}
            <div class="form-row">

                <div class="form-group col-md-6">

                    <label class="font-weight-bold">Password</label>

                    <input type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror">

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti password
                    </small>

                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group col-md-6">

                    <label class="font-weight-bold">Konfirmasi Password</label>

                    <input type="password"
                        name="password_confirmation"
                        class="form-control">

                </div>

            </div>


            {{-- ============================= --}}
            {{-- BUTTON --}}
            {{-- ============================= --}}
            <div class="text-right">

                <button type="submit" class="btn btn-warning px-4">
                    <i class="fas fa-save"></i> Update
                </button>

            </div>

        </form>

    </div>
</div>


<script>

document.addEventListener("DOMContentLoaded", function(){

    const roleSelect = document.getElementById("roleSelect");
    const dealerField = document.getElementById("dealerField");

    function toggleDealer(){

        if(!dealerField) return;

        if(roleSelect.value === "super_admin"){
            dealerField.style.display = "none";
        }else{
            dealerField.style.display = "block";
        }

    }

    roleSelect.addEventListener("change", toggleDealer);

    toggleDealer();

});

</script>

@endsection