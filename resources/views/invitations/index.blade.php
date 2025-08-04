@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-transparent">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <h1 class="text-3xl font-dmSerif font-semibold text-[#641b0f] mb-4 md:mb-0">
            Daftar Tamu Undangan
        </h1>
        <div class="flex flex-wrap gap-3">
            {{-- Tambah Tamu --}}
            <a href="{{ route('invitations.create') }}" class="relative overflow-hidden group inline-flex items-center gap-2 px-6 py-2.5
               rounded-full bg-pink-600 text-white font-medium shadow-lg
               hover:scale-105 hover:shadow-xl transition-transform duration-300 ease-out
               focus:outline-none focus:ring-2 focus:ring-pink-300">
                <span class="absolute inset-0 bg-gradient-to-r from-pink-400 via-white/20 to-pink-400
                     transform -translate-x-full group-hover:translate-x-0
                     transition-transform duration-500 ease-out opacity-20 rounded-full"></span>
                <svg xmlns="http://www.w3.org/2000/svg" class="relative z-10 w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="relative font-dmSerif z-10">Tambah Tamu</span>
            </a>
        </div>

    </div>

    {{-- Table --}}
    <div class="flex-1 overflow-x-auto">
        <table class="min-w-full bg-white rounded-2xl shadow-lg overflow-hidden">
            <thead class="bg-[#641b0f]">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-medium font-dmSerif text-white">#</th>
                    <th class="px-4 py-3 text-left text-sm font-medium font-dmSerif text-white">Nama</th>
                    <th class="px-4 py-3 text-center text-sm font-medium font-dmSerif text-white">Side</th>
                    <th class="px-4 py-3 text-center text-sm font-medium font-dmSerif text-white">Kode</th>
                    <th class="px-4 py-3 text-center text-sm font-medium font-dmSerif text-white">Barcode</th>
                    <th class="px-4 py-3 text-center text-sm font-medium font-dmSerif text-white">Kedatangan</th>
                    <th class="px-4 py-3 text-left text-sm font-medium font-dmSerif text-white">Invitation URL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invitations as $inv)
                <tr class="border-b font-dmSerif hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-sm text-gray-700">{{ $loop->iteration +
                        ($invitations->currentPage()-1)*$invitations->perPage() }}</td>
                    <td class="px-4 py-3 text-sm text-gray-700">{{ $inv->name }}</td>
                    <td class="px-4 py-3 text-center text-sm text-gray-700">{{ ucfirst($inv->side) }}</td>
                    <td class="px-4 py-3 text-center text-sm font-mono text-gray-700">{{ $inv->code }}</td>
                    <td class="px-4 py-3 text-center">
                        <div class="inline-block">
                            {!! Milon\Barcode\Facades\DNS2DFacade::getBarcodeSVG($inv->code, 'QRCODE', 4, 4) !!}
                        </div>
                        <div class="text-xs text-gray-500 mt-1">{{ $inv->code }}</div>
                    </td>
                    <td class="px-4 py-3 text-center text-sm text-gray-700">
                        @if($last = $inv->attendances->last())
                        {{ $last->arrived_at->format('d M Y H:i') }}
                        @else
                        <span class="text-gray-400">—</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-700">
                        <div class="flex items-center gap-2">
                            <span class="text-xs bg-gray-200 hover:bg-gray-300 text-gray-800 px-2 py-1 rounded">
                                <a href="{{ config('app.url') . '/' . $inv->slug }}" target="_blank">
                                    Open Link
                                </a>
                            </span>
                            <button onclick="navigator.clipboard.writeText('{{ config('app.url') . '/' . $inv->slug }}'); 
                     this.innerText = 'Copied!'; 
                     setTimeout(() => this.innerText = 'Copy', 2000);"
                                class="text-xs bg-gray-200 hover:bg-gray-300 text-gray-800 px-2 py-1 rounded">
                                Copy
                            </button>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $invitations->links() }}
    </div>
</div>
@endsection