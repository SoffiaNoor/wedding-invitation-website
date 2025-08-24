<section id="gallery" class="h-screen w-full">
    <div
        class="h-screen grid grid-cols-2 grid-rows-3 md:grid-cols-2 md:grid-rows-3 lg:grid-cols-3 lg:grid-rows-2 h-full w-full">
        <div class="relative overflow-hidden h-full lg:col-start-1 lg:row-start-1">
            <img src="{{ asset('assets/images-edit/2-new.png') }}" alt="foto 1"
                class="w-full h-full object-cover transform transition-transform duration-500 hover:scale-110">
        </div>

        <div class="flex items-center justify-center p-6 sm:p-8 text-center bg-cover bg-center bg-no-repeat text-white h-full lg:col-start-2 lg:row-start-1"
            style="background-image: url('{{ asset('assets/images/background-red.png') }}');">
            <div class="w-full max-w-lg lg:px-2 px-0">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-brittany text-white">Piece of our Memories
                </h2>
                <p class="font-dmSerif mt-2 text-xs sm:text-sm md:text-base opacity-90">05 September 2025 • Surabaya</p>
                <div id="countdown" class="mt-6 grid grid-cols-4 gap-2 text-center items-center w-full"
                    aria-live="polite" role="timer" aria-label="Hitung mundur menuju 5 September 2025">
                    <div
                        class="flex flex-col items-center justify-center bg-white/8 backdrop-blur-sm border border-white/8 rounded-xl p-2 min-h-[56px]">
                        <span id="days"
                            class="text-sm sm:text-base md:text-lg font-semibold leading-none transform-gpu transition-transform duration-300"
                            style="will-change: transform">0</span>
                        <span class="text-[9px] uppercase tracking-widest opacity-80">Hari</span>
                    </div>
                    <div
                        class="flex flex-col items-center justify-center bg-white/8 backdrop-blur-sm border border-white/8 rounded-xl p-2 min-h-[56px]">
                        <span id="hours"
                            class="text-sm sm:text-base md:text-lg font-semibold leading-none transform-gpu transition-transform duration-300"
                            style="will-change: transform">0</span>
                        <span class="text-[9px] uppercase tracking-widest opacity-80">Jam</span>
                    </div>
                    <div
                        class="flex flex-col items-center justify-center bg-white/8 backdrop-blur-sm border border-white/8 rounded-xl p-2 min-h-[56px]">
                        <span id="minutes"
                            class="text-sm sm:text-base md:text-lg font-semibold leading-none transform-gpu transition-transform duration-300"
                            style="will-change: transform">0</span>
                        <span class="text-[9px] uppercase tracking-widest opacity-80">Menit</span>
                    </div>
                    <div
                        class="flex flex-col items-center justify-center bg-white/8 backdrop-blur-sm border border-white/8 rounded-xl p-2 min-h-[56px]">
                        <span id="seconds"
                            class="text-sm sm:text-base md:text-lg font-semibold leading-none transform-gpu transition-transform duration-300"
                            style="will-change: transform">0</span>
                        <span class="text-[9px] uppercase tracking-widest opacity-80">Detik</span>
                    </div>
                </div>
                <p id="countdown-message" class="mt-3 text-sm md:text-base opacity-95 hidden">We’re married 💍</p>
            </div>
        </div>

        <div class="flex items-center justify-center p-8 text-center bg-cover bg-center bg-no-repeat text-white h-full lg:col-start-1 lg:row-start-2"
            style="background-image: url('{{ asset('assets/images/background-red.png') }}');">
            <div class="flex flex-col items-center justify-center">
                <img src="{{ asset('assets/images/icon-wanita.png') }}" alt="Foto Nabiilah" loading="lazy"
                    class="mb-4 w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 rounded-full object-cover shadow-lg">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-rouge font-semibold text-white">Nabiilah
                </h2>
                <p class="mt-2 text-sm md:text-base font-dmSerif">The Bride</p>
            </div>
        </div>

        <div class="relative overflow-hidden h-full lg:col-start-3 lg:row-start-1">
            <img src="{{ asset('assets/images-edit2/wanita-new.png') }}" alt="foto 2"
                class="w-full h-full object-cover transform transition-transform duration-500 hover:scale-110">
        </div>

        <div class="relative overflow-hidden h-full lg:col-start-2 lg:row-start-2">
            <img src="{{ asset('assets/images-edit2/laki2-new.png') }}" alt="foto 3"
                class="w-full h-full object-cover transform transition-transform duration-500 hover:scale-110">
        </div>

        <div class="flex items-center justify-center p-8 text-center bg-cover bg-center bg-no-repeat text-white h-full lg:col-start-3 lg:row-start-2"
            style="background-image: url('{{ asset('assets/images/background-red.png') }}');">
            <div class="flex flex-col items-center justify-center">
                <img src="{{ asset('assets/images/icon-pria.png') }}" alt="Foto Zulfi" loading="lazy"
                    class="mb-4 w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 rounded-full object-cover shadow-lg">
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-rouge font-semibold text-white">Zulfi</h2>
                <p class="mt-2 text-sm md:text-base font-dmSerif">The Groom</p>
            </div>
        </div>
    </div>
</section>

<script>
    (function () {
    const target = new Date(2025, 8, 5, 9, 0, 0);

    const els = {
        days: document.getElementById('days'),
        hours: document.getElementById('hours'),
        minutes: document.getElementById('minutes'),
        seconds: document.getElementById('seconds')
    };
    const container = document.getElementById('countdown');
    const message = document.getElementById('countdown-message');

    if (container) {
        container.setAttribute('aria-label', 'Hitung mundur menuju 05 September 2025 09:00');
    }

    function setNumber(el, value) {
        if (!el) return;
        const s = String(value);
        if (el.textContent !== s) {
        el.classList.add('scale-110');
        el.textContent = s;
        setTimeout(() => el.classList.remove('scale-110'), 260);
        }
    }

    function pad(n) {
        return String(n).padStart(2, '0');
    }

    function update() {
        const now = new Date();
        let diff = target - now;

        if (diff <= 0) {
        if (container) container.classList.add('hidden');
        if (message) {
            message.classList.remove('hidden');
            message.textContent = "05 September 2025 • 09:00 • We’re married 🎉";
        }
        if (typeof timer !== 'undefined' && timer !== null) clearInterval(timer);
        return;
        }

        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        diff -= days * (1000 * 60 * 60 * 24);

        const hours = Math.floor(diff / (1000 * 60 * 60));
        diff -= hours * (1000 * 60 * 60);

        const minutes = Math.floor(diff / (1000 * 60));
        diff -= minutes * (1000 * 60);

        const seconds = Math.floor(diff / 1000);

        setNumber(els.days, days);
        setNumber(els.hours, pad(hours));
        setNumber(els.minutes, pad(minutes));
        setNumber(els.seconds, pad(seconds));
    }

    update();
    let timer = setInterval(update, 1000);
    })();
</script>