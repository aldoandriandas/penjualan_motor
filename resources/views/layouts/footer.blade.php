<!-- ================= FOOTER ================= -->
<footer class="bg-gray-800 text-white py-10 mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

            <!-- BRAND -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 bg-teal-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-motorcycle text-white text-sm"></i>
                    </div>
                    <span class="text-lg font-bold">MotorStore</span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Your trusted partner for quality motorcycles since 2020.
                </p>
            </div>

            <!-- QUICK LINKS -->
            <div>
                <h4 class="font-semibold mb-3">Quick Links</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>
                        <a href="#home" class="hover:text-teal-400 transition">Home</a>
                    </li>
                    <li>
                        <a href="#products" class="hover:text-teal-400 transition">Products</a>
                    </li>
                    <li>
                        <a href="#contact" class="hover:text-teal-400 transition">Contact</a>
                    </li>
                </ul>
            </div>

            <!-- SOCIAL -->
            <div>
                <h4 class="font-semibold mb-3">Follow Us</h4>
                <div class="flex items-center gap-3">
                    
                    <a href="#"
                       class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-700 hover:bg-teal-600 transition">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>

                    <a href="#"
                       class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-700 hover:bg-teal-600 transition">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>

                    <a href="#"
                       class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-700 hover:bg-teal-600 transition">
                        <i class="fab fa-twitter text-sm"></i>
                    </a>

                </div>
            </div>

        </div>

        <!-- COPYRIGHT -->
        <div class="border-t border-gray-700 mt-10 pt-6 text-center text-gray-400 text-sm">
            <p>&copy; {{ date('Y') }} MotorStore. All rights reserved.</p>
        </div>

    </div>
</footer>

    <script>
        // Profile Dropdown on Click (not hover)
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');
        const dropdownOverlay = document.getElementById('dropdownOverlay');
        const chevronIcon = document.getElementById('chevronIcon');

        function openDropdown() {
            profileDropdown.classList.add('show');
            dropdownOverlay.classList.add('active');
            if (chevronIcon) {
                chevronIcon.style.transform = 'rotate(180deg)';
            }
        }

        function closeDropdown() {
            profileDropdown.classList.remove('show');
            dropdownOverlay.classList.remove('active');
            if (chevronIcon) {
                chevronIcon.style.transform = 'rotate(0deg)';
            }
        }

        function toggleDropdown() {
            if (profileDropdown.classList.contains('show')) {
                closeDropdown();
            } else {
                openDropdown();
            }
        }

        if (profileBtn) {
            profileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleDropdown();
            });
        }

        // Close dropdown when clicking overlay
        if (dropdownOverlay) {
            dropdownOverlay.addEventListener('click', () => {
                closeDropdown();
            });
        }

        // Close dropdown when clicking escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && profileDropdown && profileDropdown.classList.contains('show')) {
                closeDropdown();
            }
        });

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Close mobile menu when clicking links
        const mobileLinks = mobileMenu ? mobileMenu.querySelectorAll('a') : [];
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
        document.addEventListener("DOMContentLoaded", function() {

            // ================= YEAR AUTO GENERATE =================
            const yearSelect = document.getElementById("yearSelect");
            const currentYear = new Date().getFullYear();

            for (let i = currentYear; i >= 2000; i--) {
                let option = document.createElement("option");
                option.value = i;
                option.textContent = i;
                yearSelect.appendChild(option);
            }

            // ================= PRICE FILTER LOGIC =================
            const priceSelect = document.getElementById("priceSelect");

            priceSelect.addEventListener("change", function() {
                const value = this.value;

                let min = null;
                let max = null;

                switch (value) {
                    case "under_10":
                        max = 10000000;
                        break;
                    case "10_20":
                        min = 10000000;
                        max = 20000000;
                        break;
                    case "20_30":
                        min = 20000000;
                        max = 30000000;
                        break;
                    case "above_30":
                        min = 30000000;
                        break;
                }

                console.log("Min Price:", min);
                console.log("Max Price:", max);

                // Kalau mau kirim ke backend pakai hidden input
                document.getElementById("min_price")?.remove();
                document.getElementById("max_price")?.remove();

                if (min !== null) {
                    let inputMin = document.createElement("input");
                    inputMin.type = "hidden";
                    inputMin.name = "min_price";
                    inputMin.id = "min_price";
                    inputMin.value = min;
                    priceSelect.closest("form").appendChild(inputMin);
                }

                if (max !== null) {
                    let inputMax = document.createElement("input");
                    inputMax.type = "hidden";
                    inputMax.name = "max_price";
                    inputMax.id = "max_price";
                    inputMax.value = max;
                    priceSelect.closest("form").appendChild(inputMax);
                }
            });

        });
    </script>
    </body>

    </html>
