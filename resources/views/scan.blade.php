@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-start justify-center pt-8 bg-white">
  <div class="w-full max-w-md px-4 py-2">
    <h2 class="text-2xl font-dmSerif font-semibold text-[#641b0f] mb-3 text-center">
      Scan Barcode Undangan
    </h2>

    <div id="alert"
      class="hidden w-full max-w-md mx-auto flex items-start rounded-lg border-l-4 bg-white shadow-md p-3 mb-3 transition duration-200"
      role="alert" aria-live="polite" aria-hidden="true">

      <!-- Icon -->
      <div id="alertIcon" class="flex-shrink-0">
        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 16h-1v-4h-1m1-4h.01M12 20.5a8.5 8.5 0 100-17 8.5 8.5 0 000 17z" />
        </svg>
      </div>

      <!-- Content -->
      <div class="flex-1 min-w-0 pl-3">
        <p id="alertTitle" class="text-sm font-medium text-gray-900">Mencari kamera…</p>
        <p id="alertBody" class="text-xs text-gray-500 mt-0.5">Pastikan kamera Anda terhubung dan izinkan akses.</p>
      </div>

      <!-- Close button -->
      <button id="closeAlert"
        class="ml-3 inline-flex items-center justify-center p-1 rounded hover:bg-gray-100 text-gray-400 hover:text-gray-600 focus:outline-none"
        aria-label="Tutup notifikasi">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <div class="flex items-center justify-between mb-2">
      <div id="cameraLabel" class="text-sm text-gray-600">Mencari kamera…</div>
      <div class="flex items-center gap-2">
        <select id="cameraSelect" class="hidden md:inline-block p-1 border rounded text-sm"></select>
        <button id="switchCameraBtn" class="px-3 py-1 bg-[#641b0f] text-white rounded text-sm">Switch Camera</button>
      </div>
    </div>

    <div id="reader"
      class="w-full h-72 lg:h-60 md:h-80 lg:h-96 bg-gray-50 rounded-lg mb-3 overflow-hidden border border-gray-200">
    </div>

    <div id="message" class="text-center text-base font-medium transition-colors text-gray-700 mb-2 hidden"></div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
  document.addEventListener('DOMContentLoaded', async () => {
    const messageEl = document.getElementById('message');
    const readerEl = document.getElementById('reader');
    const switchBtn = document.getElementById('switchCameraBtn');
    const cameraLabelEl = document.getElementById('cameraLabel');
    const cameraSelect = document.getElementById('cameraSelect');

    const alertEl = document.getElementById('alert');
    const alertIcon = document.getElementById('alertIcon');
    const alertTitle = document.getElementById('alertTitle');
    const alertBody = document.getElementById('alertBody');
    const closeAlertBtn = document.getElementById('closeAlert');

    let qrCodeScanner = null;
    let isProcessing = false;
    let lastDecoded = null;
    const DUPLICATE_COOLDOWN = 2000;
    let lastTime = 0;
    let alertTimeout = null;

    let cameras = [];
    let currentIndex = 0;
    let fallbackConfigs = [
      { config: { facingMode: "environment" }, label: "Rear (environment)" },
      { config: { facingMode: "user" }, label: "Front (user)" }
    ];

    const isIos = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;

    function showInlineMessage(text = '', ok = true) {
      messageEl.textContent = text;
      messageEl.classList.toggle('text-green-600', ok);
      messageEl.classList.toggle('text-red-600', !ok);
    }
    function clearInlineMessage(){ messageEl.textContent = ''; messageEl.classList.remove('text-green-600','text-red-600') }

    function resetAlertClasses() {
      alertEl.classList.remove('border-[#641b0f]','border-green-500','border-red-500','border-yellow-400','border-blue-500');
      alertTitle.classList.remove('text-[#641b0f]','text-green-700','text-red-700','text-yellow-700','text-blue-700');
      const svg = alertIcon.querySelector('svg'); if (svg) svg.classList.remove('text-[#641b0f]','text-green-500','text-red-500','text-yellow-400','text-blue-500');
    }

    function showAlert(type = 'info', title = '', body = '', autoHide = true, ms = 5000) {
      resetAlertClasses();
      alertTitle.textContent = title || 'Info'; alertBody.textContent = body || '';
      switch(type) {
        case 'success': alertEl.classList.add('border-green-500'); alertTitle.classList.add('text-green-700'); alertIcon.querySelector('svg').classList.add('text-green-500'); break;
        case 'error': alertEl.classList.add('border-red-500'); alertTitle.classList.add('text-red-700'); alertIcon.querySelector('svg').classList.add('text-red-500'); break;
        case 'warning': alertEl.classList.add('border-yellow-400'); alertTitle.classList.add('text-yellow-700'); alertIcon.querySelector('svg').classList.add('text-yellow-400'); break;
        default: alertEl.classList.add('border-[#641b0f]'); alertTitle.classList.add('text-[#641b0f]'); alertIcon.querySelector('svg').classList.add('text-[#641b0f]');
      }
      alertEl.classList.remove('hidden');
      if (alertTimeout) clearTimeout(alertTimeout);
      if (autoHide) alertTimeout = setTimeout(() => { alertEl.classList.add('hidden'); }, ms);
    }
    function hideAlert(){ if (alertTimeout) clearTimeout(alertTimeout); alertEl.classList.add('hidden'); }
    closeAlertBtn.addEventListener('click', hideAlert);

    const qrSuccess = async (decodedText) => {
      const now = Date.now();
      if (decodedText === lastDecoded && (now - lastTime) < DUPLICATE_COOLDOWN) return;
      lastDecoded = decodedText; lastTime = now;
      if (isProcessing) return;
      isProcessing = true;
      showInlineMessage('Memproses...', true);

      try {
        const response = await fetch("{{ route('scan') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ code: decodedText })
        });
        const data = await response.json();
        const ok = data.status === 'ok' || data.status === 'success';
        showInlineMessage(data.message || (ok ? 'Berhasil' : 'Gagal'), ok);
        showAlert(ok ? 'success' : 'error', ok ? (data.title || 'Berhasil') : (data.title || 'Gagal'), data.message || '', true, 4000);
      } catch (err) {
        console.error('Fetch error:', err);
        showInlineMessage('Terjadi kesalahan. Coba lagi.', false);
        showAlert('error', 'Terjadi kesalahan', 'Coba lagi atau periksa koneksi.', true, 5000);
      } finally {
        setTimeout(()=>{ isProcessing = false; }, 400);
      }
    };

    const qrError = (err) => { /* per-frame errors, ignore or log */ };

    const updateCameraLabel = (text) => { cameraLabelEl.textContent = text || ''; };

    const startScanner = async (cameraOrConfig) => {
      try {
        if (!qrCodeScanner) qrCodeScanner = new Html5Qrcode(readerEl.id);
        try { await qrCodeScanner.stop(); } catch(e) {}
        const qrbox = { width: Math.min(320, Math.max(200, readerEl.clientWidth - 20)), height: Math.min(320, Math.max(200, readerEl.clientHeight - 20)) };
        await qrCodeScanner.start(cameraOrConfig, { fps: 10, qrbox, formatsToSupport: [ Html5QrcodeSupportedFormats.QRCODE ] }, qrSuccess, qrError);
        window._qrCodeScanner = qrCodeScanner;
        clearInlineMessage();
      } catch (err) {
        console.error('Start scanner error:', err);
        showInlineMessage('Gagal mengakses kamera. Coba refresh & beri izin.', false);
        showAlert('error', 'Gagal mengakses kamera', 'Coba refresh & beri izin kamera pada browser.', true, 6000);
      }
    };

    const restartWithIndex = async (index) => {
      if (cameras.length > 0) {
        currentIndex = index % cameras.length;
        const cam = cameras[currentIndex];
        updateCameraLabel(cam.label || ('Camera ' + (currentIndex + 1)));
        await startScanner(cam.id || cam.deviceId || cam);
      } else {
        currentIndex = index % fallbackConfigs.length;
        const conf = fallbackConfigs[currentIndex];
        updateCameraLabel(conf.label);
        await startScanner({ facingMode: conf.config.facingMode });
      }
    };

    switchBtn.addEventListener('click', async () => {
      if (cameras.length > 1) await restartWithIndex((currentIndex + 1) % Math.max(1, cameras.length));
      else await restartWithIndex((currentIndex + 1) % fallbackConfigs.length);
    });

    cameraSelect.addEventListener('change', async (e) => {
      const idx = parseInt(e.target.value, 10);
      if (!isNaN(idx)) await restartWithIndex(idx);
    });

    try {
      const rawCams = await Html5Qrcode.getCameras();
      if (rawCams && rawCams.length > 0) {
        cameras = rawCams.map(c => ({ id: c.id, label: c.label || '' }));
        let preferredIndex = cameras.findIndex(c => /back|rear|environment|wide/i.test(c.label));
        if (preferredIndex === -1) preferredIndex = 0;

        if (cameras.length > 1) {
          cameraSelect.innerHTML = '';
          cameras.forEach((c, i) => {
            const opt = document.createElement('option');
            opt.value = i; opt.textContent = c.label || `Camera ${i + 1}`;
            cameraSelect.appendChild(opt);
          });
          cameraSelect.classList.remove('hidden');
        } else {
          cameraSelect.classList.add('hidden');
        }

        if (isIos) {
          await restartWithIndex(0);
        } else {
          await restartWithIndex(preferredIndex);
        }
      } else {
        cameras = [];
        cameraSelect.classList.add('hidden');
        await restartWithIndex(0);
      }
    } catch (err) {
      console.error('QR init error:', err);
      showInlineMessage('Tidak dapat mengakses kamera. Pastikan HTTPS & beri izin kamera.', false);
      showAlert('error', 'Tidak dapat mengakses kamera', 'Pastikan halaman dijalankan di HTTPS & beri izin kamera pada browser.', true, 7000);
    }

    window.addEventListener('beforeunload', async () => {
      try { if (qrCodeScanner) await qrCodeScanner.stop(); } catch(e) {}
    });
  });
</script>
@endpush