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
    let isProcessing = false;       // prevents concurrent fetches
    let lastDecoded = null;         // simple duplicate filter
    const DUPLICATE_COOLDOWN = 2000; // ms - ignore same code within this time
    let lastTime = 0;

    const showMessage = (text, ok = true) => {
      messageEl.textContent = text;
      messageEl.classList.toggle('text-green-600', ok);
      messageEl.classList.toggle('text-red-600', !ok);
    };

    try {
      const cameras = await Html5Qrcode.getCameras();
      if (!cameras || cameras.length === 0) throw new Error('No camera found');

      // Prefer back/rear/environment camera if available (works better on phones)
      const backCamera = cameras.find(c => /back|rear|environment/i.test(c.label)) || cameras[0];

      qrCodeScanner = new Html5Qrcode(readerEl.id);

      const qrSuccess = async (decodedText /*, decodedResult */) => {
        const now = Date.now();

        // Ignore duplicate results very quickly in a row
        if (decodedText === lastDecoded && (now - lastTime) < DUPLICATE_COOLDOWN) {
          return;
        }
        lastDecoded = decodedText;
        lastTime = now;

        // Prevent overlapping requests
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
          // DO NOT stop the scanner here — we want unlimited scanning.
          isProcessing = false;
        }
      };

      // Start the camera using the camera id (more reliable on mobile)
      await qrCodeScanner.start(
        backCamera.id, // pass device id to ensure back camera on mobiles
        {
          fps: 10,
          // qrbox helps with performance and UI; it's responsive to the reader size
          qrbox: {
            width: Math.min(320, readerEl.clientWidth - 20),
            height: Math.min(320, readerEl.clientHeight - 20)
          },
          // support only QR codes
          formatsToSupport: [ Html5QrcodeSupportedFormats.QRCODE ]
        },
        qrSuccess,
        (errorMessage) => {
          // Optional per-frame error callback (useful for debugging)
          // console.debug('QR frame error:', errorMessage);
        }
      );

      // Optional: expose stop/start controls if you want to manually stop/resume
      window._qrCodeScanner = qrCodeScanner;

    } catch (err) {
      console.error('QR init error:', err);
      showMessage('Tidak dapat mengakses kamera.', false);
    }
  });
</script>
@endpush