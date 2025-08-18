<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    <title>Nabiilah & Zulfi Wedding</title>

    {{-- Styles --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&family=Monsieur+La+Doulaise&family=Raleway:ital,wght@0,100..900;1,100..900&family=Rouge+Script&display=swap"
        rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/brittany-signature" rel="stylesheet">

    
    <link rel="stylesheet" href="{{ asset('assets/css/build.css') }}">
    <script src="{{ asset('assets/js/build.js') }}"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

</head>

<body x-data="{ showImportModal: false }"
    class="antialiased bg-cover bg-center text-gray-700 flex flex-col min-h-screen"
    style="background-image: url('{{ asset('assets/images/background-cream.png') }}');">

    <div x-show="showImportModal" x-cloak x-transition
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div @click.away="showImportModal = false" class="bg-white p-6 m-6 rounded-xl shadow-xl w-full max-w-md">
            <h2 class="text-lg font-bold mb-4 font-dmSerif text-[#641b0f]">Import Daftar Tamu</h2>
            <form action="{{ route('invitations.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="mb-4 w-full border rounded p-2" required>
                <div class="flex justify-end space-x-2">
                    <button type="button" @click="showImportModal = false"
                        class="px-4 py-2 bg-gray-200 rounded font-dmSerif">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-[#641b0f] text-white rounded font-dmSerif">Import</button>
                </div>
            </form>
        </div>
    </div>

    <nav x-data="{ open: false }" x-cloak
        class="bg-white/30 backdrop-blur-lg border-b border-white/30 shadow-lg sticky top-0 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center h-16">
                <a href="{{ url('/invitations') }}"
                    class="text-2xl font-brittany font-extrabold text-[#641b0f] transition">
                    Nabila & Zulfi Wedding
                </a>

                <div class="hidden md:flex space-x-4">
                    <a href="javascript:void(0)" @click="showImportModal = true"
                        class="relative overflow-hidden group rounded-full text-sm font-medium font-dmSerif bg-transparent text-[#641b0f] transition-transform duration-300 ease-out hover:scale-105">
                        <span
                            class="absolute inset-0 bg-gradient-to-r from-red-200 via-white to-red-200 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500 ease-out"></span>
                        <span class="relative z-10 block px-6 py-2">Import Daftar Tamu</span>
                    </a>
                    @php
                    $links = [
                    ['label' => 'Daftar Tamu', 'route' => route('invitations.index')],
                    ['label' => 'Tambah Tamu', 'route' => route('invitations.create')],
                    ['label' => 'Scan Barcode', 'route' => route('scan.form')],
                    ];
                    @endphp

                    @foreach ($links as $link)
                    <a href="{{ $link['route'] }}" class="relative overflow-hidden group rounded-full text-sm font-medium font-dmSerif
                   bg-transparent text-[#641b0f]
                   transition-transform duration-300 ease-out hover:scale-105">
                        <span class="absolute inset-0 bg-gradient-to-r from-red-200 via-white to-red-200
                         transform -translate-x-full group-hover:translate-x-0
                         transition-transform duration-500 ease-out"></span>
                        <span class="relative z-10 block px-6 py-2">{{ $link['label'] }}</span>
                    </a>
                    @endforeach
                </div>

                <button @click="open = !open"
                    class="md:hidden p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-200 text-gray-700">
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="md:hidden bg-[#fffded] border-t border-white/20 shadow-inner">

            <div class="px-4 py-4 space-y-3">
                <a href="javascript:void(0)" @click="showImportModal = true" class="relative overflow-hidden group block text-center text-sm font-medium font-dmSerif
                       bg-[#fffded] text-[#641b0f]
                       hover:scale-[1.02] hover:shadow-lg transition-all duration-300 ease-out">
                    <span class="absolute inset-0 bg-gradient-to-r from-red-200 via-white to-red-200
                             transform -translate-x-full group-hover:translate-x-0
                             transition-transform duration-500 ease-out opacity-20 rounded-full"></span>
                    <span class="relative z-10 block px-5 py-2.5">Import Daftar Tamu</span>
                </a>
                @php
                $links = [
                ['label' => 'Daftar Tamu', 'route' => route('invitations.index')],
                ['label' => 'Tambah Tamu', 'route' => route('invitations.create')],
                ['label' => 'Scan Barcode', 'route' => route('scan.form')],
                ];
                @endphp

                @foreach ($links as $link)
                <a href="{{ $link['route'] }}" class="relative overflow-hidden group block text-center text-sm font-medium font-dmSerif
                       bg-[#fffded] text-[#641b0f]
                       hover:scale-[1.02] hover:shadow-lg transition-all duration-300 ease-out">
                    <span class="absolute inset-0 bg-gradient-to-r from-red-200 via-white to-red-200
                             transform -translate-x-full group-hover:translate-x-0
                             transition-transform duration-500 ease-out opacity-20 rounded-full"></span>
                    <span class="relative z-10 block px-5 py-2.5">{{ $link['label'] }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </nav>


    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10">
        @if(session('success'))
        <div
            class="mb-6 flex items-center space-x-2 bg-green-50 border border-green-200 text-green-800 rounded-xl p-4 shadow-sm">
            <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <div class="bg-white shadow-lg rounded-2xl shadow-xl p-8">
            @yield('content')
        </div>
    </main>

    <footer class="relative bg-white/30 backdrop-blur-lg border-t border-white/40 shadow-inner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center text-sm text-gray-600 relative z-10">
            <div class="text-xs font-dmSerif text-gray-500">
                &copy; {{ date('Y') }} <span class="font-semibold font-dmSerif text-[#641b0f]">Nabiilah & Zulfi
                    Wedding</span>.
                All rights reserved.
            </div>
        </div>
    </footer>


    @stack('scripts')
</body>

</html>