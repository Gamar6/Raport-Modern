<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTrack - Pantau & Kembangkan Potensi Siswa</title>
    @vite('resources/css/app.css')
</head>
<body class="antialiased bg-white text-gray-900">
    <div class="min-h-screen">

    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-white to-violet-50">
        <div class="container mx-auto px-6 py-20 relative z-10">
            <div class="grid gap-12 lg:grid-cols-2 items-center">
                <!-- Text -->
                <div class="space-y-6">
                    <h1 class="text-5xl font-bold leading-tight text-gray-900">
                        Pantau &amp; Kembangkan <br>
                        <span class="bg-gradient-to-r from-violet-500 to-indigo-500 bg-clip-text text-transparent">
                            Potensi Siswa
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 max-w-lg">
                        Platform modern untuk guru, pembina ekstrakurikuler, dan orang tua dalam memantau performa serta mengidentifikasi potensi unik setiap siswa.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('login') }}"
                           class="px-8 py-3 bg-indigo-600 text-white rounded-xl font-semibold shadow-md hover:bg-indigo-700 transition">
                           Mulai Sekarang
                        </a>
                    </div>
                </div>

                <!-- Image -->
                <div class="relative">
                    <div class="absolute -inset-4 bg-indigo-400 opacity-20 blur-3xl rounded-full"></div>
                    <img src="{{ asset('img/hero-education.jpg') }}"
                         alt="Modern education platform"
                         class="relative rounded-2xl shadow-xl w-full">
                </div>
            </div>
        </div>
    </section>

    {{-- Fitur Unggulan Section --}}
    <section class="py-20 bg-[#faf8ff]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4 text-gray-900">Fitur Unggulan</h2>
                <p class="text-lg text-gray-500">
                    Semua yang Anda butuhkan untuk mengembangkan potensi siswa
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                {{-- Card 1 --}}
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all p-8 border border-gray-100">
                    <div class="rounded-full bg-purple-50 w-12 h-12 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-graduation-cap h-6 w-6 text-purple-500">
                            <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z" />
                            <path d="M22 10v6" />
                            <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Dashboard Guru</h3>
                    <p class="text-gray-500">
                        Input dan kelola nilai tugas, UTS, UAS, serta catatan keaktifan siswa dengan mudah
                    </p>
                </div>

                {{-- Card 2 --}}
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all p-8 border border-gray-100">
                    <div class="rounded-full bg-indigo-50 w-12 h-12 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-trophy h-6 w-6 text-indigo-500">
                            <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6" />
                            <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18" />
                            <path d="M4 22h16" />
                            <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22" />
                            <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22" />
                            <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Dashboard Pembina</h3>
                    <p class="text-gray-500">
                        Catat perilaku dan aktivitas siswa di ekstrakurikuler, serta identifikasi potensi khusus
                    </p>
                </div>

                {{-- Card 3 --}}
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all p-8 border border-gray-100">
                    <div class="rounded-full bg-green-50 w-12 h-12 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-heart h-6 w-6 text-green-500">
                            <path d="M19 14c1.5-1.4 3-3.5 3-6a5.5 5.5 0 0 0-10-3A5.5 5.5 0 0 0 2 8c0 2.5 1.5 4.6 3 6l7 7Z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Dashboard Orang Tua</h3>
                    <p class="text-gray-500">
                        Pantau perkembangan akademik dan non-akademik anak secara real-time dengan visualisasi data
                    </p>
                </div>

                {{-- Card 4 --}}
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all p-8 border border-gray-100">
                    <div class="rounded-full bg-yellow-50 w-12 h-12 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-bar-chart-3 h-6 w-6 text-yellow-500">
                            <path d="M3 3v18h18" />
                            <path d="M18 17V9" />
                            <path d="M13 17V5" />
                            <path d="M8 17v-3" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Analitik &amp; Grafik</h3>
                    <p class="text-gray-500">
                        Visualisasi data dengan grafik batang dan radar untuk melihat kecenderungan minat siswa
                    </p>
                </div>

                {{-- Card 5 --}}
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all p-8 border border-gray-100">
                    <div class="rounded-full bg-purple-50 w-12 h-12 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-target h-6 w-6 text-purple-500">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="6"></circle>
                            <circle cx="12" cy="12" r="2"></circle>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Badge Potensi</h3>
                    <p class="text-gray-500">
                        Sistem badge otomatis yang menandai potensi siswa seperti kepemimpinan, kreativitas, dan lainnya
                    </p>
                </div>

                {{-- Card 6 --}}
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all p-8 border border-gray-100">
                    <div class="rounded-full bg-indigo-50 w-12 h-12 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-users h-6 w-6 text-indigo-500">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Profil Lengkap</h3>
                    <p class="text-gray-500">
                        Ringkasan komprehensif progres dan pencapaian siswa dalam satu tampilan
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-20 bg-gradient-to-b from-violet-100 to-white text-center">
        <h2 class="text-4xl font-bold mb-4 text-gray-900">
            Siap Mengembangkan Potensi Siswa?
        </h2>
        <p class="text-xl text-gray-600 mb-8">
            Bergabunglah dengan sekolah-sekolah yang sudah mempercayai <strong>EduPotensi</strong>
        </p>
    </section>

</div>
</body>
</html>
