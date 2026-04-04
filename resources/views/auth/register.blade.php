{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Halaman Register</h1>
    <form method="POST" action="/register">
        @csrf

        <input type="text" name="name" placeholder="Nama"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <input type="password" name="password" placeholder="Password"><br>

        <button type="submit">Register</button>
        <a href="{{route('login')}}">Login</a>
    </form>

</body> --}}

</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotorStore - Daftar Akun</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }
        
        input:focus {
            outline: none;
            ring: 2px solid #0d9488;
        }
        
        input[type="checkbox"] {
            accent-color: #0d9488;
        }
        
        /* Simple animation on load */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.4s ease-out;
        }
        
        /* Custom styling untuk input lebih lega */
        input, button {
            transition: all 0.2s ease;
        }
        
        /* Efek hover pada card */
        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center py-12 px-6 md:px-8">

    <!-- Register Container - WIDER untuk laptop/device desktop (max-w-3xl) -->
    <div class="w-full max-w-3xl mx-auto fade-in">
        <!-- Card dengan desain lebar dan modern -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden card-hover">
            <!-- Header dengan background gradien - lebih lebar dan proporsional -->
            <div class="bg-gradient-to-r from-teal-600 to-teal-700 px-10 py-8 text-center">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 backdrop-blur-sm">
                    <i class="fas fa-motorcycle text-white text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-white">Daftar Akun</h1>
                <p class="text-teal-100 text-base mt-2">Bergabung dan temukan motor impianmu</p>
            </div>

            <!-- Form Area - Lebih lebar dengan padding ekstra -->
            <div class="p-10 md:p-12">

                <form method="POST" action="/register" class="space-y-6">
                    @csrf
                    <!-- Grid Layout untuk membuat form lebih lebar dan rapi (2 kolom pada layar besar) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name - Wajib -->
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 text-sm font-semibold mb-2">
                                <i class="fas fa-user mr-1 text-teal-500"></i> Nama Lengkap
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       name="name"
                                       class="w-full px-5 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                       placeholder="John Doe"
                                       required>
                                <i class="fas fa-user absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Email - Wajib -->
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 text-sm font-semibold mb-2">
                                <i class="fas fa-envelope mr-1 text-teal-500"></i> Alamat Email
                            </label>
                            <div class="relative">
                                <input type="email" 
                                       name="email"
                                       class="w-full px-5 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                       placeholder="you@example.com"
                                       required>
                                <i class="fas fa-envelope absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Password - Wajib -->
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 text-sm font-semibold mb-2">
                                <i class="fas fa-lock mr-1 text-teal-500"></i> Kata Sandi
                            </label>
                            <div class="relative">
                                <input type="password" 
                                       name="password"
                                       class="w-full px-5 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent transition"
                                       placeholder="Minimal 6 karakter"
                                       required>
                                <i class="fas fa-lock absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                            <p class="text-xs text-gray-400 mt-1.5 ml-1">*Minimal 6 karakter, gunakan kombinasi huruf dan angka untuk keamanan</p>
                        </div>
                    </div>

                    <!-- Submit Button - Lebar penuh dengan efek -->
                    <button type="submit" class="w-full bg-gradient-to-r from-teal-600 to-teal-700 text-white font-bold py-3.5 rounded-xl hover:from-teal-700 hover:to-teal-800 transition transform hover:scale-[1.02] active:scale-[0.98] shadow-lg mt-2">
                        <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                    </button>

                    <!-- Login Link -->
                    <div class="text-center pt-2">
                        <p class="text-sm text-gray-600">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-teal-600 font-semibold hover:text-teal-700 hover:underline transition">Masuk di sini</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
