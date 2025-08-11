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

    const DEBOUNCE_MS = 800; 
    const lastScanTimestamps = {};
    let processing = false; 

    const beep = (() => {
      try {
        const ctx = new (window.AudioContext || window.webkitAudioContext)();
        return () => {
          const o = ctx.createOscillator();
          const g = ctx.createGain();
          o.type = 'sine';
          o.frequency.value = 900;
          g.gain.value = 0.1;
          o.connect(g);
          g.connect(ctx.destination);
          o.start();
          setTimeout(() => { o.stop(); }, 120);
        };
      } catch (e) {
        return () => {};
      }
    })();

    const flash = (color = 'rgba(34,197,94,0.12)') => {
      readerEl.style.boxShadow = `0 0 0 9999px ${color} inset`;
      setTimeout(() => { readerEl.style.boxShadow = ''; }, 140);
    };

    Html5Qrcode.getCameras()
      .then(cameras => {
        if (!cameras.length) throw new Error('No camera found');

        const cameraId = cameras[0].id;
        const qrCodeScanner = new Html5Qrcode(readerEl.id, /* verbose= */ false);

        const onScanSuccess = async (decodedText, decodedResult) => {
          const now = Date.now();

          if (lastScanTimestamps[decodedText] && (now - lastScanTimestamps[decodedText]) < DEBOUNCE_MS) {
            return;
          }
          lastScanTimestamps[decodedText] = now;

          if (processing) {
            return;
          }
          processing = true;

          messageEl.textContent = 'Memproses...';
          messageEl.classList.remove('text-red-600', 'text-green-600', 'text-yellow-600');
          messageEl.classList.add('text-gray-700');

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
            try {
              data = await res.json();
            } catch (e) {
              data = { status: 'error', message: 'Response bukan JSON' };
            }

            if (res.ok && data.status === 'ok') {
              messageEl.textContent = data.message || 'Tamu terdaftar — Checked in';
              messageEl.classList.remove('text-red-600');
              messageEl.classList.add('text-green-600');
              beep();
              flash('rgba(16,185,129,0.12)');
            } else if (res.ok && (data.status === 'already' || data.status === 'already_scanned')) {
              messageEl.textContent = data.message || 'Sudah discan sebelumnya';
              messageEl.classList.remove('text-green-600');
              messageEl.classList.add('text-yellow-600');
              beep(); 
              flash('rgba(234,179,8,0.12)'); 
            } else {
              messageEl.textContent = data.message || 'Gagal memproses kode';
              messageEl.classList.remove('text-green-600');
              messageEl.classList.add('text-red-600');
              flash('rgba(220,38,38,0.12)'); 
            }
          } catch (err) {
            console.error('Fetch error:', err);
            messageEl.textContent = 'Terjadi kesalahan koneksi';
            messageEl.classList.remove('text-green-600');
            messageEl.classList.add('text-red-600');
            flash('rgba(220,38,38,0.12)');
          } finally {
            processing = false;
          }
        };

        const onScanFailure = (error) => {
        };

        qrCodeScanner.start(
          { deviceId: { exact: cameraId } },
          { fps: 10, qrbox: { width: 300, height: 200 }, aspectRatio: 1.78 },
          onScanSuccess,
          onScanFailure
        ).catch(err => {
          console.error('QR start error:', err);
          messageEl.textContent = 'Gagal memulai scanner. Periksa izin kamera.';
          messageEl.classList.add('text-red-600');
        });

        window.addEventListener('beforeunload', async () => {
          try { await qrCodeScanner.stop(); } catch(e) {}
        });

      })
      .catch(err => {
        console.error('QR init error:', err);
        messageEl.textContent = 'Tidak dapat mengakses kamera.';
        messageEl.classList.add('text-red-600');
      });
  });
</script>
@endpush