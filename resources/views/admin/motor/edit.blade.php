@extends('admin.layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-edit mr-2"></i>
        Edit Motor
    </h1>

    <div class="card shadow mb-4">
        <div class="card-header bg-warning d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.motor.index') }}" class="btn btn-sm btn-success">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.motor.update', $motor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-row">
                    {{-- Merk --}}
                    <div class="form-group col-md-6">
                        <label>Merk</label>
                        <select name="merk_id" class="form-control">
                            @foreach ($merks as $merk)
                                <option value="{{ $merk->id }}"
                                    {{ old('merk_id', $motor->merk_id) == $merk->id ? 'selected' : '' }}>
                                    {{ $merk->nama_merk }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Model --}}
                    <div class="form-group col-md-6">
                        <label>Model</label>
                        <select name="model_id" class="form-control">
                            @foreach ($models as $model)
                                <option value="{{ $model->id }}"
                                    {{ old('model_id', $motor->model_id) == $model->id ? 'selected' : '' }}>
                                    {{ $model->nama_model }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Tahun</label>
                        <input type="number" name="tahun" value="{{ old('tahun', $motor->tahun) }}" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Harga</label>
                        <input type="number" name="harga" value="{{ old('harga', $motor->harga) }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label>Jarak Tempuh (KM)</label>
                    <input type="number" name="jarak_tempuh" value="{{ old('jarak_tempuh', $motor->jarak_tempuh) }}"
                        class="form-control">
                </div>
                {{-- Stock --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name="stock" value="{{ old('stock', $motor->stock) }}"
                            class="form-control @error('stock') is-invalid @enderror">
                        @error('stock')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Dealer</label>

                            <select name="dealer_id" class="form-control @error('dealer_id') is-invalid @enderror">

    <option value="">-- Pilih Dealer --</option>

    @foreach ($dealers as $dealer)
        <option value="{{ $dealer->id }}"
            {{ old('dealer_id', $motor->dealer_id) == $dealer->id ? 'selected' : '' }}>

            {{ $dealer->nama_dealer }}

        </option>
    @endforeach

</select>

@error('dealer_id')
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror

                            @error('dealer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Kondisi</label>
                        <select name="kondisi" class="form-control">
                            <option value="Baru" {{ old('kondisi', $motor->kondisi) == 'Baru' ? 'selected' : '' }}>
                                Baru
                            </option>
                            <option value="Bekas" {{ old('kondisi', $motor->kondisi) == 'Bekas' ? 'selected' : '' }}>
                                Bekas
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Warna</label>
                        <input type="text" name="warna" value="{{ old('warna', $motor->warna) }}"
                            class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $motor->deskripsi) }}</textarea>
                </div>

                {{-- ================= GAMBAR MOTOR ================= --}}
                <div class="form-group">
                    <label class="font-weight-bold">Gambar Motor</label>

                    <div class="row">

                        {{-- Gambar 1 --}}
                        <div class="col-md-4 mb-4">
                            <label>Gambar 1</label>

                            @if ($motor->gambar)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $motor->gambar) }}" class="img-thumbnail w-100"
                                        style="height:160px; object-fit:cover;">
                                </div>
                            @endif

                            <input type="file" name="gambar" class="form-control" accept="image/*"
                                onchange="previewImage(event, 'preview1')">

                            <img id="preview1" class="img-thumbnail mt-2 d-none w-100"
                                style="height:160px; object-fit:cover;">
                        </div>


                        {{-- Gambar 2 --}}
                        <div class="col-md-4 mb-4">
                            <label>Gambar 2</label>

                            @if ($motor->gambar2)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $motor->gambar2) }}" class="img-thumbnail w-100"
                                        style="height:160px; object-fit:cover;">
                                </div>
                            @endif

                            <input type="file" name="gambar2" class="form-control" accept="image/*"
                                onchange="previewImage(event, 'preview2')">

                            <img id="preview2" class="img-thumbnail mt-2 d-none w-100"
                                style="height:160px; object-fit:cover;">
                        </div>


                        {{-- Gambar 3 --}}
                        <div class="col-md-4 mb-4">
                            <label>Gambar 3</label>

                            @if ($motor->gambar3)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $motor->gambar3) }}" class="img-thumbnail w-100"
                                        style="height:160px; object-fit:cover;">
                                </div>
                            @endif

                            <input type="file" name="gambar3" class="form-control" accept="image/*"
                                onchange="previewImage(event, 'preview3')">

                            <img id="preview3" class="img-thumbnail mt-2 d-none w-100"
                                style="height:160px; object-fit:cover;">
                        </div>

                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save mr-1"></i> Update
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function previewImage(event, previewId) {
            const reader = new FileReader();

            reader.onload = function() {
                const output = document.getElementById(previewId);
                output.src = reader.result;
                output.classList.remove('d-none');
            }

            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
