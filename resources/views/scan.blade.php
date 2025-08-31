@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
  <div class="w-full max-w-md p-6">
    <h2 class="text-2xl font-dmSerif font-semibold text-[#641b0f] mb-6 text-center">
      Scan Barcode Undangan
    </h2>

    <div id="reader" class="w-full h-64 bg-gray-100 rounded-lg mb-4 overflow-hidden">
    </div>

    <div id="message" class="text-center text-lg font-medium transition-colors"></div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
  document.addEventListener('DOMContentLoaded', async () => {
    const messageEl = document.getElementById('message');
    const readerEl = document.getElementById('reader');

    let qrCodeScanner;
    let isProcessing = false;
    let lastDecoded = null;
    const DUPLICATE_COOLDOWN = 2000; // ms
    let lastTime = 0;

    const showMessage = (text, ok = true) => {
      messageEl.textContent = text;
      messageEl.classList.toggle('text-green-600', ok);
      messageEl.classList.toggle('text-red-600', !ok);
    };

    const detectIsMobileLike = () => {
      // heuristik: userAgent mobile OR touch device with small screen
      const uaMobile = /Mobi|Android|iPhone|iPad|iPod|Windows Phone/i.test(navigator.userAgent);
      const hasTouch = ('ontouchstart' in window) || (navigator.maxTouchPoints && navigator.maxTouchPoints > 1);
      const smallScreen = Math.min(screen.width, screen.height) < 768;
      return uaMobile || (hasTouch && smallScreen);
    };

    try {
      let cameras = await Html5Qrcode.getCameras();
      if (!cameras || cameras.length === 0) throw new Error('No camera found');

      // jika labels kosong (umumnya karena belum ada izin), minta izin dan refresh daftar kamera
      const labelsEmpty = cameras.every(c => !c.label || c.label.trim() === '');
      if (labelsEmpty && navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        try {
          // minta permission (langsung dilepas)
          const stream = await navigator.mediaDevices.getUserMedia({ video: true });
          // hentikan track agar tidak terus on
          stream.getTracks().forEach(t => t.stop());
          cameras = await Html5Qrcode.getCameras();
        } catch (permErr) {
          // kalau user menolak, lanjut dengan apa yang ada
          console.warn('Camera permission denied or unavailable', permErr);
        }
      }

      const isMobileLike = detectIsMobileLike();

      // helper: cari kamera berdasar kata pada label
      const findByLabel = (regex) => cameras.find(c => c.label && regex.test(c.label));

      // pilih kamera: mobile -> prefer back/rear/environment, fallback ke first;
      // desktop/laptop -> prefer front/user if ada, else first
      let chosenCameraId = null;
      if (isMobileLike) {
        const backCam = findByLabel(/back|rear|environment|wide angle|outdoor|kamerabelakang/i);
        chosenCameraId = backCam ? backCam.id : (cameras[0] ? cameras[0].id : null);
      } else {
        const frontCam = findByLabel(/front|user|integrated|face/i);
        chosenCameraId = frontCam ? frontCam.id : (cameras[0] ? cameras[0].id : null);
      }

      qrCodeScanner = new Html5Qrcode(readerEl.id);

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
          // jangan stop scanner -> unlimited scanning
          isProcessing = false;
        }
      };

      // Options
      const config = {
        fps: 10,
        qrbox: {
          width: Math.min(320, readerEl.clientWidth - 20),
          height: Math.min(320, readerEl.clientHeight - 20)
        },
        formatsToSupport: [ Html5QrcodeSupportedFormats.QRCODE ]
      };

      // Jika kita punya deviceId, pakai itu. Kalau tidak (atau tidak berhasil), coba pakai facingMode fallback.
      try {
        if (chosenCameraId) {
          await qrCodeScanner.start(chosenCameraId, config, qrSuccess, (err) => {
            // per-frame error opsional
          });
        } else {
          // fallback ke facingMode (library mendukung object config untuk facingMode)
          const facing = isMobileLike ? { facingMode: { exact: "environment" } } : { facingMode: "user" };
          await qrCodeScanner.start(facing, config, qrSuccess, (err) => {
            // ignore per-frame errors
          });
        }

        window._qrCodeScanner = qrCodeScanner; // expose for debugging/controls
        showMessage('Siap melakukan scan', true);

      } catch (startErr) {
        console.warn('Start camera with chosen id failed, trying opposite/fallback...', startErr);

        // coba kebalikan pilihan (jika mobile pakai user, jika desktop pakai environment), lalu fallback final ke default start()
        try {
          const oppositeFacing = isMobileLike ? { facingMode: "user" } : { facingMode: { exact: "environment" } };
          await qrCodeScanner.start(oppositeFacing, config, qrSuccess, (err) => {});
          window._qrCodeScanner = qrCodeScanner;
          showMessage('Siap melakukan scan (fallback)', true);
        } catch (finalErr) {
          console.error('Final start failed', finalErr);
          showMessage('Tidak dapat mengakses kamera.', false);
        }
      }

    } catch (err) {
      console.error('QR init error:', err);
      showMessage('Tidak dapat mengakses kamera.', false);
    }
  });
</script>
@endpush