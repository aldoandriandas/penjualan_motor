@extends('layouts.main')

@section('content')
@include('layouts.navbar')
 <div class="container mx-auto px-4 py-6 sm:py-8 md:py-12 max-w-5xl">
    <div class="flex justify-center">
        
        <!-- Profile Card -->
        <div class="w-full max-w-2xl">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

                <!-- HEADER -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-5 py-4 sm:px-6 sm:py-5 md:px-8">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 sm:h-12 sm:w-12 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-user text-white text-lg sm:text-xl"></i>
                        </div>
                        <div>
                            <h5 class="text-white text-lg sm:text-xl font-bold">My Profile</h5>
                            <p class="text-blue-100 text-xs sm:text-sm">Kelola informasi pribadi Anda</p>
                        </div>
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="p-5 sm:p-6 md:p-8">

                    <!-- ALERT -->
                    <div id="liveAlert" class="hidden mb-5 rounded-xl border-l-4 border-green-500 bg-green-50 p-4 shadow-sm">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 text-lg"></i>
                            <p id="alertMessage" class="text-sm text-green-700 font-medium flex-1">
                                Profile updated successfully!
                            </p>
                            <button id="closeAlertBtn" class="text-green-500 hover:text-green-700">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <!-- FORM -->
                    <form id="profileForm" action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <!-- NAMA -->
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-user text-gray-500"></i> Nama Lengkap
                            </label>
                            <input type="text"
                                   value="{{ $user->name }}"
                                   readonly
                                   class="form-control w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-700 cursor-not-allowed">
                        </div>

                        <!-- EMAIL -->
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-envelope text-gray-500"></i> Email
                            </label>
                            <input type="email"
                                   value="{{ $user->email }}"
                                   readonly
                                   class="form-control w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-700 cursor-not-allowed">
                            <p class="text-xs text-gray-400 mt-1">Email tidak dapat diubah</p>
                        </div>

                        <!-- NO HP -->
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-phone-alt text-gray-500"></i> Nomor HP
                            </label>
                            <input type="text"
                                   name="no_hp"
                                   value="{{ old('no_hp', $user->no_hp) }}"
                                   placeholder="Masukkan nomor HP"
                                   class="form-control w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition">
                        </div>

                        <!-- ALAMAT -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fas fa-map-marker-alt text-gray-500"></i> Alamat
                            </label>
                            <textarea name="alamat"
                                      rows="4"
                                      class="form-control w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition resize-y"
                                      placeholder="Masukkan alamat lengkap">{{ old('alamat', $user->alamat) }}</textarea>
                        </div>

                        <!-- BUTTON -->
                        <div class="flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between pt-4 border-t border-gray-100">

                            <a href="{{ route('home') }}"
                               class="inline-flex items-center justify-center gap-2 text-sm text-gray-600 hover:text-indigo-600 font-medium transition">
                                <i class="fas fa-arrow-left"></i>
                                Kembali
                            </a>

                            <button type="submit"
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-3 rounded-xl shadow-md hover:shadow-lg transition">
                                <i class="fas fa-save"></i>
                                Update Profile
                            </button>

                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection