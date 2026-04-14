<!-- ================= NAVBAR (Previous style with profile dropdown on click) ================= -->
<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-teal-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-motorcycle text-white text-sm"></i>
                </div>
                <span class="text-xl font-bold text-gray-800">BicyStore</span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-teal-600 transition">Home</a>
                <a href="#search" class="text-gray-600 hover:text-teal-600 transition">Search</a>
                <a href="#products" class="text-gray-600 hover:text-teal-600 transition">Products</a>
                <a href="#testimonials" class="text-gray-600 hover:text-teal-600 transition">Testimonials</a>
                <a href="#faq" class="text-gray-600 hover:text-teal-600 transition">FAQ</a>
                <a href="#contact" class="text-gray-600 hover:text-teal-600 transition">Contact</a>
            </div>

            <!-- Profile Dropdown (on click) -->
            @auth
                <div class="hidden md:flex space-x-3 items-center relative" id="profileContainer">
                    <button
                        class="flex items-center space-x-2 focus:outline-none hover:bg-gray-50 px-3 py-2 rounded-lg transition"
                        id="profileBtn">
                        <div class="w-8 h-8 bg-teal-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-teal-600 text-sm"></i>
                        </div>
                        <span
                            class="text-gray-700 text-sm font-medium">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        <i class="fas fa-chevron-down text-gray-400 text-xs transition-transform duration-200"
                            id="chevronIcon"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="profileDropdown"
                        class="profile-dropdown absolute right-0 top-full mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 invisible transition-all duration-200 transform -translate-y-2 z-50">
                        <div class="p-2">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.index') }}"
                                class="flex items-center gap-3 rounded-lg px-4 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition mt-1">
                                <i class="fas fa-user-circle w-4 text-teal-500"></i>
                                My Profile
                            </a>
                            @if (in_array(Auth::user()->role, ['super_admin', 'admin']))
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center gap-3 rounded-lg px-4 py-2 text-sm text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">
                                    <i class="fas fa-cog w-4 text-teal-500"></i>
                                    Dashboard
                                </a>
                            @endif

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf

                                <div class="border-t border-gray-100 mt-1 pt-1">
                                    <button type="submit"
                                        class="w-full flex items-center gap-3 rounded-lg px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">

                                        <i class="fas fa-sign-out-alt w-4"></i>
                                        Logout
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobileMenuBtn" class="md:hidden text-gray-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-3 space-y-2">
                <a href="#home" class="block py-2 text-gray-600 hover:text-teal-600">Home</a>
                <a href="#search" class="block py-2 text-gray-600 hover:text-teal-600">Search</a>
                <a href="#products" class="block py-2 text-gray-600 hover:text-teal-600">Products</a>
                <a href="#testimonials" class="block py-2 text-gray-600 hover:text-teal-600">Testimonials</a>
                <a href="#faq" class="block py-2 text-gray-600 hover:text-teal-600">FAQ</a>
                <a href="#contact" class="block py-2 text-gray-600 hover:text-teal-600">Contact</a>
                <div class="pt-3 border-t space-y-2">
                    <div class="flex items-center gap-3 py-2 px-2 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-teal-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <a href="{{ route('profile.index') }}" class="block py-2 text-gray-600 hover:text-teal-600"><i
                            class="fas fa-user-circle w-5 mr-2"></i> My Profile</a>
                            @if (in_array(Auth::user()->role, ['super_admin', 'admin']))
                                <a href="{{route('admin.dashboard') }}" class="block py-2 text-gray-600 hover:text-teal-600"><i
                            class="fas fa-shopping-bag w-5 mr-2"></i> Dashboard</a>
                            @endif
                    
<form action="{{ route('logout') }}" method="POST" class="mt-2">
    @csrf

    <button type="submit"
        class="w-full block py-2 text-center text-red-600 border border-red-600 rounded-lg
               hover:bg-red-600 hover:text-white transition duration-200">
        Logout
    </button>
</form>
                </div>
            </div>
        </div>
    @endauth
    @guest
        <div class="flex items-center gap-3">
            <!-- Kalau BELUM login -->
            <a href="{{ route('login') }}"
                class="px-4 py-2 rounded-xl text-sm font-semibold bg-teal-300
                          text-white shadow-md
                          hover:scale-105 hover:shadow-lg
                          transition duration-200">
                Login
            </a>

            <a href="{{ route('register') }}"
                class="px-4 py-2 rounded-xl text-sm font-semibold bg-teal-500
                          text-white shadow-md
                          hover:scale-105 hover:shadow-lg
                          transition duration-200">
                Register
            </a>
        </div>

    @endguest
</nav>
