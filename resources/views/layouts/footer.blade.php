    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-teal-600 rounded-lg flex items-center justify-center"><i
                                class="fas fa-motorcycle text-white text-sm"></i></div><span
                            class="text-lg font-bold">BicyStore</span>
                    </div>
                    <p class="text-gray-400 text-sm">Mitra terpercaya Anda untuk sepeda motor berkualitas sejak tahun 2026.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-3">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#home" class="hover:text-teal-400 transition">Home</a></li>
                        <li><a href="#products" class="hover:text-teal-400 transition">Products</a></li>
                        <li><a href="#contact" class="hover:text-teal-400 transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-3">Support</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-teal-400 transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-teal-400 transition">Shipping Info</a></li>
                        <li><a href="#" class="hover:text-teal-400 transition">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-3">Follow Us</h4>
                    <div class="flex space-x-3"><a href="#"
                            class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center hover:bg-teal-600 transition"><i
                                class="fab fa-facebook-f text-sm"></i></a><a href="#"
                            class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center hover:bg-teal-600 transition"><i
                                class="fab fa-instagram text-sm"></i></a><a href="#"
                            class="w-8 h-8 bg-gray-700 rounded-full flex items-center justify-center hover:bg-teal-600 transition"><i
                                class="fab fa-twitter text-sm"></i></a></div>
                </div>
            </div>
        </div>
    </footer>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ================= DROPDOWN =================
            const profileBtn = document.getElementById('profileBtn');
            const profileDropdown = document.getElementById('profileDropdown');
            const dropdownOverlay = document.getElementById('dropdownOverlay');
            const chevronIcon = document.getElementById('chevronIcon');

            function openDropdown() {
                profileDropdown?.classList.add('show');
                dropdownOverlay?.classList.add('active');
                if (chevronIcon) chevronIcon.style.transform = 'rotate(180deg)';
            }

            function closeDropdown() {
                profileDropdown?.classList.remove('show');
                dropdownOverlay?.classList.remove('active');
                if (chevronIcon) chevronIcon.style.transform = 'rotate(0deg)';
            }

            function toggleDropdown() {
                profileDropdown?.classList.contains('show') ? closeDropdown() : openDropdown();
            }

            profileBtn?.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleDropdown();
            });

            dropdownOverlay?.addEventListener('click', closeDropdown);

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && profileDropdown?.classList.contains('show')) {
                    closeDropdown();
                }
            });


            // ================= MOBILE MENU =================
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');

            mobileMenuBtn?.addEventListener('click', () => {
                mobileMenu?.classList.toggle('hidden');
            });

            mobileMenu?.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                });
            });

            const merkSelect = document.getElementById('merkSelect');
            const modelSelect = document.getElementById('modelSelect');

            merkSelect.addEventListener('change', function() {
                const merkId = this.value;

                // kalau merk kosong
                if (!merkId) {
                    modelSelect.disabled = true;
                    modelSelect.innerHTML = '<option value="">Pilih merk dulu</option>';
                    return;
                }

                // aktifkan select model
                modelSelect.disabled = false;
                modelSelect.innerHTML = '<option>Loading...</option>';

                fetch(`/get-models/${merkId}`)
                    .then(response => response.json())
                    .then(data => {

                        // reset isi
                        modelSelect.innerHTML = '';

                        // kalau tidak ada model
                        if (data.length === 0) {
                            modelSelect.innerHTML = '<option value="">Model tidak tersedia</option>';
                            return;
                        }

                        // default option
                        modelSelect.innerHTML = '<option value="">All Models</option>';

                        data.forEach(model => {
                            modelSelect.innerHTML += `
                    <option value="${model.id}">${model.nama_model}</option>
                `;
                        });
                    })
                    .catch(error => {
                        console.error(error);
                        modelSelect.innerHTML = '<option>Error loading data</option>';
                    });
            });
            // ================= YEAR =================
            const yearSelect = document.getElementById('yearSelect');
            const currentYear = new Date().getFullYear();

            if (yearSelect) {
                for (let year = currentYear; year >= 2000; year--) {
                    const option = document.createElement('option');
                    option.value = year;
                    option.textContent = year;

                    if (year == {{ request('tahun', 'null') }}) {
                        option.selected = true;
                    }

                    yearSelect.appendChild(option);
                }
            }

        });
    </script>


    </html>
