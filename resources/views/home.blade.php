@extends('layouts.main')

@section('content')

@include('layouts.navbar')

    <!-- Overlay for closing dropdown when clicking outside -->
    <div id="dropdownOverlay" class="dropdown-overlay"></div>

    <!-- ================= HERO SECTION ================= -->
    <section id="home" class="relative bg-gray-900">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=1920&h=1080&fit=crop" 
                 alt="Motorcycle" 
                 class="w-full h-full object-cover opacity-50">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Find Your Dream
                    <span class="text-teal-400">Motorcycle</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                    Discover the perfect ride that matches your style and personality. Quality motorcycles from world-class manufacturers.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#search" class="px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition inline-block">
                        Explore Now
                    </a>
                    <a href="#products" class="px-6 py-3 border border-white text-white rounded-lg hover:bg-white/10 transition inline-block">
                        View Products
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= SEARCH SECTION ================= -->
    <section id="search" class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Find Your Perfect Match</h2>
                <p class="text-gray-600">Use our filters to find the motorcycle that suits you best</p>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                        <select name="merk" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            <option value="">All Merk</option>
                            @foreach ($merks as $merk )
                                <option value="{{ $merk->id }}">{{ $merk->nama_merk }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Model</label>
                        <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            <option>All Models</option>
                            @foreach ($models as $model)
                                <option value="{{ $model->id }}">{{ $model->nama_model }}</option>
                            @endforeach
                        </select>
                    </div>
                    
{{-- Year --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
    <select id="yearSelect" name="tahun"
        class="w-full px-3 py-2 border border-gray-300 rounded-lg 
               focus:ring-2 focus:ring-teal-500 focus:border-transparent">
        <option value="">All Years</option>
    </select>
</div>

{{-- Price --}}
<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
    <select id="priceSelect" name="price_range"
        class="w-full px-3 py-2 border border-gray-300 rounded-lg 
               focus:ring-2 focus:ring-teal-500 focus:border-transparent">
        <option value="">All Prices</option>
        <option value="under_10">Under 10jt</option>
        <option value="10_20">10jt - 20jt</option>
        <option value="20_30">20jt - 30jt</option>
        <option value="above_30">Above 30jt</option>
    </select>
</div>
                </div>
                
                <div class="mt-6 text-center">
                    <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                        <i class="fas fa-search mr-2"></i>Search Motorcycles
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= PRODUCT SECTION ================= -->
    <section id="products" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Featured Motorcycles</h2>
                <p class="text-gray-600">Explore our collection of premium motorcycles</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse ($motors as $motor)
                                        
                <!-- Product Card 1 -->
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition">
                    <img src="{{ asset('storage/' . $motor->gambar) }}" 
                         alt="{{ $motor->nama }}"
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm text-gray-500">{{ $motor->merk->nama_merk }}</span>
                            <span class="text-xs text-gray-400">{{ $motor->tahun }}</span>
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-1">{{ $motor->nama }}</h3>
                        <p class="text-teal-600 font-bold text-lg mb-2">Rp {{ number_format($motor->harga, 0, ',', '.') }}</p>
                        <div class="flex justify-between text-sm text-gray-500 mb-3">
                            <span><i class="fas fa-tachometer-alt mr-1"></i>{{ number_format($motor->jarak_tempuh) }} KM</span>
                            <span><i class="fas fa-palette mr-1"></i> {{ $motor->warna }}</span>
                            <span><i class="fas fa-box mr-1"></i> Stock: {{ $motor->stock }}</span>
                        </div>
                        <a href="{{ route('motors.show', $motor->id) }}">
                            <button class="w-full py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-teal-600 hover:text-white transition">
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
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">What Our Customers Say</h2>
                <p class="text-gray-600">Trusted by thousands of satisfied customers</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-teal-600 rounded-full flex items-center justify-center text-white font-bold text-lg">AF</div>
                        <div class="ml-3">
                            <h4 class="font-semibold text-gray-800">Ahmad Fauzi</h4>
                            <div class="text-yellow-400 text-sm"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Amazing service! The motorcycle arrived in perfect condition. Highly recommended!"</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-teal-600 rounded-full flex items-center justify-center text-white font-bold text-lg">SN</div>
                        <div class="ml-3">
                            <h4 class="font-semibold text-gray-800">Siti Nurhaliza</h4>
                            <div class="text-yellow-400 text-sm"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Very professional team. They helped me choose the perfect motorcycle for my needs."</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-teal-600 rounded-full flex items-center justify-center text-white font-bold text-lg">BS</div>
                        <div class="ml-3">
                            <h4 class="font-semibold text-gray-800">Budi Santoso</h4>
                            <div class="text-yellow-400 text-sm"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Fast delivery and great after-sales support. Will definitely buy again!"</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ================= FAQ SECTION ================= -->
    <section id="faq" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Frequently Asked Questions</h2>
                <p class="text-gray-600">Find answers to common questions about our motorcycles and services</p>
            </div>
            
            <div class="max-w-3xl mx-auto">
                <div class="space-y-4">
                    <details class="group rounded-xl border border-gray-200 bg-white shadow-sm transition-all duration-200 faq-card">
                        <summary class="flex cursor-pointer items-center justify-between gap-4 rounded-lg px-6 py-4 font-semibold text-gray-800 hover:bg-gray-50 transition-colors">
                            <span class="flex items-center gap-3"><i class="fas fa-motorcycle text-teal-500 text-lg"></i><span>What are the basic features?</span></span>
                            <svg class="size-5 shrink-0 transition-transform duration-300 group-open:-rotate-180 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                        </summary>
                        <div class="px-6 pb-5 pt-2 border-t border-gray-100">
                            <p class="text-gray-600 leading-relaxed">Our motorcycles come equipped with advanced digital displays, fuel-efficient engines ranging from 150cc to 1000cc, anti-lock braking systems (ABS) on premium models, LED lighting, and ergonomic seating for maximum comfort.</p>
                        </div>
                    </details>
                    <details class="group rounded-xl border border-gray-200 bg-white shadow-sm transition-all duration-200 faq-card">
                        <summary class="flex cursor-pointer items-center justify-between gap-4 rounded-lg px-6 py-4 font-semibold text-gray-800 hover:bg-gray-50 transition-colors">
                            <span class="flex items-center gap-3"><i class="fas fa-rocket text-teal-500 text-lg"></i><span>How do I get started?</span></span>
                            <svg class="size-5 shrink-0 transition-transform duration-300 group-open:-rotate-180 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                        </summary>
                        <div class="px-6 pb-5 pt-2 border-t border-gray-100">
                            <p class="text-gray-600 leading-relaxed">Getting started is easy! Simply browse our collection, choose your desired motorcycle, and click "Book Test Ride" or "Buy Now". New customers receive a complimentary safety gear package with their first purchase.</p>
                        </div>
                    </details>
                    <details class="group rounded-xl border border-gray-200 bg-white shadow-sm transition-all duration-200 faq-card">
                        <summary class="flex cursor-pointer items-center justify-between gap-4 rounded-lg px-6 py-4 font-semibold text-gray-800 hover:bg-gray-50 transition-colors">
                            <span class="flex items-center gap-3"><i class="fas fa-headset text-teal-500 text-lg"></i><span>What support options are available?</span></span>
                            <svg class="size-5 shrink-0 transition-transform duration-300 group-open:-rotate-180 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                        </summary>
                        <div class="px-6 pb-5 pt-2 border-t border-gray-100">
                            <p class="text-gray-600 leading-relaxed">We offer 24/7 customer support via live chat, WhatsApp, and phone. Every purchase includes a 2-year warranty with roadside assistance.</p>
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
                        <div class="flex items-center space-x-3"><div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center"><i class="fas fa-map-marker-alt text-teal-600"></i></div><span class="text-gray-600">Jakarta, Indonesia</span></div>
                        <div class="flex items-center space-x-3"><div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center"><i class="fas fa-phone text-teal-600"></i></div><span class="text-gray-600">+62 812 3456 7890</span></div>
                        <div class="flex items-center space-x-3"><div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center"><i class="fas fa-envelope text-teal-600"></i></div><span class="text-gray-600">info@motorstore.com</span></div>
                    </div>
                </div>
                <div class="bg-gray-100 rounded-lg p-6">
                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <input type="text" 
                                   name="name" 
                                   required
                                   placeholder="Your Name"
                                   value="{{ old('name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500">
                            <input type="email" 
                                   name="email" 
                                   required
                                   placeholder="Your Email"
                                   value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500">
                            <textarea name="message" 
                                      rows="4" 
                                      required
                                      placeholder="Your Message" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500">{{ old('message') }}</textarea>
                            <button type="submit" class="w-full px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>




@endsection