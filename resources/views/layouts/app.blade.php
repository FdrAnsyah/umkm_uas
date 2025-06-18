<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/indonesiaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Map Styles */
        #indonesia-map {
            width: 100%;
            height: 100%;
            min-height: 400px;
            background-color: theme('colors.gray.100');
        }

        @media (min-width: 768px) {
            #indonesia-map {
                min-height: 500px;
            }
        }

        /* Map Container */
        .map-container {
            position: relative;
            height: 100%;
            overflow: hidden;
            border-radius: 0.75rem;
        }

        /* Loading Indicator */
        .loading-indicator {
            position: absolute;
            inset: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.9);
            z-index: 10;
            backdrop-filter: blur(2px);
        }

        /* Province Card Animation */
        .province-item {
            transition: transform-shadow 0.3s ease;
        }

        .province-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Focus Styles for Accessibility */
        button:focus,
        a:focus {
            outline: 2px solid #2563eb;
            /* Replace with the actual primary color value */
            outline-offset: 2px;
        }
    </style>
</head>

<body class="font-sans bg-gray-50 text-gray-800">
    @include('layouts.components.navbar')
    <main>
        @yield('content')
    </main>
    <footer class="bg-dark text-white pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center mb-4">
                        <img src="./src/assets/logo.png" alt="Logo UMKM Indonesia" class="h-8 w-auto mr-2 rounded-sm">
                        <span class="text-xl font-bold text-white">UMKM<span class="text-accent">Indonesia</span></span>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Platform resmi untuk pengembangan dan promosi UMKM lokal di seluruh Indonesia.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-bold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                        <li><a href="#produk" class="text-gray-400 hover:text-white transition">Produk</a></li>
                        <li><a href="#lokasi" class="text-gray-400 hover:text-white transition">Lokasi</a></li>
                        <li><a href="#umkm" class="text-gray-400 hover:text-white transition">Daftar UMKM</a></li>
                        <li><a href="#tentang" class="text-gray-400 hover:text-white transition">Tentang Kami</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-bold mb-4">Layanan</h4>
                    <ul class="space-y-2">
                        <li><a href="./pages/pelatihan.php" class="text-gray-400 hover:text-white transition">Pelatihan
                                UMKM</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Pendampingan Bisnis</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Akses Pembiayaan</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Pemasaran Digital</a>
                        </li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Legalitas Usaha</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-bold mb-4">Kontak</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-gray-400 mt-1 mr-3"></i>
                            <span class="text-gray-400">Gedung Kementerian UMKM, Jl. Jend. Sudirman Kav. 1, Jakarta
                                Pusat</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt text-gray-400 mt-1 mr-3"></i>
                            <span class="text-gray-400">(021) 1234567</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-gray-400 mt-1 mr-3"></i>
                            <span class="text-gray-400">info@umkm-indonesia.go.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-500 text-sm mb-4 md:mb-0">
                        &copy; 2025 Direktori UMKM Indonesia. Hak Cipta Dilindungi.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-500 hover:text-white text-sm transition">Kebijakan
                            Privasi</a>
                        <a href="#" class="text-gray-500 hover:text-white text-sm transition">Syarat &
                            Ketentuan</a>
                        <a href="#" class="text-gray-500 hover:text-white text-sm transition">FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuOpenIcon = document.getElementById('menu-open-icon');
            const menuCloseIcon = document.getElementById('menu-close-icon');

            // Fungsi untuk toggle menu mobile
            function toggleMobileMenu() {
                // Toggle visibility menu mobile
                mobileMenu.classList.toggle('hidden');

                // Toggle animasi
                mobileMenu.classList.toggle('origin-top');
                mobileMenu.classList.toggle('transition-all');
                mobileMenu.classList.toggle('duration-300');
                mobileMenu.classList.toggle('ease-out');

                // Toggle icons
                menuOpenIcon.classList.toggle('hidden');
                menuCloseIcon.classList.toggle('hidden');
            }

            // Event listener untuk tombol menu mobile
            mobileMenuButton.addEventListener('click', toggleMobileMenu);

            // Tutup menu ketika mengklik item menu (untuk navigasi anchor)
            const mobileMenuItems = mobileMenu.querySelectorAll('a[href^="#"]');
            mobileMenuItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Tunggu sebentar sebelum menutup untuk memastikan navigasi terjadi
                    setTimeout(() => {
                        toggleMobileMenu();
                    }, 100);
                });
            });

            // Tutup menu ketika mengklik di luar menu
            document.addEventListener('click', function(event) {
                const isClickInsideNavbar = event.target.closest('nav');
                const isClickOnMenuButton = event.target.closest('#mobile-menu-button');
                const isClickInsideMobileMenu = event.target.closest('#mobile-menu');

                if (!mobileMenu.classList.contains('hidden') &&
                    isClickInsideNavbar &&
                    !isClickOnMenuButton &&
                    !isClickInsideMobileMenu) {
                    toggleMobileMenu();
                }
            });

            // Tutup menu ketika ukuran layar berubah menjadi lebih besar (desktop)
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768 && !mobileMenu.classList.contains('hidden')) {
                    toggleMobileMenu();
                }
            });
        });


        function initIndonesiaMap() {
            const root = am5.Root.new('indonesia-map');

            root.setThemes([am5themes_Animated.new(root)]);

            const chart = root.container.children.push(
                am5map.MapChart.new(root, {
                    panX: 'none',
                    panY: 'none',
                    projection: am5map.geoMercator(),
                    paddingBottom: 20,
                    paddingTop: 20,
                    paddingLeft: 20,
                    paddingRight: 20,
                })
            );

            // Buat series polygon untuk peta
            const polygonSeries = chart.series.push(
                am5map.MapPolygonSeries.new(root, {
                    geoJSON: am5geodata_indonesiaLow,
                    exclude: ['AQ'],
                    fill: am5.color(0x6699cc),
                    stroke: am5.color(0xffffff),
                })
            );

            // Konfigurasi series
            polygonSeries.mapPolygons.template.setAll({
                tooltipText: '{name}',
                interactive: true,
                fill: am5.color(0x6699cc),
            });

            // Efek hover
            polygonSeries.mapPolygons.template.states.create('hover', {
                fill: am5.color(0xf59e0b),
            });

            // Event click
            polygonSeries.mapPolygons.template.events.on('click', function(ev) {
                const province = ev.target.dataItem?.dataContext;
                if (province) {
                    console.log('Provinsi dipilih:', province.name);
                }
            });

            // Tambahkan zoom control
            chart.set('zoomControl', am5map.ZoomControl.new(root, {}));

            // Sembunyikan loading indicator
            document.querySelector('.loading-indicator').style.display = 'none';

            return {
                chart,
                polygonSeries
            };
        }

        // Fungsi untuk menampilkan daftar provinsi
        function populateProvinceList(polygonSeries) {
            // Data provinsi
            const popularProvinces = [{
                    id: 'ID-JK',
                    name: 'DKI Jakarta',
                    umkmCount: 850
                },
                {
                    id: 'ID-JB',
                    name: 'Jawa Barat',
                    umkmCount: 1250
                },
                {
                    id: 'ID-JT',
                    name: 'Jawa Tengah',
                    umkmCount: 980
                },
                {
                    id: 'ID-JI',
                    name: 'Jawa Timur',
                    umkmCount: 1100
                },
                {
                    id: 'ID-BT',
                    name: 'Banten',
                    umkmCount: 620
                },
            ];

            // Populasi daftar provinsi
            const provinceList = document.getElementById('province-list');

            popularProvinces.forEach((province) => {
                const item = document.createElement('div');
                item.className = 'province-item flex items-center p-3 bg-white rounded-lg cursor-pointer';
                item.innerHTML = `
          <div class="w-8 h-8 rounded-full bg-primary bg-opacity-10 text-primary flex items-center justify-center mr-3">
              <i class="fas fa-map-marker-alt text-sm"></i>
          </div>
          <div>
              <h4 class="font-medium">${province.name}</h4>
              <p class="text-xs text-gray-500">${province.umkmCount} UMKM</p>
          </div>
      `;

                // Event click untuk highlight peta
                item.addEventListener('click', () => {
                    polygonSeries.mapPolygons.each((polygon) => {
                        if (polygon.dataItem?.dataContext?.id === province.id) {
                            polygonSeries.triggerHoverOnDataItem(polygon.dataItem);
                            polygon.events.dispatch('click');
                        }
                    });
                });

                // Efek hover
                item.addEventListener('mouseenter', () => {
                    item.classList.add('shadow-md');
                    item.style.transform = 'translateY(-2px)';
                });

                item.addEventListener('mouseleave', () => {
                    item.classList.remove('shadow-md');
                    item.style.transform = '';
                });

                provinceList.appendChild(item);
            });
        }

        // Fungsi untuk toggle mobile menu
        function initMobileMenu() {
            const button = document.getElementById('mobile-menu-button');
            const menu = document.querySelector('.md-hidden'); // Sesuaikan dengan class di HTML

            if (button && menu) {
                button.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                });
            }
        }

        // Inisialisasi semua ketika DOM siap
        document.addEventListener('DOMContentLoaded', () => {
            // Inisialisasi peta
            const {
                polygonSeries
            } = initIndonesiaMap();
            populateProvinceList(polygonSeries);

            // Inisialisasi mobile menu
            initMobileMenu();

            // Smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 80,
                            behavior: 'smooth',
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
