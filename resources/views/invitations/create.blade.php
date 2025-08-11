@extends('layouts.app')

@section('content')
<div class="min-h-screen flex bg-transparent">
    <div class="w-full max-w-full rounded-2xl p-2">
        <h2 class="text-3xl font-dmSerif font-semibold text-[#641b0f] mb-6">
            Tambah Tamu Undangan
        </h2>

        {{-- Error Validasi --}}
        @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-start space-x-2">
            <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18.364 5.636l-12.728 12.728M5.636 5.636l12.728 12.728" />
            </svg>
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('invitations.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Nama --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Nama Tamu
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg 
                      focus:outline-none focus:ring-2 focus:ring-pink-200 focus:border-pink-400"
                    placeholder="Masukkan nama lengkap">
            </div>

            {{-- Side --}}
            <div>
                <label for="side" class="block text-sm font-medium text-gray-700">
                    Pengantin
                </label>
                <select name="side" id="side" required class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg 
                       focus:outline-none focus:ring-2 focus:ring-pink-200 focus:border-pink-400">
                    <option value="">-- Pilih Side --</option>
                    <option value="pria" {{ old('side')=='pria' ? 'selected' : '' }}>Pria</option>
                    <option value="wanita" {{ old('side')=='wanita' ? 'selected' : '' }}>Wanita</option>
                </select>
            </div>

            {{-- Tombol Submit --}}
            <div>
                <button type="submit" class="relative lg:w-1/3 w-full overflow-hidden group inline-flex items-center justify-center gap-2
               px-6 py-3 rounded-lg bg-pink-600 text-white font-semibold shadow-md
               hover:scale-[1.02] hover:shadow-lg transition-all duration-300 ease-out
               focus:outline-none focus:ring-2 focus:ring-pink-300">

                    {{-- Gradient hover overlay --}}
                    <span class="absolute inset-0 bg-gradient-to-r from-pink-400 via-white/20 to-pink-400
                     transform -translate-x-full group-hover:translate-x-0
                     transition-transform duration-500 ease-out opacity-20 rounded-lg"></span>

                    {{-- Icon and Label --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="relative z-10 w-5 h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6h1M4 10h1M4 14h1M4 18h1M8 6h2M8 10h2M8 14h2M8 18h2M14 6h1M14 10h1M14 14h1M14 18h1M18 6h2M18 10h2M18 14h2M18 18h2" />
                    </svg>
                    <span class="relative z-10">Simpan & Generate Barcode</span>
                </button>
            </div>

        </form>
    </div>
</div>
@endsection