<div id="qris-modal" class="fixed inset-0 z-[99999] hidden flex items-center justify-center px-4">
  <div id="qris-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>

  <div class="relative z-10 w-full max-w-md md:max-w-lg lg:max-w-xl mx-auto">
    <div class="transform-gpu transition-all duration-300 ease-out scale-95 opacity-0 pointer-events-none"
      id="qris-panel" role="dialog" aria-modal="true" aria-labelledby="qris-title" aria-hidden="true">
      <div class="bg-white/5 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden ring-1 ring-white/10">
        <div class="flex items-center justify-between px-6 py-4">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
              </svg>
            </div>

            <div class="max-w-[92vw] text-center lg:block md:block hidden">
              <div id="qris-title"
                class="font-brittany text-base sm:text-lg md:text-2xl lg:text-3xl text-white leading-tight tracking-tight">
                Scan untuk Bayar
              </div>
              <div class="text-[11px] sm:text-xs md:text-sm text-white/75 -mt-0.5">
                QRIS — Nabiilah &amp; Zulfi
              </div>
            </div>
          </div>

          <div class="flex items-center gap-3">
            <button id="qris-open-new" title="Buka gambar di tab baru"
              class="p-2 rounded-md hover:bg-white/5 focus:outline-none" aria-label="Open QR image in new tab">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white/90" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 3h7v7"></path>
                <path d="M10 14L21 3"></path>
                <path d="M21 21H3V3"></path>
              </svg>
            </button>

            <button id="qris-download"
              class="px-3 py-1 rounded-md bg-white text-[#641b0f] font-medium text-sm shadow-sm hover:scale-[1.02] transition"
              aria-label="Download QR image" title="Download QRIS">
              Download
            </button>

            <button id="qris-close" class="p-2 rounded-md hover:bg-white/5 focus:outline-none" aria-label="Tutup dialog"
              title="Tutup">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white/90" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6L6 18"></path>
                <path d="M6 6l12 12"></path>
              </svg>
            </button>
          </div>
        </div>

        <div class="p-6 flex flex-col items-center gap-4">
          <div id="qris-loader" class="flex flex-col items-center gap-3">
            <div class="w-12 h-12 rounded-full border-4 border-white/10 border-t-white animate-spin"></div>
            <div class="text-sm text-white/75">Memuat QR…</div>
          </div>

          <div id="qris-img-wrap" class="w-full hidden">
            <img id="qris-img" src="" alt="QRIS Nabiilah & Zulfi"
              class="w-full max-w-[420px] h-auto rounded-lg shadow-xl mx-auto" />
            <div class="mt-3 text-xs text-white/80 text-center">Scan QR dengan aplikasi pembayaran (QRIS)
            </div>
          </div>

          <div id="qris-error" class="hidden text-sm text-red-300">Gagal memuat gambar. <span
              class="text-white underline cursor-pointer" id="qris-retry">Coba lagi</span></div>
        </div>

        <div class="px-6 py-4 border-t border-white/5 text-center text-xs text-white/60">
          Tip: gunakan camera / fitur scan pada e-wallet Anda lalu pilih jumlah yang ingin dikirim.
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  (function () {
  const BTN = document.getElementById('cashless');
  const MODAL = document.getElementById('qris-modal');
  const PANEL = document.getElementById('qris-panel');
  const BACKDROP = document.getElementById('qris-backdrop');
  const CLOSE = document.getElementById('qris-close');
  const OPEN_NEW = document.getElementById('qris-open-new');
  const DOWNLOAD_BTN = document.getElementById('qris-download');
  const LOADER = document.getElementById('qris-loader');
  const IMG_WRAP = document.getElementById('qris-img-wrap');
  const IMG = document.getElementById('qris-img');
  const ERROR = document.getElementById('qris-error');
  const RETRY = document.getElementById('qris-retry');

  const QRIS_SRC = "{{ asset('assets/images/qris.jpg') }}";
  const DOWNLOAD_FILENAME = 'qris-nabiilah-zulfi.jpg';
  let lastFocused = null;

  function openModal() {
    lastFocused = document.activeElement;
    MODAL.classList.remove('hidden');
    PANEL.classList.remove('pointer-events-none');
    PANEL.style.opacity = '1';
    PANEL.style.transform = 'scale(1)';
    PANEL.removeAttribute('aria-hidden');

    document.body.style.overflow = 'hidden';
    LOADER.classList.remove('hidden');
    IMG_WRAP.classList.add('hidden');
    ERROR.classList.add('hidden');
    IMG.removeAttribute('src');

    OPEN_NEW.onclick = () => window.open(QRIS_SRC, '_blank', 'noopener');
    DOWNLOAD_BTN.onclick = () => {
      const a = document.createElement('a');
      a.href = QRIS_SRC;
      a.download = DOWNLOAD_FILENAME;
      document.body.appendChild(a);
      a.click();
      a.remove();
    };

    loadImage(QRIS_SRC);
    CLOSE.focus();

    document.addEventListener('keydown', onKeyDown);
    BACKDROP.addEventListener('click', closeModalOnce);
    document.addEventListener('focus', trapFocus, true);
  }

  function closeModal() {
    PANEL.style.opacity = '0';
    PANEL.style.transform = 'scale(.96)';
    PANEL.setAttribute('aria-hidden', 'true');

    setTimeout(() => {
      MODAL.classList.add('hidden');
      document.body.style.overflow = '';
      IMG.src = '';
      document.removeEventListener('keydown', onKeyDown);
      BACKDROP.removeEventListener('click', closeModalOnce);
      document.removeEventListener('focus', trapFocus, true);
      if (lastFocused && typeof lastFocused.focus === 'function') lastFocused.focus();
    }, 180);
  }

  function closeModalOnce() { closeModal(); }
  function onKeyDown(e) { if (e.key === 'Escape') closeModal(); }
  function trapFocus(e) {
    if (!MODAL.contains(e.target)) {
      e.stopPropagation();
      CLOSE.focus();
    }
  }

  function loadImage(src) {
    LOADER.classList.remove('hidden');
    IMG_WRAP.classList.add('hidden');
    ERROR.classList.add('hidden');

    const temp = new Image();
    temp.onload = function () {
      IMG.src = src;
      LOADER.classList.add('hidden');
      IMG_WRAP.classList.remove('hidden');
    }
    temp.onerror = function () {
      LOADER.classList.add('hidden');
      ERROR.classList.remove('hidden');
    }
    temp.src = src;
  }

  RETRY && RETRY.addEventListener('click', () => loadImage(QRIS_SRC));
  BTN && BTN.addEventListener('click', (e) => { e.preventDefault(); openModal(); });
  CLOSE && CLOSE.addEventListener('click', closeModal);

})();
</script>