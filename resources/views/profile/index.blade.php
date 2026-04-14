@extends('layouts.main')

@section('content')
@include('layouts.navbar')

    
<body class="min-h-screen flex items-center justify-center py-12 px-6 md:px-8">

    <!-- Profile Container - WIDER untuk laptop/device desktop (max-w-4xl) -->
    <div class="w-full max-w-4xl mx-auto fade-in my-5">
        
        <!-- Profile Card dengan desain lebar dan modern - warna teal seperti sebelumnya -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden card-hover border border-gray-100">

            <!-- HEADER - menggunakan gradien teal seperti register/login -->
            <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-8 py-7 md:px-10 md:py-8">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm shadow-md">
                        <i class="fas fa-user-circle text-white text-2xl md:text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-white text-2xl md:text-3xl font-bold tracking-tight">My Profile</h1>
                        <p class="text-teal-100 text-sm md:text-base mt-1">Kelola informasi pribadi Anda</p>
                    </div>
                </div>
            </div>

            <!-- CONTENT - Lebih lebar dengan padding ekstra -->
            <div class="p-6 md:p-8 lg:p-10">

                <!-- ALERT MESSAGE (untuk feedback) -->
                <div id="liveAlert" class="hidden mb-6 rounded-xl border-l-4 border-green-500 bg-green-50 p-4 shadow-sm transition-all duration-300">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-green-500 text-lg mt-0.5"></i>
                        <p id="alertMessage" class="text-sm text-green-700 font-medium flex-1">
                            Profile updated successfully!
                        </p>
                        <button id="closeAlertBtn" class="text-green-500 hover:text-green-700 transition">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- FORM - Tanpa JavaScript, menggunakan POST -->
                <form id="profileForm" method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf

                    <!-- Grid layout untuk form yang lebih rapi pada layar besar -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- NAMA (Readonly - Full width) -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-user text-teal-500 w-5"></i>
                                <span>Nama Lengkap</span>
                            </label>
                            <div class="relative">
                                <input type="text"
                                       name="name"
                                       value="{{ $user->name }}"
                                       readonly
                                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3.5 text-gray-700 cursor-not-allowed focus:ring-2 focus:ring-teal-400">
                                <i class="fas fa-lock absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                            </div>
                            <p class="text-xs text-gray-400 mt-1.5 ml-1">Nama tidak dapat diubah, hubungi admin jika perlu perubahan</p>
                        </div>

                        <!-- EMAIL (Readonly) -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-envelope text-teal-500 w-5"></i>
                                <span>Alamat Email</span>
                            </label>
                            <div class="relative">
                                <input type="email"
                                       name="email"
                                       value="{{ $user->email }}"
                                       readonly
                                       class="w-full bg-gray-50 border border-gray-200 rounded-xl px-5 py-3.5 text-gray-700 cursor-not-allowed focus:ring-2 focus:ring-teal-400">
                                <i class="fas fa-lock absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                            </div>
                            <p class="text-xs text-gray-400 mt-1.5 ml-1">Email tidak dapat diubah</p>
                        </div>

                        <!-- NO HP - Full width untuk konsistensi -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-phone-alt text-teal-500 w-5"></i>
                                <span>Nomor HP</span>
                            </label>
                            <input type="text"
                                   name="no_hp"
                                   value="{{ old('no_hp', $user->no_hp )}}"
                                   placeholder="Masukkan nomor HP aktif"
                                   class="w-full border border-gray-200 rounded-xl px-5 py-3.5 focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition bg-white hover:border-gray-300">
                        </div>
                    </div>

                    <!-- ALAMAT - Full width dengan textarea yang lebih besar -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-teal-500 w-5"></i>
                            <span>Alamat Lengkap</span>
                        </label>
                        <textarea name="alamat"
                                  rows="4"
                                  class="w-full border border-gray-200 rounded-xl px-5 py-3.5 focus:ring-2 focus:ring-teal-400 focus:border-teal-400 transition resize-y bg-white"
                                  placeholder="Masukkan alamat lengkap (jalan, kota, kode pos)">{{ old('alamat', $user->alamat) }}</textarea>
                    </div>

                    <!-- BUTTON ACTION - Lebar penuh dengan layout fleksibel -->
                    <div class="flex flex-col sm:flex-row gap-4 sm:items-center sm:justify-between pt-6 mt-2 border-t border-gray-200">
                        <a href="{{ route('home') }}"
                           class="inline-flex items-center justify-center gap-2 text-sm text-gray-600 hover:text-teal-600 font-medium transition py-2 px-3 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-arrow-left"></i>
                            Kembali ke Beranda
                        </a>

                        <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white text-sm font-semibold px-8 py-3.5 rounded-xl shadow-md hover:shadow-lg transition transform hover:scale-[1.02] active:scale-[0.98]">
                            <i class="fas fa-save"></i>
                            Update Profile
                        </button>
                    </div>

                </form>
            </div>
        </div>
        

@endsection