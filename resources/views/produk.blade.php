@extends('layouts.main')

@section('content')
@include('layouts.navbar')
    <section class="py-20 px-6 bg-gray-50" id="produk">
        
        <div class="mx-auto max-w-7xl">
            <!-- BREADCRUMB -->
            <nav aria-label="Breadcrumb" class="mb-8">
                <ol class="flex items-center gap-1 text-sm text-gray-600">
                    <li>
                        <a href="{{ route('home') }}" class="block transition-colors hover:text-teal-600">
                            Home
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
                        <a href="#" class="block transition-colors hover:text-teal-600">
                            Produk
                        </a>
                    </li>
                </ol>
            </nav>

            <!-- TITLE -->
            <div class="mb-12 text-center">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">
                    Hasil Pencarian Motor
                </h1>
                <p class="mt-3 text-gray-600">
                    Temukan motor terbaik sesuai kebutuhan Anda
                </p>
            </div>

            {{-- Pesan Similar --}}
            @if (!empty($similar))
                <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-lg mb-6 text-center">
                    Hanya menemukan motor yang mirip!
                </div>
            @endif

            {{-- Pesan Kosong --}}
            @if (!empty($empty))
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg mb-6 text-center">
                    Motor belum tersedia.
                </div>
            @endif

            <!-- GRID MOTOR -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($motors as $motor)
                    <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden flex flex-col border border-gray-100">
                        <!-- IMAGE -->
                        <a href="{{ route('motors.show', $motor->id) }}" class="relative overflow-hidden block">
                            <img src="{{ $motor->gambar ? asset('storage/' . $motor->gambar) : asset('images/no-image.png') }}"
                                alt="{{ $motor->nama }}"
                                class="h-56 w-full object-cover transition duration-500 group-hover:scale-105">
                        </a>

                        <!-- CONTENT -->
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-teal-600 font-semibold text-sm uppercase tracking-wide">
                                    {{ $motor->merk->nama_merk ?? '-' }}
                                </span>
                                <span class="text-gray-500 text-sm">
                                    Stock: {{ $motor->stock }}
                                </span>
                            </div>
                            
                            <p class="text-teal-600 font-bold text-2xl mb-2">
                                Rp {{ number_format($motor->harga, 0, ',', '.') }}
                            </p>
                            
                            <h3 class="text-lg font-bold text-gray-900 mb-3">
                                {{ $motor->nama }}
                            </h3>

                            <!-- SPECS -->
                            <div class="flex flex-wrap gap-3 text-sm text-gray-600 border-t border-gray-100 pt-4 mt-auto">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $motor->tahun }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    {{ number_format($motor->jarak_tempuh) }} KM
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                    </svg>
                                    {{ $motor->warna }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500 text-lg py-12">
                        Tidak ada data motor ditemukan
                    </div>
                @endforelse
            </div>

            <!-- PAGINATION -->
            @if ($motors instanceof \Illuminate\Pagination\AbstractPaginator)
                <div class="mt-12 flex justify-center">
                    {{ $motors->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection