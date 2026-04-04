@extends('layouts.main')
@include('layouts.navbar')
@section('content')
    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
        <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Breadcrumb (Light Mode) -->
        <nav aria-label="Breadcrumb">
            <ol class="flex items-center gap-1 text-sm text-black my-3">
                <li>
                    <a href="{{ route('home') }}"
                        class="block transition-colors text-black"
                        aria-label="Home">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>

                <li class="rtl:rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </li>

                <li>
                    <a href="#" class="font-bold block transition-colors hover:text-black">
                        {{ $motor->merk->nama_merk }}
                    </a>
                </li>

                <li class="rtl:rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </li>
                <li>
                    <a href="#" class="font-bold block transition-colors hover:text-black">
                        {{ $motor->model->nama_model }}
                    </a>
                </li>
                <li class="rtl:rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </li>

                <li>
                    <p>{{ $motor->merk->nama_merk }} {{ $motor->model->nama_model }} {{ $motor->tahun }}</p>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- LEFT: Motor Images -->
            <div class="lg:w-2/3">
                <!-- Image Slider -->
                <div x-data="sliderMotor()" class="relative w-full mb-6">
                    <div class="relative aspect-[16/9] overflow-hidden rounded-xl shadow-lg bg-gray-100">
                        <template x-for="(image, index) in images" :key="index">
                            <div x-show="current === index" 
                                 x-transition:enter="transition transform ease-out duration-500"
                                 x-transition:enter-start="translate-x-full" 
                                 x-transition:enter-end="translate-x-0"
                                 x-transition:leave="transition transform ease-in duration-500"
                                 x-transition:leave-start="translate-x-0" 
                                 x-transition:leave-end="-translate-x-full"
                                 class="absolute inset-0 w-full h-full">
                                <img :src="image" class="w-full h-full object-cover rounded-xl">
                            </div>
                        </template>
                    </div>

                    <!-- Slider Buttons -->
                    <button x-show="images.length > 1" @click="prev()" 
                            class="absolute top-1/2 left-3 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-700 w-10 h-10 rounded-full flex items-center justify-center text-2xl z-10 transition shadow-md">
                        ❮
                    </button>
                    <button x-show="images.length > 1" @click="next()" 
                            class="absolute top-1/2 right-3 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-700 w-10 h-10 rounded-full flex items-center justify-center text-2xl z-10 transition shadow-md">
                        ❯
                    </button>

                    <!-- Slide Indicator -->
                    <div class="absolute bottom-4 right-4 bg-black/60 text-white px-3 py-1 rounded-full text-sm z-10">
                        <span x-text="current + 1"></span> dari <span x-text="images.length"></span>
                    </div>
                </div>

                <!-- Product Information -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h1 class="font-bold text-xl text-gray-800 mb-3">
                        <i class="fas fa-info-circle text-teal-500 mr-2"></i>Informasi Produk :
                    </h1>
                    <p class="text-gray-600 leading-relaxed">
                        {!! nl2br(e($motor->deskripsi)) !!}
                    </p>
                </div>
            </div>

            <!-- RIGHT: Motor Info & Seller -->
            <div class="lg:w-1/3">
                <div class="sticky top-24 space-y-4">
                    <!-- Motor Info Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
                        <h1 class="text-2xl font-bold text-gray-800 text-center mb-4">{{ $motor->merk->nama_merk }}</h1>
                        <h3 class="text-3xl text-teal-600 font-bold text-center mb-6">Rp.{{ number_format($motor->harga) }}</h3>
                        <p class="text-gray-500 text-center mb-4">
                            <i class="fas fa-map-marker-alt text-teal-500 mr-1"></i> {{ $motor->dealer->alamat_dealer }}
                        </p>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-gray-500">Merk, Model</span>
                                <span class="font-semibold text-gray-800">{{ $motor->merk->nama_merk }} {{ $motor->nama }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-gray-500">Tahun Rilis</span>
                                <span class="font-semibold text-gray-800">{{ $motor->tahun }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-gray-500">Tipo / Varian</span>
                                <span class="font-semibold text-gray-800">{{ $motor->model->nama_model }} </span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-gray-500">Warna Motor</span>
                                <span class="font-semibold text-gray-800">{{ $motor->warna }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-gray-500">Jarak Tempuh</span>
                                <span class="font-semibold text-gray-800">{{ number_format($motor->jarak_tempuh) }} KM</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 my-4"></div>

                        <div class="text-center">
                            <span class="text-gray-400 text-sm">{{ $motor->merk->nama_merk }}, {{ $motor->tahun }}</span>
                        </div>
                    </div>
                                        <!-- Tombol Chat -->
                    @php
                        $pesan = '';
                        // Tambahkan second_id
                        $pesan .= 'ID Motor: *' . ($motor->second_id ?? '-') . "*\n";

                        $pesan .= 'Dealer: ' . strtoupper($motor->dealer->nama_dealer ?? '-') . "\n";
                        $pesan .= 'Merk: ' . ($motor->merk->nama_merk ?? '-') . "\n";
                        $pesan .= 'Model: ' . ($motor->model->nama_model ?? '-') . "\n";
                        $pesan .= 'Tahun: ' . ($motor->tahun ?? '-') . "\n";
                        $pesan .= 'Warna: ' . ($motor->warna ?? '-') . "\n";
                        $pesan .= 'Jarak Tempuh: ' . (isset($motor->jarak_tempuh) ? number_format($motor->jarak_tempuh) : '-') . " KM\n";
                        $pesan .= 'Harga: Rp ' . (isset($motor->harga) ? number_format($motor->harga, 0, ',', '.') : '-') . "\n";


                    @endphp


                    <!-- Seller Info & Chat Button -->
                    <div class="bg-gray-50 rounded-2xl p-4 border border-gray-200">
                        <div class="flex items-center gap-4 mb-4">
                            {{-- Logo Dealer --}}
                                    @if ($motor->dealer && $motor->dealer->logo_dealer)
                                        <img src="{{ asset('storage/' . $motor->dealer->logo_dealer) }}" alt="Logo Dealer"
                                            class="rounded-full" style="width:60px;height:60px;object-fit:cover;">
                                    @endif
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $motor->dealer->nama_dealer ?? 'Dealer tidak tersedia' }}</h3>
                                <p class="text-sm text-gray-500">Dealer {{ $motor->dealer->alamat_dealer }}</p>
                            </div>
                        </div>
                        
                        <a href="hhttps://wa.me/628984362143?text={{ urlencode($pesan) }}" target="_blank" 
                           class="flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-4 rounded-xl w-full transition-all duration-300 shadow-md">
                            <i class="fab fa-whatsapp text-xl"></i>
                            Hubungi Penjual
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Other Motorcycles Section -->
    <div class="max-w-7xl mx-auto mt-12 px-4 pb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            <i class="fas fa-motorcycle text-teal-500 mr-2"></i>Motor Lainnya
        </h2>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

    @if($otherMotors->isEmpty())
        <div class="col-span-full text-center py-10">
            <p class="text-gray-500 text-lg font-semibold">
                Motor lainnya tidak ada
            </p>
        </div>
    @else
        @foreach ($otherMotors as $other)
        <a href="{{ route('motors.show', $other->id) }}" 
           class="group overflow-hidden rounded-2xl bg-white border border-gray-200 shadow-md hover:shadow-xl transition duration-300 flex flex-col card-hover">
            
            <div class="relative overflow-hidden">
                <img src="{{ asset('storage/' . $other->gambar) }}" 
                     alt="{{ $other->nama }}" 
                     class="h-56 w-full object-cover transition duration-500 group-hover:scale-105">
                
                <span class="absolute top-4 left-4 bg-teal-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                    {{ $other->model->nama_model }}
                </span>
            </div>

            <div class="p-4 flex flex-col flex-grow">
                <span class="font-bold text-teal-600 text-lg">
                    {{ $other->merk->nama_merk }}
                </span>

                <h3 class="mt-1 font-semibold text-gray-800 text-lg">
                    {{ $other->nama }}
                </h3>

                <p class="text-teal-600 font-bold text-xl mt-1">
                    Rp {{ number_format($other->harga, 0, ',', '.') }}
                </p>

                <div class="flex items-center gap-2 mt-2 text-sm text-gray-500">
                    <span><i class="fas fa-tachometer-alt"></i> {{ $other->jarak_tempuh }}</span>
                    <span><i class="fas fa-palette"></i> {{ $other->warna }}</span>
                </div>

                <p class="mt-3 text-sm text-gray-500">
                    Stock: <span class="text-green-600 font-semibold">{{ $other->stock }}</span>
                </p>
            </div>
        </a>
        @endforeach
    @endif

</div>
    </div>
    <script>
                function sliderMotor() {
            return {
                current: 0,
                images: [
                    @foreach (['gambar', 'gambar2', 'gambar3'] as $img)
                        @if (!empty($motor->$img))
                            "{{ asset('storage/' . $motor->$img) }}",
                        @endif
                    @endforeach
                                ],
                next() {
                    this.current = (this.current + 1) % this.images.length;
                },
                prev() {
                    this.current = (this.current - 1 + this.images.length) % this.images.length;
                }
            }
        }
    </script>
@endsection