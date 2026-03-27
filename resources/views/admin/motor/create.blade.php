@extends('admin.layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-plus"></i>
        Tambah Motor
    </h1>


    <div class="card shadow mb-4">
        <div class="card shadow">
            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.motor.index') }}" class="btn btn-sm btn-light">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.motor.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        {{-- Merk --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Merk</label>
                                <select id="merk" name="merk_id"
                                    class="form-control @error('merk_id') is-invalid @enderror">
                                    <option value="">-- Pilih Merk --</option>
                                    @foreach ($merks as $merk)
                                        <option value="{{ $merk->id }}" {{ old('merk_id') == $merk->id ? 'selected' : '' }}>
                                            {{ $merk->nama_merk }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('merk_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Model --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Model</label>
                                <select id="model" name="model_id"
                                    class="form-control @error('model_id') is-invalid @enderror" disabled>
                                    <option value="">-- Pilih Model --</option>
                                    @foreach ($models as $model)
                                        <option value="{{ $model->id }}" data-merk="{{ $model->merk_id }}" {{ old('model_id') == $model->id ? 'selected' : '' }}>
                                            {{ $model->nama_model }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('model_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        {{-- Tahun --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" name="tahun" value="{{ old('tahun') }}"
                                    class="form-control @error('tahun') is-invalid @enderror">
                                @error('tahun')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Harga --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" name="harga" value="{{ old('harga') }}"
                                    class="form-control @error('harga') is-invalid @enderror">
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Jarak Tempuh --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jarak Tempuh (KM)</label>
                                <input type="number" name="jarak_tempuh" value="{{ old('jarak_tempuh') }}"
                                    class="form-control @error('jarak_tempuh') is-invalid @enderror">
                                @error('jarak_tempuh')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Warna --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Warna</label>
                                <input type="text" name="warna" value="{{ old('warna') }}"
                                    class="form-control @error('warna') is-invalid @enderror">
                                @error('warna')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Kondisi --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kondisi</label>
                                <select name="kondisi" class="form-control @error('kondisi') is-invalid @enderror">
                                    <option value="">-- Pilih Kondisi --</option>
                                    <option value="Baru" {{ old('kondisi') == 'Baru' ? 'selected' : '' }}>Baru</option>
                                    <option value="Bekas" {{ old('kondisi') == 'Bekas' ? 'selected' : '' }}>Bekas</option>
                                </select>
                                @error('kondisi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Stock --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Stock</label>
                                <input type="number" name="stock" value="{{ old('stock') }}"
                                    class="form-control @error('stock') is-invalid @enderror">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- Dealer --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dealer</label>

                                <select name="dealer_id" class="form-control @error('dealer_id') is-invalid @enderror">
                                    <option value="">-- Pilih Dealer --</option>

                                    @foreach ($dealers as $dealer)
                                        <option value="{{ $dealer->id }}" {{ old('dealer_id') == $dealer->id ? 'selected' : '' }}>

                                            {{ $dealer->alamat_dealer }}

                                        </option>
                                    @endforeach

                                </select>

                                @error('dealer_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Gambar 1</label>
                                <input type="file" name="gambar" class="form-control mb-2">

                                <label>Gambar 2</label>
                                <input type="file" name="gambar2" class="form-control mb-2">

                                <label>Gambar 3</label>
                                <input type="file" name="gambar3" class="form-control mb-2">
                            </div>
                        </div>


                        {{-- Deskripsi --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" rows="4" class="form-control">{{ old('deskripsi') }}</textarea>
                            </div>
                        </div>

                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>

        {{-- Script Preview --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function previewImage(event) {
                let reader = new FileReader();
                reader.onload = function () {
                    let output = document.getElementById('preview');
                    output.src = reader.result;
                    output.style.display = 'block';
                }
                reader.readAsDataURL(event.target.files[0]);
            }
            $(document).ready(function () {
                $('#merk').on('change', function () {
                    var merkId = $(this).val();
                    $('#model').prop('disabled', !merkId); // disable jika merk belum dipilih

                    $('#model option').each(function () {
                        var optionMerk = $(this).data('merk');
                        if (!merkId || optionMerk != merkId) {
                            $(this).hide();
                        } else {
                            $(this).show();
                        }
                    });

                    $('#model').val(''); // reset pilihan model
                });

                // trigger change saat page load untuk old()
                $('#merk').trigger('change');
            });
        </script>
@endsection