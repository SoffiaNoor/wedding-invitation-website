<section id="wedding-gift"
    class="relative min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat overflow-hidden"
    style="background-image: url('{{ asset('assets/images/background-cream.png') }}');">

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

        <h2 class="wedding-gift-title font-brittany text-3xl sm:text-5xl md:text-6xl text-[#641b0f] mb-6 z-10"
            data-aos="fade-down">
            Wedding Gift
        </h2>

        <div class="wedding-gift-text font-dmSerif text-sm md:text-base lg:text-lg text-[#641b0f] leading-relaxed mt-5 z-10"
            data-aos="fade-up">
            Doa restu Anda adalah anugerah terindah. Jika berkenan, kami menyediakan pilihan hadiah secara cashless.
        </div>
        <img class="mx-auto my-2 lg:w-[40%] w-[60%]" src="{{ asset('assets/images/qris-wedding2.png') }}" />
    </div>
</section>

@include('partials.footer')