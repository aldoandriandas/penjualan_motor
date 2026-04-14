@extends('layouts.main')

@section('content')
    @include('layouts.navbar')

    <!-- Overlay for closing dropdown when clicking outside -->
    <div id="dropdownOverlay" class="dropdown-overlay"></div>

    <!-- ================= HERO SECTION ================= -->
    <section id="home" class="relative bg-gray-900">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=1920&h=1080&fit=crop" alt="Motorcycle"
                class="w-full h-full object-cover opacity-50">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Temukan
                    <span class="text-teal-400">Motor</span>
                    Impian Anda!    
                </h1>
                <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                    Temukan perjalanan sempurna yang sesuai dengan gaya dan kepribadian Anda. Sepeda motor berkualitas se-Indonesia disini.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#search"
                        class="px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition inline-block">
                        Jelajahi
                    </a>
                    <a href="#products"
                        class="px-6 py-3 border border-white text-white rounded-lg hover:bg-white/10 transition inline-block">
                        Lihat Produk
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= SEARCH SECTION ================= -->
    <section id="search" class="py-16 bg-gray-100">
        <form action="{{ route('motor.searchs') }}" method="GET">\
            @csrf
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Temukan motor yang anda suka</h2>
                    <p class="text-gray-600">Disini pasti menyediakan yang bagus dan sesuai budget anda.</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Merk</label>
                            <select name="merk" id="merkSelect"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg" required
                                oninvalid="this.setCustomValidity('Masukan merk')" oninput="this.setCustomValidity('')">
                                <option value="">Semua Merk</option>
                                @foreach ($merks as $merk)
                                    <option value="{{ $merk->id }}">{{ $merk->nama_merk }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Model</label>
                            <select name="model" id="modelSelect"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg" disabled>
                                <option value="">Pilih merk dulu</option>
                            </select>
                        </div>

                        {{-- Year --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                            <select id="yearSelect" name="tahun"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg 
               focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                required oninvalid="this.setCustomValidity('Masukan Tahun')"
                                oninput="this.setCustomValidity('')">
                                <option value="">Pilih Tahun</option>
                            </select>
                        </div>

                        {{-- Price --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kisaran Harga</label>
                            <select id="priceSelect" name="price_range"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg 
               focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                required oninvalid="this.setCustomValidity('Sesuaikan Harga')"
                                oninput="this.setCustomValidity('')">
                                <option value="">Harga</option>
                                <option value="under_10">Dibawah 10jt</option>
                                <option value="10_20">10jt - 20jt</option>
                                <option value="20_30">20jt - 30jt</option>
                                <option value="above_30">Diatas 30jt</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 text-center">
                        <button type="submit"
                            class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                            <i class="fas fa-search mr-2"></i>Cari Motor
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <!-- ================= PRODUCT SECTION ================= -->
    <section id="products" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Motor Impian Anda</h2>
                <p class="text-gray-600">Temukan Motor terbaik yang anda suka</p>
            </div>
            <div class="p-6">
                <h2 class="text-2xl font-bold text-teal-600">
                     {{ $totalMotor }} <span class="text-gray-800 text-2xl"> Motor Bekas</span>
                </h2>
                <p class="text-gray-600 mt-2">
                    Tersedia untuk dibeli
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($motors as $motor)
                    <!-- Product Card 1 -->
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition">
                        <img src="{{ asset('storage/' . $motor->gambar) }}" alt="{{ $motor->nama }}"
                            class="w-full h-48 object-cover">
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-sm text-gray-500">{{ $motor->merk->nama_merk }}</span>
                                <span class="text-xs text-gray-400">{{ $motor->tahun }}</span>
                            </div>
                            <h3 class="font-semibold text-gray-800 mb-1">{{ $motor->nama }}</h3>
                            <p class="text-teal-600 font-bold text-lg mb-2">Rp
                                {{ number_format($motor->harga, 0, ',', '.') }}</p>
                            <div class="flex justify-between text-sm text-gray-500 mb-3">
                                <span><i class="fas fa-tachometer-alt mr-1"></i>{{ number_format($motor->jarak_tempuh) }}
                                    KM</span>
                                <span><i class="fas fa-palette mr-1"></i> {{ $motor->warna }}</span>
                                <span><i class="fas fa-box mr-1"></i> Stock: {{ $motor->stock }}</span>
                            </div>
                            <a href="{{ route('motors.show', $motor->id) }}">
                                <button
                                    class="w-full py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-teal-600 hover:text-white transition">
                                    View Details
                                </button>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <i class="fas fa-motorcycle text-6xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500">No motorcycles available at the moment</p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>

    <!-- ================= TESTIMONIALS SECTION ================= -->
    <section id="testimonials" class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- TITLE --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">
                    Testimoni Pelanggan
                </h2>
                <p class="text-gray-600">
                    Beberapa pelanggan kami memberikan ulasan.
                </p>
            </div>

            {{-- WRAPPER --}}
            <div class="overflow-hidden relative">

                {{-- SLIDER --}}
                <div id="slider" class="flex gap-6 transition-transform duration-700 ease-linear">

                    {{-- CLONE DEPAN --}}
                    @foreach ($testimonis as $t)
                        <div class="card min-w-[300px] max-w-[300px] bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-12 h-12 bg-teal-600 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($t->nama, 0, 1)) }}
                                </div>
                                <div class="ml-3">
                                    <h4 class="font-semibold">{{ $t->nama }}</h4>
                                    <p class="text-sm text-gray-500">{{ $t->email }}</p>
                                </div>
                            </div>
                            <p>"{{ $t->pesan }}"</p>
                        </div>
                    @endforeach

                    {{-- DATA ASLI --}}
                    @foreach ($testimonis as $t)
                        <div class="card min-w-[300px] max-w-[300px] bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-12 h-12 bg-teal-600 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($t->nama, 0, 1)) }}
                                </div>
                                <div class="ml-3">
                                    <h4 class="font-semibold">{{ $t->nama }}</h4>
                                    <p class="text-sm text-gray-500">{{ $t->email }}</p>
                                </div>
                            </div>
                            <p>"{{ $t->pesan }}"</p>
                        </div>
                    @endforeach

                    {{-- CLONE BELAKANG --}}
                    @foreach ($testimonis as $t)
                        <div class="card min-w-[300px] max-w-[300px] bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-12 h-12 bg-teal-600 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($t->nama, 0, 1)) }}
                                </div>
                                <div class="ml-3">
                                    <h4 class="font-semibold">{{ $t->nama }}</h4>
                                    <p class="text-sm text-gray-500">{{ $t->email }}</p>
                                </div>
                            </div>
                            <p>"{{ $t->pesan }}"</p>
                        </div>
                    @endforeach

                </div>

            </div>

        </div>
    </section>

    <script>
        const slider = document.getElementById('slider');
        const cardWidth = 320;
        const total = slider.children.length / 3; // karena clone 3x
        let index = total; // mulai dari tengah

        // posisi awal (tengah)
        slider.style.transform = `translateX(-${index * cardWidth}px)`;

        function autoSlide() {
            index++;

            slider.style.transition = "transform 0.7s linear";
            slider.style.transform = `translateX(-${index * cardWidth}px)`;

            // RESET TANPA JEDA
            if (index >= total * 2) {
                setTimeout(() => {
                    slider.style.transition = "none";
                    index = total;
                    slider.style.transform = `translateX(-${index * cardWidth}px)`;
                }, 700);
            }
        }

        setInterval(autoSlide, 2500);
    </script>

    <!-- ================= FAQ SECTION ================= -->
    <section id="faq" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Tanya Jawab BicyStore</h2>
                <p class="text-gray-600">Saya akan menjawab pertanyaan yang mungkin sering anda Tanyakan!</p>
            </div>

            <div class="max-w-3xl mx-auto">
                <div class="space-y-4">
                    <details
                        class="group rounded-xl border border-gray-200 bg-white shadow-sm transition-all duration-200 faq-card">
                        <summary
                            class="flex cursor-pointer items-center justify-between gap-4 rounded-lg px-6 py-4 font-semibold text-gray-800 hover:bg-gray-50 transition-colors">
                            <span class="flex items-center gap-3"><i
                                    class="fas fa-motorcycle text-teal-500 text-lg"></i><span>What are the basic
                                    features?</span></span>
                            <svg class="size-5 shrink-0 transition-transform duration-300 group-open:-rotate-180 text-gray-500"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </summary>
                        <div class="px-6 pb-5 pt-2 border-t border-gray-100">
                            <p class="text-gray-600 leading-relaxed">Our motorcycles come equipped with advanced digital
                                displays, fuel-efficient engines ranging from 150cc to 1000cc, anti-lock braking systems
                                (ABS) on premium models, LED lighting, and ergonomic seating for maximum comfort.</p>
                        </div>
                    </details>
                    <details
                        class="group rounded-xl border border-gray-200 bg-white shadow-sm transition-all duration-200 faq-card">
                        <summary
                            class="flex cursor-pointer items-center justify-between gap-4 rounded-lg px-6 py-4 font-semibold text-gray-800 hover:bg-gray-50 transition-colors">
                            <span class="flex items-center gap-3"><i
                                    class="fas fa-rocket text-teal-500 text-lg"></i><span>How do I get
                                    started?</span></span>
                            <svg class="size-5 shrink-0 transition-transform duration-300 group-open:-rotate-180 text-gray-500"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </summary>
                        <div class="px-6 pb-5 pt-2 border-t border-gray-100">
                            <p class="text-gray-600 leading-relaxed">Getting started is easy! Simply browse our collection,
                                choose your desired motorcycle, and click "Book Test Ride" or "Buy Now". New customers
                                receive a complimentary safety gear package with their first purchase.</p>
                        </div>
                    </details>
                    <details
                        class="group rounded-xl border border-gray-200 bg-white shadow-sm transition-all duration-200 faq-card">
                        <summary
                            class="flex cursor-pointer items-center justify-between gap-4 rounded-lg px-6 py-4 font-semibold text-gray-800 hover:bg-gray-50 transition-colors">
                            <span class="flex items-center gap-3"><i
                                    class="fas fa-headset text-teal-500 text-lg"></i><span>What support options are
                                    available?</span></span>
                            <svg class="size-5 shrink-0 transition-transform duration-300 group-open:-rotate-180 text-gray-500"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </summary>
                        <div class="px-6 pb-5 pt-2 border-t border-gray-100">
                            <p class="text-gray-600 leading-relaxed">We offer 24/7 customer support via live chat,
                                WhatsApp, and phone. Every purchase includes a 2-year warranty with roadside assistance.</p>
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= CONTACT SECTION ================= -->
    <section id="contact" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Get In Touch</h2>
                <p class="text-gray-600">Have questions? We're here to help you find your perfect motorcycle</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-gray-100 rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Contact Information</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center"><i
                                    class="fas fa-map-marker-alt text-teal-600"></i></div><span
                                class="text-gray-600"><a href="https://maps.app.goo.gl/vuCFNZNqytPo4cdj9" target="_blank">Padang, Indonesia</a></span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center"><i
                                    class="fas fa-phone text-teal-600"></i></div><span class="text-gray-600">+62 812 3456
                                7890</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center"><i
                                    class="fas fa-envelope text-teal-600"></i></div><span
                                class="text-gray-600">contact@bicystore.com</span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-100 rounded-lg p-6">
                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <input name="name" value="{{ old('name') }}" type="text" placeholder="Your Name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500">
                            <input name="email" value="{{ old('email') }}" type="email" placeholder="Your Email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500">
                            <textarea name="message" rows="4" placeholder="Your Message"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500">{{ old('message') }}</textarea>
                            <button type="submit"
                                class="w-full px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
