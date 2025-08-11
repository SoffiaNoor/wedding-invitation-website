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
  document.addEventListener('DOMContentLoaded', () => {
    const messageEl = document.getElementById('message');
    const readerEl = document.getElementById('reader');

    Html5Qrcode.getCameras()
      .then(cameras => {
        if (!cameras.length) throw new Error('No camera found');
        const qrCodeScanner = new Html5Qrcode(readerEl.id);

        qrCodeScanner.start(
          { facingMode: 'environment' },
          { fps: 10, formatsToSupport: [ Html5QrcodeSupportedFormats.QRCODE ] },
          async (decodedText) => {
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
              messageEl.textContent = data.message;
              messageEl.classList.toggle('text-green-600', data.status === 'ok');
              messageEl.classList.toggle('text-red-600', data.status !== 'ok');
            } catch (err) {
              console.error('Fetch error:', err);
              messageEl.textContent = 'Terjadi kesalahan. Coba lagi.';
              messageEl.classList.add('text-red-600');
            } finally {
              await qrCodeScanner.stop();
            }
          }
        );
      })
      .catch(err => {
        console.error('QR init error:', err);
        const messageEl = document.getElementById('message');
        messageEl.textContent = 'Tidak dapat mengakses kamera.';
        messageEl.classList.add('text-red-600');
      });
  });
</script>
@endpush