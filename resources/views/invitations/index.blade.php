@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-transparent"
    x-data="invitationTable({ invitations: {{ $invitationsJson }} })">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <h1 class="text-3xl font-dmSerif font-semibold text-[#641b0f] mb-4 md:mb-0">
            Daftar Tamu Undangan
        </h1>

        <div class="flex items-center gap-2">
            <input type="text" placeholder="Cari nama atau kode..."
                class="border border-gray-300 rounded-full px-4 py-2 text-sm focus:ring-2 focus:ring-pink-400"
                x-model="search">
            <button x-show="selected.length > 0" @click="printSelected()"
                class="font-dmSerif px-3 py-2 rounded-lg bg-blue-600 text-white text-sm shadow-sm hover:bg-blue-700">
                Print Selected ( <span x-text="selected.length"></span> )
            </button>
        </div>
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
                    <th class="px-4 py-3 text-left text-sm font-medium font-dmSerif text-white">Select
                    </th>
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
                    {{-- <th class="px-4 py-3 text-sm font-medium font-dmSerif text-white">Barcode</th> --}}
                    <th class="px-4 py-3 text-sm font-medium font-dmSerif text-white">Kedatangan</th>
                    <th class="px-4 py-3 text-sm font-medium font-dmSerif text-white">Invitation URL</th>
                    <th class="px-4 py-3 text-sm font-medium font-dmSerif text-white">Actions</th>
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
                        <td class="text-center">
                            <input type="checkbox" :value="inv.slug" x-model="selected" />
                        </td>
                        <td class="text-center" x-text="(currentPage - 1) * perPage + index + 1"></td>
                        <td x-text="inv.name"></td>
                        <td x-text="inv.side"></td>
                        <td x-text="inv.code"></td>
                        {{-- <td class="text-center py-2">
                            <div class="justify-items-center" x-html="inv.barcode_svg"></div>
                            <div x-text="inv.code"></div>
                        </td> --}}
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
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button @click="editGuest(inv)" class="p-2 rounded-lg border hover:bg-gray-50"
                                    title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon>
                                    </svg>
                                </button>

                                <button @click="deleteSlug = inv.slug; showDeleteModal = true"
                                    class="p-2 rounded-lg border hover:bg-red-50" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </button>
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

    <!-- Edit Modal -->
    <div x-show="editingGuest" x-cloak x-transition
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div @click.away="editingGuest = null" class="bg-white p-6 m-6 rounded-xl shadow-xl w-full max-w-md">

            <h2 class="text-lg font-bold mb-4 font-dmSerif text-[#641b0f]">Edit Guest</h2>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium font-dmSerif text-[#641b0f]">Name</label>
                    <input type="text" x-model="editingGuest.name" class="w-full border rounded p-2 mt-1" />
                </div>

                <div>
                    <label class="block text-sm font-medium font-dmSerif text-[#641b0f]">Side</label>
                    <input type="text" x-model="editingGuest.side" class="w-full border rounded p-2 mt-1" />
                </div>

                <div class="hidden">
                    <label class="block text-sm font-medium font-dmSerif text-[#641b0f]">Code</label>
                    <input type="text" x-model="editingGuest.code" class="w-full border rounded p-2 mt-1" />
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-2">
                <button type="button" @click="editingGuest = null"
                    class="px-4 py-2 bg-gray-200 rounded font-dmSerif">Batal</button>
                <button type="button" @click="saveGuest()"
                    class="px-4 py-2 bg-[#641b0f] text-white rounded font-dmSerif">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div x-show="showDeleteModal" x-cloak x-transition
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div @click.away="showDeleteModal = false" class="bg-white p-6 m-6 rounded-xl shadow-xl w-full max-w-md">

            <h2 class="text-lg font-bold mb-4 font-dmSerif text-[#641b0f]">Hapus Tamu</h2>
            <p class="mb-6 text-gray-700">Apakah Anda yakin ingin menghapus tamu ini?
                <br><span class="font-semibold text-red-600">Tindakan ini tidak bisa dibatalkan.</span>
            </p>

            <div class="flex justify-end space-x-2">
                <button @click="showDeleteModal = false"
                    class="px-4 py-2 bg-gray-200 rounded font-dmSerif">Batal</button>
                <button @click="confirmDelete()"
                    class="px-4 py-2 bg-red-600 text-white rounded font-dmSerif">Hapus</button>
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

        selected: [], 
        selectModeVisible: false,

        showAlert(message, type = 'success') {
            this.alertMessage = message;
            this.alertType = type;
            setTimeout(() => this.alertMessage = '', 2000);
        },

        printSelected() {
        if (!this.selected || this.selected.length === 0) {
            this.showAlert('Pilih minimal 1 tamu untuk dicetak.', 'error');
            return;
        }

        const size = 3;
        const copies = 1;
        const perPage = 18;

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/invitations/print-selected';
        form.target = '_blank';

        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        this.selected.forEach(slug => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'slugs[]';
            input.value = slug;
            form.appendChild(input);
        });

        const sizeInput = document.createElement('input');
        sizeInput.type = 'hidden';
        sizeInput.name = 'size';
        sizeInput.value = size;
        form.appendChild(sizeInput);

        const copiesInput = document.createElement('input');
        copiesInput.type = 'hidden';
        copiesInput.name = 'copies';
        copiesInput.value = copies;
        form.appendChild(copiesInput);

        const perPageInput = document.createElement('input');
        perPageInput.type = 'hidden';
        perPageInput.name = 'per_page';
        perPageInput.value = perPage;
        form.appendChild(perPageInput);

        document.body.appendChild(form);
        form.submit();
        form.remove();
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

        editGuest(inv) {
            this.editingGuest = {...inv};
            this.editIndex = this.invitations.findIndex(g => g.slug === inv.slug);
        },

        saveGuest() {
            if (!this.editingGuest) return;
            const payload = {
                name: this.editingGuest.name,
                side: this.editingGuest.side,
                code: this.editingGuest.code
            };

            fetch(`/invitations/${this.editingGuest.slug}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            })
            .then(res => {
                if (!res.ok) return res.json().then(err => Promise.reject(err));
                return res.json();
            })
            .then(data => {
                if (this.editIndex !== null && this.editIndex >= 0) {
                    this.invitations.splice(this.editIndex, 1, data);
                } else {
                    const idx = this.invitations.findIndex(g => g.slug === data.slug);
                    if (idx !== -1) this.invitations.splice(idx, 1, data);
                }

                this.showAlert('Guest updated successfully', 'success');
                this.editingGuest = null;
                this.editIndex = null;
            })
            .catch(err => {
                console.error(err);
                const message = (err && err.message) ? err.message : 'Failed to update guest';
                this.showAlert(message, 'error');
            });
        },

        // ---------- DELETE ----------
        deleteSlug: null,
        showDeleteModal: false,

        deleteGuest(slug) {
            this.deleteSlug = slug; 
            this.showDeleteModal = true; 
        },

        confirmDelete() {
            if (!this.deleteSlug) return;

            fetch(`/invitations/${this.deleteSlug}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => {
                if (!res.ok) throw new Error('Failed to delete');
                return res.json();
            })
            .then(data => {
                this.invitations = this.invitations.filter(g => g.slug !== this.deleteSlug);
                this.showAlert('Guest deleted', 'success');

                this.showDeleteModal = false;
                this.deleteSlug = null;

                if (this.paginatedInvitations.length === 0 && this.currentPage > 1) {
                    this.currentPage--;
                }
            })
            .catch(err => {
                console.error(err);
                this.showAlert('Error deleting guest', 'error');
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