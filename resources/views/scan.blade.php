@extends('layouts.app')


@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 p-4">
  <div class="w-full max-w-md sm:max-w-lg md:max-w-2xl bg-white shadow-lg rounded-2xl overflow-hidden">
    <div class="p-4 sm:p-6 md:p-8">
      <h2 class="text-xl sm:text-2xl md:text-3xl font-dmSerif font-semibold text-[#641b0f] mb-4 text-center">
        Scan Barcode Undangan
      </h2>


      <!-- Controls: camera label + select + switch button -->
      <div class="flex flex-col sm:flex-row items-center sm:justify-between gap-3 mb-3">
        <div id="cameraLabel" class="text-sm text-gray-600 text-center sm:text-left">Mencari kamera…</div>


        <div class="flex items-center gap-2 w-full sm:w-auto">
          <select id="cameraSelect" class="hidden sm:inline-block p-2 border rounded-md text-sm bg-white">
            <!-- populated by JS -->
          </select>


          <button id="switchCameraBtn"
            class="w-full sm:w-auto px-4 py-2 rounded-md text-sm font-medium bg-[#641b0f] text-white shadow-sm hover:opacity-95 focus:outline-none"
            aria-label="Switch Camera">
            Switch Camera
          </button>
        </div>
      </div>


      <!-- Reader area: responsive height, keeps aspect on larger screens -->
      <div id="reader" class="w-full bg-black rounded-lg overflow-hidden flex items-center justify-center mb-3"
        style="height: 36vw; max-height: 480px; min-height: 220px;">
        <!-- html5-qrcode will inject the video/canvas here -->
        <div class="text-gray-300 text-sm">Memuat kamera…</div>
      </div>


      <div id="message" class="text-center text-base sm:text-lg font-medium transition-colors h-8"></div>


      <!-- Optional hint / instructions -->
      <div class="mt-4 text-xs text-gray-500 text-center">
        Pastikan halaman dijalankan melalui HTTPS (atau localhost) dan berikan izin kamera jika diminta.
      </div>
    </div>
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

    let qrCodeScanner;
    let isProcessing = false;
    let lastDecoded = null;
    const DUPLICATE_COOLDOWN = 2000; // ms
    let lastTime = 0;

    let cameras = []; // array of {id, label}
    let currentIndex = 0; // index into cameras array or into fallbackConfigs
    let fallbackConfigs = [
      { config: { facingMode: "environment" }, label: "Rear (environment)" },
      { config: { facingMode: "user" }, label: "Front (user)" }
    ];
    let usingFallback = false;

    const showMessage = (text, ok = true) => {
      messageEl.textContent = text;
      messageEl.classList.toggle('text-green-600', ok);
      messageEl.classList.toggle('text-red-600', !ok);
    };

    const qrSuccess = async (decodedText /*, decodedResult */) => {
      const now = Date.now();

      if (decodedText === lastDecoded && (now - lastTime) < DUPLICATE_COOLDOWN) {
        return;
      }
      lastDecoded = decodedText;
      lastTime = now;

      if (isProcessing) return;
      isProcessing = true;

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
        showMessage(data.message || 'Scanned', data.status === 'ok');

      } catch (err) {
        console.error('Fetch error:', err);
        showMessage('Terjadi kesalahan. Coba lagi.', false);
      } finally {
        isProcessing = false;
      }
    };

    const qrError = (err) => {
      // optional per-frame error
      // console.debug('QR frame error:', err);
    };

    const updateCameraLabel = (text) => {
      cameraLabelEl.textContent = text || '';
    };

    const startScanner = async (cameraOrConfig) => {
      try {
        if (!qrCodeScanner) qrCodeScanner = new Html5Qrcode(readerEl.id);

        // make sure to stop previous stream before starting new one
        try { await qrCodeScanner.stop(); } catch (e) { /* ignore if not started */ }

        const qrbox = {
          width: Math.min(320, readerEl.clientWidth - 20),
          height: Math.min(320, readerEl.clientHeight - 20)
        };

        await qrCodeScanner.start(
          cameraOrConfig,
          {
            fps: 10,
            qrbox,
            formatsToSupport: [ Html5QrcodeSupportedFormats.QRCODE ]
          },
          qrSuccess,
          qrError
        );

        // expose to console for debugging
        window._qrCodeScanner = qrCodeScanner;

      } catch (err) {
        console.error('Start scanner error:', err);
        showMessage('Gagal mengakses kamera. Coba refresh & beri izin.', false);
      }
    };

    const restartWithIndex = async (index) => {
      if (cameras.length > 0) {
        usingFallback = false;
        currentIndex = index % cameras.length;
        const cam = cameras[currentIndex];
        updateCameraLabel(cam.label || ('Camera ' + (currentIndex + 1)));
        await startScanner(cam.id || cam.deviceId || cam); // device id string
      } else {
        // fallback to facingMode configs
        usingFallback = true;
        currentIndex = index % fallbackConfigs.length;
        const conf = fallbackConfigs[currentIndex];
        updateCameraLabel(conf.label);
        await startScanner({ facingMode: conf.config.facingMode });
      }
    };

    // switch button handler: cycle to next camera
    switchBtn.addEventListener('click', async () => {
      if (cameras.length > 1) {
        await restartWithIndex((currentIndex + 1) % Math.max(1, cameras.length));
      } else {
        // toggle fallback (rear <-> front)
        await restartWithIndex((currentIndex + 1) % fallbackConfigs.length);
      }
    });

    // camera select handler (if many devices)
    cameraSelect.addEventListener('change', async (e) => {
      const idx = parseInt(e.target.value, 10);
      if (!isNaN(idx)) await restartWithIndex(idx);
    });

    try {
      const rawCams = await Html5Qrcode.getCameras();
      // rawCams: array of {id, label} or empty if not available
      if (rawCams && rawCams.length > 0) {
        // Normalize
        cameras = rawCams.map(c => ({ id: c.id, label: c.label || '' }));

        // Try to prefer a back/rear/environment camera
        let preferredIndex = cameras.findIndex(c => /back|rear|environment|wide/i.test(c.label));
        if (preferredIndex === -1) preferredIndex = 0;

        // If more than one camera, populate select and show
        if (cameras.length > 1) {
          cameraSelect.innerHTML = '';
          cameras.forEach((c, i) => {
            const opt = document.createElement('option');
            opt.value = i;
            opt.textContent = c.label || `Camera ${i + 1}`;
            cameraSelect.appendChild(opt);
          });
          cameraSelect.classList.remove('hidden');
        } else {
          cameraSelect.classList.add('hidden');
        }

        await restartWithIndex(preferredIndex);
      } else {
        // No device ids returned — fallback to facingMode toggle (useful on iOS)
        cameras = [];
        cameraSelect.classList.add('hidden');
        // start with rear first
        await restartWithIndex(0);
      }
    } catch (err) {
      console.error('QR init error:', err);
      showMessage('Tidak dapat mengakses kamera. Pastikan halaman dijalankan di HTTPS & beri izin kamera.', false);
    }

    // Cleanup when page unloads (stop camera)
    window.addEventListener('beforeunload', async () => {
      try { if (qrCodeScanner) await qrCodeScanner.stop(); } catch(e) {}
    });
  });
</script>
@endpush