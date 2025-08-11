@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-transparent"
    x-data="invitationTable({ invitations: {{ $invitationsJson }} })">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <h1 class="text-3xl font-dmSerif font-semibold text-[#641b0f] mb-4 md:mb-0">
            Daftar Tamu Undangan
        </h1>

        <input type="text" placeholder="Cari nama atau kode..."
            class="border border-gray-300 rounded-full px-4 py-2 text-sm focus:ring-2 focus:ring-pink-400"
            x-model="search">
    </div>
    <div class="flex-1 overflow-x-auto">
        <div x-show="alertMessage" x-transition:enter="transform ease-out duration-300"
            x-transition:enter-start="translate-y-[-8px] opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transform ease-in duration-300" x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="translate-y-[-8px] opacity-0" :class="{
    'bg-green-600': alertType === 'success',
    'bg-red-600':   alertType === 'error',
    'bg-blue-600':  alertType === 'info'
  }" role="alert" :aria-live="alertType === 'error' ? 'assertive' : 'polite'" class="fixed z-50 px-4 py-3 rounded-lg shadow-lg font-semibold tracking-wide text-white
         left-4 right-4 mx-auto max-w-xl
         sm:left-auto sm:right-5 sm:top-5 sm:max-w-md
         text-sm sm:text-base
         pointer-events-auto" style="top: calc(env(safe-area-inset-top, 0px) + 0.75rem);">
            <div class="flex items-start gap-3">
                <div class="flex-1">
                    <span x-text="alertMessage" class="block break-words"></span>
                </div>

                <button type="button" @click="alertMessage = null" aria-label="Close alert"
                    class="ml-2 inline-flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 p-1.5 focus:outline-none focus:ring-2 focus:ring-white/40">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 8.586l4.95-4.95 1.414 1.414L11.414 10l4.95 4.95-1.414 1.414L10 11.414l-4.95 4.95-1.414-1.414L8.586 10 3.636 5.05 5.05 3.636 10 8.586z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        <table class="min-w-full bg-white rounded-2xl shadow-lg overflow-hidden">
            <thead class="bg-[#641b0f]">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-medium font-dmSerif text-white">No.</th>

                    <th class="px-4 py-3 text-left text-sm font-medium font-dmSerif text-white cursor-pointer"
                        @click="sort('name')">
                        <div class="flex items-center justify-between">
                            <span>Nama</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                :class="{'rotate-180': sortBy === 'name' && sortDirection === 'desc', 'opacity-30': sortBy !== 'name'}"
                                x-show="sortBy === 'name' || sortBy !== 'name'">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 15l7-7 7 7" />
                            </svg>
                        </div>
                    </th>

                    <th class="px-4 py-3 text-center text-sm font-medium font-dmSerif text-white cursor-pointer"
                        @click="sort('side')">
                        <div class="flex items-center justify-between">
                            <span>Side</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                :class="{'rotate-180': sortBy === 'side' && sortDirection === 'desc', 'opacity-30': sortBy !== 'side'}">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 15l7-7 7 7" />
                            </svg>
                        </div>
                    </th>

                    <th class="px-4 py-3 text-sm font-medium font-dmSerif text-white">Code</th>
                    <th class="px-4 py-3 text-sm font-medium font-dmSerif text-white">Barcode</th>
                    <th class="px-4 py-3 text-sm font-medium font-dmSerif text-white">Kedatangan</th>
                    <th class="px-4 py-3 text-sm font-medium font-dmSerif text-white">Invitation URL</th>
                    <th class="px-4 py-3 text-sm font-medium font-dmSerif text-white">Manual Check-In</th>
                </tr>
            </thead>

            <tbody>
                <tr x-show="filteredInvitations.length === 0">
                    <td colspan="8" class="text-center py-6 text-gray-500 italic">
                        Tidak ada tamu undangan yang didaftarkan
                    </td>
                </tr>
                <template x-for="(inv, index) in paginatedInvitations" :key="inv.id">
                    <tr class="font-dmSerif text-sm">
                        <td class="text-center" x-text="(currentPage - 1) * perPage + index + 1"></td>
                        <td x-text="inv.name"></td>
                        <td x-text="inv.side"></td>
                        <td x-text="inv.code"></td>
                        <td class="text-center py-2">
                            <div class="justify-items-center" x-html="inv.barcode_svg"></div>
                            <div x-text="inv.code"></div>
                        </td>
                        <td class="text-center">
                            <span x-text="inv.arrived_at ?? '—'"></span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a :href="`{{ config('app.url') }}/${inv.slug}`" target="_blank"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-[#641b0f] text-white text-xs font-medium shadow-sm hover:bg-[#7a2517] hover:shadow-md transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 3h7m0 0v7m0-7L10 14m-4 7h14a2 2 0 002-2V10" />
                                    </svg>
                                    Open
                                </a>

                                <button @click="navigator.clipboard.writeText(`{{ config('app.url') }}/${inv.slug}`);
                    $el.innerText = 'Copied!';
                    setTimeout(() => $el.innerText = 'Copy', 2000)"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-gray-200 text-gray-800 text-xs font-medium shadow-sm hover:bg-gray-300 hover:shadow-md transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-4 12h6a2 2 0 002-2v-6a2 2 0 00-2-2h-6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                    </svg>
                                    Copy
                                </button>

                                <a :href="`/print-barcode/${inv.slug}`" target="_blank"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-blue-600 text-white text-xs font-medium shadow-sm hover:bg-blue-700 hover:shadow-md transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 9V2h12v7m-6 4v7m-4-4h8" />
                                    </svg>
                                    Print
                                </a>
                            </div>
                        </td>
                        <td class="px-4 py-3 justify-items-center">
                            <button @click="toggleCheckIn(inv.slug)" :class="inv.checkedIn 
            ? 'bg-green-500 hover:bg-green-600' 
            : 'bg-gray-200 hover:bg-gray-300'"
                                class="flex items-center gap-2 text-white px-4 py-2 rounded-full text-sm transition-all duration-300 ease-in-out">
                                <template x-if="inv.checkedIn">
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                        Checked-In
                                    </span>
                                </template>

                                <template x-if="!inv.checkedIn">
                                    <span class="flex items-center gap-1 text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-700"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 9l3 3-3 3m5-6l3 3-3 3" />
                                        </svg>
                                        Check-In
                                    </span>
                                </template>
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>

        <div class="flex items-center justify-between mt-4 px-2">
            <div class="flex items-center gap-2">
                <label class="text-sm">Per page</label>
                <select x-model.number="perPage" class="border rounded px-2 py-1 text-sm">
                    <option :value="5">5</option>
                    <option :value="10">10</option>
                    <option :value="25">25</option>
                    <option :value="50">50</option>
                </select>
                <div class="text-sm text-gray-600" x-text="filteredInvitations.length + ' result(s)'"></div>
            </div>

            <div class="flex items-center gap-2">
                <button @click="prevPage()" :disabled="currentPage === 1"
                    class="px-3 py-1 rounded-md border disabled:opacity-50">Prev</button>

                <template x-for="page in visiblePageNumbers" :key="page">
                    <button @click="goToPage(page)" x-text="page"
                        :class="{'bg-[#641b0f] text-white': page === currentPage, 'bg-white': page !== currentPage}"
                        class="px-3 py-1 rounded-md border text-sm"></button>
                </template>

                <button @click="nextPage()" :disabled="currentPage === totalPages"
                    class="px-3 py-1 rounded-md border disabled:opacity-50">Next</button>
            </div>
        </div>
    </div>
</div>

<script>
    function invitationTable({ invitations }) {
    return {
        invitations: invitations,
        search: '',
        sortBy: 'name',
        sortDirection: 'asc',
        alertMessage: '',
        alertType: 'success',

        currentPage: 1,
        perPage: 10,

        showAlert(message, type = 'success') {
            this.alertMessage = message;
            this.alertType = type;
            setTimeout(() => this.alertMessage = '', 2000);
        },

        toggleCheckIn(slug) {
            let guest = this.invitations.find(g => g.slug === slug);
            if (!guest) return;

            let newState = !guest.checkedIn;

            fetch(`/invitations/${slug}/check-in`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ checked_in: newState })
            })
            .then(res => {
                if (!res.ok) throw new Error('Failed to update');
                return res.json();
            })
            .then(data => {
                guest.checkedIn = data.checked_in;
                guest.arrived_at = data.arrived_at ?? null;

                if (data.checked_in) {
                    this.showAlert(`${guest.name} has been checked in.`, 'success');
                } else {
                    this.showAlert(`${guest.name} has been marked as not attended.`, 'info');
                }
            })
            .catch(err => {
                console.error(err);
                this.showAlert('Error updating check-in status', 'error');
            });
        },

        get filteredInvitations() {
            let data = this.invitations;

            if (this.search) {
                const searchLower = this.search.toLowerCase();
                data = data.filter(inv => 
                    inv.name.toLowerCase().includes(searchLower));
            }

            data = data.sort((a, b) => {
                let fa = a[this.sortBy] ? a[this.sortBy].toString().toLowerCase() : '';
                let fb = b[this.sortBy] ? b[this.sortBy].toString().toLowerCase() : '';
                if (fa < fb) return this.sortDirection === 'asc' ? -1 : 1;
                if (fa > fb) return this.sortDirection === 'asc' ? 1 : -1;
                return 0;
            });

            return data;
        },

        get totalPages() {
            return Math.max(1, Math.ceil(this.filteredInvitations.length / this.perPage || 0));
        },

        get paginatedInvitations() {
            const total = this.totalPages;
            if (this.currentPage > total) this.currentPage = total;
            if (this.currentPage < 1) this.currentPage = 1;

            const start = (this.currentPage - 1) * this.perPage;
            return this.filteredInvitations.slice(start, start + this.perPage);
        },

        get visiblePageNumbers() {
            const total = this.totalPages;
            const maxButtons = 7;
            let start = Math.max(1, this.currentPage - Math.floor(maxButtons / 2));
            let end = start + maxButtons - 1;
            if (end > total) {
                end = total;
                start = Math.max(1, end - maxButtons + 1);
            }
            const pages = [];
            for (let i = start; i <= end; i++) pages.push(i);
            return pages;
        },

        goToPage(page) {
            if (page < 1) page = 1;
            if (page > this.totalPages) page = this.totalPages;
            this.currentPage = page;
        },

        prevPage() {
            if (this.currentPage > 1) this.currentPage--;
        },

        nextPage() {
            if (this.currentPage < this.totalPages) this.currentPage++;
        },

        sort(column) {
            if (this.sortBy === column) {
                this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortBy = column;
                this.sortDirection = 'asc';
            }
            this.currentPage = 1;
        },

        init() {
            this.$watch('search', () => { this.currentPage = 1; });
            this.$watch('perPage', () => { this.currentPage = 1; });
            this.$watch('sortBy', () => { this.currentPage = 1; });
            this.$watch('sortDirection', () => { this.currentPage = 1; });
        }
    }
}
</script>
@endsection