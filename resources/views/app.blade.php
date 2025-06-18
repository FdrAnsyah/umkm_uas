@extends('layouts.app')
@section('content')
    <section class="relative bg-gradient-to-r from-primary to-secondary text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div
                class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80')] bg-cover bg-center">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 py-24 md:py-32 relative z-10">
            <div class="max-w-3xl mx-auto text-center animate-fade-in">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                    Temukan <span class="text-accent">UMKM</span> di Seluruh Indonesia
                </h1>
                <p class="text-xl md:text-2xl mb-8 opacity-90">
                    Platform direktori UMKM terintegrasi untuk menemukan produk lokal berkualitas dari berbagai provinsi dan
                    kabupaten/kota di Indonesia.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#produk"
                        class="bg-accent hover:bg-yellow-500 text-dark font-bold px-8 py-4 rounded-lg transition transform hover:scale-105 shadow-lg">
                        Jelajahi Produk <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    <a href="#umkm"
                        class="bg-white hover:bg-gray-100 text-primary font-bold px-8 py-4 rounded-lg transition transform hover:scale-105 shadow-lg">
                        Daftarkan UMKM <i class="fas fa-store ml-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 h-16 bg-white transform skew-y-1 -mb-8 z-0"></div>
    </section>

    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="bg-light p-6 rounded-xl shadow-sm animate-fade-in delay-100">
                    <div class="text-4xl font-bold text-primary mb-2">34</div>
                    <div class="text-gray-600">Provinsi</div>
                </div>
                <div class="bg-light p-6 rounded-xl shadow-sm animate-fade-in delay-200">
                    <div class="text-4xl font-bold text-primary mb-2">514</div>
                    <div class="text-gray-600">Kabupaten/Kota</div>
                </div>
                <div class="bg-light p-6 rounded-xl shadow-sm animate-fade-in delay-300">
                    <div class="text-4xl font-bold text-primary mb-2">65K+</div>
                    <div class="text-gray-600">UMKM Terdaftar</div>
                </div>
                <div class="bg-light p-6 rounded-xl shadow-sm animate-fade-in delay-300">
                    <div class="text-4xl font-bold text-primary mb-2">24/7</div>
                    <div class="text-gray-600">Layanan Dukungan</div>
                </div>
            </div>
        </div>
    </section>

    <section id="lokasi" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4">Jelajahi UMKM Berdasarkan <span
                        class="text-primary">Lokasi</span></h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Temukan produk UMKM dari berbagai daerah di seluruh Indonesia.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-3">
                    <!-- Map Visualization -->
                    <div class="lg:col-span-2 p-6">
                        <div class="map-container h-full min-h-[400px]">
                            <div id="indonesia-map"></div>
                            <div class="loading-indicator">
                                <div class="text-center p-4 bg-white bg-opacity-90 rounded-lg shadow-sm">
                                    <div
                                        class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-primary mx-auto mb-4">
                                    </div>
                                    <p class="text-gray-700 font-medium">Memuat peta interaktif...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Location List -->
                    <div class="bg-gray-50 p-6 border-t lg:border-t-0 lg:border-l border-gray-200">
                        <h3 class="text-xl font-bold text-dark mb-4">Provinsi Populer</h3>
                        <div class="space-y-3 max-h-[360px] overflow-y-auto pr-2" id="province-list">
                            <!-- Province items will be added by JavaScript -->
                        </div>

                        <div class="mt-6">
                            <a href="#" class="text-primary font-medium hover:underline flex items-center">
                                Lihat Semua Provinsi <i class="fas fa-chevron-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
