<section id="wedding-gift"
    class="relative min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat overflow-hidden"
    style="background-image: url('{{ asset('assets/images/background-red.png') }}');">

    <img class="wedding-gift-leaf-r absolute bottom-[-70px] right-[20px] lg:bottom-[-100px] lg:right-[-100px] w-[40%] sm:w-[30%] lg:w-[25%] h-auto z-10"
        src="{{ asset('assets/images/gallery-leaf-r.png') }}" alt="flower" data-aos="fade-left" />

    <img class="wedding-gift-bride absolute bottom-[-100px] right-[-50px] md:bottom-[-200px] md:right-[-60px] lg:bottom-[-300px] lg:right-[-100px] w-[60%] md:w-[45%] lg:w-[30%] h-auto z-10"
        src="{{ asset('assets/images/pengantin-wanita.png') }}" alt="flower" data-aos="fade-up" />

    <img class="wedding-gift-leaf-l absolute bottom-[-70px] left-[20px] lg:bottom-[-100px] lg:left-[-100px] w-[40%] sm:w-[30%] lg:w-[25%] h-auto z-10"
        src="{{ asset('assets/images/gallery-leaf-l.png') }}" alt="flower" data-aos="fade-right" />

    <img class="wedding-gift-groom absolute bottom-[-100px] left-[-50px] md:bottom-[-200px] md:left-[-60px] lg:bottom-[-300px] lg:left-[-100px] w-[60%] md:w-[45%] lg:w-[30%] h-auto z-10"
        src="{{ asset('assets/images/pengantin-pria.png') }}" alt="flower" data-aos="fade-up" />

    <img class="wedding-gift-flower-3 absolute bottom-[-40px] right-[-60px] lg:bottom-[-120px] lg:w-[15%] md:w-[25%] w-[35%] h-auto z-20"
        src="{{ asset('assets/images/flower3.png') }}" alt="flower" data-aos="zoom-in" />

    <img class="wedding-gift-flower-4 absolute bottom-[-40px] left-[-60px] lg:bottom-[-120px] lg:w-[15%] md:w-[25%] w-[35%] h-auto z-20"
        src="{{ asset('assets/images/flower4.png') }}" alt="flower" data-aos="zoom-in" />

    <div
        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-screen-md px-4 text-center">

        <h2 class="wedding-gift-title font-brittany text-3xl sm:text-5xl md:text-6xl text-white mb-6 z-10"
            data-aos="fade-down">
            Wedding Gift
        </h2>

        <div class="wedding-gift-text font-dmSerif text-sm md:text-base lg:text-lg text-white leading-relaxed mt-5 z-10"
            data-aos="fade-up">
            Terima kasih telah menambah semangat kegembiraan pernikahan kami dengan kehadiran dan hadiah indah Anda.
        </div>
        <button id="cashless" class="relative overflow-hidden group text-2xl font-brittany rounded-full 
               bg-[#fffded] text-[#641b0f] shadow-lg shadow-[#fffded]/20
               transition-transform duration-300 ease-out
               hover:scale-105 mt-4">
            <span class="absolute inset-0 bg-gradient-to-r from-red-200 via-white to-red-200
                     transform -translate-x-full group-hover:translate-x-0
                     transition-transform duration-500 ease-out"></span>

            <span class="relative z-10 flex items-center gap-2 px-10 py-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
                Cashless
            </span>
        </button>
    </div>

    @include('partials.qris-modal')

</section>

@include('partials.footer')