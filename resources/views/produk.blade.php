@extends('layouts.main')

@section('content')
    <section class="py-20 px-6 bg-gray-100 dark:bg-gray-900" id="produk">

        <div class="mx-auto max-w-7xl">

            <!-- TITLE -->
            <nav aria-label="Breadcrumb">
                <ol class="flex items-center gap-1 text-sm text-gray-700 dark:text-gray-200">
                    <li>
                        <a href="{{ route('home') }}"
                            class="block transition-colors hover:text-gray-900 dark:hover:text-white">
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
                        <a href="#" class="block transition-colors hover:text-gray-900 dark:hover:text-white">
                            Produk
                        </a>
                    </li>
                </ol>
            </nav>

            <div class="mb-12 text-center">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                    Hasil Pencarian Motor
                </h1>

                <p class="mt-3 text-gray-500 dark:text-gray-400">
                    Temukan motor terbaik sesuai kebutuhan Anda
                </p>
            </div>

            {{-- Pesan Similar --}}
            @if (!empty($similar))
                <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-6 text-center">
                    Hanya menemukan motor yang mirip!
                </div>
            @endif

            {{-- Pesan Kosong --}}
            @if (!empty($empty))
                <div class="bg-red-100 text-red-800 p-4 rounded mb-6 text-center">
                    Motor belum tersedia.
                </div>
            @endif

            <!-- GRID MOTOR -->

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse ($motors as $motor)
                    <div
                        class="group overflow-hidden rounded-2xl 
bg-gradient-to-br from-slate-800 to-slate-900
border border-white/10 shadow-xl 
hover:shadow-2xl transition duration-300 flex flex-col">

                        <!-- IMAGE -->

                        <a href="{{ route('motors.show', $motor->id) }}">

                            <div class="relative overflow-hidden">

                                <img src="{{ $motor->gambar ? asset('storage/' . $motor->gambar) : asset('images/no-image.png') }}"
                                    alt="{{ $motor->nama }}"
                                    class="h-56 w-full object-cover transition duration-500 group-hover:scale-105">

                                <span
                                    class="absolute top-4 left-4 
bg-teal-500 text-white text-xs font-semibold
px-3 py-1 rounded-full shadow">

                                    {{ $motor->model->nama_model ?? '-' }}

                                </span>

                            </div>

                        </a>

                        <!-- CONTENT -->

                        <div class="p-6 text-white flex flex-col flex-grow">

                            <span class="font-bold text-xl">
                                {{ $motor->merk->nama_merk ?? '-' }}
                            </span>

                            <p class="text-teal-400 font-semibold text-lg">
                                Rp {{ number_format($motor->harga, 0, ',', '.') }}
                            </p>

                            <h3 class="mt-1 text-lg font-bold">
                                {{ $motor->nama }}
                            </h3>

                            <!-- SPECS -->

                            <div class="mt-4 flex flex-wrap text-sm text-gray-300 divide-x divide-gray-500">

                                <span class="px-2 first:pl-0">
                                    {{ $motor->tahun }}
                                </span>

                                <span class="px-2">
                                    {{ number_format($motor->jarak_tempuh) }} KM
                                </span>

                                <span class="px-2">
                                    {{ $motor->warna }}
                                </span>

                                <span class="px-2">
                                    Stock {{ $motor->stock }}
                                </span>

                            </div>

                            <!-- BUTTON -->

                        </div>

                    </div>

                @empty

                    <div class="col-span-3 text-center text-gray-400 text-lg">
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
