<section id="barcode"
    class="relative h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat overflow-hidden"
    style="background-image: url('{{ asset('assets/images/background-cream.png') }}');">

    <img class="barcode-flower-t absolute top-0 lg:w-[25%] w-[40%] h-auto z-20"
        src="{{ asset('assets/images/flower-on-top.png') }}" alt="flower" />
    <img class="barcode-flower-r absolute bottom-0 right-0 lg:w-[25%] w-[40%] h-auto z-20"
        src="{{ asset('assets/images/couple-flower-r.png') }}" alt="flower" />
    <img class="barcode-flower-l absolute bottom-0 left-0 lg:w-[25%] w-[40%] h-auto z-20"
        src="{{ asset('assets/images/couple-flower-l.png') }}" alt="flower" />

    <div class="relative z-30 flex flex-col items-center justify-center px-4 text-center w-full max-w-2xl"
        data-aos="fade-up" data-aos-delay="200">

        <h2 class="font-dmSerif text-[#641b0f] text-lg sm:text-xl md:text-2xl lg:text-3xl leading-relaxed">
            Barcode <br class="hidden sm:block">
            to enter our wedding
        </h2>

        <div class="mt-6 sm:mt-8 md:mt-10" data-aos="zoom-in" data-aos-delay="400">
            {!! Milon\Barcode\Facades\DNS2DFacade::getBarcodeSVG($invitation->code, 'QRCODE', 10, 10) !!}
        </div>

        <p class="mt-6 font-dmSerif text-[#641b0f] text-sm sm:text-base md:text-lg opacity-80" data-aos="fade-up"
            data-aos-delay="600">
            Show this barcode at the venue entrance
        </p>
    </div>
</section>