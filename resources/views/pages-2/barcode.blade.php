<div id="barcode"
    class="page-section h-screen w-screen flex items-center justify-center bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('assets_new/images/background-red.png') }}');">

    <!-- Flower Decorations -->
    <img class="barcode-flower-t absolute top-0 lg:w-[25%] w-[40%] h-auto z-20"
        src="{{ asset('assets_new/images/flower-on-top.png') }}" alt="flower" />
    <img class="barcode-flower-r absolute bottom-0 right-0 lg:w-[25%] w-[40%] h-auto z-20"
        src="{{ asset('assets_new/images/couple-flower-r.png') }}" alt="flower" />
    <img class="barcode-flower-l absolute bottom-0 left-0 lg:w-[25%] w-[40%] h-auto z-20"
        src="{{ asset('assets_new/images/couple-flower-l.png') }}" alt="flower" />

    <!-- Center Content -->
    <div class="relative z-30 flex flex-col items-center justify-center px-4 text-center max-w-screen-sm w-full"
        data-aos="fade-up" data-aos-delay="200">

        <!-- Title -->
        <h2 class="font-dmSerif text-xl sm:text-2xl md:text-3xl lg:text-4xl text-white leading-relaxed">
            Barcode <br>
            to enter our wedding
        </h2>

        <div class="mt-6 sm:mt-10" data-aos="zoom-in" data-aos-delay="400">
            <img src="{{ asset('assets_new/images/barcode2.png') }}"
                class="mx-auto w-[180px] sm:w-[220px] md:w-[250px] lg:w-[280px] max-w-full" />
        </div>

        <p class="mt-6 font-dmSerif text-sm sm:text-base md:text-lg text-white opacity-80" data-aos="fade-up"
            data-aos-delay="600">
            Show this barcode at the venue entrance
        </p>
    </div>
</div>