@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
  <div class="w-full max-w-lg p-6">
    <h2 class="text-2xl font-dmSerif font-semibold text-[#641b0f] mb-4 text-center">
      Scan Barcode Undangan
    </h2>

    <div class="mb-4 flex gap-2 items-center justify-center">
      <select id="cameraSelect" class="p-2 border rounded" style="min-width:200px;">
        <option value="">Memuat kamera...</option>
      </select>
      <button id="startBtn" class="px-3 py-2 bg-green-600 text-white rounded">Start</button>
      <button id="stopBtn" class="px-3 py-2 bg-gray-500 text-white rounded">Stop</button>
    </div>

    <!-- removed fixed height class (h-64) so CSS below controls responsiveness -->
    <div id="reader" class="w-full bg-gray-100 rounded-lg mb-4 overflow-hidden relative">
      <!-- scanning area -->
    </div>

    <div class="mb-3 text-center">
      <input id="fileInput" type="file" accept="image/*" class="mb-2" />
      <div class="text-sm text-gray-600">Jika kamera bermasalah, unggah gambar QR sebagai cadangan.</div>
    </div>

    <div id="message" class="text-center text-lg font-medium transition-colors mt-2"></div>
    <div id="consoleLog" class="mt-3 text-xs text-gray-500 whitespace-pre-wrap"></div>
  </div>
</div>
@endsection

@push('scripts')
<!-- CSS overrides: hide html5-qrcode visual focus box but keep scanner active. Make reader responsive. -->
<style>
  /* Hide decorative qrbox / overlay elements created by html5-qrcode (visual focus box) */
  .html5-qrcode .qrbox,
  .html5-qrcode .qrbox:before,
  .html5-qrcode .qrbox:after,
  .html5-qrcode .scanner-laser,
  .html5-qrcode .scan-region,
  .html5-qrcode .scanning-region,
  .html5-qrcode .scan-region-frame,
  .html5-qrcode .html5-qrcode-overlay {
    border: none !important;
    box-shadow: none !important;
    background: transparent !important;
    display: none !important;
  }

  /* Responsive scanning container */
  #reader {
    width: 100%;
    max-width: 100%;
    height: min(60vh, 420px);
    /* responsive height: up to 60% of viewport but not huge */
    min-height: 200px;
    border-radius: 0.5rem;
    overflow: hidden;
  }

  /* Force video/canvas inserted by html5-qrcode to cover the container */
  #reader video,
  #reader canvas {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
  }

  /* Slightly different desktop height */
  @media (min-width: 768px) {
    #reader {
      height: 320px;
    }
  }
</style>

<script src="https://unpkg.com/html5-qrcode"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
  const messageEl = document.getElementById('message');
  const readerEl = document.getElementById('reader');

  const DEBOUNCE_MS = 800;
  const lastScanTimestamps = {};
  let processing = false;

  let audioCtx = null;
  const getAudioCtx = () => {
    if (!audioCtx) {
      try {
        audioCtx = new (window.AudioContext || window.webkitAudioContext)();
      } catch (e) {
        audioCtx = null;
      }
    }
    return audioCtx;
  };
  document.addEventListener('click', () => {
    const ctx = getAudioCtx();
    if (ctx && ctx.state === 'suspended') ctx.resume();
  }, { once: true });

  const beep = (() => {
    return () => {
      const ctx = getAudioCtx();
      if (!ctx) return;
      const o = ctx.createOscillator();
      const g = ctx.createGain();
      o.type = 'sine';
      o.frequency.value = 900;
      g.gain.value = 0.06;
      o.connect(g);
      g.connect(ctx.destination);
      o.start();
      setTimeout(() => { o.stop(); }, 120);
    };
  })();

  const flash = (color = 'rgba(34,197,94,0.12)') => {
    readerEl.style.boxShadow = `0 0 0 9999px ${color} inset`;
    setTimeout(() => { readerEl.style.boxShadow = ''; }, 140);
  };

  const showMessage = (text, colorClass = 'text-gray-700') => {
    messageEl.textContent = text;
    messageEl.classList.remove('text-red-600','text-green-600','text-yellow-600','text-gray-700');
    messageEl.classList.add(colorClass);
  };

  const qrCodeScanner = new Html5Qrcode(readerEl.id, /* verbose= */ false);

  Html5Qrcode.getCameras()
    .then(cameras => {
      console.log('Cameras found:', cameras);
      if (!cameras || !cameras.length) throw new Error('No camera found');

      let chosenConfig = { facingMode: { ideal: "environment" } };

      const backCamera = cameras.find(cam => /back|rear|environment/i.test(cam.label));
      if (backCamera && backCamera.id) {
        chosenConfig = { deviceId: { exact: backCamera.id } };
        console.log('Using deviceId for camera:', backCamera);
      } else {
        console.log('Using facingMode environment fallback');
      }

      const onScanSuccess = async (decodedText, decodedResult) => {
        const now = Date.now();
        if (lastScanTimestamps[decodedText] && (now - lastScanTimestamps[decodedText]) < DEBOUNCE_MS) return;
        lastScanTimestamps[decodedText] = now;
        if (processing) return;
        processing = true;

        showMessage('Memproses...', 'text-gray-700');
        if (navigator.vibrate) navigator.vibrate(60);
        flash('rgba(59,130,246,0.12)');

        try {
          const res = await fetch("{{ route('scan') }}", {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ code: decodedText })
          });

          let data;
          try { data = await res.json(); } catch (e) { data = { status: 'error', message: 'Response bukan JSON' }; }

          if (res.ok && data.status === 'ok') {
            showMessage(data.message || 'Tamu terdaftar — Checked in', 'text-green-600');
            beep();
            flash('rgba(16,185,129,0.12)');
          } else if (res.ok && (data.status === 'already' || data.status === 'already_scanned')) {
            showMessage(data.message || 'Sudah discan sebelumnya', 'text-yellow-600');
            beep();
            flash('rgba(234,179,8,0.12)');
          } else {
            showMessage(data.message || 'Gagal memproses kode', 'text-red-600');
            flash('rgba(220,38,38,0.12)');
          }
        } catch (err) {
          console.error('Fetch error:', err);
          showMessage('Terjadi kesalahan koneksi', 'text-red-600');
          flash('rgba(220,38,38,0.12)');
        } finally {
          processing = false;
        }
      };

      const onScanFailure = (error) => {
        console.debug('scan failure:', error);
      };

      const isMobile = /Mobi|Android|iPhone|iPad/i.test(navigator.userAgent);
      const qrbox = isMobile ? { width: 220, height: 140 } : { width: 300, height: 200 };
      const cfg = { fps: 10, qrbox, aspectRatio: isMobile ? 1.6 : 1.78 };

      qrCodeScanner.start(
        chosenConfig,
        cfg,
        onScanSuccess,
        onScanFailure
      ).then(() => {
        console.log('QR scanner started with config', chosenConfig, cfg);
        showMessage('Arahkan kamera ke QR code', 'text-gray-700');
      }).catch(err => {
        console.error('QR start error:', err);
        if (err && err.name === 'NotAllowedError') {
          showMessage('Izin kamera ditolak — izinkan kamera di pengaturan browser.', 'text-red-600');
        } else if (err && err.message && err.message.includes('unsupported constraint')) {
          showMessage('Kamera tidak mendukung konfigurasi yang diminta. Mencoba fallback...', 'text-yellow-600');
          if (chosenConfig.deviceId) {
            qrCodeScanner.start({ facingMode: { ideal: "environment" } }, cfg, onScanSuccess, onScanFailure)
              .then(() => showMessage('Arahkan kamera ke QR code', 'text-gray-700'))
              .catch(e => {
                console.error('Fallback start error:', e);
                showMessage('Gagal memulai kamera.', 'text-red-600');
              });
          }
        } else {
          showMessage('Gagal memulai scanner. Periksa izin kamera dan koneksi (HTTPS).', 'text-red-600');
        }
      });

      window.addEventListener('beforeunload', async () => {
        try { await qrCodeScanner.stop(); } catch(e) {}
      });

    })
    .catch(err => {
      console.error('QR init error:', err);
      if (err && err.name === 'NotAllowedError') {
        showMessage('Izin kamera ditolak — izinkan kamera di browser.', 'text-red-600');
      } else {
        showMessage('Tidak dapat mengakses kamera. Pastikan halaman diakses via HTTPS dan berikan izin.', 'text-red-600');
      }
    });
});
</script>

@endpush